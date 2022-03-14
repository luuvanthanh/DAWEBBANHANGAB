@extends('frontend.layouts.master')
<style>
    .menu-search {
        display: flex;
    }
</style>
@section('content')
@if (session('thongbao'))
    <div class="alert alert-success" role="alert">
        {{ session('thongbao') }}
    </div>
@endif
<div class="col-sm-9">
    <form action="{{ route('searchAllValue') }}" method="POST">
        @csrf
        <div class="menu-search">
            <input type="text" name="valueSearch">
            <select class="form-select" name="price">
                <option selected>Choose price</option>
            </select>
            <select class="form-select" name="category">
                <option value="category" selected>----category------</option>
                @if (!empty($categories))
                    @foreach ($categories as $categoryId => $categoryName)
                        <option value="{{ $categoryId }}">{{ $categoryName }}</option>
                    @endforeach
                @endif
            </select>
            <select class="form-select" name="brand">
                <option value="brand" selected>----Brand------</option>
                @if (!empty($brands))
                    @foreach ($brands as $brandId => $brandsName)
                        <option value="{{ $brandId }}">{{ $brandsName }}</option>
                    @endforeach
                @endif
            </select>   
            <select class="form-select">
                <option selected>Status</option>
                <option value="1">One</option>
                <option value="2">Two</option>
            </select>
        </div>
        <button type="submit" class="btn btn-info">Search</button>
    </form>
</div>
@if (!empty($products))
@foreach ($products as $pro)
@php
    $images = json_decode($pro->image, true);
    $id = $pro->user_id;
@endphp
<div class="col-sm-4">
    <div class="product-image-wrapper">
        <div class="single-products">
            <input class="idProduct" type="hidden" value="{{ $pro->id }}">
                <div class="productinfo text-center">
                    @foreach ($images as $img)
                        <img style="
                        width: 120px;
                        height: 120px;
                        padding: 10px;
                        " src="{{ asset('upload/product/'.$id.'/'. $img.'') }}" alt="" />
                        @php
                            break;
                        @endphp
                    @endforeach
                    <h2>${{ $pro->price }}</h2>
                    <p>{{ $pro->name }}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
                <div class="product-overlay" onclick="passId({{$pro->id}})">
                    <div class="overlay-content">
                        <h2>${{ $pro->price }}</h2>
                        <p>{{ $pro->name }}</p>
                        <a class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div>
        </div>
        <div class="choose">
            <ul class="nav nav-pills nav-justified">
                {{-- <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li> --}}
                <li><a href="{{ route('getDetailProduct', $pro->id) }}"><i class="fa fa-plus-square"></i>Detail</a></li>
            </ul>
        </div>
    </div>
</div>
@endforeach
@endif
@endsection