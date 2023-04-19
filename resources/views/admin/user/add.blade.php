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
                            <h2 class="panel-title">Add User</h2>
                        </header>
                        <div class="panel-body">
                            @if(session()->has('status'))
                                {!! session()->get('status') !!}
                            @endif
                            <form action="{{ route('admin.user.add') }}" method="post" >
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
                                            <label class="control-label">Gender<span
                                                        class="text-danger">*</span></label>
                                            <select name="sex" required
                                                    class="form-control @error('sex') is-invalid @enderror">
                                                <option value="">Choose  gender</option>
                                                <option value="male" @if(old('sex') == 'male') selected @endif>Male</option>
                                                <option value="female" @if(old('sex') == 'female') selected @endif>Female</option>
                                            </select>
                                            @error('sex')
                                            <strong class="text-danger">{{ $errors->first('sex') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone No<span class="text-danger">*</span></label>
                                            <input type="number" name="phone" placeholder="Phone No"
                                                   value="{{ old('phone') }}" required
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
                                                   value="{{ old('email') }}" required
                                                   class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                            <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Password<span class="text-danger">*</span><span
                                                        class="text-danger"> *</span></label>
                                            <input type="text" name="password" placeholder="Password" required value="{{ old('password') }}"
                                            class="form-control @error('password') is-invalid @enderror">
                                           @error('password')
                                            <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">User type<span
                                                        class="text-danger">*</span></label>
                                            <select name="user_type" required
                                                    class="form-control @error('user_type') is-invalid @enderror">
                                                <option value="">Choose a User</option>
                                                <option value="customer" @if(old('user_type') == 'customer') selected @endif>Customer</option>
                                                <option value="manager" @if(old('user_type') == 'manager') selected @endif>Manager</option>
                                            </select>
                                            @error('user_type')
                                            <strong class="text-danger">{{ $errors->first('user_type') }}</strong>
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