@extends('layouts.app')

@section("title", "Login / Register")

@section("breadcrumb")
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Login / Register</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-ptb lagin-and-register-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <!-- login-register-tab-list start -->
                        <div class="login-register-tab-list nav">
                            <a class="active" data-toggle="tab" href="#lg1">
                                <h4> login </h4>
                            </a>
                            <a data-toggle="tab" href="#lg2">
                                <h4> register </h4>
                            </a>
                        </div>
                        <!-- login-register-tab-list end -->
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="login-input-box">
                                                <input type="email" name="email"
                                                       class="@error('email') is-invalid @enderror" placeholder="Email"
                                                       value="{{ old('email') }}" required autocomplete="email"
                                                       autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <input type="hidden" name="type" value="vendor">
                                                <input type="password" name="password"
                                                       class="@error('password') is-invalid @enderror" required
                                                       autocomplete="" placeholder="Password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <input type="checkbox" name="remember"
                                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label>Remember me</label>
                                                    @if (Route::has('password.request'))
                                                        <a href="{{ route('password.request') }}">
                                                            {{ __('Lost your password?') }}
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="button-box">
                                                    <button class="login-btn btn" type="submit"><span>Login</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="lg2" class="tab-pane">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="login-input-box">
                                                <input type="text" name="first_name"
                                                       class="form-control @error('first_name') is-invalid @enderror"
                                                       placeholder="First Name" value="{{ old('first_name') }}" required
                                                       autocomplete="first_name" autofocus>
                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                               </span>
                                                @enderror

                                                <input type="text" name="last_name"
                                                       class="form-control @error('last_name') is-invalid @enderror"
                                                       placeholder="Last Name" value="{{ old('last_name') }}" required
                                                       autocomplete="last_name" autofocus>
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                               </span>
                                                @enderror
                                                <input name="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       placeholder="Email" type="email" value="{{ old('email') }} "
                                                       required autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                               </span>
                                                @enderror
                                                <input type="password" name="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       placeholder="Password" required autocomplete="off">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <input type="password" name="password_confirmation"
                                                       class="form-control @error('confirm_password') is-invalid @enderror"
                                                       placeholder="Confirm Password" required autocomplete="off">
                                                <div class="captcha mb-3">

                                                <span>{!! captcha_img() !!}</span>
                                                <button type="button" class="btn btn-default ml-3" id="refresh"><i class="fa fa-refresh" ></i></button>
                                                </div>
                                                <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" required="">

                                                @error('captcha')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            <div class="button-box">
                                                <button class="register-btn btn" type="submit"><span>Register</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- main-content-wrap end -->

<!-- jQuery JS -->
<script src="{{ asset('assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){

    $('#refresh').click(function(){

      $.ajax({
         type:'GET',
         url:'refreshcaptcha',
         success:function(data){
            $(".captcha span").html(data.captcha);
         }
      });
    });
})
</script>
@endsection
