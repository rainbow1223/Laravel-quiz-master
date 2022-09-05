<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Quiz Maker') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
</head>
<body style="display: flex; height: 100vh; align-items: center;">
<div class="container" id="login_container">
        <div class="row justify-content-center" id="login_main">
            <div class="container p-0">
                <div class="card">
                    <div style="padding-top:10px">
                        <span id="login_logo" class="icon-shield"><i class="fas fa-user-shield"></i></span>
                        <h3>Enter your details</h3>
                        <div style="clear:both; border-bottom: 1px dotted #CCCCCC;margin-top: 15px"></div>
                    </div>

                    <div class="card-body">
                        <form method="get" action="{{ route('startExam') }}">
                            @csrf

                            <div class="form-group row">

                                <label for="firstName" class="col-form-label">{{ __('First Name') }} <sup style="color: red">*</sup> </label>

                                <div class="container p-0">
                                    <input id="firstName" type="text"
                                           class="form-control @error('firstName') is-invalid @enderror" name="firstName"
                                           value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>

                                    @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="lastName" class="col-form-label">{{ __('Last Name') }} <sup style="color: red">*</sup></label>

                                <div class="container p-0">
                                    <input id="lastName" type="text"
                                           class="form-control @error('lastName') is-invalid @enderror" name="lastName"
                                           value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>

                                    @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <label for="email" class="col-form-label">{{ __('User Email') }} <sup style="color: red">*</sup></label>

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

                            <p style="font-size: 20px; padding-bottom: 20px;">{{ __("Results will be sent to this email.") }}</p>

                            <div class="form-group row">
                                <label for="company" class="col-form-label">{{ __('Your Company') }}<sup style="color: red">*</sup></label>

                                <div class="container p-0">
                                    <input id="company" type="text"
                                           class="form-control @error('company') is-invalid @enderror" name="company"
                                           required autocomplete="current-company">

                                    @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" name="name" value="{{ $name }}">

                            <div class="form-group row mb-0">
                                <div class="container p-0">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
