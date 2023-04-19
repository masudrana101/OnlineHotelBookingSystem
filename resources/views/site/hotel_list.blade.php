@extends('layouts.frontend_layout')


@section('stylesheet')
    <link href="{{ asset('assets/admin/css/select2.min.css') }}" rel="stylesheet" type="text/css">

@endsection

@section('content')
<main>

    <!-- slider Area Start-->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center" data-background="{{asset('assets/frontend/assets/img/hero/roomspage_hero.jpg')}}" >
            <div class="container">
                <div class="row ">
                    <div class="col-md-11 offset-xl-1 offset-lg-1 offset-md-1">
                        <div class="hero-caption">
                            <span>Hotel</span>
                            <h2>Our Hotel</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <!-- Room Start -->
@if(count($hotels) > 0)
    <!-- Hotel Start -->
        <section class="room-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <!--font-back-tittle  -->
                        <div class="font-back-tittle mb-45">
                            <div class="archivment-front" style="z-index: 0">
                                <h3>Our Hotels</h3>
                            </div>
                            <h3 class="archivment-back">Our Hotels</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($hotels as $hotel)
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <!-- Single Room -->
                            <div class="single-room mb-50">
                                <div class="room-img">
                                    <a href="{{ route('hotel.hotel_room',$hotel->id) }}"><img src="{{ asset($hotel->logo) }}" alt=""></a>
                                </div>
                                <div class="room-caption">
                                    <h3><a href="{{ route('hotel.hotel_room',$hotel->id) }}">{{ $hotel->name }}</a></h3>
                                    <div class="per-night">
                                        <span>{{ $hotel->district->name }}, {{ $hotel->district->division->name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Hotel End -->
@endif
    <!-- Room End -->

    <!-- Gallery img Start-->
    <div class="gallery-area fix">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="gallery-active owl-carousel">
                        <div class="gallery-img">
                            <a href="#"><img src="assets/img/gallery/gallery1.jpg" alt=""></a>
                        </div>
                        <div class="gallery-img">
                            <a href="#"><img src="assets/img/gallery/gallery2.jpg" alt=""></a>
                        </div>
                        <div class="gallery-img">
                            <a href="#"><img src="assets/img/gallery/gallery3.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Gallery img End-->
</main>

@endsection


@section('script')

@endsection

