@extends('layouts.admin')
@section('content')
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="fw-bold">Add Coupon</h4>
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.coupons') }}">Coupons</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Coupon</li>
                </ol>
            </nav>
        </div>
    </div>
    <form action="{{ route('admin.coupon-store') }}" method="POST">
        @csrf
        <div class="add-form">
            <div class="row align-items-center row-gap-4">
                <div class="col-md-4">
                    <label for="code" class="form-label mb-0">Coupon Code <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="w-100 form-input" placeholder="Enter coupon code" id="code"
                        name="code" value="{{ old('code') }}">
                    @error('code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="type" class="form-label mb-0">Coupon Type</label>
                </div>
                <div class="col-md-8">
                    <select name="type" id="type" class="w-100 form-input">
                        <option value="">Select</option>
                        <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : ''}}>Fixed</option>
                        <option value="percent" {{ old('type') == 'percent' ? 'selected' : ''}}>Percentage</option>
                    </select>
                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="value" class="form-label mb-0">Value <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="w-100 form-input" placeholder="Enter coupon value" id="value"
                        name="value" {{ old('value') }}>
                    @error('value')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="cvalue" class="form-label mb-0">Cart Value <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="w-100 form-input" placeholder="Enter cart value" id="cvalue"
                        name="cvalue" {{ old('cvalue') }}>
                    @error('cvalue')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="expdate" class="form-label mb-0">Expiry Date <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-8">
                    <input type="date" class="w-100 form-input" id="expdate" name="expdate">
                    @error('expdate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-8 justify-self-end">
                    <button class="add-submit">Save</button>
                </div>
            </div>
        </div>
    </form>
@endsection
