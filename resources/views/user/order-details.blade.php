@extends('layouts.app')
@section('content')
<section class="details-myaccount">
    <div class="container">
        <h2 class="text-uppercase mb-5">Order Details</h2>
        <div class="row">
            <div class="col-lg-3">
                @include('user.user-nav')
            </div>
            <div class="col-lg-9">
                <div class="table-container rounded-3 p-3 w-100 mt-2 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5>Order Details</h5>
                        <a href="{{ route('admin.orders') }}" class="btn btn-outline btn-primary">Go Back</a>
                    </div>
                    @if (Session::has('status'))
                        <p class="alert alert-success mb-1">{{ Session::get('status') }}</p>
                    @endif
                    <div class="w-100 overflow-x-auto">
                        <table class="w-100 table-bordered">
                            <tr>
                                <th>Order No</th>
                                <td>{{ $order->id }}</td>
                                <th>Mobile</th>
                                <td>{{ $order->phone }}</td>
                                <th>Zip</th>
                                <td>{{ $order->zip }}</td>
                            </tr>
                            <tr>
                                <th>Ordered Date</th>
                                <td>{{ $order->created_at }}</td>
                                <th>Delivery Date</th>
                                <td>{{ $order->delivered_at }}</td>
                                <th>Cancelled Date</th>
                                <td>{{ $order->cancelled_date }}</td>
                            </tr>
                            <tr>
                                <th>Order Status</th>
                                <td colspan="5">
                                    @if ($order->status == 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                    @elseif ($order->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-warning">Ordered</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="table-container rounded-3 p-3 w-100 mt-2 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5>Ordered Items</h5>
                    </div>
                    <div class="w-100 overflow-x-auto">
                        <table class="w-100 table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>SKU</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Options</th>
                                <th>Return Status</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($orderItems as $orderItem)
                                <tr>
                                    <td>{{ $orderItem->product->name }}</td>
                                    <td>{{ $orderItem->price }}</td>
                                    <td>{{ $orderItem->quantity }}</td>
                                    <td>${{ $orderItem->product->SKU }}</td>
                                    <td>${{ $orderItem->product->category->name }}</td>
                                    <td>${{ $orderItem->product->brand->name }}</td>
                                    <td>{{ $orderItem->options }}</td>
                                    <td>{{ $orderItem->rstatus == 0 ? "No" : "Yes" }}</td>
                                    <td><a href="{{ route('shop.details',['product_slug'=>$orderItem->product->slug]) }}" class="text-primary"><i class="fa fa-eye"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    {{ $orderItems->links('pagination::bootstrap-5') }}
                </div>
                <div class="table-container rounded-3 p-3 w-100 bg-white mt-3">
                    <h5>Shipping Address</h5>
                    <div class="my-account__address-item col-md-6">
                        <div class="my-account__address-item__detail">
                            <p class="mb-1">{{ $order->name }}</p>
                            <p class="mb-1">{{ $order->address }}</p>
                            <p class="mb-1">{{ $order->locality }}</p>
                            <p class="mb-1">{{ $order->city }}</p>
                            <p class="mb-1">{{ $order->ladnmark }}</p>
                            <p class="mb-1">{{ $order->zip }}</p>
                            <p class="mb-1">{{ $order->phone }}</p>
                        </div>
                    </div>
                </div>
                <div class="table-container rounded-3 p-3 w-100 bg-white mt-3">
                    <h5>Transactions</h5>
                    <table class="table table-striped table-bordered table-transaction">
                        <tbody>
                            <tr>
                                <th>Subtotal</th>
                                <td>${{ $order->subtotal }}</td>
                                <th>Tax</th>
                                <td>${{ $order->tax }}</td>
                                <th>Discount</th>
                                <td>${{ $order->discount }}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>{{ $order->total }}</td>
                                <th>Payment Mode</th>
                                <td>{{ $order->transaction->mode }}</td>
                                <th>Status</th>
                                <td>{{ $order->transaction->status }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if ($order->status == 'ordered')
                <div class="text-end mt-3">
                    <form action="{{ route('user.order-cancel') }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <button class="btn btn-danger">Cancel Order</button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection