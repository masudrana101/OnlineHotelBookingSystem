<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{

  public function add_room(Request $request, $hotel_id = null)
  {
    $hotel = Hotel::where('id', $hotel_id)->where('manager_id', auth()->id())->first();
    if(isset($hotel)) {
      if ($request->isMethod('POST')) {
        $data = $request->all();
//        return $data;
        $validator = Validator::make($data, [
          'room_number' => 'required|string',
          'room_type_id' => 'required|numeric',
          'attached_bath' => 'required|string',
          'type' => 'required|string',
          'amount' => 'required|numeric',
          'status' => 'required|string',
        ]);
        if ($validator->fails()) {
//        return $validator->messages();
          return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        try {
          $room = new Room();
          $room->hotel_id = $hotel_id;
          $room->room_type_id = $data['room_type_id'];
          $room->room_number = $data['room_number'];
          $room->amount = $data['amount'];
          $room->attached_bath = (strtolower($data['attached_bath']) === 'yes') ? true : false;
          $room->type = strtolower($data['type']);
          if(isset($data['description'])) {
            $room->description = $data['description'];
          }
          $room->status = strtolower($data['status']);
          if ($room->save()) {
            $this->__alert('s', '<strong>Congratulation!!! </strong> Room added successful.');
            return redirect()->back();
          }
          $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
          return redirect()->back()->withInput();
        } catch (QueryException $e) {
//          dd($e);
          $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
          return redirect()->back()->withInput();
        }
      }
      $roomTypes = RoomType::where('status', 'active')->get();
      return view('manager.room.add', compact('hotel', 'roomTypes'));
    }
    $this->__alert('w', '<strong>Sorry!!! </strong> Hotel Not Found.');
    return redirect()->route('manager.hotel.view');
  }


  public function view_room()
  {
    $roomTypes = RoomType::all();
    return view('admin.room_type.view', compact('roomTypes'));
  }


  public function edit_room(Request $request, $hotel_id = null,$id = null)
  {
    $hotel = Hotel::where('id', $hotel_id)->where('manager_id', auth()->id())->first();
    if(isset($hotel)) {
      $room = Room::where('id', $id)->where('hotel_id', $hotel_id)->first();
      if (isset($room)) {
        if ($request->isMethod('POST')) {
          $data = $request->all();
          $validator = Validator::make($data, [
            'room_number' => 'required|string',
            'room_type_id' => 'required|numeric',
            'attached_bath' => 'required|string',
            'type' => 'required|string',
            'amount' => 'required|numeric',
          ]);
          if ($validator->fails()) {
//        return $validator->messages();
            return redirect()->back()
              ->withErrors($validator)
              ->withInput();
          }

          try {
            $update_data = [
              'room_number' => $data['room_number'],
              'room_type_id' => $data['room_type_id'],
              'attached_bath' => (strtolower($data['attached_bath']) === 'yes') ? true : false,
              'type' => strtolower($data['type']),
              'amount' => $data['amount'],
            ];
            if(isset($data['description'])){
              $update_data['description'] = $data['description'];
            }
            if ($room->update($update_data)) {
              $this->__alert('s', '<strong>Congratulation!!! </strong> Room update successful.');
              return redirect()->route('manager.hotel.details', $hotel_id);
            }
            $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
            return redirect()->back()->withInput();
          } catch (QueryException $e) {
            $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
            return redirect()->back()->withInput();
          }
        }
        $roomTypes = RoomType::where('status', 'active')->get();
        return view('manager.room.edit', compact('hotel_id','room', 'roomTypes'));
      }
      $this->__alert('w', '<strong>Sorry!!! </strong> Room Not Found.');
      return redirect()->route('manager.hotel.details', $hotel_id);
    }
    $this->__alert('w', '<strong>Sorry!!! </strong> Hotel Not Found.');
    return redirect()->route('manager.hotel.view');
  }

  public function ajax_update_room_status(Request $request)
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


  public function delete_room(Request $request)
  {
    if ($request->isMethod('DELETE')) {
      $id = $request->post('id');
      $hotel_id = $request->post('hotel_id');

      $hotel = Hotel::where('id', $hotel_id)->where('manager_id', auth()->id())->first();
      if(isset($hotel)) {
        $room = Room::where('id', $id)->where('hotel_id', $hotel_id)->first();
        if ($room->delete()) {
          return 'success';
        }
      }
      return $hotel;
    }
  }
}
