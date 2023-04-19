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
              <h2 class="panel-title">View Room Type</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12 text-right mb-3">
                  <a href="{{ route('admin.room-type.add') }}" class="brn btn-primary btn-sm">Add New</a>
                </div>
              </div>
                <table class="table table-bordered table-striped mb-none" id="data-table">
                  <thead>
                  <tr>
                    <th width="50">#</th>
                    <th>Name</th>
                    <th>Capacity</th>
                    <th width="220">Created At</th>
                    <th width="70">Status</th>
                    <th class="hidden-phone" width="100">Option</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($roomTypes as $key => $val)
                    <tr class="@if(($key%2) == 0)gradeX @else gradeC @endif">
                      <td>{{ ($key+1) }}</td>
                      <td class="text-capitalize" >{{ $val->name }}</td>
                      <td>{{ $val->capacity }}</td>
                      <td>{{ date('F d, Y h:i A', strtotime($val->created_at)) }}</td>
                      <td class="text-capitalize">{{ $val->status }}</td>
                      <td class="center hidden-phone" width="100">
                        <a href="{{ route('admin.room-type.edit', $val->id) }}" class="btn btn-sm btn-success"> <i class="fa fa-edit"></i> </a>
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
            <h4>Delete Room Type</h4>
        </div>
        <div class="modal-body">
          <strong>Are you sure to delete this Room Type?</strong>
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
        var $this = $('.delete_' + pid)
        $.ajax({
          url: "{{ route('admin.room-type.delete') }}",
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