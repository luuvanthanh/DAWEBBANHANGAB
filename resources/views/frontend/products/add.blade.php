<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('frontend.layouts.master-account')
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
            <form action="{{ route('addProduct') }}" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-md-12">Name product</label>
                    <div class="col-md-12">
                        <input value="{{ old('name') }}" name="name" placeholder="Enter name" type="text" class="form-control form-control-line">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-email" class="col-md-12">Price</label>
                    <div class="col-md-12">
                        <input value="{{ old('price') }}" type="text" class="form-control form-control-line" name="price" id="example-email">
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
                                    <option value="{{ $categoryId }} @if ($categoryId == old('category_id')) selected @endif">{{ $categoryName }}</option>
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
                                    <option value="{{ $brandId }}" @if ($brandId == old('brand_id')) selected @endif>{{ $brandName }}</option>
                                @endforeach
                            @endif
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Sale</label>
                    <div class="col-md-12">
                        <select id="saleId" name="sale" class="form-control form-control-line">
                           <option value="0" @if (old('sale') == 0) selected @endif>New</option>
                           <option value="1" @if (old('sale') == 1) selected @endif>Sale</option>
                    </select>
                    </div>
                </div>
                <div id="saleVale" class="form-group">
                    <label class="col-md-12">Sale value</label>
                    <div class="col-md-12">
                        <input value="{{ old('saleValue') }}" name="saleValue" type="text" class="form-control form-control-line">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Sale value</label>
                    <div class="col-md-12">
                        <input value="{{ old('avatar') }}" name="avatar[]" type="file" multiple="multiple" class="form-control form-control-line">
                        @error('avatar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success">Add product</button>
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
        $("#saleVale").hide();
        $("#saleId").change(function(){
            let saleId = $("#saleId").val();
            if (saleId == 1) {
                $("#saleVale").show();
            }else{
                $("#saleVale").hide();
            }
        });
    });
</script>