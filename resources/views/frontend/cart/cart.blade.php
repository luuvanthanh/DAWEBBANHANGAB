<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('frontend.layouts.master')
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
                </ol>
                <div class="alert alert-success" role="alert">
                    Cập nhật giỏ hàng thành công
                </div>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $tongTien = 0;
                        @endphp
                        @if (session()->has('cart'))
                        @php
                            $data = array_values(session()->get('cart'));
                        @endphp
                        @foreach ($data as $key => $item)
                            @php
                                $images = json_decode($item['image'], true);
                                $total = $item['price'] * $item['quantity'];
                                $tongTien += $total;
                            @endphp
                                <tr>
                                    <input class="product-id" type="hidden" value="{{ $item['id'] }}">
                                    @foreach ($images as $img)
                                        <td class="cart_product">
                                            <a href=""><img style="width: 30%" src="{{ asset('upload/product/'.$item['user_id'].'/'.$img.'') }}" alt=""></a>
                                        </td>
                                        @php
                                            break;
                                        @endphp
                                    @endforeach
                                    <td class="cart_description">
                                        <h4><a href="">{{ $item['name'] }}</a></h4>
                                    </td>
                                    <td class="cart_price">
                                        <p class="price">${{ $item['price'] }}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <a class="cart_quantity_up"> + </a>
                                            <input class="cart_quantity_input" type="text" name="quantity" value="{{ $item['quantity'] }}" autocomplete="off" size="2">
                                            <a class="cart_quantity_down"> - </a>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">${{ $total }}</p>
                                    </td>
                                    <td class="cart_delete">
                                        <a class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->
    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <input type="checkbox">
                                <label>Use Coupon Code</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Use Gift Voucher</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Estimate Shipping & Taxes</label>
                            </li>
                        </ul>
                        <ul class="user_info">
                            <li class="single_field">
                                <label>Country:</label>
                                <select>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                
                            </li>
                            <li class="single_field">
                                <label>Region / State:</label>
                                <select>
                                    <option>Select</option>
                                    <option>Dhaka</option>
                                    <option>London</option>
                                    <option>Dillih</option>
                                    <option>Lahore</option>
                                    <option>Alaska</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                            
                            </li>
                            <li class="single_field zip-field">
                                <label>Zip Code:</label>
                                <input type="text">
                            </li>
                        </ul>
                        <a class="btn btn-default update" href="">Get Quotes</a>
                        <a class="btn btn-default check_out" href="">Continue</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>$59</span></li>
                            <li>Eco Tax <span>$2</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span class="total-price">{{$tongTien}}</span></li>
                        </ul>
                            <a class="btn btn-default update" href="">Update</a>
                            <a class="btn btn-default check_out" href="{{ route('getCheckout') }}">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
@endsection
<script>
    $(document).ready(function(){
        $(".alert-success").hide();
        // Tăng số lượng trong giỏ hàng
        $("a.cart_quantity_up").click(function(){
            var id = $(this).closest("tr").find("input.product-id").val();
            var quantity = $(this).closest(".cart_quantity_button").find("input").val();
            quantity = Number(quantity) + 1;
            $(this).closest(".cart_quantity_button").find("input").val(quantity);
            let qtyCart = $("span.quantity-cart").text();
            qtyCart = Number(qtyCart) + 1;
            $("span.quantity-cart").text(qtyCart);
            let price = $(this).closest("tr").find("p.price").text();
            price = price.replace('$','');
            price = Number(price);
            let total = 0;
            total = quantity * price;
            $(this).closest("tr").find("p.cart_total_price").text(total+'$');
            let tongTien = $(".total-price").text();
            tongTien = Number(tongTien);
            tongTien = tongTien + price;
            $(".total-price").text(tongTien+'$');
            $.ajax({
                url: "{{ route('UpQuantity') }}",
                method: "POST",
                data: {
                    id: id
                },
                success:function(response){
                    if (response.success) {
                        $(".alert-success").show();
                    }
                }
            });
        });
        // Giảm số lượng trong giỏ hàng
        $("a.cart_quantity_down").click(function(){
            var id = $(this).closest("tr").find("input.product-id").val();
            var quantity = $(this).closest(".cart_quantity_button").find("input").val();
            quantity = Number(quantity) - 1;
            $(this).closest(".cart_quantity_button").find("input").val(quantity);
            let qtyCart = $("span.quantity-cart").text();
            qtyCart = Number(qtyCart) - 1;
            $("span.quantity-cart").text(qtyCart);
            if (quantity < 1) {
                $(this).closest("tr").remove();
            }
            let price = $(this).closest("tr").find("p.price").text();
            price = price.replace('$','');
            price = Number(price);
            let total = 0;
            total = quantity * price;
            $(this).closest("tr").find("p.cart_total_price").text(total+'$');
            let tongTien = $(".total-price").text();
            tongTien = Number(tongTien);
            tongTien = tongTien - price;
            $(".total-price").text(tongTien+'$');
            $.ajax({
                url: "{{ route('DownQuantity') }}",
                method: "POST",
                data: {
                    id: id
                },
                success:function(response){
                    if (response.success) {
                        $(".alert-success").show();
                    }
                }
            });
        });
        // Xóa product trong giỏ hàng
        $("a.cart_quantity_delete").click(function(){
            var id = $(this).closest("tr").find("input.product-id").val();
            var total = $(this).closest("tr").find("p.cart_total_price").text();
            total = total.replace('$','');
            total = Number(total);
            let tongTien = $(".total-price").text();
            tongTien = Number(tongTien);
            tongTien = tongTien - total;
            $(".total-price").text(tongTien+'$');
            $(this).closest("tr").remove();
            $.ajax({
                url: "{{ route('DeleteCart') }}",
                method: "POST",
                data: {
                    id: id
                },
                success:function(response){
                    if (response.success) {
                        $(".alert-success").show();
                    }
                }
            });
        });
    });
</script>