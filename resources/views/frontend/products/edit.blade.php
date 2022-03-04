<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('frontend.layouts.master-account')
<style>
    .image-edit-product {
        display: flex;
    }

    .image-item {
        width: 110px;
        height: 110px;
        margin-left: 2px;
    }

    .check-product {
        display: flex;
    }
    .check {
        width: 30px;
        margin-left: 48px;
        padding-right: 66px;
    }

    input[type=checkbox]
    {
        -ms-transform: scale(2);
        -moz-transform: scale(2);
        -webkit-transform: scale(2); 
        -o-transform: scale(2);
        transform: scale(2);
        padding: 10px;
    }

</style>
@section('content')
<div class="container">
<div class="col-lg-8 col-xlg-9 col-md-7">
    <h4>Add product</h4>
    <div class="card">
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('updateProduct', $product->id) }}" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="col-md-12">Name product</label>
                    <div class="col-md-12">
                        <input value="{{ $product->name }}" name="name" placeholder="Enter name" type="text" class="form-control form-control-line">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-email" class="col-md-12">Price</label>
                    <div class="col-md-12">
                        <input value="{{ $product->price }}" type="text" class="form-control form-control-line" name="price" id="example-email">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Category</label>
                    <div class="col-md-12">
                        <select name="category_id"  class="form-control form-control-line">
                            @if (!empty($categories))
                                @foreach ($categories as $categoryId => $categoryName)
                                    <option value="{{ $categoryId }}" {{ $product->category_id == $categoryId ? 'selected' : ''}}>{{ $categoryName }}</option>
                                @endforeach
                            @endif
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Brand</label>
                    <div class="col-md-12">
                        <select name="brand_id" class="form-control form-control-line">
                            @if (!empty($brands))
                                @foreach ($brands as $brandId => $brandName)
                                    <option value="{{ $brandId }}" {{ $product->brand_id == $brandId ? 'selected' : '' }}>{{ $brandName }}</option>
                                @endforeach
                            @endif
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Sale</label>
                    <div class="col-md-12">
                        <select id="saleId" name="sale" class="form-control form-control-line">
                           <option value="0" @if ($product->status == 0) selected @endif>New</option>
                           <option value="1" @if ($product->status == 1) selected @endif>Sale</option>
                    </select>
                    </div>
                </div>
                <div id="saleVale" class="form-group">
                    <label class="col-md-12">Sale value</label>
                    <div class="col-md-12">
                        <input value="{{ $product->sale }}" name="saleValue" type="text" class="form-control form-control-line">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Sale value</label>
                    <div class="col-md-12">
                        <input  name="avatar[]" type="file" multiple="multiple" class="form-control form-control-line">                       
                        <div class="image-edit-product">
                            @if (!empty($product->image))
                            @php
                                $images = json_decode($product->image, true);
                            @endphp
                            @foreach ($images as $img)
                                <div class="image-item">
                                    <img style="
                                    width: 100px;
                                    height: 100px;
                                    padding: 10px;
                                    " src="{{ asset('upload/product/'.Auth::user()->id.'/'.$img.'') }}" alt="product1">
                                </div>
                            @endforeach
                            @endif
                        </div>
                        <div class="check-product">
                            @if (!empty($product->image))
                            @php
                                $images = json_decode($product->image, true);
                            @endphp
                            @foreach ($images as $img)
                                <label class="check">
                                    <input type="checkbox" name="check[]" value="{{$img}}">
                                </label>
                            @endforeach
                            @endif
                        </div>
                        @error('avatar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success">Update product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</section>
@endsection
<script>
    $(document).ready(function(){
        // $("#saleVale").hide();
        // $("#saleId").change(function(){
        //     let saleId = $("#saleId").val();
        //     if (saleId == 1) {
        //         $("#saleVale").show();
        //     }else{
        //         $("#saleVale").hide();
        //     }
        // });
    });
</script>