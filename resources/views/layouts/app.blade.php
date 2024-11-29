<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack("styles")
</head>
<body>
    <header class="py-2 position-sticky top-0 border-bottom bg-white">
        <nav class="navbar navbar-expand-lg">
            <div class="search-container d-none border-top py-5" id="search-container">
                <div class="container">
                    <h5 class="title">What are you looking for?</h5>
                    <div class="position-relative mb-4">
                        <form action="#" method="get">
                            <input type="text" class="w-100 border-0 p-1" placeholder="Search products" name="query" id="search-input">
                            <i class="fa fa-search fa-lg search-icon"></i>
                        </form>
                    </div>
                    <ul class="mb-0 p-0" id="search-result">
                    </ul>
                </div>
            </div>
            <div class="container">
                <i class="fa fa-bars fa-lg navbar-toggler border-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"></i>
                <a class="navbar-brand" href="{{ route('home.index') }}">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="logo">
                </a>
                <a href="{{ route('cart.index') }}" class="d-lg-none">
                    <i class="fa fa-lg fa-shopping-bag"></i>
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="search-bar d-lg-none">
                        <input type="text" class="w-100 rounded-1 p-2 border" placeholder="Search products">
                        <i class="fa fa-search fa-lg search-icon"></i>
                    </div>
                    <ul class="navbar-nav me-auto ms-lg-5 mb-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home.index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('shop.index') }}">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home.contact') }}">Contact</a>
                        </li>
                    </ul>
                    <ul class="navbar-icons d-flex gap-5 mb-0 p-0">
                        <li class="d-none d-lg-block pointer"><i class="fa fa-lg fa-search" id="openSearch"></i></li>
                        @guest
                            <li><a href="{{ route('login') }}"><i class="fa fa-lg fa-user-o"></i></a></li>
                        @else   
                            <li>
                                <a href="{{ Auth::user()->utype === "ADM" ? route('admin.index') : route('user.index') }}">
                                    <span class="me-1">{{ Auth::user()->name }}</span>
                                    <i class="fa fa-lg fa-user-o"></i>
                                </a>
                            </li>
                        @endguest
                        <li><a href=""><i class="fa fa-lg fa-heart-o"></i></a></li>
                        <li class="d-none d-lg-block"><a href="{{ route('cart.index') }}"><i class="fa fa-lg fa-shopping-bag"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer class="footer pt-5 border-top">
        <div class="container">
            <div class="row row-cols-2 row-cols-lg-5">
                <div class="col-12 footer-info">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" width="180">
                    <p class="footer-address mt-3">Kathmandu, Nepal</p>

                    <p class="mb-1 fw-medium"><a href="mailto:contact@gmail.com">contact@gmail.com</a></p>
                    <p class="fw-medium"><a href="tel: 9810000000">9810000000</a></p>

                    <ul class="social-links ps-0 d-flex gap-4">
                        <li><a href=""><i class="fa fa-facebook"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                        <li><a href=""><i class="fa fa-instagram"></i></a></li>
                        <li><a href=""><i class="fa fa-youtube"></i></a></li>
                        <li><a href=""><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h5 class="footer-title">Company</h5>
                    <ul class="footer-list ps-0">
                        <li class="mb-2"><a href="" class="nav-link">About Us</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Careers</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Affiliates</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Blog</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h5 class="footer-title">Shop</h5>
                    <ul class="footer-list ps-0">
                        <li class="mb-2"><a href="" class="nav-link">New Arrivals</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Accessories</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Men</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Women</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Shop All</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h5 class="footer-title">Help</h5>
                    <ul class="footer-list ps-0">
                        <li class="mb-2"><a href="" class="nav-link">Customer Service</a></li>
                        <li class="mb-2"><a href="" class="nav-link">My Account</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Find a Store</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Legal & Privacy</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Gift Card</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h5 class="footer-title">Categories</h5>
                    <ul class="footer-list ps-0">
                        <li class="mb-2"><a href="" class="nav-link">Shirts</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Jeans</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Shoes</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Bags</a></li>
                        <li class="mb-2"><a href="" class="nav-link">Shop All</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom border-top mt-3 py-3">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <p class="mb-0">&copy;2024 Surfside Media</p>
                    <p class="mb-0">Privacy Policy | Terms & Conditions</p>
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
        $(function(){
            $('#search-input').on("keyup",function(){
                var searchQuery = $(this).val();
                if(searchQuery.length > 2){
                    $.ajax({
                        type: "GET",
                        url: "{{ route('home.search') }}",
                        date: {query: searchQuery},
                        dataType: 'json',
                        success: function(data){
                            $("#search-result").html('');
                            $.each(data,function(index,item){
                                var url = "{{ route('shop.details',['product_slug'=>'product_slug_pls']) }}"
                                var link = url.replace('product_slug_pls',item.slug)
                                $("#search-result").append(`
                                        <li class='product-search-card mb-2'>
                                            <a href="${link}" class='d-flex gap-2'>
                                                <img src = "{{ asset('uploads/products/thumbnails/${item.image}') }}" height = 100 width = 100>
                                                <h3 class= 'product-title'>${item.name}</h3>
                                            </a>
                                        </li>
                                `)
                            })
                        }
                    })
                }
            })
        })
    </script>
    @stack('script')
</body>
</html>
