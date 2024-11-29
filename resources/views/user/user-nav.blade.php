<ul class="ps-0 mb-0">
    <li class="mb-3 text-uppercase fw-medium"><a href="{{ route('user.index') }}">Dashboard</a></li>
    <li class="mb-3 text-uppercase fw-medium"><a href="{{ route('user.orders') }}">Orders</a></li>
    <li class="mb-3 text-uppercase fw-medium"><a href="">Addresses</a></li>
    <li class="mb-3 text-uppercase fw-medium"><a href="">Account Details</a></li>
    <li class="mb-3 text-uppercase fw-medium"><a href="">Wishlist</a></li>
    <li class="mb-3 text-uppercase fw-medium">
        <form action="{{ route('logout') }}" method="POST" id="logout-form">
            @csrf
            <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="pointer">Logout</a>
        </form>
    </li>
</ul>