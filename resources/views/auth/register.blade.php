@extends('layouts.frontend_layout')


@section('stylesheet')
@endsection

@section('content')

  <div class="row m-5" style="min-height: fit-content">
    <div class="col-sm-8 offset-sm-2">
      <div class="card">
        <div class="card-head text-center">
          <h1>Register</h1>
        </div>
        <div class="card-body">
          <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="name">Full Name</label>
                  <input type="text" name="name" id="name" placeholder="Enter Your name"
                         class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                  @error('name')
                  <strong class="text-danger">{{ $errors->first('name') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" placeholder="Enter Your email"
                         class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                  @error('email')
                  <strong class="text-danger">{{ $errors->first('email') }}</strong>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="phone">Phone NO</label>
                  <input type="number" name="phone" id="phone" placeholder="Enter Your phone"
                         class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                  @error('phone')
                  <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                  @enderror
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group mt-4" style="padding-top: 10px">
                  <label class="mr-5" >Sex</label>
                  <label class="mr-5" for="male"><input type="radio" id="male" class="mr-2" name="sex" value="male"
                                                        checked> Male</label>
                  <label for="female"><input type="radio" id="female" class="mr-2" name="sex" value="female"
                                             @if(old('sex') === 'female') checked @endif> Female</label>
                  @error('sex')
                  <strong class="text-danger">{{ $errors->first('sex') }}</strong>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" placeholder="Enter Your password"
                         class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}"
                         required>
                  @error('password')
                  <strong class="text-danger">{{ $errors->first('password') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" name="confirm_password" id="confirm_password" placeholder="Enter Your confirm password"
                         class="form-control @error('confirm_password') is-invalid @enderror" value="{{ old('confirm_password') }}"
                         required>
                  @error('confirm_password')
                  <strong class="text-danger">{{ $errors->first('confirm_password') }}</strong>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col-sm-12 text-right">
                <a href="{{ route('login') }}" class="btn btn-primary ml-2 mr-2">Log In</a>
                <button class="btn btn-primary" type="submit">Register</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
@endsection
