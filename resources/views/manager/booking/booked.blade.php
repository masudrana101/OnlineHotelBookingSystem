@extends('layouts.manager_layout')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}" />
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">View Room Booking</h2>
                        </header>
                        <div class="panel-body">
                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif
                            {{--<div class="row">--}}
                                {{--<div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">--}}
                                    {{--<a href="{{ route('admin.hotel.add') }}" class="brn btn-primary btn-sm">Add New</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <table class="table table-bordered table-striped mb-none" id="data-table">
                                <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Customer</th>
                                    <th>Room</th>
                                    <th>Payment</th>
                                    <th width="220">Interval</th>
                                    <th width="70">Status</th>
                                    {{--<th class="hidden-phone" width="100">Option</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bookings as $val)
                                    <tr class="@if(($loop->iteration %2) == 0)gradeX @else gradeC @endif">
                                        <td>{{ ($loop->iteration  +1) }}</td>
                                        <td class="text-capitalize" >
                                            <strong>{{ $val->user->name }}</strong><br>
                                            <span>{{ $val->user->phone }}</span><br>
                                            <span>{{ $val->user->email }}</span><br>
                                        </td>
                                        <td class="text-capitalize" >
                                            <strong>{{ $val->room->hotel->name }}</strong><br>
                                            <span>{{ $val->room->room_number }} -> <span>{{ $val->room->roomType->name }} <span>({{ $val->room->roomType->capacity }} P)</span></span></span><br>
                                            <strong class="text-indigo">{{ $val->room->amount }} TK / Night</strong>
                                        </td>
                                        <td>
                                            <strong>Pay: {{ $val->amount }} TK</strong><br>
                                            <span class="text-capitalize">By: {{ $val->payment_by }}</span><br>
                                        </td>
                                        <td>
                                            <span>{{ $val->check_in }} to {{ $val->check_out }}</span><br>
                                            <span>Apply at: </span><br>
                                            <span>{{ date('F d, Y h:i A', strtotime($val->created_at)) }}</span>
                                        </td>
                                        <td class="text-capitalize">
                                            <form action="{{ route('manager.change.booking.status') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $val->id }}">
                                                <select name="status" >
                                                    <option value="pending" @if($val->status == 'pending') selected @endif>Pending</option>
                                                    <option value="booked" @if($val->status == 'booked') selected @endif>Booked</option>
                                                    <option value="canceled" @if($val->status == 'canceled') selected @endif>Canceled</option>
                                                    <option value="completed" @if($val->status == 'completed') selected @endif>Completed</option>
                                                </select>
                                            </form>
                                            {{--{{ $val->status }}--}}
                                        </td>
                                        {{--<td class="center hidden-phone" width="100">--}}
                                            {{--<a href="{{ route('admin.hotel.edit', $val->id) }}" class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>--}}
                                            {{--<span style="cursor: pointer" class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" data-id="{{ $val->id }}"><i class="fa fa-trash-o"></i></span>--}}
                                        {{--</td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script src="{{ asset('assets/admin/vendor/jquery-datatables/media/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/jquery-datatables-bs3/assets/js/datatables.js') }}"></script>
    <script>
      $(document).ready(function () {
        $('#data-table').DataTable();
        $(document.body).on('change', 'select[name="status"]', function () {
          const select = $(this).val();
          if(select !== '') {
            $(this).closest('form').submit()
          }
        })
      })
    </script>
@endsection