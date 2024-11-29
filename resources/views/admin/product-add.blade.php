@extends('layouts.admin')

@section('content')
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="fw-bold">Add Product</h4>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">All Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                </ol>
            </nav>
        </div>
    </div>
    <form action="{{ route('admin.product-store') }}" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xl-6">
                <div class="add-form">
                    @csrf
                    <div class="form-input-group">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="w-100 form-input" placeholder="Enter product name" id="name"
                            name="name" value="{{ old('name') }}">
                        <p class="form-note">Do not exceed 100 characters when entering the product name.</p>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-input-group">
                        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                        <input type="text" class="w-100 form-input" placeholder="Enter slug" id="slug"
                            name="slug" value="{{ old('slug') }}">
                        <p class="form-note">Do not exceed 100 characters when entering the product name.</p>
                        @error('slug')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-input-group">
                                <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                <select name="category_id" id="category" class="w-100 form-input">
                                    <option value="">Choose category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"  {{ old('category_id') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input-group">
                                <label for="brand" class="form-label">Brand <span class="text-danger">*</span></label>
                                <select name="brand_id" id="brand" class="w-100 form-input">
                                    <option value="">Choose Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : ''}}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-input-group">
                        <label for="sdescription" class="form-label">Short Description <span
                                class="text-danger">*</span></label>
                        <textarea name="sdescription" id="sdescription" class="w-100 form-input" placeholder="Short Description" rows="8">{{ old('sdescription') }}</textarea>
                        @error('sdescription')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-input-group">
                        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" class="w-100 form-input" placeholder="Description" rows="8">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="add-form">
                    <div class="form-input-group">
                        <label for="image" class="form-label">Upload Images <span class="text-danger">*</span></label>
                        <div class="image-container text-center" id="form-image">
                            <input type="file" id="image" name="image" hidden>
                            <i class="fa fa-cloud-upload fa-2x"></i>
                            <p class="mb-0">Browse file to upload</p>
                        </div>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-input-group">
                        <label for="gallery" class="form-label">Upload Gallery Images <span
                                class="text-danger">*</span></label>
                        <div class="image-container text-center" id="form-gallery">
                            <input type="file" id="gallery" name="gallery[]" multiple hidden>
                            <i class="fa fa-cloud-upload fa-2x"></i>
                            <p class="mb-0">Browse file to upload</p>
                        </div>
                        @error('gallery')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-input-group">
                                <label for="price" class="form-label">Regular Price <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="w-100 form-input" placeholder="Enter regular price"
                                    id="price" name="price" value="{{ old('price') }}">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input-group">
                                <label for="sprice" class="form-label">Sale Price <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="w-100 form-input" placeholder="Enter sale price"
                                    id="sprice" name="sprice" value="{{ old('sprice') }}">
                                @error('sprice')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input-group">
                                <label for="sku" class="form-label">SKU <span class="text-danger">*</span></label>
                                <input type="text" class="w-100 form-input" placeholder="Enter SKU" id="sku"
                                    name="sku" value="{{ old('sku') }}">
                                @error('sku')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input-group">
                                <label for="quantity" class="form-label">Quantity <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="w-100 form-input" placeholder="Enter quantity"
                                    id="quantity" name="quantity" value="{{ old('quantity') }}">
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input-group">
                                <label for="stock" class="form-label">Stock</label>
                                <select name="stock" id="stock" class="w-100 form-input">
                                    <option value="instock" {{ old('stock') == 'instock' ? 'selected' : ''}}>In Stock</option>
                                    <option value="outofstock" {{ old('stock') == 'outofstock' ? 'selected' : ''}}>Out of Stock</option>
                                </select>
                                @error('stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-input-group">
                                <label for="featured" class="form-label">Featured</label>
                                <select name="featured" id="featured" class="w-100 form-input">
                                    <option value="0" {{ old('featured') == '0' ? 'selected' : ''}}>No</option>
                                    <option value="1" {{ old('featured') == '1' ? 'selected' : ''}}>Yes</option>
                                </select>
                                @error('featured')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button class="add-submit w-100 text-center">Add product</button>
                </div>
            </div>
        </div>
    </form>
@endsection
