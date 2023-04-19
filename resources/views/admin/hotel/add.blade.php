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
                            <h2 class="panel-title">Add Hotel</h2>
                        </header>
                        <div class="panel-body">
                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif
                            <form action="{{ route('admin.hotel.add') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" placeholder="Name" required
                                                   value="{{ old('name') }}"
                                                   class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                            <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">District<span
                                                        class="text-danger">*</span></label>
                                            <select name="district_id" required
                                                    class="form-control @error('district_id') is-invalid @enderror">
                                                <option value="">Choose a District</option>
                                                @foreach($divisions as $division)
                                                    <optgroup label="{{ $division->name }}">
                                                        @foreach($division->district as $val)
                                                            <option value="{{ $val->id }}" @if(old('district_id') == $val->id) selected @endif>{{ $val->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                            @error('title')
                                            <strong class="text-danger">{{ $errors->first('title') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone No</label>
                                            <input type="number" name="phone" placeholder="Phone No"
                                                   value="{{ old('phone') }}"
                                                   class="form-control @error('phone') is-invalid @enderror">
                                            @error('phone')
                                            <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" name="email" placeholder="Email"
                                                   value="{{ old('email') }}"
                                                   class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                            <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Address<span
                                                        class="text-danger"> *</span></label>
                                            {{--<input type="text" name="name" placeholder="Insurer name" required value="{{ old('name') }}"--}}
                                            {{--class="form-control @error('name') is-invalid @enderror">--}}
                                            <textarea name="address" cols="30" rows="2" placeholder="Hotel Address"
                                                      class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                            @error('address')
                                            <strong class="text-danger">{{ $errors->first('address') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mb-2">
                                        <div class="form-group">
                                            <label class="control-label">Logo</label>
                                            <input type="file" name="logo"
                                                   class="form-control @error('logo') is-invalid @enderror">
                                            @error('logo')
                                            <strong class="text-danger">{{ $errors->first('logo') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mt-2">
                                        <label class="mr-5">Status</label>
                                        <label class="mr-5" for="active"><input type="radio" id="active" class="mr-2"
                                                                                name="status" value="active" checked>
                                            Active</label>
                                        <label for="inactive"><input type="radio" id="inactive" class="mr-2"
                                                                     name="status" value="inactive" @if(old('status') == 'inactive') checked @endif> Inactive</label>
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