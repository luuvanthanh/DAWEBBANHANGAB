@extends('frontend.layouts.master-account')
@section('content')
<div class="page-breadcrumb">
<div class="container">
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
        <div class="col-lg-8 col-xlg-9 col-md-7">
            <h4>Update profile</h4>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('postAccount') }}" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="col-md-12">Full Name</label>
                            <div class="col-md-12">
                                <input value="{{ $user->name }}" name="name" placeholder="Enter name" type="text" class="form-control form-control-line">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Email</label>
                            <div class="col-md-12">
                                <input value="{{ $user->email }}" type="email" placeholder="example@admin.com" class="form-control form-control-line" name="email" id="example-email">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Password</label>
                            <div class="col-md-12">
                                <input name="password" type="password" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Phone No</label>
                            <div class="col-md-12">
                                <input value="{{ $user->phone }}" name="phone" type="text" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Address</label>
                            <div class="col-md-12">
                                <input value="{{ $user->address }}" name="address" type="text" placeholder="123 456 7890" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Avatar</label>
                            <div class="col-md-12">
                                <input value="" name="avatar" type="file" placeholder="123 456 7890" class="form-control form-control-line">
                                <img style="width:100px; heigth: 100px;" src="././upload/avatar/{{ $user->avatar }}">
                                @error('avatar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-12">Select Country</label>
                            <div class="col-sm-12">
                                <select name="country_id" class="form-control form-control-line">
                                    @if (!empty($countries))
                                        @foreach ($countries as $countryId => $countryName)
                                            <option value="{{ $countryId }} " {{ $user->country_id == $countryId ? 'selected' : '' }}>{{ $countryName }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Update Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection