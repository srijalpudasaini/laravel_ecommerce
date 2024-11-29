@extends('layouts.admin')
@section('content')
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="fw-bold">All Orders</h4>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Orders</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="table-container rounded-3 p-3 w-100 mt-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="search-bar">
                <input type="text" class="rounded-3" placeholder="Search Here...">
                <i class="fa fa-search fa-lg pointer"></i>
            </div>
        </div>
        <div class="w-100 overflow-x-auto">
            <table class="w-100 table-bordered">
                <tr>
                    <th>Order No</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Subtotal</th>
                    <th>Tax</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Total Items</th>
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
                        <td><a href="{{ route('admin.order-details',['order_id'=>$order->id]) }}" class="text-primary"><i class="fa fa-eye"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
@endsection
