@extends('layouts.admin_layout')

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
              <h2 class="panel-title">View Hotel</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
                <table class="table table-bordered table-striped mb-none" id="data-table">
                  <thead>
                  <tr>
                    <th width="50">#</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th width="220">Created At</th>
                    <th width="70">Status</th>
                    <th class="hidden-phone" width="100">Option</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($hotels as $key => $val)
                    <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                      <td>{{ ($key+1) }}</td>
{{--                      <td><img src="{{ asset($val->image) }}" width="75" height="50" alt=""></td>--}}
                      <td class="text-capitalize" >{{ $val->name }}</td>
                      <td>{{ (strlen($val->address) > 100) ?  substr($val->address, 0, 100)."..." : $val->address }}</td>
                      <td>{{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>
                      <td class="text-capitalize" width="100">
                        <div class="onoffswitch">
                          <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                                 @if($val->status == 'active')
                                 checked
                                 @endif
                                 data-id="{{ $val->id }}"
                                 id="myonoffswitch{{ ($key+1) }}">
                          <label class="onoffswitch-label" for="myonoffswitch{{ ($key+1) }}">
                            <span class="onoffswitch-inner"></span>
                            <span class="onoffswitch-switch"></span>
                          </label>
                        </div>
                      </td>
                      <td class="center hidden-phone" width="100">
                        <a href="{{ route('admin.hotel.edit', $val->id) }}" class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>
                        <span style="cursor: pointer" class="btn btn-sm btn-danger btn-delete delete_{{ $val->id }}" data-id="{{ $val->id }}"><i class="fa fa-trash-o"></i></span>
                      </td>
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
  <div class="modal fade" id="hotelDeleteModal" tabindex="-1" role="dialog" aria-labelledby="hotelDeleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h4>Delete Hotel</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this Hotel?</strong>
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


      $(document).on('change', 'input[name="onoffswitch"]', function () {
        var status = 'inactive';
        var id = $(this).data('id')
        var isChecked = $(this).is(":checked");
        if (isChecked) {
          status = 'active';
        }
        // console.log(id)
        $.ajax({
          url: "{{ route('admin.ajax.update.hotel.status') }}",
          method: "post",
          dataType: "html",
          data: {id, status},
          success: function (data) {
            if (data === "success") {
            }
          }
        });
      })



      $(document).on('click', '.yes-btn', function () {
        var pid = $(this).data('id');
        var $this = $('.delete_' + pid)
        $.ajax({
          url: "{{ route('admin.hotel.delete') }}",
          method: "delete",
          dataType: "html",
          data: {id: pid},
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