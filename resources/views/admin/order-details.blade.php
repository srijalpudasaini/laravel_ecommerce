@extends('layouts.admin')
@section('content')
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="fw-bold">Order Details</h4>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="table-container rounded-3 p-3 w-100 mt-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5>Ordered Details</h5>
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
                    <td>{{ $order->delivered_date }}</td>
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
    <div class="table-container rounded-3 p-3 w-100 mt-4 bg-white">
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
                        <td><a href="" class="text-primary"><i class="fa fa-eye"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $orderItems->links('pagination::bootstrap-5') }}
    </div>
    <div class="table-container rounded-3 p-3 w-100 bg-white mt-5">
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
    <div class="table-container rounded-3 p-3 w-100 bg-white mt-5">
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
                    <td>{{ $transaction->mode }}</td>
                    <th>Status</th>
                    <td>{{ $transaction->status }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="table-container rounded-3 p-3 w-100 bg-white mt-5">
        <h5>Update Order Status</h5>
        <form action="{{ route('admin.update-order') }}" method="post">
            @csrf
            @method('PUT')
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <select name="status" id="" class="form-input w-25 me-3">
                <option value="ordered" {{ $order->status == 'ordered' ? 'selected' : ''}}>Ordered</option>
                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : ''}}>Delivered</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : ''}}>Cancelled</option>
            </select>
            <button class="add-submit text-center">Update</button>
        </form>
    </div>
@endsection
