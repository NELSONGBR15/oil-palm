@extends('layouts.guest')

@section('content')
    <div class="auth">
        <div class="auth__header">
            <div class="auth__logo">
                <img height="90" src="{{ asset('assets/images/favicon.ico') }}" alt="logo">
            </div>
        </div>
        <div class="auth__body">
            <form class="auth__form" autocomplete="off" method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="auth__form_body">
                    <h3 class="auth__form_title">Reset Password</h3>
                    <div>
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label class="text-uppercase small">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email" autocomplete="off">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-uppercase small">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autocomplete="off">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="text-uppercase small">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmed" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="auth__form_actions">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
