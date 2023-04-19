<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\District;
use App\Models\Division;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\RoomChecking;
use App\Models\RoomType;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
  public function index()
  {
    $divisions = Division::all();
    $rt =  RoomType::where('status','active')->get();
    $hotels = Hotel::where('status', 'active')->whereNotNull('logo')->take(12)->get();

    return view('site.index', compact('hotels', 'divisions','rt'));
  }


  public function hotel_search(Request $request)
  {
//    return $request;
    if (isset($request->check_in) && isset($request->check_out)) {
      $check_in = DateTime::createFromFormat('m/d/Y', $request->check_in)->format('Y-m-d');
      $check_out = DateTime::createFromFormat('m/d/Y', $request->check_out)->format('Y-m-d');
      $diff = $this->__diff_day($check_in, $check_out);
      $available_room = DB::table('rooms')
        ->leftJoin('room_checkings', 'room_checkings.room_id', '=', 'rooms.id')
//        ->where(function ($query) use ($check_in, $check_out) {
//          $query->where([['room_checkings.start_date', '<', $check_in ], ['room_checkings.end_date','<', $check_in ]])
//          ->orWhere([['room_checkings.start_date', '>', $check_out], ['room_checkings.end_date', '>', $check_out]]);
//        })
        ->orWhere([['room_checkings.start_date', '>=', $check_in ], ['room_checkings.start_date','<=', $check_out ]])
        ->orWhere([['room_checkings.start_date', '<=', $check_in ], ['room_checkings.end_date','>=', $check_out ]])
        ->orWhere([['room_checkings.end_date', '>=', $check_in ], ['room_checkings.end_date','<=', $check_out ]])
        ->groupby('rooms.id')
        ->pluck('rooms.id');
//      return $available_room;
      if (isset($request->district) && isset($request->room)) {
        $district_id = $request->district;
        $room_id = $request->room;
        $rooms = DB::table('rooms')
          ->join('hotels', 'hotels.id', '=', 'rooms.hotel_id')
          ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
          ->join('districts', 'districts.id', '=', 'hotels.district_id')
          ->join('divisions', 'districts.division_id', '=', 'divisions.id')
          ->select('hotels.id as hotel_id', 'hotels.name as hotel_name',  'hotels.phone as hotel_phone',  'hotels.email as hotel_email',
            'hotels.logo as hotel_logo', 'hotels.address as hotel_address', 'rooms.id as room_id', 'rooms.room_number as room_number',
            'rooms.amount as room_amount', 'rooms.attached_bath as room_attached_bath', 'rooms.type as room_type', 'rooms.description as room_description', 'room_types.id as room_type_id',
            'room_types.name as room_type_name', 'room_types.capacity as room_type_capacity', 'districts.id as district_id',  'districts.name as district_name',
            'divisions.id as division_id', 'divisions.name as division_name')
          ->where('room_types.status', 'active')
          ->where('hotels.status', 'active')
//          ->where('rooms.status', 'available')
          ->whereNotIn('rooms.id', $available_room)
          ->where('districts.id', $district_id)
          ->where('room_types.id', $room_id)
          ->get();
//        return $rooms;
      }
      if (isset($request->district) && !isset($rooms)) {
        $district_id = $request->district;
        $rooms = DB::table('rooms')
          ->join('hotels', 'hotels.id', '=', 'rooms.hotel_id')
          ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
          ->join('districts', 'districts.id', '=', 'hotels.district_id')
          ->join('divisions', 'districts.division_id', '=', 'divisions.id')
          ->select('hotels.id as hotel_id', 'hotels.name as hotel_name',  'hotels.phone as hotel_phone',  'hotels.email as hotel_email',
            'hotels.logo as hotel_logo', 'hotels.address as hotel_address', 'rooms.id as room_id', 'rooms.room_number as room_number',
            'rooms.amount as room_amount', 'rooms.attached_bath as room_attached_bath', 'rooms.type as room_type', 'rooms.description as room_description', 'room_types.id as room_type_id',
            'room_types.name as room_type_name', 'room_types.capacity as room_type_capacity', 'districts.id as district_id',  'districts.name as district_name',
            'divisions.id as division_id', 'divisions.name as division_name')
          ->where('room_types.status', 'active')
          ->where('hotels.status', 'active')
//          ->where('rooms.status', 'available')
          ->whereNotIn('rooms.id', $available_room)
          ->where('districts.id', $district_id)
          ->get();
//        return $rooms;
      }
      if (isset($request->room) && !isset($rooms)) {
        $room_id = $request->room;
        $rooms = DB::table('rooms')
          ->join('hotels', 'hotels.id', '=', 'rooms.hotel_id')
          ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
          ->join('districts', 'districts.id', '=', 'hotels.district_id')
          ->join('divisions', 'districts.division_id', '=', 'divisions.id')
          ->select('hotels.id as hotel_id', 'hotels.name as hotel_name',  'hotels.phone as hotel_phone',  'hotels.email as hotel_email',
            'hotels.logo as hotel_logo', 'hotels.address as hotel_address', 'rooms.id as room_id', 'rooms.room_number as room_number',
            'rooms.amount as room_amount', 'rooms.attached_bath as room_attached_bath', 'rooms.type as room_type', 'rooms.description as room_description',
            'room_types.id as room_type_id', 'room_types.name as room_type_name', 'room_types.capacity as room_type_capacity',
            'districts.id as district_id',  'districts.name as district_name', 'divisions.id as division_id', 'divisions.name as division_name')
          ->where('room_types.status', 'active')
          ->where('hotels.status', 'active')
//          ->where('rooms.status', 'available')
          ->whereNotIn('rooms.id', $available_room)
          ->where('room_types.id', $room_id)
          ->get();
//        return $rooms;
      }
//      return $request;
//      return $request->district;
      if(!isset($rooms)){
        $rooms = DB::table('rooms')
          ->join('hotels', 'hotels.id', '=', 'rooms.hotel_id')
          ->join('room_types', 'room_types.id', '=', 'rooms.room_type_id')
          ->join('districts', 'districts.id', '=', 'hotels.district_id')
          ->join('divisions', 'districts.division_id', '=', 'divisions.id')
          ->select('hotels.id as hotel_id', 'hotels.name as hotel_name',  'hotels.phone as hotel_phone',  'hotels.email as hotel_email',
            'hotels.logo as hotel_logo', 'hotels.address as hotel_address', 'rooms.id as room_id', 'rooms.room_number as room_number',
            'rooms.amount as room_amount', 'rooms.attached_bath as room_attached_bath', 'rooms.type as room_type', 'rooms.description as room_description',
            'room_types.id as room_type_id', 'room_types.name as room_type_name', 'room_types.capacity as room_type_capacity',
            'districts.id as district_id',  'districts.name as district_name', 'divisions.id as division_id', 'divisions.name as division_name')
          ->where('room_types.status', 'active')
          ->where('hotels.status', 'active')
          ->whereNotIn('rooms.id', $available_room)
          ->get();
      }
      $divisions = Division::all();
      $rt =  RoomType::where('status','active')->get();
      Session::put('check_in', $check_in);
      Session::put('check_out', $check_out);
      Session::put('diff', $diff);
      return view('site.hotel_search', compact('divisions','rooms', 'rt', 'request', 'diff'));
    }
    $this->__alert('w', 'Sorry!!! No hotel found.');
    return redirect()->back();
  }


  public function book_room(Request $request, $id = null)
  {
    if ($request->method('POST')) {
      if (Session::has('check_in') && Session::has('check_in')) {
        $check_in = Session::get('check_in');
        $check_out = Session::get('check_out');
        $diff = Session::get('diff');
//      Session::forget('check_in');
//      Session::forget('check_out');
        $room = Room::find($id);
        if (isset($room)) {
          $data =  $request->all();
          $payment_by = 'cash on hotel';
          if($data['payment_method'] == 'op'){
            $payment_by = 'online payment';
          }
          $booking = new Booking();
          $booking->user_id = auth()->id();
          $booking->room_id = $id;
          $booking->check_in = $check_in;
          $booking->check_out = $check_out;
          $booking->amount = ($room->amount * $diff);
          $booking->payment_by = $payment_by;
          if(isset($data['card_no'])){
            $booking->card_no = $data['card_no'];
          }
          if(isset($data['cvc_no'])){
            $booking->cvc_no = $data['cvc_no'];
          }
          if(isset($data['month'])){
            $booking->month = $data['month'];
          }
          if(isset($data['year'])){
            $booking->year = $data['year'];
          }
          $booking->status = 'pending';
          if($booking->save()){
            $this->__alert('s', 'Booking successful.');
            return redirect()->route('home');
          }
        }
        $this->__alert('w', 'Sorry!!! Please try again.');
        return redirect()->route('home');
      }
      $this->__alert('w', 'Sorry!!! Please try again.');
      return redirect()->route('home');
    }
    return redirect()->route('home');
  }

    public function hotel_list()
    {
        $hotels = Hotel::where('status', 'active')->whereNotNull('logo')->get();
     return view('site.hotel_list',compact('hotels'));
  }

    public function hotel_room($id)
    {
        $hotel = Hotel::where('id',$id)->pluck('name')->first();
        $rooms = DB::table('rooms')
            ->join('room_types','room_types.id','=','rooms.room_type_id')
            ->select('rooms.id as room_id','rooms.room_number as room_number','rooms.amount','rooms.type','rooms.attached_bath','rooms.description',
                'room_types.id as room_type_id','room_types.name as type_name')
            ->where('rooms.hotel_id',$id)
            ->where('rooms.status','available')
            ->get();
        return view('site.hotel_room',compact('rooms','hotel'));
    }
    public function hotel_contact()
    {
        return view('site.contact');
  }
  public function coming_soon()
  {
    return "Coming Soon ! !! !!!";
  }
}
