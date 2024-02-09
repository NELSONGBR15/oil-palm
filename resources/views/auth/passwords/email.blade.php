@extends('layouts.guest')

@section('content')
    <div class="auth">
        <div class="auth__header">
            <div class="auth__logo">
                <img height="90" src="{{ asset('assets/images/favicon.ico') }}" alt="logo">
            </div>
        </div>
        <div class="auth__body">
            <form class="auth__form" autocomplete="off" method="POST" action="{{ route('password.email') }}">
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @csrf
                <div class="auth__form_body">
                    <h3 class="auth__form_title">Reset Password</h3>
                    <div>
                        <div class="form-group">
                            <label class="text-uppercase small">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" autocomplete="off">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="auth__form_actions">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">
                        Send Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
