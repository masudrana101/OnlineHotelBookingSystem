@extends('layouts.frontend_layout')


@section('stylesheet')
@endsection

@section('content')

  <div class="row m-5" style="min-height: fit-content">
    <div class="col-sm-6 offset-sm-3">
      <div class="card">
        <div class="card-head text-center">
          <h1>Login</h1>
        </div>
        <div class="card-body">
          <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" placeholder="Enter Your email"
                         class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                  @error('email')
                  <strong class="text-danger">{{ $errors->first('email') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" placeholder="Enter Your password"
                         class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" required>
                  @error('password')
                  <strong class="text-danger">{{ $errors->first('password') }}</strong>
                  @enderror
                </div>
              </div>
              <div class="col-sm-12 text-right">
                {{--<a href="">Forgot Password?</a>--}}
                <a href="{{ route('register') }}" class="btn btn-primary ml-2 mr-2">Register</a>
                <button class="btn btn-primary" type="submit">Log In</button>
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
