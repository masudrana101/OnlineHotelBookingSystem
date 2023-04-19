<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Hotel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{

  public function add_hotel(Request $request)
  {
    if ($request->isMethod('POST')) {
      $data = $request->all();
      $validator = Validator::make($data, [
        'name' => 'required|string',
        'district_id' => 'required|numeric',
        'phone' => 'nullable|string|min:11',
        'email' => 'nullable|email',
        'logo' => 'required|mimes:jpeg,png,jpg,webp|max:1000',
        'address' => 'required|string',
      ]);
      if ($validator->fails()) {
//        return $validator->messages();
        return redirect()->back()
          ->withErrors($validator)
          ->withInput();
      }
      try {

        if ($request->hasFile('logo')) {
          $image = $request->file('logo');
          $name = time() . '.' . $image->getClientOriginalExtension();
          $path = 'hotel_logos/';
          $destinationPath = public_path($path);
          $image->move($destinationPath, $name);
        }

        $hotel_image = '';
        if (isset($name)) {
          $hotel_image = $path . $name;
        }


        $hotel = new Hotel();
        $hotel->manager_id = auth()->id();
        $hotel->district_id = $data['district_id'];
        $hotel->name = $data['name'];
        $hotel->address = $data['address'];
        if (isset($data['phone'])) {
          $hotel->phone = $data['phone'];
        }
        if (isset($data['email'])) {
          $hotel->email = $data['email'];
        }
        if ($hotel_image != '') {
          $hotel->logo = $hotel_image;
        }
//        $hotel->status = strtolower($data['status']);
        if ($hotel->save()) {
          $this->__alert('s', '<strong>Congratulation!! </strong> Hotel added successful.');
          return redirect()->back();
        }
        $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
        return redirect()->back()->withInput();
      } catch (QueryException $e) {
        $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
        return redirect()->back()->withInput();
      }
    }
    $divisions = Division::with('district')->get();
    return view('manager.hotel.add', compact('divisions'));
  }


  public function view_hotel()
  {
    $hotels = Hotel::where('manager_id', auth()->id())->get();
    return view('manager.hotel.view', compact('hotels'));
  }


  public function edit_hotel(Request $request, $id = null)
  {
    $hotel = Hotel::find($id);
    if (isset($hotel) && $hotel->manager_id === auth()->id()) {
      if ($request->isMethod('POST')) {
        $data = $request->all();
        $validator = Validator::make($data, [
          'name' => 'required|string',
          'district_id' => 'required|numeric',
          'phone' => 'nullable|string|min:11',
          'email' => 'nullable|email',
          'logo' => 'nullable|mimes:jpeg,png,jpg,webp|max:1000',
          'address' => 'required|string',
        ]);
        if ($validator->fails()) {
//        return $validator->messages();
          return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        try {

          if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $path = 'hotel_logos/';
            $destinationPath = public_path($path);
            $image->move($destinationPath, $name);
          }

          $hotel_image = '';
          if (isset($name)) {
            $hotel_image = $path . $name;
          }
          $update_data = [
            'name' => $data['name'],
            'district_id' => $data['district_id'],
            'address' => $data['address'],
          ];

          if ($hotel_image != '') {
            $update_data['logo'] = $hotel_image;
          }

          if (isset($data['phone'])) {
            $update_data['phone'] = $data['phone'];
          }

          if (isset($data['email'])) {
            $update_data['email'] = $data['email'];
          }


          if ($hotel->update($update_data)) {
            $this->__alert('s', '<strong>Congratulation!!! </strong> Hotel update successful.');
            return redirect()->route('manager.hotel.view');
          }
          $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
          return redirect()->back()->withInput();
        } catch (QueryException $e) {
          $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
          return redirect()->back()->withInput();
        }
      }
      $divisions = Division::with('district')->get();
      return view('manager.hotel.edit', compact('hotel', 'divisions'));
    }
    $this->__alert('w', '<strong>Sorry!!! </strong> Hotel Not Found.');
    return redirect()->route('manager.hotel.view');
  }

  public function details_hotel($id = null)
  {
    $hotel = Hotel::where('id', $id)->where('manager_id', auth()->id())->first();
    if(isset($hotel)){
     return view('manager.hotel.details', compact('hotel'));
    }
    $this->__alert('w', '<strong>Sorry!!! </strong> Hotel Not Found.');
    return redirect()->route('manager.hotel.view');
  }




  public function delete_hotel(Request $request)
  {
    if ($request->isMethod('DELETE')) {
      $id = $request->post('id');
      $hotel = Hotel::find($id);
        if ($hotel->delete()) {
          return 'success';
        }
    }
  }


  public function view_hotel_admin()
  {
    $hotels = Hotel::all();
    return view('admin.hotel.view', compact('hotels'));
  }


  public function ajax_update_hotel_status(Request $request)
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



}
