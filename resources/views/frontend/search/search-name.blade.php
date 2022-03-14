@extends('frontend.layouts.master')
@section('content')
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