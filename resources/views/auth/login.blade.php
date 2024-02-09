@extends('layouts.guest')

@section('content')
    <div class="auth">
        <div class="auth__header">
            <div class="auth__logo">
                <img height="90" src="{{ asset('assets/images/icono-user.png') }}" alt="logo">
            </div>
        </div>
        <div class="auth__body">
            <form class="auth__form" autocomplete="off" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="auth__form_body">
                    <h3 class="auth__form_title">Sign in</h3>
                    <div>
                        <div class="form-group">
                            <label class="text-uppercase small">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" autocomplete="off">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-uppercase small">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="auth__form_actions">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">
                        LOGIN
                    </button>
                    <div class="mt-2">
                        <a href="#" class="small text-uppercase">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
