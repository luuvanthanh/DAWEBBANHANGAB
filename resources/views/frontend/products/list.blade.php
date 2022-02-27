@extends('frontend.layouts.master-account')
@section('content')
<section id="cart_items">
    <div class="col-lg-8 col-xlg-9 col-md-7">
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
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Id</td>
                        <td class="description">Name</td>
                        <td class="price">Image</td>
                        <td class="quantity">Price</td>
                        {{-- <td class="total">Action</td> --}}
                        <td colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Colorblock Scuba</td>
                        <td style="width: 30px" class="cart_product">
                            <a href=""><img src="{{ asset('frontend/images/cart/one.png') }}" alt=""></a>
                        </td>
                        <td class="cart_price">
                            <p>$59</p>
                        </td>
                        <td style="float: left" class="cart_delete">
                            <a class="cart_quantity_delete" href="">Edit</i></a>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('getProduct') }}" class="btn btn-fefault cart">
                <i class="fa fa-shopping-cart"></i>
                Add product
            </a>
        </div>
    </div>
</section>
@endsection
