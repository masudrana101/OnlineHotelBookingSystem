@extends('layouts.frontend_layout')


@section('stylesheet')
    <link href="{{ asset('assets/admin/css/select2.min.css') }}" rel="stylesheet" type="text/css">

@endsection

@section('content')
    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="slider-active dot-style">
            <div class="single-slider  hero-overly slider-height d-flex align-items-center"
                 data-background="assets/frontend/assets/img/hero/h1_hero.jpg">
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
            <div class="single-slider  hero-overly slider-height d-flex align-items-center"
                 data-background="assets/frontend/assets/img/hero/h1_hero.jpg">
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
            <div class="single-slider  hero-overly slider-height d-flex align-items-center"
                 data-background="assets/frontend/assets/img/hero/h1_hero.jpg">
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
                                    <input id="datepicker1"
                                           value="@if(isset($request->check_in)) {{ $request->check_in }} @endif"
                                           name="check_in" placeholder="10/12/2020"/>
                                </div>
                            </div>

                            <!-- Single Select Box -->
                            <div class="single-select-box mb-30">
                                <!-- select out date -->
                                <div class="boking-tittle">
                                    <span>Check OutDate:</span>
                                </div>
                                <div class="boking-datepicker">
                                    <input id="datepicker2"
                                           value="@if(isset($request->check_out)) {{ $request->check_out }} @endif"
                                           name="check_out" placeholder="12/12/2020"/>
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
                                            <option value="">Choose</option>
                                            @foreach($divisions as $key => $division)
                                                <optgroup label="{{ $division->name }}">
                                                    @foreach($division->district as $k => $val)
                                                        <option value="{{ $val->id }}"
                                                                @if($request->district == $val->id) selected @endif>{{ $val->name }}</option>
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
                                        <select name="select" id="select3">
                                            <option value="">Choose</option>
                                            @foreach($rt as $r)
                                                <option value="{{ $r->id }}"
                                                        @if($request->room == $r->id) selected @endif>{{ $r->name}}
                                                    ({{$r->capacity }})
                                                </option>
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

    @if(count($rooms) > 0)
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
                    @foreach($rooms as $val)
                        <div class="col-sm-12 m-2">
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                    <a href="#"><img src="{{ asset($val->hotel_logo) }}" alt="{{ $val->hotel_name }}"
                                                     style="height: 100%; width: 100%"></a>
                                </div>
                                <div class="col-sm-8 col-md-8 col-lg-8 col-xl-8 pl-2">
                                    <h2><a href="#"><strong>{{ $val->hotel_name }}</strong></a></h2>
                                    <h4 class="text-capitalize"><i
                                                class="fa fa-map-marker-alt pr-1"></i>{{ $val->district_name }}
                                        , {{ $val->division_name }}</h4>
                                    <h4><i class="fa fa-phone pr-1"></i>{{ $val->hotel_phone }}</h4>
                                    <h4><i class="fa fa-at pr-1"></i>{{ $val->hotel_email }}</h4>
                                    <h6><i class="fa fa-home pr-1"></i><strong
                                                style="color: #0000cc">{{ $val->room_number }}</strong></h6>
                                    <h6><i class="fa fa-users pr-1"></i>{{ $val->room_type_name }}
                                        ({{ $val->room_type_capacity }})</h6>
                                    <h6><i class="fa fa-dollar-sign pr-1" style="color: #1a202c"></i><strong
                                                style="color: #0000cc">{{ $val->room_amount }} Taka/Day</strong></h6>
                                    <h4><a href="#" class="order_btn btn btn-success btn-sm p-3" data-diff="{{ $diff }}" data-url="{{ route('book_room', $val->room_id) }}" data-amount="{{ $val->room_amount }}">Book Now</a></h4>
                                    {{--<h4><a href="{{ route('book_room', $val->room_id) }}" class="order_btn btn btn-success btn-sm p-3">Book Now</a></h4>--}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{--<div class="row justify-content-center">--}}
                    {{--<div class="room-btn pt-70">--}}
                        {{--<a href="#" class="btn view-btn1">View more <i class="ti-angle-right"></i> </a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </section>
        <div class="modal fade" id="hotelDeleteModal" tabindex="-1" role="dialog" aria-labelledby="hotelDeleteModal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Payment</h4>
                    </div>
                    <form method="post" id="payment_form">
                        @csrf
                        <div class="modal-body">
                            <h4>Pay <strong id="pay_amount"></strong> TK</h4>
                            <div class="row">
                                <div class="col-6">
                                    <label for="cod"><input type="radio" name="payment_method" id="cod" checked
                                                            value="cod"> Cash On Delivery</label>
                                </div>
                                <div class="col-6">
                                    <label for="op"><input type="radio" name="payment_method" id="op" value="op"> Online
                                        Payment</label>
                                </div>
                                <div class="col-12 {{--d-none--}}" id="online_payment">
                                    {{--<div class="form-row">--}}
                                        {{--<div class="col-6">--}}
                                            {{--<div class="form-group">--}}
                                                {{--<label for="">Card No</label>--}}
                                                {{--<input type="number" class="form-contact" required name="card_no"--}}
                                                       {{--placeholder="Card No">--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-6">--}}
                                            {{--<label for="">CVC</label>--}}
                                            {{--<input type="number" class="form-contact" required name="cvc_no"--}}
                                                   {{--placeholder="CVC No">--}}
                                        {{--</div>--}}
                                        {{--<div class="col-6">--}}
                                            {{--<label for="">Month</label>--}}
                                            {{--<input type="number" class="form-contact" required name="month" placeholder="Month">--}}
                                        {{--</div>--}}
                                        {{--<div class="col-6">--}}
                                            {{--<label for="">Year</label>--}}
                                            {{--<input type="number" class="form-contact" required name="year" placeholder="Year">--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm yes-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection


@section('script')
    <script>

      $(document).ready(function () {


        $(document).on('change', 'input[name="payment_method"]', function () {
          const id = $(this).attr('id')
          if(id === 'op'){
            $('#online_payment').append('<div class="form-row">\n' +
              '                                        <div class="col-6">\n' +
              '                                            <div class="form-group">\n' +
              '                                                <label for="">Card No</label>\n' +
              '                                                <input type="number" class="form-contact" required name="card_no"\n' +
              '                                                       placeholder="Card No">\n' +
              '                                            </div>\n' +
              '                                        </div>\n' +
              '                                        <div class="col-6">\n' +
              '                                            <label for="">CVC</label>\n' +
              '                                            <input type="number" class="form-contact" required name="cvc_no"\n' +
              '                                                   placeholder="CVC No">\n' +
              '                                        </div>\n' +
              '                                        <div class="col-6">\n' +
              '                                            <label for="">Month</label>\n' +
              '                                            <input type="number" class="form-contact" required name="month" placeholder="Month">\n' +
              '                                        </div>\n' +
              '                                        <div class="col-6">\n' +
              '                                            <label for="">Year</label>\n' +
              '                                            <input type="number" class="form-contact" required name="year" placeholder="Year">\n' +
              '                                        </div>\n' +
              '                                    </div>');
          }else{
            $('#online_payment').empty();
          }
        })

        $(document).on('click', '.order_btn', function () {
          const url = $(this).data('url');
          const diff = $(this).data('diff');
          const amount = $(this).data('amount');
          const taka = amount * diff;
          $('#pay_amount').text(taka);
          $('#payment_form').attr('action', url);
          $('#hotelDeleteModal').modal('show')
        })
      });
    </script>

@endsection
