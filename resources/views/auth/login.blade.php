@extends('layouts.auth_master')
@section('title', 'Login')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="p-4">
                <div class="auth-logo text-center mb-4"><img src="{{ asset('backend/dist-assets/images/logo.jpeg') }}"
                        alt=""></div>
                <h1 class="mb-3 text-18">Sign In</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input class="form-control" id="email" name="email" value="{{ old('email') }}" type="email"
                            @error('email') is-invalid @enderror required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <button class="btn btn-rounded btn-primary btn-block mt-2">Sign In</button>
                </form>
                {{-- <div class="mt-3 text-center"><a class="text-muted" href="{{ route('password.request') }}">
                        <u>Forgot Password?</u></a></div> --}}
            </div>
        </div>

    </div>

@endsection
