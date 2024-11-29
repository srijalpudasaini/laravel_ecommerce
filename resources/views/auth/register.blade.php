@extends('layouts.app')

@section('content')
<section class="login-form my-5">
    <div class="text-center">
        <h3 class="login-title pb-1 d-inline-block mb-5">Register</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="name" id="name" class="w-100 form-control p-3 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" class="w-100 form-control p-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile *</label>
                        <input type="number" id="mobile" class="w-100 form-control p-3 @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}">
                        @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pass">Password *</label>
                        <input type="password" id="pass" class="w-100 form-control p-3 @error('password') is-invalid @enderror" name="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cpass">Confirm Password *</label>
                        <input type="password" id="cpass" class="w-100 form-control p-3 @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <p>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.</p>
                    <button class="d-block py-3 w-100 text-white">REGISTER</button>
                </form>
                <p class="mt-4 text-center">Already have an account? <a href="{{ route('login') }}" class="text-underline">Login here</a></p>
            </div>
        </div>
    </div>
</section>
@endsection
