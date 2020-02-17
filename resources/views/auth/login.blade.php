@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-md-right">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <small id="emailHelp" class="form-text text-muted">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="form-group mb-0">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                            
                        </div>
                        <div class="form-group mt-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">{{ __('Login') }}</button>
                                <a class="btn btn-light btn-lg btn-block" href="{{ route('login.social', ['site' => 'github']) }}">
                                    <strong><i class="fab fa-github icon"></i> Login with Github</strong>
                                </a>
                                <a href="{{ route('login.social', ['site' => 'kakao']) }}" class="btn-block" style="background: #F7E317; text-align: center">
                                    <img src="{{ asset('/images/common/kakao_account_login_btn_medium_narrow.png') }}" />
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
