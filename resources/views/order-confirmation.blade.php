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
                <a href="" class="header-content p-3 header-content-active">
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

            <div class="order-status text-center">
                <div class="order-icon">
                    <i class="fa fa-check fa-2x text-white"></i>
                </div>

                <h2>Your order is completed!</h2>
                <p>Thank you. Your order has been received.</p>

            </div>

            <div class="order-details my-5 p-5">
                <div class="row">
                    <div class="col-md-3">
                        <p class="mb-2">Order Number</p>
                        <h5>{{ $order->id }}</h5>
                    </div>
                    <div class="col-md-3">
                        <p class="mb-2">Date</p>
                        <h5>{{ $order->created_at }}</h5>
                    </div>
                    <div class="col-md-3">
                        <p class="mb-2">Total</p>
                        <h5>{{ $order->total }}</h5>
                    </div>
                    <div class="col-md-3">
                        <p class="mb-2">Payment Method</p>
                        <h5>{{ $order->transaction->mode }}</h5>
                    </div>
                </div>
            </div>

            <div class="cart-totals p-4">
                <h6 class="text-uppercase">Your Order</h6>
                <table class="w-100">
                    <tr>
                        <th class="text-uppercase">Product</th>
                        <th>Subtotal</th>
                    </tr>
                    @foreach ($order->orderItems as $item)
                        
                    <tr class="border-0">
                        <td>{{ $item->product->name }} x {{ $item->quantity }}</td>
                        <td>${{ $item->price }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th class="text-uppercase">SUBTOTAL</th>
                        <td>${{ $order->subtotal }}</td>
                    </tr>
                    <tr>
                        <th class="text-uppercase">Discount</th>
                        <td>{{ $order->discount }}</td>
                    </tr>
                    <tr>
                        <th class="text-uppercase">Shipping</th>
                        <td>Free Shipping</td>
                    </tr>
                    <tr>
                        <th class="text-uppercase">vat</th>
                        <td>${{ $order->vat }}</td>
                    </tr>
                    <tr>
                        <th class="text-uppercase">Total</th>
                        <td>${{ $order->total }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection