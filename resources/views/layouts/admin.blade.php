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
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack("styles")
</head>
<body>
    <div class="layout" id="layout">
        <aside class="sidebar">
            <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                <img src={{ asset('images/logo.png') }} alt="Logo" height=33 width=138>
                <i class="fa fa-times fa-lg pointer" id="sidebar-close"></i>
            </div>
            <nav class="sidebar-menu mt-4">
                <ul class="nav-list ps-0">
                    <li class="px-3 mb-1"><a href="{{ route('admin.index') }}" class="nav-link p-2"><i
                                class="fa fa-th-large me-2"></i>Dashboard</a></li>
                    <li class="px-3 mb-1 has-menu-dropdown">
                        <a class="nav-link p-2"><i class="fa fa-shopping-cart me-2"></i>Product</a>
                        <ul class="sub-menu">
                            <li class="mb-1"><a href="{{ route('admin.add-product') }}" class="submenu-link">Add Product</a></li>
                            <li class="mb-1"><a href="{{ route('admin.products') }}" class="submenu-link">Products</a></li>
                        </ul>
                    </li>
                    <li class="px-3 mb-1 has-menu-dropdown">
                        <a class="nav-link p-2"><i class="fa fa-clone me-2"></i>Brands</a>
                        <ul class="sub-menu">
                            <li class="mb-1"><a href="{{ route('admin.add-brand') }}" class="submenu-link">Add Brand</a></li>
                            <li class="mb-1"><a href="{{ route('admin.brands') }}" class="submenu-link">Brands</a></li>
                        </ul>
                    </li>
                    <li class="px-3 mb-1 has-menu-dropdown">
                        <a class="nav-link p-2"><i class="fa fa-clone me-2"></i>Category</a>
                        <ul class="sub-menu">
                            <li class="mb-1"><a href="{{ route('admin.add-category') }}" class="submenu-link">Add Category</a></li>
                            <li class="mb-1"><a href="{{ route('admin.categories') }}" class="submenu-link">Categories</a></li>
                        </ul>
                    </li>
                    <li class="px-3 mb-1 has-menu-dropdown">
                        <a class="nav-link p-2"><i class="fa fa-picture-o me-2"></i>Slider</a>
                        <ul class="sub-menu">
                            <li class="mb-1"><a href="{{ route('admin.add-slide') }}" class="submenu-link">Add Slider</a></li>
                            <li class="mb-1"><a href="{{ route('admin.slides') }}" class="submenu-link">Sliders</a></li>
                        </ul>
                    </li>
                    <li class="px-3 mb-1 has-menu-dropdown">
                        <a class="nav-link p-2"><i class="fa fa-plus-square-o me-2"></i>Order</a>
                        <ul class="sub-menu">
                            <li class="mb-1"><a href="{{ route('admin.orders') }}" class="submenu-link">Orders</a></li>
                            <li class="mb-1"><a href="order-tracking.html" class="submenu-link">Order Tracking</a></li>
                        </ul>
                    </li>
                    <li class="px-3 mb-1 has-menu-dropdown">
                        <a class="nav-link p-2"><i class="fa fa-dollar me-2"></i>Coupons</a>
                        <ul class="sub-menu">
                            <li class="mb-1"><a href="{{ route('admin.coupons') }}" class="submenu-link">Coupons</a></li>
                            <li class="mb-1"><a href="{{ route('admin.add-coupon') }}" class="submenu-link">Add Coupon</a></li>
                        </ul>
                    </li>
                    <li class="px-3 mb-1"><a href="{{ route('admin.contacts') }}" class="nav-link p-2"><i class="fa fa-envelope me-2"></i>Messages</a>
                    <li class="px-3 mb-1"><a href="user.html" class="nav-link p-2"><i class="fa fa-user-o me-2"></i>User</a>
                    </li>
                    <li class="px-3 mb-1"><a href="settings.html" class="nav-link p-2"><i class="fa fa-cog me-2"></i>Settings</a>
                    </li>
                </ul>
            </nav>
        </aside>
        <main>
            <header class="p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex gap-2 align-items-center">
                        <img src="assets/images/logo.png" alt="" height="40" width="170" class="d-lg-none">
                        <i class="fa fa-bars fa-lg pointer" id="sidebar-open"></i>
                        <div class="search-bar d-none d-lg-block position-relative">
                            <form action="#" method="get">    
                                <input type="text" name="query" class="rounded-3" placeholder="Search Here..." id="search-input">
                                <i class="fa fa-search fa-lg pointer"></i>
                            </form>
                            <ul id="search-result">
    
                            </ul>
                        </div>
                    </div>
                    <div class="d-none d-lg-flex gap-4 align-items-center">
                        <div class="notification-icon pointer has-dropdown" data-target="#notification-dropdown">
                            <i class="fa fa-bell-o fa-lg"></i>
                            <div class="notification-badge"><span class="position-relative">1</span></div>
                            <div class="notification-dropdown dropdown-menu p-3" id="notification-dropdown">
                                <h6 class="pb-2 border-bottom fw-semibold">Notifications</h6>
                                <ul class="notifications ps-0">
                                    <li class="d-flex gap-2 mb-3">
                                        <div class="notification-icon-container notification-blue">
                                            <i class="fa fa-certificate"></i>
                                        </div>
                                        <div class="notification-detail">
                                            <h6 class="notification-title">Discount</h6>
                                            <p class="mb-0 text-secondary">Lorem ipsum, dolor sit amet consectetur
                                                adipisicing elit.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex gap-2 mb-3">
                                        <div class="notification-icon-container notification-purple">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <div class="notification-detail">
                                            <h6 class="notification-title">Account Verfied</h6>
                                            <p class="mb-0 text-secondary">Lorem ipsum, dolor sit amet consectetur
                                                adipisicing elit.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex gap-2 mb-3">
                                        <div class="notification-icon-container notification-green">
                                            <i class="fa fa-archive"></i>
                                        </div>
                                        <div class="notification-detail">
                                            <h6 class="notification-title">Order Shipped</h6>
                                            <p class="mb-0 text-secondary">Lorem ipsum, dolor sit amet consectetur
                                                adipisicing elit.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex gap-2 mb-3">
                                        <div class="notification-icon-container notification-orange">
                                            <i class="fa fa-certificate"></i>
                                        </div>
                                        <div class="notification-detail">
                                            <h6 class="notification-title">Order Pending</h6>
                                            <p class="mb-0 text-secondary">Lorem ipsum, dolor sit amet consectetur
                                                adipisicing elit.</p>
                                        </div>
                                    </li>
                                </ul>
                                <a href="" class="btn btn-primary d-block py-2">View All</a>
                            </div>
                        </div>
                        <div class="user-profile d-flex gap-2 align-items-center pointer has-dropdown"
                            data-target="#user-dropdown">
                            <div class="user-icon">
                                <img src="https://surfsidemedia.github.io/Laravel-11-E-Commerce-Project/Admin/images/avatar/user-1.png"
                                    alt="" height="40" width="40">
                            </div>
                            <div>
                                <h6 class="mb-0">User Name</h6>
                                <p class="text-secondary mb-0">Admin</p>
                            </div>
                            <div class="user-dropdown dropdown-menu p-3" id="user-dropdown">
                                <ul class="ps-0">
                                    <li class="mb-2"><a href=""><i class="fa me-2 fa-user-o"></i>Account</a></li>
                                    <li class="mb-2"><a href=""><i class="fa me-2 fa-envelope-o"></i>Inbox</a></li>
                                    <li class="mb-2"><a href=""><i class="fa me-2 fa-file-text-o"></i>Taskboard</a></li>
                                    <li class="mb-2"><a href=""><i class="fa me-2 fa-headphones"></i>Support</a></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                            @csrf
                                            <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa me-2 fa-sign-out"></i>Logout</a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="main-content p-4">
                @yield('content')
            </div>
        </main>
    </div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
        $(function(){
            $('#search-input').on("keyup",function(){
                var searchQuery = $(this).val();
                if(searchQuery.length > 2){
                    $.ajax({
                        type: "GET",
                        url: "{{ route('admin.search') }}",
                        date: {query: searchQuery},
                        dataType: 'json',
                        success: function(data){
                            $("#search-result").html('');
                            $.each(data,function(index,item){
                                var url = "{{ route('admin.product-edit',['id'=>'product_slug_pls']) }}"
                                var link = url.replace('product_slug_pls',item.id)
                                $("#search-result").append(`
                                        <li class='product-search-card mb-2 pb-2'>
                                            <a href="${link}" class='d-flex gap-2'>
                                                <img src = "{{ asset('uploads/products/thumbnails/${item.image}') }}" height = 50 width = 50>
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
