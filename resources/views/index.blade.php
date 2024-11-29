@extends('layouts.app')
@section('content')
    <section class="hero-section py-2 m-0">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($slides as $slide)
                    <div class="swiper-slide">
                        <div class="container">
                            <div class="hero-content row align-content-center">
                                <div class="col-8">
                                    <h5 class="banner-subtitle">{{ $slide->tagline }}</h5>
                                    <h1 class="banner-title">{{ $slide->title }} <span>{{ $slide->subtitle }}</span></h1>
                                    <a href="{{ $slide->link }}" class="btn-main">Shop Now</a>
                                </div>
                                <img src="{{ asset('uploads/slides/' . $slide->image) }}" alt="" class="slider-img">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="container">
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <section class="categories">
        <h2 class="section-title">You might like</h2>
        <div class="container position-relative">
            <div class="swiper catSwiper">
                <div class="swiper-wrapper">
                    @foreach ($categories as $category)
                        <div class="swiper-slide">
                            <div class="categories-card">
                                <img src="{{ asset('uploads/categories/' . $category->image) }}" alt=""
                                    class="w-100">
                                <h4 class="category-title"><a
                                        href="{{ route('shop.index', ['categories' => $category->id]) }}">{{ $category->name }}</a>
                                </h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-button-next-out"></div>
            <div class="swiper-button-prev-out"></div>
        </div>
    </section>

    <section class="hot-deals">
        <h2 class="section-title">Hot deals</h2>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="deals-head mb-5 mb-md-0">
                        <h2>Summer Sale</h2>
                        <h2 class="fw-bold mb-3 mb-lg-5">Up to 60% Off</h2>
                        <a href="" class="btn-main">View More</a>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="swiper dealSwiper">
                        <div class="swiper-wrapper">
                            @foreach ($sale_products as $sale_product)
                                <div class="swiper-slide">
                                    <div class="product-card product-hover">
                                        <a href="{{ route('shop.details', ['product_slug' => $sale_product->slug]) }}">
                                            <div class="product-img-wrapper">
                                                <div class="product-img-cover">
                                                    <img src="{{ asset('uploads/products/' . $sale_product->image) }}"
                                                        alt="">
                                                </div>
                                                <div class="product-img-back">
                                                    <img src="{{ asset('uploads/products/thumbnails/' . explode(",",$sale_product->images)[0]) }}"
                                                        alt="">
                                                </div>
                                            </div>
                                        </a>
                                        <div class="product-body">
                                            <h5 class="product-title mt-2 mb-1"><a
                                                    href="{{ route('shop.details', ['product_slug' => $sale_product->slug]) }}">{{ $sale_product->name }}</a>
                                            </h5>
                                            <p class="product-price">
                                                @if ($sale_product->sale_price)
                                                    <del>${{ $sale_product->regular_price }}</del>
                                                    <span class="text-danger">${{ $sale_product->sale_price }}</span>
                                                @else
                                                    ${{ $sale_product->regular_price }}
                                                @endif
                                            </p>
                                            <div class="product-actions">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    @if (Cart::instance('cart')->content()->where('id', $sale_product->id)->count() > 0)
                                                        <a href="{{ route('cart.index') }}"class=""><i
                                                                class="fa fa-cart"></i></a>
                                                    @else
                                                        <form action="{{ route('cart.add') }}" method="post">
                                                            <div class="cart-single d-flex gap-2 flex-wrap">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $sale_product->id }}">
                                                                <input type="hidden" name="quantity" value="1">
                                                                <input type="hidden" name="name"
                                                                    value="{{ $sale_product->name }}">
                                                                <input type="hidden" name="price"
                                                                    value="{{ $sale_product->sale_price == '' ? $sale_product->regular_price : $sale_product->sale_price }}">
                                                                <button type="submit">Add to cart</button>
                                                            </div>
                                                        </form>
                                                    @endif
                                                    <a href="{{ route('shop.details', ['product_slug' => $sale_product->slug]) }}"
                                                        class="view-btn">
                                                        <span class="d-xl-none"><i class="fa fa-eye"></i></span>
                                                        <span class="d-none d-xl-block">Quick view</span>
                                                    </a>
                                                    <a href="">
                                                        <i class="fa fa-heart-o"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="category-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="category-banner-card position-relative">
                        <div class="category-banner-img overflow-hidden rounded-2">
                            <img src="https://surfsidemedia.github.io/Laravel-11-E-Commerce-Project/Website/assets/images/home/demo3/category_10.jpg"
                                alt="" class="h-auto w-100">
                        </div>
                        <div class="category-banner-offer text-uppercase">
                            starting at $19
                        </div>
                        <div class="row justify-content-center category-banner-details">
                            <div class="col-10 rounded-3 p-3 text-center bg-white">
                                <h4 class="category-banner-title mb-2"><a href="">Sports Wear</a></h4>
                                <a href="" class="btn-main">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="category-banner-card position-relative">
                        <div class="category-banner-img overflow-hidden rounded-2">
                            <img src="https://surfsidemedia.github.io/Laravel-11-E-Commerce-Project/Website/assets/images/home/demo3/category_10.jpg"
                                alt="" class="h-auto w-100">
                        </div>
                        <div class="category-banner-offer text-uppercase">
                            starting at $19
                        </div>
                        <div class="row justify-content-center category-banner-details">
                            <div class="col-10 rounded-3 p-3 text-center bg-white">
                                <h4 class="category-banner-title mb-2"><a href="">Sports Wear</a></h4>
                                <a href="" class="btn-main">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-products">
        <div class="container">
            <h2 class="section-title">Featured products</h2>
            <div class="section-products">
                <div class="row justify-content-center">
                    @foreach ($f_products as $f_product)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product-card">
                                <a href="{{ route('shop.details', ['product_slug' => $f_product->slug]) }}">
                                    <div class="product-img-wrapper featured-product">
                                        <img src="{{ asset('uploads/products/' . $f_product->image) }}" alt=""
                                            height="310">
                                    </div>
                                </a>
                                <div class="product-body">
                                    <h5 class="product-title mt-2 mb-1"><a href="">{{ $f_product->name }}</a></h5>
                                    <p class="product-price">
                                        @if ($f_product->sale_price)
                                            <del>${{ $f_product->regular_price }}</del>
                                            <span class="text-danger">${{ $f_product->sale_price }}</span>
                                        @else
                                            ${{ $f_product->regular_price }}
                                        @endif
                                    </p>
                                    <div class="product-actions">
                                        <div class="d-flex align-items-center justify-content-between">
                                            @if (Cart::instance('cart')->content()->where('id', $f_product->id)->count() > 0)
                                                <a href="{{ route('cart.index') }}"class=""><i
                                                        class="fa fa-cart"></i></a>
                                            @else
                                                <form action="{{ route('cart.add') }}" method="post">
                                                    <div class="cart-single d-flex gap-2 flex-wrap">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $f_product->id }}">
                                                        <input type="hidden" name="quantity" value="1">
                                                        <input type="hidden" name="name"
                                                            value="{{ $f_product->name }}">
                                                        <input type="hidden" name="price"
                                                            value="{{ $f_product->sale_price == '' ? $f_product->regular_price : $f_product->sale_price }}">
                                                        <button type="submit">Add to cart</button>
                                                    </div>
                                                </form>
                                            @endif
                                            <a href="{{ route('shop.details', ['product_slug' => $f_product->slug]) }}"
                                                class="view-btn">
                                                <span class="d-xl-none"><i class="fa fa-eye"></i></span>
                                                <span class="d-none d-xl-block">Quick view</span>
                                            </a>
                                            <a href="">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-center">
                        <a href="" class="btn-main">Load more</a>
                    </div>
                </div>
            </div>
    </section>
@endsection
@push('script')
    <script>
        var swiper = new Swiper(".mySwiper", {
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                renderBullet: function(index, className) {
                    return '<span class="' + className + '">0' + (index + 1) + "</span>";
                },
                crossFade: true,
            },
        });
        var catSwiper = new Swiper(".catSwiper", {
            slidesPerView: 2,
            spaceBetween: 30,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next-out",
                prevEl: ".swiper-button-prev-out",
            },
            breakpoints: {
                480: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 6,
                    spaceBetween: 40,
                },
                1200: {
                    slidesPerView: 8,
                    spaceBetween: 50,
                },
            },
        });
        var dealSwiper = new Swiper(".dealSwiper", {
            slidesPerView: 2,
            spaceBetween: 30,
            loop: false,
            breakpoints: {
                992: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
            },
        });
    </script>
@endpush
