<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
  public function index()
  {
    return view('customer.index');
  }



  public function booking_list()
  {
//    return "hi";
    $bookings = Booking::where('user_id', auth()->id())->orderby('id','desc')->get();
//    return $bookings[0]->room->hotel->district->name;
//    dd($bookings);
    return view('customer.booked', compact('bookings'));
  }
}
