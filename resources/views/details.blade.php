@extends('layouts.app')
@section('content')
    <section class="product-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-3 order-1 order-lg-0 my-3 my-lg-0">
                            <div thumbsSlider="" class="swiper product-thumbs">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="product-thumb-image">
                                            <img src="{{ asset('uploads/products/thumbnails/' . $product->image) }}"
                                                alt="" class="w-100">
                                        </div>
                                    </div>
                                    @foreach (explode(',', $product->images) as $gimg)
                                        <div class="swiper-slide">
                                            <div class="product-thumb-image">
                                                <img src="{{ asset('uploads/products/thumbnails/' . $gimg) }}"
                                                    alt="" class="w-100">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="swiper product-single-swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="product-single-image">
                                            <img src="{{ asset('uploads/products/' . $product->image) }}" alt=""
                                                class="w-100">
                                        </div>
                                    </div>
                                    @foreach (explode(',', $product->images) as $gimg)
                                        <div class="swiper-slide">
                                            <div class="product-single-image">
                                                <img src="{{ asset('uploads/products/' . $gimg) }}" alt=""
                                                    class="w-100">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <h2>{{ $product->name }}</h2>
                    <div class="d-flex gap-3 mb-3">
                        <div>
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                            <i class="fa fa-star review-star"></i>
                        </div>
                        <p class="mb-0">8k+ reviews</p>
                    </div>
                    <h4 class="product-single-price mb-4">
                        @if ($product->sale_price)
                            <del>${{ $product->regular_price }}</del>
                            <span class="text-danger">${{ $product->sale_price }}</span>
                        @else
                            ${{ $product->regular_price }}
                        @endif
                    </h4>
                    <p class="mb-5">{{ $product->short_description }}</p>
                    @if (Cart::instance('cart')->content()->where('id',$product->id)->count()>0)
                        <a href="{{ route('cart.index') }}" class="fw-medium text-decoration-underline">Already in Cart. Go to Cart</a> 
                    @else
                        <form action="{{ route('cart.add') }}" method="post">
                            <div class="cart-single d-flex gap-2 flex-wrap">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->name }}">
                                <input type="hidden" name="price" value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price}}">
                                <div class="d-flex border cart-quantity-btns py-2">
                                    <button id="decrementQuantity" class="px-3" type="button">-</button>
                                    <input type="number" id="quantity-cart" value="1" name="quantity">
                                    <button id="incrementQuantity" class="px-3" type="button">+</button>
                                </div>
                                <button class="d-inline-block bg-dark py-2 px-5 text-uppercase text-white" type="submit">Add to cart</button>
                            </div>
                        </form>
                    @endif
                    <div class="d-flex gap-3 my-4">
                        <a href="" class="text-uppercase fw-medium"><i class="fa fa-heart-o me-2"></i>Add to
                            wishlist</a>
                        <a href="" class="text-uppercase fw-medium"><i class="fa fa-share-alt me-2"></i>Share</a>
                    </div>
                    <ul class="product-single-details ps-0">
                        <li><span class="text-uppercase">SKU:</span> {{ $product->SKU }}</li>
                        <li><span class="text-uppercase">Categories:</span>{{ $product->category->name }}</li>
                        <li><span class="text-uppercase">Tags:</span> Biker, black, leather</li>
                    </ul>
                </div>
            </div>
            <div class="product-tabs mt-5">
                <ul class="nav nav-underline ps-0 justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase active" href="#tabDescription" data-bs-toggle="tab" role="tab"
                            aria-controls="tabDescription" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="#tabInformation" data-bs-toggle="tab" role="tab"
                            aria-controls="tabInformation" aria-selected="false">Additional Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase" href="#tabReviews" data-bs-toggle="tab" role="tab"
                            aria-controls="tabReviews" aria-selected="false">Reviews</a>
                    </li>
                </ul>
                <div class="tab-content mt-3">
                    <div class="tab-pane show fade active" id="tabDescription" role="tabpanel">
                        {{ $product->description }}
                    </div>
                    <div class="tab-pane show fade" id="tabInformation" role="tabpanel">
                        <table class="w-100">
                            <tr>
                                <th>Weight</th>
                                <td>1.25kg</td>
                            </tr>
                            <tr>
                                <th>Dimensions</th>
                                <td>90 x 60 x 90 cm</td>
                            </tr>
                            <tr>
                                <th>Size</th>
                                <td>XS, S, M, L, XL</td>
                            </tr>
                            <tr>
                                <th>Color</th>
                                <td>Black, Orange, White</td>
                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane show fade" id="tabReviews" role="tabpanel">
                        <div class="reviews">
                            <div class="review-card border-bottom pb-2 pt-3">
                                <div class="d-flex gap-3">
                                    <div class="user-icon"></div>
                                    <div class="review-head">
                                        <div class="d-flex justify-content-between">
                                            <h6>Janice Miller</h6>
                                            <div>
                                                <i class="fa fa-star review-star"></i>
                                                <i class="fa fa-star review-star"></i>
                                                <i class="fa fa-star review-star"></i>
                                                <i class="fa fa-star review-star"></i>
                                                <i class="fa fa-star review-star"></i>
                                            </div>
                                        </div>
                                        <p class="mb-3">April 06, 2023</p>
                                        <div class="review-details">
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur pariatur
                                                totam similique recusandae necessitatibus provident praesentium expedita
                                                enim saepe tenetur est, architecto dignissimos odio rerum nihil minima.
                                                Inventore, expedita perspiciatis?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="review-card border-bottom pb-2 pt-3">
                                <div class="d-flex gap-3">
                                    <div class="user-icon"></div>
                                    <div class="review-head">
                                        <div class="d-flex justify-content-between">
                                            <h6>Janice Miller</h6>
                                            <div>
                                                <i class="fa fa-star review-star"></i>
                                                <i class="fa fa-star review-star"></i>
                                                <i class="fa fa-star review-star"></i>
                                                <i class="fa fa-star review-star"></i>
                                                <i class="fa fa-star review-star"></i>
                                            </div>
                                        </div>
                                        <p class="mb-3">April 06, 2023</p>
                                        <div class="review-details">
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur pariatur
                                                totam similique recusandae necessitatibus provident praesentium expedita
                                                enim saepe tenetur est, architecto dignissimos odio rerum nihil minima.
                                                Inventore, expedita perspiciatis?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="review-form mt-3">
                            <h5 class="mb-4">Add Your Review</h5>
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input type="text" id="name" class="w-100 p-3">
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" class="w-100 p-3">
                            </div>
                            <div class="form-group">
                                <textarea name="" id="" class="w-100 p-3" rows="6" placeholder="Your Review"></textarea>
                            </div>
                            <div class="d-flex align-items-center">
                                <input type="checkbox" name="" id="" class="custom-checkbox me-2">
                                <span>Save my name, email, and website in this browser for the next time I comment.</span>
                            </div>
                            <button
                                class="bg-dark py-2 px-5 text-white text-uppercase text-center d-inline-block mt-3">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="related-products">
        <div class="container position-relative">
            <h3 class="text-uppercase mb-3">Related <span class="fw-bold">Products</span></h3>
            <div class="swiper relatedSwiper">
                <div class="swiper-wrapper">
                    @foreach ($related_products as $related_product)
                        <div class="swiper-slide">
                            <div class="product-card product-hover product-shop-card">
                                <a href="{{ route('shop.details', ['product_slug' => $related_product->slug]) }}">
                                    <div class="product-img-wrapper">
                                        <div class="product-img-cover">
                                            <img src="{{ asset('uploads/products/' . $related_product->image) }}"
                                                alt="{{ $related_product->name }}">
                                        </div>
                                        <div class="product-img-back">
                                            @foreach (explode(',', $related_product->images) as $gimg)
                                                <img src="{{ asset('uploads/products/'.$gimg) }}"
                                                    alt="{{ $related_product->name }}">
                                                @break
                                            @endforeach
                                        </div>
                                        @if (Cart::instance('cart')->content()->where('id', $related_product->id)->count() > 0)
                                        <a href="{{ route('cart.index') }}"
                                            class="add-to-cart-btn py-2 px-5">Go
                                            to Cart</a>
                                    @else
                                        <form action="{{ route('cart.add') }}" method="post">
                                            <div class="cart-single d-flex gap-2 flex-wrap">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $related_product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="name" value="{{ $related_product->name }}">
                                                <input type="hidden" name="price" value="{{ $related_product->sale_price == '' ? $related_product->regular_price : $related_product->sale_price}}">
                                                <button class="add-to-cart-btn py-2 px-5" type="submit">Add to cart</button>
                                            </div>
                                        </form>
                                        @endif
                                    </div>
                                </a>
                                <div class="product-details mt-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="product-shop-category">{{ $related_product->category->name }}</h6>
                                        <i class="fa fa-heart-o"></i>
                                    </div>
                                    <h4 class="product-title mb-1"><a
                                            href="{{ route('shop.details', ['product_slug' => $related_product->slug]) }}">{{ $related_product->name }}</a>
                                    </h4>
                                    <p class="product-shop-price">
                                        @if ($related_product->sale_price)
                                            <del>${{ $related_product->regular_price }}</del>
                                            <span class="text-danger">${{ $related_product->sale_price }}</span>
                                        @else
                                            ${{ $related_product->regular_price }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-button-next-out"></div>
            <div class="swiper-button-prev-out"></div>
        </div>
    </section>
@endsection
@push('script')
    <script>
        var swiperThumb = new Swiper(".product-thumbs", {
            spaceBetween: 10,
            slidesPerView: 4,
            watchSlidesProgress: true,
            breakpoints: {
                992: {
                    direction: "vertical"
                }
            }
        });
        var swiper = new Swiper(".product-single-swiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiperThumb,
            }
        });
        var relatedSwiper = new Swiper(".relatedSwiper", {
            slidesPerView: 1,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next-out",
                prevEl: ".swiper-button-prev-out",
            },
            breakpoints: {
                450:{
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
            },
        });
    </script>
@endpush
