@extends('layouts.manager_layout')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/jquery-datatables-bs3/assets/css/datatables.css') }}"/>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <section class="panel">
                        <header class="panel-heading">
                            <h2 class="panel-title">Hotel Details</h2>
                        </header>
                        <div class="panel-body">
                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                                    <a href="{{ route('manager.hotel.view') }}"
                                       class="brn btn-primary btn-sm">Hotels</a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-6 col-xl-8">
                                            <h3 class="text-capitalize">Name: {{ $hotel->name }}</h3>
                                            <h6>Phone: {{ $hotel->phone }}</h6>
                                            <h6>Email: {{ $hotel->email }}</h6>
                                            <h6>Address: {{ $hotel->address }}</h6>
                                            <h6 class="text-capitalize">Status: {{ $hotel->status }}</h6>
                                        </div>
                                        <div class="col-md-12 col-lg-6 col-xl-4">
                                            @if(isset($hotel->logo))
                                                <img src="{{ asset($hotel->logo) }}" alt="{{ $hotel->name }}"
                                                     style="width: 300px; height: 300px">
                                            @endif
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-xl-12 mt-2 mb-2">
                                                    <h4 class="mb-4 m-2"><strong>Rooms</strong></h4>
                                            <div class="row mb-2">
                                                <div class="col-md-12 text-right">
                                                    <a href="{{ route('manager.hotel.room.add', $hotel->id) }}" class="btn btn-sm btn-info">Add Room</a>
                                                </div>
                                            </div>
                                            <table class="table table-bordered table-striped mb-none" id="data-table">
                                                <thead>
                                                <tr>
                                                    <th width="50">#</th>
                                                    <th>Room</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th width="220">Created At</th>
                                                    <th width="50">Status</th>
                                                    <th width="100">Option</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($hotel->rooms as $key => $val)
                                                    <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                                                        <td>{{ ($key+1) }}</td>
                                                        <td>
                                                            <strong class="text-capitalize">{{ $val->room_number }}</strong>
                                                            <span class="text-capitalize">{{ $val->type }}</span><br>
                                                            <span>Attached Bath: {{ ($val->attached_bath == 1) ? "Yes" : "No" }}</span><br>
                                                        </td>
                                                        <td>
                                                            <span>{{ $val->roomType->name.'( '.$val->roomType->capacity." P)" }}</span>
                                                        </td>
                                                        <td>{{ $val->amount }}</td>
                                                        <td>{{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>
                                                        <td>
                                                            @if(strtolower($val->status) === 'active')
                                                                <span class="text-capitalize badge-success p-1">{{ $val->status }}</span>
                                                            @else
                                                                <span class="text-capitalize badge-danger p-1">{{ $val->status }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="center hidden-phone" width="100">
                                                            <a href="{{ route('manager.hotel.room.edit', [$hotel->id, $val->id]) }}"
                                                               class="btn btn-sm btn-success"> <i
                                                                        class="fa fa-edit"></i> </a>
                                                            <span style="cursor: pointer"
                                                                  class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}"
                                                                  data-id="{{ $val->id }}"><i class="fa fa-trash-o"></i></span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="hotelDeleteModal" tabindex="-1" role="dialog" aria-labelledby="hotelDeleteModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Delete Room</h4>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete this Room?</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-success btn-sm yes-btn">Yes</button>
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


        $(document).on('click', '.yes-btn', function () {
          var pid = $(this).data('id');
          var hotel_id = "{{ $hotel->id }}";
          var $this = $('.delete_' + pid)
          $.ajax({
            url: "{{ route('manager.hotel.room.delete') }}",
            method: "delete",
            dataType: "html",
            data: {id: pid, hotel_id: hotel_id},
            success: function (data) {
              if (data === "success") {
                $('#hotelDeleteModal').modal('hide')
                $this.closest('tr').css('background-color', 'red').fadeOut();
              }
            }
          });
        })

        $(document).on('click', '.btn-delete', function () {
          var pid = $(this).data('id');
          $('.yes-btn').data('id', pid);
          $('#hotelDeleteModal').modal('show')
        });
      })
    </script>
@endsection