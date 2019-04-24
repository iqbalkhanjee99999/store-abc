@extends('layouts.login')

@section('content')
<div class="login-content">
    <div class="nk-block toggled" id="l-login">
        <div class="nk-form">
            <h3 class="text-center" style="color:#356b8c">LOGIN</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <span class="input-group-addon nk-ic-st-pro"><i class="fa fa-envelope"></i></span>
                    <div class="nk-int-st">
                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  required placeholder="Email">

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="input-group mg-t-15">
                    <span class="input-group-addon nk-ic-st-pro"><i class="fa fa-lock"></i></span>
                    <div class="nk-int-st">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required ">

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="fm-checkbox" style="text-align:right !important">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <button type="submit" class="btn btn-login btn-success btn-float" style="position: absolute;bottom: -20px;"><i class="notika-icon notika-right-arrow right-arrow-ant"></i></button>
            </form>
        </div>
    </div>
</div>
@endsection
