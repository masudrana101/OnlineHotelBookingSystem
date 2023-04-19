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
                            <h2 class="panel-title">Change Profile</h2>
                        </header>
                        <div class="panel-body">
                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif
                            <form action="{{ route('admin.change-profile') }}" method="post" >
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name" placeholder="Name" required
                                                   value="{{ Auth::user()->name }}"
                                                   class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                            <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Gender<span
                                                        class="text-danger">*</span></label>
                                            <select name="sex" required
                                                    class="form-control @error('sex') is-invalid @enderror">
                                                <option value="">Choose  gender</option>
                                                <option @if(Auth::user()->sex == 'male') selected @endif value="male">Male</option>
                                                <option @if(Auth::user()->sex == 'female') selected @endif value="female">Female</option>
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
                                            <label class="control-label">Phone No<span class="text-danger">*</span></label>
                                            <input type="number" name="phone" placeholder="Phone No"
                                                   value="{{ Auth::user()->phone }}"
                                                   class="form-control @error('phone') is-invalid @enderror">
                                            @error('phone')
                                            <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Email<span class="text-danger">*</span></label>
                                            <input type="email" name="email" placeholder="Email"
                                                   value="{{ Auth::user()->email }}"
                                                   class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                            <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-12 text-right">
                                        <button class="btn btn-success " type="submit">Update</button>
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