@extends('layouts.app');
@section('content')
    <main class="my-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="sidebar" id="sidebar">
                        <div class="sidebar-top d-flex justify-content-between d-lg-none p-4 align-items-center">
                            <h5>Filter By</h5>
                            <i class="fa fa-times fa-lg sidebar-close"></i>
                        </div>
                        <div class="p-4 p-lg-0">
                            <div class="accordion" id="accordionCategories">
                                <div class="accordion-item mb-4">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fw-medium text-uppercase p-0" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseProduct"
                                            aria-expanded="false" aria-controls="collapseProduct">
                                            Product Categories
                                        </button>
                                    </h2>
                                    <div id="collapseProduct" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionCategories">
                                        <div class="accordion-body p-0 pt-3">
                                            <ul class="ps-0">
                                                @foreach ($categories as $category)
                                                    <li class="py-1 d-flex align-items-center">
                                                        <input type="checkbox" name="categories" value="{{ $category->id }}"
                                                            class="filter-category me-2"
                                                            @if (in_array($category->id, explode(',', $f_categories))) checked @endif>
                                                        {{ $category->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion" id="accordionColor">
                                <div class="accordion-item mb-4">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fw-medium text-uppercase p-0" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#colapseColor" aria-expanded="false"
                                            aria-controls="colapseColor">
                                            Colors
                                        </button>
                                    </h2>
                                    <div id="colapseColor" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionColor">
                                        <div class="accordion-body p-0 pt-3">
                                            <ul class="ps-0 d-flex gap-4 flex-wrap">
                                                <li><a href="" class="color-filter"
                                                        style="background-color: #0a2472;"></a>
                                                </li>
                                                <li><a href="" class="color-filter"
                                                        style="background-color: #0a2472;"></a>
                                                </li>
                                                <li><a href="" class="color-filter"
                                                        style="background-color: #0a2472;"></a>
                                                </li>
                                                <li><a href="" class="color-filter"
                                                        style="background-color: #0a2472;"></a>
                                                </li>
                                                <li><a href="" class="color-filter"
                                                        style="background-color: #0a2472;"></a>
                                                </li>
                                                <li><a href="" class="color-filter"
                                                        style="background-color: #0a2472;"></a>
                                                </li>
                                                <li><a href="" class="color-filter"
                                                        style="background-color: #0a2472;"></a>
                                                </li>
                                                <li><a href="" class="color-filter"
                                                        style="background-color: #0a2472;"></a>
                                                </li>
                                                <li><a href="" class="color-filter"
                                                        style="background-color: #0a2472;"></a>
                                                </li>
                                                <li><a href="" class="color-filter"
                                                        style="background-color: #0a2472;"></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion" id="accordionSizes">
                                <div class="accordion-item mb-4">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fw-medium text-uppercase p-0" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSizes" aria-expanded="false"
                                            aria-controls="collapseSizes">
                                            Sizes
                                        </button>
                                    </h2>
                                    <div id="collapseSizes" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionSizes">
                                        <div class="accordion-body p-0 pt-3">
                                            <ul class="ps-0 d-flex gap-3 flex-wrap">
                                                <li><a href=""
                                                        class="size-filter d-inline-block border py-2 px-4">XS</a>
                                                </li>
                                                <li><a href=""
                                                        class="size-filter d-inline-block border py-2 px-4">S</a>
                                                </li>
                                                <li><a href=""
                                                        class="size-filter d-inline-block border py-2 px-4">M</a>
                                                </li>
                                                <li><a href=""
                                                        class="size-filter d-inline-block border py-2 px-4">L</a>
                                                </li>
                                                <li><a href=""
                                                        class="size-filter d-inline-block border py-2 px-4">XL</a>
                                                </li>
                                                <li><a href=""
                                                        class="size-filter d-inline-block border py-2 px-4">XXL</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion" id="accordionBrands">
                                <div class="accordion-item mb-4">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fw-medium text-uppercase p-0" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseBrand"
                                            aria-expanded="false" aria-controls="collapseBrand">
                                            Brands
                                        </button>
                                    </h2>
                                    <div id="collapseBrand" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionBrands">
                                        <div class="accordion-body p-0 pt-3">
                                            <div class="search-bar">
                                                <input type="text" class="w-100 rounded-1 p-2 border"
                                                    placeholder="Search products">
                                                <i class="fa fa-search fa-lg search-icon"></i>
                                            </div>
                                            <ul class="ps-0 mt-2">
                                                @foreach ($brands as $brand)
                                                    <li class="py-1 d-flex align-items-center">
                                                        <input type="checkbox" name="brands" value="{{ $brand->id }}"
                                                            class="custom-checkbox me-2"
                                                            @if (in_array($brand->id, explode(',', $f_brands))) checked @endif>
                                                        <span class="me-auto">{{ $brand->name }}</span>
                                                        <span>{{ $brand->products->count() }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion" id="accordionPrices">
                                <div class="accordion-item mb-4">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fw-medium text-uppercase p-0" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapsePrice"
                                            aria-expanded="false" aria-controls="collapsePrice">
                                            Prices
                                        </button>
                                    </h2>
                                    <div id="collapsePrice" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionPrices">
                                        <div class="accordion-body p-0 pt-3">
                                            <div class="d-flex gap-2">
                                                <input type="number" placeholder="Min" name="minPrice"
                                                    class="flex-grow-1 p-1 price-range" value="{{ $min_price }}">
                                                <input type="number" placeholder="Max" name="maxPrice"
                                                    class="flex-grow-1 p-1 price-range" value="{{ $max_price }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="main-content h-100">
                        <div class="shop-banner w-100">
                            <div class="row ms-0">
                                <div class="col-md-4 col-lg-6 p-md-0">
                                    <div class="shop-banner-text p-2 d-flex align-items-center h-100">
                                        <div>
                                            <h2>Women's <span class="d-block fw-bold">Accessiories</span></h2>
                                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Modi eius
                                                minima
                                                quasi
                                                voluptatum facere delectus voluptates molestiae corrupti, ab quo!</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-6 p-md-0">
                                    <img src="https://surfsidemedia.github.io/Laravel-11-E-Commerce-Project/Website/assets/images/shop/shop_banner3.jpg"
                                        alt="" class="w-100">
                                </div>
                            </div>
                        </div>
                        <div class="shop-products mt-3">
                            <div class="shop-header">
                                <div class="d-flex justify-content-between">
                                    <div class="breadcrumb-shop">
                                        <a href="{{ route('home.index') }}" class="fw-medium text-uppercase">Home</a> /
                                        <span class="fw-medium text-uppercase">Shop</span>
                                    </div>
                                    <div class="shop-options">
                                        <select name="pagesize" id="pagesize" class="me-3">
                                            <option value="12" {{ $size == 12 ? 'selected' : '' }}>12</option>
                                            <option value="24" {{ $size == 24 ? 'selected' : '' }}>24</option>
                                            <option value="48" {{ $size == 48 ? 'selected' : '' }}>48</option>
                                        </select>
                                        <select name="orderby" id="orderby" class="me-3">
                                            <option value="-1" {{ $order == -1 ? 'selected' : '' }}>Default</option>
                                            <option value="1" {{ $order == 1 ? 'selected' : '' }}>Latest</option>
                                            <option value="2" {{ $order == 2 ? 'selected' : '' }}>Oldest</option>
                                            <option value="3" {{ $order == 3 ? 'selected' : '' }}>Price Low to High
                                            </option>
                                            <option value="4" {{ $order == 4 ? 'selected' : '' }}>Price High to Low
                                            </option>
                                        </select>
                                        <button id="filter" class="d-lg-none">Filter</button>
                                    </div>
                                </div>
                            </div>
                            <div class="shop-product-wrapper mt-4">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-6 col-md-4">
                                            <div class="product-shop-card">
                                                <div class="product-shop-img-wrapper">
                                                    <div class="swiper product-card-swiper">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <div class="product-shop-img">
                                                                    <a
                                                                        href="{{ route('shop.details', ['product_slug' => $product->slug]) }}">
                                                                        <img src="{{ asset('uploads/products/' . $product->image) }}"
                                                                            alt="{{ $product->name }}" class="w-100">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide">
                                                                @foreach (explode(',', $product->images) as $gimg)
                                                                    <div class="product-shop-img">
                                                                        <a
                                                                            href="{{ route('shop.details', ['product_slug' => $product->slug]) }}">
                                                                            <img src="{{ asset('uploads/products/' . $gimg) }}"
                                                                                alt="{{ $product->name }}"
                                                                                class="w-100">
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="swiper-button-next"></div>
                                                        <div class="swiper-button-prev"></div>
                                                    </div>
                                                    @if (Cart::instance('cart')->content()->where('id', $product->id)->count() > 0)
                                                        <a href="{{ route('cart.index') }}"
                                                            class="add-to-cart-btn py-2 px-5">Go
                                                            to Cart</a>
                                                    @else
                                                        <form action="{{ route('cart.add') }}" method="post">
                                                            <div class="cart-single d-flex gap-2 flex-wrap">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $product->id }}">
                                                                <input type="hidden" name="quantity" value="1">
                                                                <input type="hidden" name="name"
                                                                    value="{{ $product->name }}">
                                                                <input type="hidden" name="price"
                                                                    value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}">
                                                                <button class="add-to-cart-btn py-2 px-5"
                                                                    type="submit">Add to cart</button>
                                                            </div>
                                                        </form>
                                                    @endif
                                                </div>
                                                <div class="product-details mt-3">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="product-shop-category">{{ $product->category->name }}
                                                        </h6>
                                                        <i class="fa fa-heart-o"></i>
                                                    </div>
                                                    <h4 class="product-title mb-1"><a
                                                            href="{{ route('shop.details', ['product_slug' => $product->slug]) }}">{{ $product->name }}</a>
                                                    </h4>
                                                    <p class="product-shop-price">
                                                        @if ($product->sale_price)
                                                            <del>${{ $product->regular_price }}</del>
                                                            <span class="text-danger">${{ $product->sale_price }}</span>
                                                        @else
                                                            ${{ $product->regular_price }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-10">
                                    {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <form action="{{ route('shop.index') }}" id="form_filter" method="get">
        <input type="hidden" name="page" value="{{ $products->currentPage() }}">
        <input type="hidden" name="size" id="size" value="{{ $size }}">
        <input type="hidden" name="order" id="order" value="{{ $order }}">
        <input type="hidden" name="brands" id="brands">
        <input type="hidden" name="categories" id="categories">
        <input type="hidden" name="min" id="minPrice" value="{{ $min_price }}">
        <input type="hidden" name="max" id="maxPrice" value="{{ $max_price }}">
    </form>
@endsection

@push('script')
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
        var swiper = new Swiper(".product-card-swiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            loop: true
        });
        $(function() {
            $('#pagesize').on("change", (function() {
                $('#size').val($('#pagesize option:selected').val())
                $('#form_filter').submit();
            }))
            $('#orderby').on("change", (function() {
                $('#order').val($('#orderby option:selected').val())
                $('#form_filter').submit();
            }))
            $("input[name='brands']").on('change', function() {
                var brands = '';
                $("input[name='brands']:checked").each(function() {
                    if (brands == "") {
                        brands += $(this).val();
                    } else {
                        brands += ',' + $(this).val();
                    }
                })
                $('#brands').val(brands)
                $('#form_filter').submit();
            })
            $("input[name='categories']").on('change', function() {
                var categories = '';
                $("input[name='categories']:checked").each(function() {
                    if (categories == "") {
                        categories += $(this).val();
                    } else {
                        categories += ',' + $(this).val();
                    }
                })
                $('#categories').val(categories)
                $('#form_filter').submit();
            })
            $('.price-range').each(function() {
                $(this).on('keypress', function(e) {
                    $('#minPrice').val($("input[name='minPrice']").val())
                    $('#maxPrice').val($("input[name='maxPrice']").val())
                    if (e.which == 13) {
                        $('#form_filter').submit();
                    }
                })
            })
        })
    </script>
@endpush
