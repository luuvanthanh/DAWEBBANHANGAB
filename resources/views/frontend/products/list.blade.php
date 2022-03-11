@extends('frontend.layouts.master-account')
@section('content')
<style>
    #image {
        width: 10px !important;
        height: 10px !important;
    }
</style>
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
                    @if (!empty($products))
                        @foreach ($products as $pro)
                        <?php
                            $images = json_decode($pro->image, true);
                        ?>
                            <tr>
                                <td>{{ $pro->id }}</td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $pro->name }}</a></h4>
                                </td>
                                @foreach ($images as $img)
                                <td class="cart_product">
                                <img 
                                    style="
                                    width: 100px;
                                    height: 100px;
                                    padding: 10px;
                                    "
                                    src="{{ asset('upload/product/'.$pro->user_id.'/'. $img.'') }}" alt=""
                                >
                                </td>
                                @php
                                    break;
                                @endphp
                                @endforeach
                                <td class="cart_price">
                                    <p>{{ $pro->price }}</p>
                                </td>
                                <td style="float: left" class="cart_delete">
                                    <a class="cart_quantity_delete" href="{{ route('editProduct', $pro->id) }}">Edit</i></a>
                                </td>
                                <td class="cart_delete">
                                    <form action="{{ route('deleteProduct', $pro->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cart_quantity_delete"><i class="fa fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <a href="{{ route('getProduct') }}" class="btn btn-fefault cart">
                <i class="fa fa-shopping-cart"></i>
                Add product
            </a>
            <div style="float: right;">
                {!!$products->links()!!}
            </div>
        </div>
    </div>
</section>
@endsection
