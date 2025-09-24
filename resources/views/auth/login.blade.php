@extends('layouts.public')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-5">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header text-center bg-light">
                <h4 class="mb-0 text-secondary">{{ __('Login') }}</h4>
            </div>

            <div class="card-body p-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label text-muted">{{ __('Email Address') }}</label>
                        <input id="email" type="email" 
                               class="form-control rounded-3 @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label text-muted">{{ __('Password') }}</label>
                        <input id="password" type="password" 
                               class="form-control rounded-3 @error('password') is-invalid @enderror" 
                               name="password" required>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label text-muted" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-light border rounded-3">
                            {{ __('Login') }}
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        @if (Route::has('password.request'))
                            <a class="d-block small text-decoration-none text-secondary mb-2" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif

                        <a href="{{ route('register') }}" class="small text-decoration-none text-primary">
                            {{ __("Don't have an account? Create one") }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
