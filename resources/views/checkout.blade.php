@extends('layouts.app')
@section('content')
    <section class="cart">
        <div class="container">
            <h2 class="cart-title text-uppercase fw-bold">Cart</h2>
            <div class="cart-header">
                <div class="d-flex flex-column flex-lg-row">
                    <a href="{{ route('cart.index') }}" class="header-content p-3 header-content-active">
                        <div class="d-flex gap-2">
                            <h5 class="header-index">01</h5>
                            <div class="heeader-title">
                                <h5 class="text-uppercase mb-2">Shopping Bag</h5>
                                <p class="mb-0">Manage Your Item List</p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('cart.checkout') }}" class="header-content p-3 header-content-active">
                        <div class="d-flex gap-2">
                            <h5 class="header-index">02</h5>
                            <div class="heeader-title">
                                <h5 class="text-uppercase mb-2">Shipping and checkout</h5>
                                <p class="mb-0">Checkout Your Item List</p>
                            </div>
                        </div>
                    </a>
                    <a href="order-confirmation.html" class="header-content p-3">
                        <div class="d-flex gap-2">
                            <h5 class="header-index">03</h5>
                            <div class="heeader-title">
                                <h5 class="text-uppercase mb-2">Confirmation</h5>
                                <p class="mb-0">Review And Submit Your Order</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="cart-body mt-5">
                <form action="{{ route('cart.place-order') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 h-100 overflow-auto scrollbar-none">
                            <h5 class="text-uppercase mb-5">Shipping details</h5>
                            @if ($address)
                                <p>{{ $address->name }}</p>
                                <p>{{ $address->address }}</p>
                                <p>{{ $address->landmark }}</p>
                                <p>{{ $address->city }}, {{ $address->state }}, {{ $address->country }} </p>
                                <p>{{ $address->zip }}</p>
                                <p>{{ $address->phone }}</p>
                                {{-- <input type="hidden" name="name" value="{{ $address->name }}">
                                <input type="hidden" name="address" value="{{ $address->address }}">
                                <input type="hidden" name="landmark" value="{{ $address->landmark }}">
                                <input type="hidden" name="city" value="{{ $address->city }}">
                                <input type="hidden" name="state" value="{{ $address->state }}">
                                <input type="hidden" name="country" value="{{ $address->country }}">
                                <input type="hidden" name="zip" value="{{ $address->zip }}">
                                <input type="hidden" name="phone" value="{{ $address->phone }}"> --}}
                            @else
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Full Name *</label>
                                            <input type="text" id="name" class="w-100 p-3" name="name"
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone Number *</label>
                                            <input type="text" id="phone" class="w-100 p-3" name="phone"
                                                value="{{ old('phone') }}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="pin">Pincode *</label>
                                            <input type="number" id="pin" class="w-100 p-3" name="zip"
                                                value="{{ old('zip') }}">
                                            @error('zip')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="state">State *</label>
                                            <input type="text" id="state" class="w-100 p-3" name="state"
                                                value="{{ old('state') }}">
                                            @error('state')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="town">Town / City *</label>
                                            <input type="text" id="town" class="w-100 p-3" name="city"
                                                value="{{ old('city') }}">
                                            @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="house">House no, Building Name *</label>
                                            <input type="text" id="house" class="w-100 p-3" name="address"
                                                value="{{ old('address') }}">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="road">Road Name *</label>
                                            <input type="text" id="road" class="w-100 p-3" name="locality"
                                                value="{{ old('locality') }}">
                                            @error('locality')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="landmark">Landmark *</label>
                                            <input type="text" id="landmark" class="w-100 p-3" name="landmark"
                                                value="{{ old('landmark') }}">
                                            @error('landmark')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-4">
                            <div class="cart-totals p-4">
                                <h6 class="text-uppercase">Your Order</h6>
                                @if (Session::has('discounts'))
                                    <table class="w-100">
                                        <tr>
                                            <th class="text-uppercase">Subtotal</th>
                                            <td>${{ Cart::instance('cart')->subTotal() }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-uppercase">Disount</th>
                                            <td>${{ Session::get('discounts')['discount'] }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-uppercase">Subtotal After Disount</th>
                                            <td>${{ Session::get('discounts')['subtotal'] }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-uppercase">vat</th>
                                            <td>${{ Session::get('discounts')['tax'] }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-uppercase">Total</th>
                                            <td>${{ Session::get('discounts')['total'] }}</td>
                                        </tr>
                                    </table>
                                @else
                                    <table class="w-100">
                                        <tr>
                                            <th class="text-uppercase">Product</th>
                                            <th>Subtotal</th>
                                        </tr>
                                        @foreach (Cart::instance('cart') as $item)
                                            <tr class="border-0">
                                                <td>{{ $item->name }} x {{ $item->qty }}</td>
                                                <td>${{ item->subtotal() }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <th class="text-uppercase">SUBTOTAL</th>
                                            <td>${{ Cart::instance('cart')->subtotal() }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-uppercase">Shipping</th>
                                            <td>Free Shipping</td>
                                        </tr>
                                        <tr>
                                            <th class="text-uppercase">vat</th>
                                            <td>${{ Cart::instance('cart')->tax() }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-uppercase">Total</th>
                                            <td>${{ Cart::instance('cart')->total() }}</td>
                                        </tr>
                                    </table>
                                @endif
                            </div>
                            <div class="payment-method border p-4 mt-4">
                                <ul class="ps-0">
                                    <li class="mb-3"><input type="radio" name="mode" value="direct"
                                            id="" class="me-2"> Direct Bank Transfer</li>
                                    <li class="mb-3"><input type="radio" name="mode" value="cheque"
                                            id="" class="me-2"> Check Payment</li>
                                    <li class="mb-3"><input type="radio" name="mode" value="cod"
                                            id="" class="me-2"> Cash on Delivery</li>
                                    <li class="mb-3"><input type="radio" name="mode" value="paypal"
                                            id="" class="me-2"> Paypal</li>
                                </ul>
                                <p class="mb-0">Your personal data will be used to process your order, support your
                                    experience throughout this website, and for other purposes described in our privacy
                                    policy.
                                </p>
                            </div>
                            <button type="submit"
                                class="checkout-btn d-block w-100 py-3 text-uppercase text-white bg-dark text-center mt-3">place
                                order</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
