@extends('layouts.app')

@section('content')
<section class="login-form my-5">
    <div class="text-center">
        <h3 class="login-title pb-1 d-inline-block mb-5">Login</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" class="w-100 p-3 form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pass">Password *</label>
                        <input type="password" id="pass" class="w-100 p-3 form-control @error('password') is-invalid @enderror" name="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button class="d-block py-3 w-100 text-white">LOG IN</button>
                </form>
                <p class="mt-4 text-center">No Account Yet? <a href="{{ route('register') }}" class="text-underline">Create Account</a></p>
            </div>
        </div>
    </div>
</section>
@endsection
