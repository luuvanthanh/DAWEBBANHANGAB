@extends('frontend.layouts.master-account')
@section('content')
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			</div>

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->
            {{-- start register --}}
            @if (!Auth::user())
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('postRegister') }}" method="POST" class="form-horizontal form-material" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="col-md-12">Full Name</label>
                                <div class="col-md-12">
                                    <input name="name" placeholder="Enter name" value="{{ old('name') }}" type="text" class="form-control form-control-line">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="example@admin.com" value="{{ old('email') }}" class="form-control form-control-line" name="email" id="example-email">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">                    
                                <label class="col-md-12">Password</label>
                                <div class="col-md-12">
                                    <input value="" name="password" value="{{ old('password') }}" type="password" value="password" class="form-control form-control-line">
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">                    
                                <label class="col-md-12">Password confirmation</label>
                                <div class="col-md-12">
                                    <input value="" name="password_confirmation" value="{{ old('password_confirmation') }}" type="password" value="password" class="form-control form-control-line">
                                    @error('password_confirmation')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Phone No</label>
                                <div class="col-md-12">
                                    <input name="phone" value="{{ old('phone') }}" type="text" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Address</label>
                                <div class="col-md-12">
                                    <input name="address" value="{{ old('address') }}" type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Avatar</label>
                                <div class="col-md-12">
                                    <input name="avatar" value="{{ old('avatar') }}" type="file" placeholder="123 456 7890" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Select Country</label>
                                <div class="col-sm-12">
                                    <select name="id_country" value="{{ old('id_country') }}" class="form-control form-control-line">
                                        @if (!empty($countries))
                                            @foreach ($countries as $countryId => $country)
                                                <option value="{{ $countryId }}">{{ $country->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            @endif

			{{-- end register --}}
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>
            <section id="cart_items">
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
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> 
@endsection