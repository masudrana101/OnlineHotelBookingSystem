<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomTypeController extends Controller
{

  public function add_room_type(Request $request)
  {
    if ($request->isMethod('POST')) {
      $data = $request->all();
      $validator = Validator::make($data, [
        'name' => 'required|string',
        'capacity' => 'required|numeric',
        'status' => 'required|string',
      ]);
      if ($validator->fails()) {
//        return $validator->messages();
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
      try {
        $room_type = new RoomType();
        $room_type->name = $data['name'];
        $room_type->capacity = $data['capacity'];
        $room_type->status = strtolower($data['status']);
        if ($room_type->save()) {
          $this->__alert('s', '<strong>Congratulation!! </strong> Room type added successful.');
          return redirect()->back();
        }
        $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
        return redirect()->back()->withInput();
      } catch (QueryException $e) {
        $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
        return redirect()->back()->withInput();
      }
    }
    return view('admin.room_type.add');
  }


  public function view_room_type()
  {
    $roomTypes = RoomType::all();
    return view('admin.room_type.view', compact('roomTypes'));
  }


  public function edit_room_type(Request $request, $id = null)
  {
    $roomType = RoomType::find($id);
    if (isset($roomType)) {
      if ($request->isMethod('POST')) {
        $data = $request->all();
        $validator = Validator::make($data, [
          'name' => 'required|string',
          'capacity' => 'required|numeric',
          'status' => 'required|string',
        ]);
        if ($validator->fails()) {
//        return $validator->messages();
          return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        try {
          $update_data = [
            'name' => $data['name'],
            'capacity' => $data['capacity'],
            'status' => strtolower($data['status']),
          ];
          if ($roomType->update($update_data)) {
            $this->__alert('s', '<strong>Congratulation!!! </strong> Room Type update successful.');
            return redirect()->route('admin.room-type.view');
          }
          $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
          return redirect()->back()->withInput();
        } catch (QueryException $e) {
          $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
          return redirect()->back()->withInput();
        }
      }
      return view('admin.room_type.edit', compact('roomType'));
    }
    $this->__alert('w', '<strong>Sorry!!! </strong> Room type Not Found.');
    return redirect()->route('admin.room-type.view');
  }

  public function ajax_update_room_type_status(Request $request)
  {
    if ($request->isMethod("POST")) {
      $id = $request->post('id');
      $postStatus = $request->post('status');
      $status = 'inactive';
      if (strtolower($postStatus) == 'active' || strtolower($postStatus) == 'inactive') {
        $status = strtolower($postStatus);
      }
      $hotel = Hotel::find($id);
      if ($hotel->update(['status' => $status])) {
        return "success";
      }
    }
  }


  public function delete_room_type(Request $request)
  {
    if ($request->isMethod('DELETE')) {
      $id = $request->post('id');
      $roomType = RoomType::find($id);
      if ($roomType->delete()) {
        return 'success';
      }
    }
  }
}
