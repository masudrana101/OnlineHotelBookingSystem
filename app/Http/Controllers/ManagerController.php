<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\RoomChecking;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{
  public function index()
  {
    return view('manager.index');
  }
    public function change_password(Request $request)
    {
        if ($request->isMethod('post')){
            $validator = Validator::make($request->all(), [
                'old_password' => 'required|min:8',
                'new_password' => 'required|min:8',
                'confirm_password' => 'same:new_password|min:8',

            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $user = Auth::user();
            if(Auth::guard('web')->attempt(['id'=>$user->id,'password' =>$request->post('old_password')])) {
//                return 'true';
                $user->password = Hash::make($request->post('confirm_password'));
                $user->save();
                $this->__alert('s', '<strong>Congratulation!! </strong> Password Update successful.');
                return redirect()->back();
            }
            else{
                $this->__alert('w', '<strong>Sorry!!! </strong>Old Password doesn not match.');
                return redirect()->back()->withInput();
            }
        }
        return view('manager.change_password');
    }
    public function change_profile(Request $request)
    {
        if ($request->isMethod('post')){
            $data = $request->all();
            $validator = Validator::make($data, [
                'name' => 'required|string',
                'sex' => 'required|string',
                'phone' => 'required|string|min:11',
                'email' => 'required|email',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            try {
                $user_date =[
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'sex' => $data['sex'],

                ];
                $update = User::where('id', auth()->id())->update($user_date);
                if ($update) {
                    $this->__alert('s', '<strong>Congratulation!! </strong> User Update successful.');
                    return redirect()->back();
                }

                $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
                return redirect()->back()->withInput();
            } catch (QueryException $e) {
                $this->__alert('w', '<strong>Sorry!!! </strong>Something went wrong.');
                return redirect()->back()->withInput();
            }

        }
        return view('manager.profile');
    }


  public function booking_list()
  {
    $rooms = DB::table('hotels')
      ->join('rooms', 'rooms.hotel_id', '=', 'hotels.id')
      ->where('hotels.manager_id', \auth()->id())
      ->pluck('rooms.id');
    $bookings = Booking::whereIn('room_id', $rooms)->orderby('id','desc')->get();
    return view('manager.booking.booked', compact('bookings'));
  }

  public function change_booking_status(Request $request)
  {
    $id = $request->post('id');
    $status = $request->post('status');
    $booking = Booking::find($id);
    if(isset($booking)){
//    return $booking;

      $has_room = DB::table('hotels')
        ->join('rooms', 'rooms.hotel_id', '=', 'hotels.id')
        ->where('rooms.id', $booking->room_id)
        ->where('hotels.manager_id', \auth()->id())->select('hotels.*')
        ->get();
      if (count($has_room) > 0 ){
        if ($booking->update(['status'=> strtolower($status)])){
          if (strtolower($status) == 'pending' || strtolower($status) == 'canceled'){
          $roomChecking = RoomChecking::where('booking_id', $id)->first();
            if(isset($roomChecking)){
              RoomChecking::find($roomChecking->id)->delete();
            }
          }

          if (strtolower($status) == 'booked' || strtolower($status) == 'completed'){
          $roomChecking = RoomChecking::where('booking_id', $id)->first();
            if(!isset($roomChecking)){
              $data =new RoomChecking();
                $data->room_id = $booking->room_id;
                $data->booking_id = $booking->id;
                $data->start_date = $booking->check_in;
                $data->end_date = $booking->check_out;
                $data->status = $booking->status;
              $data->save();
            }
          }
          $this->__alert('s', 'Booking status change successful.');
          return redirect()->route('manager.booking.list');
        }
      }
      $this->__alert('w', 'Sorry!!! Data not found.');
      return redirect()->route('manager.booking.list');
    }
    $this->__alert('w', 'Sorry!!! Data not found.');
    return redirect()->route('manager.booking.list');
  }
}
