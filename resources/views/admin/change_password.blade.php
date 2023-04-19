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
                            <h2 class="panel-title">Change Password</h2>
                        </header>
                        <div class="panel-body">
                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif
                            <form action="{{ route('admin.change-password') }}" method="post" >
                                @csrf
                                <div class="row ">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Old Password<span class="text-danger">*</span><span
                                                        class="text-danger"> *</span></label>
                                            <input type="password" name="old_password" placeholder="Password" required value="{{ old('old_password') }}"
                                                   class="form-control @error('old_password') is-invalid @enderror">
                                            @error('old_password')
                                            <strong class="text-danger">{{ $errors->first('old_password') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label"> New Password<span class="text-danger">*</span><span
                                                        class="text-danger"> *</span></label>
                                            <input type="password" name="new_password" placeholder=" New Password" required value="{{ old('new_password') }}"
                                                   class="form-control @error('new_password') is-invalid @enderror">
                                            @error('new_password')
                                            <strong class="text-danger">{{ $errors->first('new_password') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label"> Confirm Password<span class="text-danger">*</span><span
                                                        class="text-danger"> *</span></label>
                                            <input type="password" name="confirm_password" placeholder=" Confirm Password" required value="{{ old('confirm_password') }}"
                                                   class="form-control @error('confirm_password') is-invalid @enderror">
                                            @error('confirm_password')
                                            <strong class="text-danger">{{ $errors->first('confirm_password') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-12 text-left">
                                        <button class="btn btn-success " type="submit">Submit</button>
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