@extends('layouts.admin')
@section('content')
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="fw-bold">Add Slide</h4>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.slides') }}">Sliders</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Slider</li>
                </ol>
            </nav>
        </div>
    </div>
    <form action="{{ route('admin.slide-store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="add-form">
            <div class="row align-items-center row-gap-4">
                <div class="col-md-4">
                    <label for="title" class="form-label mb-0">Title <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="w-100 form-input" placeholder="Enter title" id="title" name="title"
                        value="{{ old('title') }}">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="tagline" class="form-label mb-0">Tagline <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="w-100 form-input" placeholder="Enter tagline" id="tagline" name="tagline"
                        value="{{ old('tagline') }}">
                    @error('tagline')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="subtitle" class="form-label mb-0">Subtitle <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="w-100 form-input" placeholder="Enter subtitle" id="subtitle"
                        name="subtitle" value="{{ old('subtitle') }}">
                    @error('subtitle')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="link" class="form-label mb-0">Link <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="w-100 form-input" placeholder="Enter link" id="link" name="link"
                        value="{{ old('link') }}">
                    @error('link')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="status" class="form-label mb-0">Status <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <select name="status" id="status" class="w-100 form-input">
                        <option value="">Select</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="image" class="form-label mb-0">Upload Images <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <div class="image-container text-center mb-3" id="form-gallery">
                        <input type="file" id="gallery" name="image" hidden>
                        <i class="fa fa-cloud-upload fa-2x"></i>
                        <p class="mb-0">Browse file to upload</p>
                    </div>
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror
                    <button class="add-submit">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
