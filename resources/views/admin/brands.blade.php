@extends('layouts.admin')
@section('content')
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="fw-bold">Brands</h4>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Brands</li>
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
            <a href="{{ route('admin.add-brand') }}" class="add-btn">+ Add New</a>
        </div>
        @session('status')
            <div class="alert alert-success">
                {{ Session::get('status') }}
            </div>
        @endsession
        <div class="w-100 overflow-x-auto">
            <table class="w-100 table-bordered">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Products</th>
                    <th>Action</th>
                </tr>
                @foreach ($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td class="d-flex gap-2">
                            <img src="{{ asset('uploads/brands/' . $brand->image) }}" alt="{{ $brand->name }}">
                            {{ $brand->name }}
                        </td>
                        <td>{{ $brand->slug }}</td>
                        <td></td>
                        <td>
                            <a href="{{ route('admin.edit-brand', ['id' => $brand->id]) }}" class="text-success me-2"><i
                                    class="fa fa-pencil"></i></a>
                            <button class="text-danger bg-transparent" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                data-bs-id="{{ $brand->id }}"><i class="fa fa-trash-o"></i></button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="pagination">
            {{ $brands->links('pagination::bootstrap-5') }}
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this brand?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form action="{{ route('admin.delete-brand', ['id' => 1]) }}" method="post" id="deleteForm">
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
        form.action = '/admin/brands/delete/' + brandId;
    });
</script>
@endpush