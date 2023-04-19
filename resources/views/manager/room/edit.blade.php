@extends('layouts.manager_layout')
@section('stylesheet')
@endsection
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <section class="panel">
            <header class="panel-heading">
              <h2 class="panel-title">Edit Room</h2>
            </header>
            <div class="panel-body">
              @if(session()->has('status'))
                {!! session()->get('status') !!}
              @endif
              <form action="{{ route('manager.hotel.room.edit', [$hotel_id, $room->id]) }}" method="post">
                @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Room No/Name<span class="text-danger">*</span></label>
                      <input type="text" name="room_number" placeholder="Room number / name" required
                             value="{{ $room->room_number  }}"
                             class="form-control @error('room_number') is-invalid @enderror">
                      @error('room_number')
                      <strong class="text-danger">{{ $errors->first('room_number') }}</strong>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Room Type<span
                                class="text-danger">*</span></label>
                      <select name="room_type_id" required
                              class="form-control @error('room_type_id') is-invalid @enderror">
                        <option value="">Choose a Room Type</option>
                        @foreach($roomTypes as $val)
                          <option value="{{ $val->id }}" @if($room->room_type_id  == $val->id) selected @endif>{{ $val->name.' ('.$val->capacity.' P)' }}</option>
                        @endforeach
                      </select>
                      @error('room_type_id')
                      <strong class="text-danger">{{ $errors->first('room_type_id') }}</strong>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row mb-2">
                  <div class="col-sm-6 mt-2">
                    <label class="mr-5">Attached Bathroom</label>
                    <label class="mr-5" for="attached_bath_yes"><input type="radio" id="attached_bath_yes" class="mr-2"
                                                                       name="attached_bath" value="yes" @if($room->attached_bath  == '1') checked @endif>Yes</label>
                    <label for="attached_bath_no"><input type="radio" id="attached_bath_no" class="mr-2"
                                                         name="attached_bath" value="no" @if($room->attached_bath  == '0') checked @endif> No</label>
                  </div>
                  <div class="col-sm-6 mt-2">
                    <label class="mr-5">Type</label>
                    <label class="mr-5" for="type_non_ac"><input type="radio" id="type_non_ac" class="mr-2"
                                                                 name="type" value="non ac" @if($room->type  == 'non ac') checked @endif>Non Ac</label>
                    <label for="type_ac"><input type="radio" id="type_ac" class="mr-2"
                                                name="type" value="ac" @if($room->type  == 'ac') checked @endif> Ac</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label">Amount / Price <span
                                class="text-danger"> *</span></label>
                      <input type="number" name="amount" placeholder="Amount / Price"
                             value="{{ $room->amount }}" required
                             class="form-control @error('amount') is-invalid @enderror">
                      @error('amount')
                      <strong class="text-danger">{{ $errors->first('amount') }}</strong>
                      @enderror
                    </div>
                  </div>
                  {{--<div class="col-sm-6 mt-4">--}}
                    {{--<label class="mr-5">Status</label>--}}
                    {{--<label class="mr-5" for="available"><input type="radio" id="available" class="mr-2"--}}
                                                               {{--name="status" value="available" checked>--}}
                      {{--Available</label>--}}
                    {{--<label for="unavailable"><input type="radio" id="unavailable" class="mr-2"--}}
                                                    {{--name="status" value="unavailable" @if($room->status  == 'unavailable') checked @endif> Unavailable</label>--}}
                  {{--</div>--}}
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label">Description</label>
                      <textarea name="description" cols="30" rows="2" placeholder="Room description"
                                class="form-control @error('description') is-invalid @enderror">{{ $room->description  }}</textarea>
                      @error('description')
                      <strong class="text-danger">{{ $errors->first('description') }}</strong>
                      @enderror
                    </div>
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