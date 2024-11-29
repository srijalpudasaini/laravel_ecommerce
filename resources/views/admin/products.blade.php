@extends('layouts.admin')

@section('content')
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="fw-bold">All Products</h4>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Products</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="table-container rounded-3 p-3 w-100 mt-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div class="search-bar">
                <input type="text" class="rounded-3" placeholder="Search Here...">
                <i class="fa fa-search fa-lg pointer"></i>
            </div>
            <a href="{{ route('admin.add-product') }}" class="add-btn">+ Add New</a>
        </div>
        @if(Session::has('status'))
            <div class="alert alert-success">
                {{ Session::get('status') }}
            </div>
        @endif
        <div class="w-100 overflow-x-auto">
            <table class="w-100 table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Sale Price</th>
                    <th>SKU</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Featured</th>
                    <th>Stock</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td class="d-flex gap-2">
                            <img src="{{ asset('uploads/products/thumbnails/' . $product->image) }}" alt="{{ $product->name }}">
                            {{ $product->name }}
                        </td>
                        <td>${{ $product->regular_price }}</td>
                        <td>${{ $product->sale_price }}</td>
                        <td>{{ $product->SKU }}</td>
                        <td>{{ $product->brand->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->featured == '0' ? 'No' : 'Yes'}}</td>
                        <td>{{ $product->stock_status }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <a href="" class="text-primary me-2"><i class="fa fa-eye"></i></a>
                            <a href="{{ route('admin.product-edit',['id'=>$product->id]) }}" class="text-success me-2"><i class="fa fa-pencil"></i></a>
                            <button class="text-danger bg-transparent" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-bs-id="{{ $product->id }}"><i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form action="" method="post" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script>
    var exampleModal = document.getElementById('exampleModal');
    exampleModal.addEventListener('show.bs.modal', function (event) {
        // Button that triggered the modal
        var button = event.relatedTarget;
        
        // Extract info from data-bs-* attributes
        var brandId = button.getAttribute('data-bs-id');
        
        // Update the form action dynamically
        var form = document.getElementById('deleteForm');
        form.action = '/admin/product/delete/' + brandId;
    });
</script>
@endpush
