@extends('layouts.app')

@section("title", "Checkout")

@section("breadcrumb")
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-ptb checkout-page">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="coupon-area">
                    @if(!auth()->check())
                        <!-- login-accordion start -->
                            <div class="coupon-accordion">
                                <h3>Returning customer? <span class="coupon" id="showlogin">Click here to login</span>
                                </h3>
                                <div class="coupon-content" id="checkout-login">
                                    <div class="coupon-info">
                                        <p>If you have shopped with us before, please enter your details in the boxes
                                            below.
                                            If you are a new customer, please proceed to the Billing &amp; Shipping
                                            section.</p>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <p class="coupon-input form-row-first">
                                                <label>Email <span class="required">*</span></label>
                                                <input type="email" name="email" id="email" disabled
                                                       class="@error('email') is-invalid @enderror" placeholder="Email"
                                                       value="{{ old('email') }}" required autocomplete="email"
                                                       autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <input type="hidden" id="total_amount" name="total_amount"
                                                       value="{{ $product->price + $product->shipping_cost }}">
                                                <input type="hidden" name="product_id" id="product_id"
                                                       value="{{$product->id}}">
                                                <input type="hidden" name="shipping_id" id="shipping_cost"
                                                       value="{{$product->shipping_cost}}">
                                                <input type="hidden" name="price" id="price"
                                                       value="{{$product->price}}">
                                            </p>
                                            <p class="coupon-input form-row-last">
                                                <label>password <span class="required">*</span></label>
                                                <input type="password" name="password"
                                                       class="@error('password') is-invalid @enderror" required
                                                       autocomplete="" placeholder="Password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </p>
                                            <div class="clear"></div>
                                            <p>
                                                <button type="submit" class="button-login btn" name="login"
                                                        value="Login">
                                                    Login
                                                </button>
                                                <label class="remember">
                                                    <input type="checkbox" name="remember"
                                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span>Remember</span>
                                                </label>
                                            </p>
                                            <p class="lost-password">
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}">
                                                        {{ __('Lost your password?') }}
                                                    </a>
                                                @endif
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- login-accordion end -->
                        @endif
                    </div>
                </div>
            </div>
            <!-- checkout-details-wrapper start -->
            <div class="checkout-details-wrapper">
                <form action="{{ route('submit-order', $product->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <!-- billing-details-wrap start -->
                            <div class="billing-details-wrap">
                                <h3 class="shoping-checkboxt-title">Delivery address</h3>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p class="single-form-row">
                                            <label>First Name <span class="required">*</span></label>
                                            <input type="text" name="first_name" id="first_name" class="form-control"
                                                   value="@auth{{ old('first_name',$user->first_name) }}@endauth">
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <p class="single-form-row">
                                            <label>Last Name <span class="required">*</span></label>
                                            <input type="text" id="last_name" name="last_name" class="form-control"
                                                   value="@auth{{ old('last_name',$user->last_name) }}@endauth">
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>Email <span class="required">*</span></label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                   value="@auth{{ old('email',$user->email) }}@endauth">
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>Street <span class="required">*</span></label>
                                            <input type="text" id="street" placeholder="Enter Street Address" required
                                                   name="street" class="form-control"
                                                   value="@auth{{ old('street', trim($user->street)) }}@endauth">
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>Street  Line <span class="required">*</span></label>
                                            <input type="text" id="street_line_2" placeholder="Street Line 2 (optional)"
                                                   name="street_line_2" class="form-control"
                                                   value="@auth{{ old('street', trim($user->street_line_2)) }}@endauth">
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>ZIP Code<span class="required">*</span></label>
                                            <input type="text" id="zip_code" name="zip_code" required
                                                   class="form-control"
                                                   placeholder="Enter Zip Code"
                                                   value="@auth{{ old('zip_code', trim($user->zip_code)) }}@endauth">
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>City <span class="required">*</span></label>
                                            <input type="text" id="city" name="city" required class="form-control"
                                                   placeholder="Enter City"
                                                   value="@auth{{ old('city', trim($user->city)) }}@endauth">
                                        </p>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>State</label>
                                            <input type="text" id="state" name="state" required class="form-control"
                                                   placeholder="Enter State"
                                                   value="@auth{{ old('state', trim($user->state)) }}@endauth">
                                        </p>
                                    </div>
                                    <div class="col-lg-12 mb-20">
                                        <div class="single-form-row">
                                            <label>Country <span class="required">*</span></label>
                                            @php
                                                $countries->prepend("Select Country...", "");
                                            @endphp
                                            {!! Form::select('country_id', $countries, old('country_id', $user->country_id), ['id' => 'country_id', 'class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>Phone</label>
                                            <input type="text" id="phone_no" name="phone_no" required
                                                   class="form-control"
                                                   placeholder="Enter Phone"
                                                   value="@auth{{ old('phone', trim($user->phone_no)) }}@endauth">
                                        </p>
                                    </div>

                                    <div class="col-lg-12">
                                        <p class="single-form-row">
                                            <label>Message to the dealer</label>
                                            <textarea name="message" id="message" rows="3"
                                                      class="form-control"></textarea>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- billing-details-wrap end -->
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <!-- your-order-wrapper start -->
                            <div class="your-order-wrapper">
                                <h3 class="shoping-checkboxt-title">Cost Summary</h3>
                                <!-- your-order-wrap start-->
                                <div class="your-order-wrap">
                                    <!-- your-order-table start -->
                                    <div class="your-order-table table-responsive">
                                        <div class="col-sm-12 col-lg-12">
                                            <div class="">
                                                <strong>You will pay the seller directly.</strong><br>
                                                <span>They will provide you with information about the available payment methods.</span>
                                            </div>
                                        </div>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <th class="product-name">Name</th>
                                                <th class="product-total text-wrap"><span class="amount">{{$product->name}}</span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="product-name">Image</th>
                                                @php
                                                    if(file_exists('admin/images/products/'.$product->productPictures()->first()->picture))
                                                            $sellerPicture = asset('admin/images/products/'.$product->productPictures()->first()->picture);
                                                        else
                                                            $sellerPicture = asset('admin/images/default-watch-picture.gif');
                                                @endphp
                                                <th class="product-image text-center">
                                                    <img alt="{{ $product->name }}" style="width: 100px; height: 100px;"
                                                         class="flag-icon-for-seller"
                                                         src="{{ $sellerPicture }}">
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="product-name">Item price</th>
                                                <th class="product-total"><span
                                                        class="amount">{{$product->currency->symbol}}{{$product->price}}</span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="product-name">Shipping price</th>
                                                <th class="product-total"><span
                                                        class="amount">{{$product->currency->symbol}}{{$product->shipping_cost}}</span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="product-name"><strong>Total price</strong></th>
                                                <th class="product-total">
                                                <span
                                                    class="amount"><strong>{{$product->currency->symbol}}{{$product->shipping_cost + $product->price}}</strong></span>
                                                </th>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- your-order-table end -->
                                    <!-- your-order-wrap end -->
                                    <div class="payment-method">
                                        <div class="payment-accordion">
                                            <!-- ACCORDION START -->
                                            <div class="payment-content">
                                                <p><a href="javascript:void(0)" class="theme-color" target="_blank">Customs
                                                        duties and import taxes</a> may be
                                                    incurred in addition to the price listed above.</p>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="payment-content">
                                            <label for="checkoutTermsAccepted">
                                                <input name="checkoutTermsAccepted" required id="checkoutTermsAccepted"
                                                       type="checkbox">
                                                <span class="fluent">
                                                I have read and accept the
                                                <a href="javascript:void(0);" class="theme-color" target="_blank">
                                                    General Terms &amp; Conditions of Sale</a>.
                                            </span>
                                            </label>
                                            <label for="checkoutCustomsHintConfirmed">
                                                <input name="checkoutCustomsHintConfirmed" required
                                                       id="checkoutCustomsHintConfirmed" type="checkbox">
                                                <span class="fluent">
                                                I am aware that additional customs duties and import taxes may be charged.
                                            </span>
                                            </label>
                                        </div>
                                        <br>
                                        <!-- ACCORDION START -->
                                        <h5>Buyer Protection guaranteed</h5>
                                        <div class="payment-content">
                                            <p>In the rare case that something doesn't go as planned, you can rely on
                                                our Buyer Protection service. <a href="javascript:void(0);"
                                                                                 class="theme-color" target="_blank">More
                                                    information</a>.</p>
                                        </div>
                                        <!-- ACCORDION END -->
                                        <br>
                                        <!-- ACCORDION START -->
                                        <h5>Your data is secure</h5>
                                        <div class="payment-content">
                                            <p>Timepiece strictly adheres to all applicable data protection laws.</p>

                                            <p>All data that you enter on our website is encrypted (SSL) and transmitted
                                                over a secure Internet connection (HTTPS).</p>

                                            <p>Your personal information will never be published and is only used during
                                                the registration process and when selling items on Timepiece.</p>
                                        </div>
                                        <!-- ACCORDION END -->
                                    </div>
                                    <div class="order-button-payment">
                                        @if(auth()->check())
                                            <input type="submit" id="submit" value="Place order"/>
                                            {{--                                        <div id="paypal-button-container"></div>--}}
                                        @else
                                            <p class="text-center mb-10">
                                                <a class="theme-color text-bold" href="{{ url('/login') }}">Login to
                                                    submit
                                                    order!</a>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <!-- your-order-wrapper start -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- checkout-details-wrapper end -->
    </div>
    <!-- main-content-wrap end -->
@endsection

@push('after-main-scripts')
    <script
        src="https://www.paypal.com/sdk/js?client-id=AdrblDc13uITTkwdArkM-89Bb85cEZ8-eh0DyRh3TjtUfYEijRQX4koMvimLO5WQ652_iqE1fKxP-5ZF">
    </script>
    <script type="text/javascript">
        /*$(document).ready(function () {
            var total_amount = $("#total_amount").val();
{{--            var product_id = '{{ $product->id }}';--}}
        console.log(product_id);
        var _token = $('meta[name="csrf-token"]').attr('content');
        var base_url = $('meta[name="base-url"]').attr('content');
        paypal.Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: total_amount
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                // Capture the funds from the transaction
                return actions.order.capture().then(function (details) {
                    if (details.id) {
                        var data = {
                            _token: _token,
                            first_name : $('#first_name').val(),
                            last_name : $('#last_name').val(),
                            street : $('#street').val(),
                            street_line_2 : $('#street_line_2').val(),
                            zip_code : $('#zip_code').val(),
                            city : $('#city').val(),
                            state : $('#state').val(),
                            country_id : $('#country_id').val(),
                            phone_no : $('#phone_no').val(),
                            message : $('#message').val(),
                            paypal_order_id: details.id,
                            paypal_payer_id: details.payer.payer_id
                        };

                        $.ajax({
                            url: base_url + '/submit-order/' + product_id,
                            method: 'POST',
                            dataType: 'json',
                            data: data,
                            success: function (response) {
                                if (response.success === true) {
                                    swal({
                                        title: "Success!",
                                        text: response.message,
                                        icon: "success"
                                    })
                                        .then((value) => {
                                            window.location.href = base_url + '/my-account';
                                        });
                                    return true;
                                }
                                console.log(response);
                                swal("Error!", response.message, "error");
                                return true;
                            },
                            error: function (err) {
                                console.log(err);
                            }
                        });
                    } else {
                        swal("Payment Error!", 'Something went wrong!', "error");
                    }
                });
            }
        }).render('#paypal-button-container');
    });*/
    </script>
@endpush

