@extends('layouts.frontend_layout')


@section('stylesheet')
  <link href="{{ asset('assets/admin/css/select2.min.css') }}" rel="stylesheet" type="text/css">

@endsection

@section('content')
  <!-- slider Area Start-->
  <div class="slider-area ">
    <!-- Mobile Menu -->
    <div class="slider-active dot-style">
      <div class="single-slider  hero-overly slider-height d-flex align-items-center" data-background="assets/frontend/assets/img/hero/h1_hero.jpg">
        <div class="container">
          <div class="row justify-content-center text-center">
            <div class="col-xl-9">
              <div class="h1-slider-caption">
                <h1 data-animation="fadeInUp" data-delay=".4s">top hotel in the city</h1>
                <h3 data-animation="fadeInDown" data-delay=".4s">Hotel & Resourt</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="single-slider  hero-overly slider-height d-flex align-items-center" data-background="assets/frontend/assets/img/hero/h1_hero.jpg">
        <div class="container">
          <div class="row justify-content-center text-center">
            <div class="col-xl-9">
              <div class="h1-slider-caption">
                <h1 data-animation="fadeInUp" data-delay=".4s">top hotel in the city</h1>
                <h3 data-animation="fadeInDown" data-delay=".4s">Hotel & Resourt</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="single-slider  hero-overly slider-height d-flex align-items-center" data-background="assets/frontend/assets/img/hero/h1_hero.jpg">
        <div class="container">
          <div class="row justify-content-center text-center">
            <div class="col-xl-9">
              <div class="h1-slider-caption">
                <h1 data-animation="fadeInUp" data-delay=".4s">top hotel in the city</h1>
                <h3 data-animation="fadeInDown" data-delay=".4s">Hotel & Resourt</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- slider Area End-->
  <!-- Booking Room Start-->
  <div class="booking-area">
    <div class="container">
      <div class="row ">
        <div class="col-12">
          <form action="{{ route('hotel.search') }}" method="get">
            <div class="booking-wrap d-flex justify-content-between align-items-center">
              <!-- select in date -->
              <div class="single-select-box mb-30">
                <!-- select out date -->
                <div class="boking-tittle">
                  <span> Check In Date:</span>
                </div>
                <div class="boking-datepicker">
                  <input id="datepicker1" name="check_in" required placeholder="10/12/2020"/>
                </div>
              </div>
              <!-- Single Select Box -->
              <div class="single-select-box mb-30">
                <!-- select out date -->
                <div class="boking-tittle">
                  <span>Check OutDate:</span>
                </div>
                <div class="boking-datepicker">
                  <input id="datepicker2" name="check_out" required placeholder="12/12/2020"/>
                </div>
              </div>
              <!-- Single Select Box -->
              <div class="single-select-box mb-30">
                <div class="boking-tittle">
                  <span>District:</span>
                </div>
                <div class="select-this">
                  <div class="select-itms">
                    <select name="district" id="select2">
                      @foreach($divisions as $key => $division)
                        <option value="">Choose</option>
                        <optgroup label="{{ $division->name }}">
                          @foreach($division->district as $k => $val)
                            <option value="{{ $val->id }}">{{ $val->name }}</option>
                          @endforeach
                        </optgroup>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <!-- Single Select Box -->
              <div class="single-select-box mb-30">
                <div class="boking-tittle">
                  <span>Rooms:</span>
                </div>
                <div class="select-this">
                    <div class="select-itms">
                      <select name="room" id="select3">
                        <option value="">Choose</option>
                        @foreach($rt as $r)
                          <option value="{{ $r->id }}">{{ $r->name}}  ({{$r->capacity }})</option>
                        @endforeach
                      </select>
                    </div>
                </div>
              </div>
              <!-- Single Select Box -->
              <div class="single-select-box pt-45 mb-30">
                <button type="submit" class="btn select-btn">Search Now</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Booking Room End-->

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
  <!-- Gallery img Start-->
  <div class="gallery-area fix">
    <div class="container-fluid p-0">
      <div class="row">
        <div class="col-md-12">
          <div class="gallery-active owl-carousel">
            <div class="gallery-img">
              <a href="#"><img src="{{ asset('assets/frontend/assets/img/gallery/gallery1.jpg') }}" alt=""></a>
            </div>
            <div class="gallery-img">
              <a href="#"><img src="{{ asset('assets/frontend/assets/img/gallery/gallery2.jpg') }}" alt=""></a>
            </div>
            <div class="gallery-img">
              <a href="#"><img src="{{ asset('assets/frontend/assets/img/gallery/gallery3.jpg') }}" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Gallery img End-->
@endsection


@section('script')

  <script src="{{ asset('assets/admin/js/select2.min.js') }}"></script>
  <script>
    $(document).ready(function() {
      // $('#select2').select2();
    })
  </script>

@endsection
