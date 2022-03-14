<!doctype html>
<html lang="en">
  <head>
    <title>Order</title>
    <meta charset="utf-8">
  </head>
  <body>
    <div class="container">
        <div class="row">
          <section id="cart_items">
            <div class="container">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                    <li class="active">Thông tin mặt hàng đã đặt</li>
                    </ol>
                </div>
                <div class="table-responsive cart_info">
                    <table style=" border-collapse: collapse;border: 1px solid;">
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
                                $tongThanhToan = 0;
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
                                    $tongThanhToan += $total;
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
                                                <input class="cart_quantity_input" type="text" name="quantity" value="{{ $item['quantity'] }}" autocomplete="off" size="2">
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
                      <label style="color: blue" for="">Tổng tiền thanh toán: ${{$tongThanhToan}}</label>
                </div>
            </div>
        </section>
        </div>
    </div>
  </body>
</html>