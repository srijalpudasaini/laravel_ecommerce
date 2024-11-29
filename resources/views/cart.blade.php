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
                    <a href="{{ route('cart.checkout') }}" class="header-content p-3">
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
                @if ($items->count() > 0)
                    <div class="row">
                        <div class="col-lg-8 h-100 overflow-auto scrollbar-none">
                            <table class="w-100 cart-table mb-3">
                                <tr class="text-uppercase">
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <img src="{{ asset('uploads/products/thumbnails/' . $item->model->image) }}"
                                                    alt="" height="100" width="100">
                                                <div class="product-cart-details">
                                                    <h4 class="product-title">{{ $item->name }}</h4>
                                                    <p class="mb-1">Color: Yellow</p>
                                                    <p class="mb-1">Size: L</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            ${{ $item->price }}
                                        </td>
                                        <td>
                                            <div class="d-flex border cart-quantity-btns py-2">
                                                <form
                                                    action="{{ route('cart.decrease_quantity', ['rowId' => $item->rowId]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="text-center">
                                                        <button class="quantity-decrement bg-transparent">-</button>
                                                    </div>
                                                </form>
                                                <input type="number" class="quantity-cart" value="{{ $item->qty }}"
                                                    size="1">
                                                <form
                                                    action="{{ route('cart.increase_quantity', ['rowId' => $item->rowId]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="text-center">
                                                        <button class="quantity-increment bg-transparent">+</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            ${{ $item->subTotal() }}
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.remove_item', ['rowId' => $item->rowId]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="bg-transparent">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <div class="row justify-content-between gap-4 flex-wrap">
                                <div class="col-md-6">
                                    <form
                                        action="{{ Session::has('coupon') ? route('cart.remove-coupon') : route('cart.apply-coupon') }}"
                                        method="post">
                                        @csrf
                                        @if (Session::has('coupon'))
                                            @method('DELETE')
                                        @endif
                                        <div class="btn-coupon">
                                            <input type="text" placeholder="Coupon Code" class="coupon p-3 w-100"
                                                name="coupon"
                                                value="@if (Session::has('coupon')) {{ Session::get('coupon')['code'] }} Applied @endif">
                                            <button class="coupon-submit p-3 fw-medium">
                                                {{ Session::has('coupon') ? 'REMOVE' : 'APPLY' }} COUPON
                                            </button>
                                        </div>
                                        @if (Session::has('success'))
                                            <span class="text-success">{{ Session::get('success') }}</span>
                                        @elseif (Session::has('error'))
                                            <span class="text-danger">{{ Session::get('error') }}</span>
                                        @endif
                                    </form>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <form action="{{ route('cart.empty') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-update p-3 px-4">CLEAR CART</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-3 mt-lg-0">
                            <div class="cart-totals p-4">
                                <h6 class="text-uppercase">Cart totals</h6>
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
                                            <th class="text-uppercase">Subtotal</th>
                                            <td>${{ Cart::instance('cart')->subTotal() }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-uppercase">Shipping</th>
                                            <td>
                                                {{-- <ul class="ps-0">
                                                    <li class="pb-1 d-flex align-items-center"><input type="checkbox"
                                                            name="" id="" class="custom-checkbox me-2">Free
                                                        Shipping</li>
                                                    <li class="pb-1 d-flex align-items-center"><input type="checkbox"
                                                            name="" id="" class="custom-checkbox me-2">Flat Rate
                                                        $49</li>
                                                    <li class="pb-1 d-flex align-items-center"><input type="checkbox"
                                                            name="" id="" class="custom-checkbox me-2">Local
                                                        pickup: $8</li>
                                                    <li class="pb-1">Shipping to address</li>
                                                    <li class="pb-1"><a href="" class="text-uppercase">Change
                                                            address</a></li>
                                                </ul> --}}
                                                Free
                                            </td>
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
                            <a href="{{ route('cart.checkout') }}"
                                class="checkout-btn d-block w-100 py-3 text-uppercase text-white bg-dark text-center mt-3">proceed
                                to checkout</a>
                        </div>
                    </div>
                @else
                    <p class="text-center py-3">No Item Found in Cart. <a href="{{ route('shop.index') }}"
                            class="text-decoration-underline fw-medium">Shop Now</a></p>
                @endif
            </div>
        </div>
    </section>
@endsection
