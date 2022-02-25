@extends('frontend.layouts.master-login')
@section('content')
@if (session('success'))
  <div class="alert alert-success" role="alert">
      {{ session('success') }}
  </div>
@endif
@if (session('error'))
  <div class="alert alert-danger" role="alert">
      {{ session('error') }}
  </div>
@endif
<form action="{{ route('postLogin') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Enter email">
      @error('email')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password" placeholder="Password">
      @error('password')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-check">
      <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <a href="{{ route('getRegister') }}"><i class="fa fa-lock"></i>Register</a>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
@endsection