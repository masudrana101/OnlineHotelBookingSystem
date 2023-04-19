@extends('layouts.admin_layout')
@section('stylesheet')
@endsection
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Edit Room Type</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <form action="{{ route('admin.room-type.edit', $roomType->id) }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Name<span class="text-danger">*</span></label>
                      <input type="text" name="name" placeholder="Name" required
                             value="{{ $roomType->name }}"
                             class="form-control @error('name') is-invalid @enderror">
                      @error('name')
                      <strong class="text-danger">{{ $errors->first('name') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Capacity</label>
                      <input type="number" name="capacity" placeholder="Room capacity"
                             value="{{ $roomType->capacity }}" required
                             class="form-control @error('capacity') is-invalid @enderror">
                      @error('capacity')
                      <strong class="text-danger">{{ $errors->first('capacity') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 mt-2">
                    <label class="mr-5">Status</label>
                    <label class="mr-5" for="active"><input type="radio" id="active" class="mr-2"
                                                            name="status" value="active" @if($roomType->status == 'active') checked @endif>
                      Active</label>
                    <label for="inactive"><input type="radio" id="inactive" class="mr-2"
                                                 name="status" value="inactive" @if($roomType->status == 'inactive') checked @endif> Inactive</label>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-sm-12 text-right">
                    <button class="btn btn-success btn-sm" type="submit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
@endsection