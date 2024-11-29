@extends('layouts.app')
@section('content')
    <section class="details-myaccount">
        <div class="container">
            <h2 class="text-uppercase mb-5">Orders</h2>
            <div class="row">
                <div class="col-lg-3">
                    @include('user.user-nav')
                </div>
                <div class="col-lg-9">
                    <div class="w-100 overflow-x-scroll">
                        <table class="w-100 table-bordered">
                            <tr class="bg-warning text-white">
                                <th>OrderNo</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Subtotal</th>
                                <th>Tax</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>Items</th>
                                <th>Delivered On</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td>${{ $order->subtotal }}</td>
                                    <td>${{ $order->tax }}</td>
                                    <td>${{ $order->total }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->orderItems->count() }}</td>
                                    <td>{{ $order->delivered_date }}</td>
                                    <td><a href="{{ route('user.order-details',['order_id'=>$order->id]) }}"><i class="fa fa-eye"></i></a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    {{ $orders->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>
@endsection
