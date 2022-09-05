@extends('layouts.auth')

@section('content')

    <div class="container" id="login_container">
        <div id="header">
{{--            <div id="logo">--}}
{{--                <img class="title" src="https://www.online-anytime.com.au/admin-logo1.png" style="margin-left: 8px;">--}}
{{--            </div>--}}
        </div>
        <div class="row justify-content-center" id="login_main">
            <div class="container p-0">
                <div class="card">
                    <div style="padding-top:10px">
                        <span id="login_logo" class="icon-shield"><i class="fas fa-user-shield"></i></span>
                        <h3>Sign In to Quiz maker</h3>
                        <p>Sign in below to create or edit your forms</p>
                        <div style="clear:both; border-bottom: 1px dotted #CCCCCC;margin-top: 15px"></div>
                    </div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>

                                <div class="container p-0">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-form-label">{{ __('Password') }}</label>

                                <div class="container p-0">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="container p-0">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="container p-0">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
