@extends('layouts.app')
@section('content')
    <section class="details-myaccount">
        <div class="container">
            <h2 class="text-uppercase mb-5">My account</h2>
            <div class="row">
                <div class="col-lg-4">
                    @include('user.user-nav')
                </div>
                <div class="col-lg-8">
                    <p class="mb-1">Hello <strong>{{ Auth::user()->name }}</strong></p>
                    <p>From your account dashboard you can view your <a href="" class="fw-semibold text-decoration-underline">recent orders</a>, manage your <a href="" class="fw-semibold text-decoration-underline">shipping addresses</a>, and <a href="" class="fw-semibold text-decoration-underline">edit your password and account details.</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection