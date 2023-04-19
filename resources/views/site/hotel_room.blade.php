@extends('layouts.frontend_layout')


@section('stylesheet')
  <link href="{{ asset('assets/admin/css/select2.min.css') }}" rel="stylesheet" type="text/css">

@endsection

@section('content')
  <!-- slider Area Start-->
  <div class="slider-area">
    <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
         data-background="{{ asset('assets/frontend/assets/img/hero/roomspage_hero.jpg') }}">
      <div class="container">
        <div class="row ">
          <div class="col-md-11 offset-xl-1 offset-lg-1 offset-md-1">
            <div class="hero-caption">
              <span>Rooms</span>
              <h2>{{ $hotel }}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- slider Area End-->
  <!-- Room Start -->
  <section class="room-area r-padding1">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-8">
          <!--font-back-tittle  -->
          <div class="font-back-tittle mb-45">
            <div class="archivment-front">
              <h3>Our Rooms</h3>
            </div>
            <h3 class="archivment-back">Our Rooms</h3>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach($rooms as $room)
          <div class="col-xl-4 col-lg-6 col-md-6">
            <!-- Single Room -->
            <div class="single-room mb-50">
              <div class="room-img">
                <a href="#"><img src="assets/img/rooms/room1.jpg" alt=""></a>
              </div>
              <div class="room-caption">
                <h3>{{ $room->type_name }}</h3>
                <h5> Room Type : <span class="uppercase">{{ $room->type }}</span></h5>
                {{--                            <h3><a href="rooms.html">{{ $room->room_number }}</a></h3>--}}
                <h5> Attached Bath : {{ ($room->attached_bath == 1) ? "Yes" : "No" }}</h5>
                <p>{{ $room->description }}</p>
                <div class="per-night">
                  <span><u>TK. </u> {{ $room->amount }} <span>/ par night</span></span>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- Room End -->
@endsection


@section('script')

@endsection