@extends('layouts.admin')
@section('content')
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="fw-bold">Edit Category</h4>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.categories') }}">Categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                </ol>
            </nav>
        </div>
    </div>
    <form action="{{ route('admin.category-update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $category->id }}">
        <div class="add-form">
            <div class="row align-items-center row-gap-4">
                <div class="col-md-4">
                    <label for="name" class="form-label mb-0">Category Name <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="w-100 form-input form-control @error('name') is-invalid @enderror"
                        placeholder="Enter brand name" id="name" name="name" value="{{ $category->name }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="slug" class="form-label mb-0">Category Slug <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="w-100 form-input form-control @error('name') is-invalid @enderror"
                        placeholder="Enter brand slug" id="slug" name="slug" value="{{ $category->slug }}">
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="image" class="form-label mb-0">Upload Images <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <div class="image-container text-center mb-3" id="form-gallery">
                        <input type="file" id="image" name="image" multiple hidden>
                        <i class="fa fa-cloud-upload fa-2x"></i>
                        <p class="mb-0">Browse file to upload</p>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button class="add-submit">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
