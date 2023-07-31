@extends('layouts.app')

@section("title", "Contact Us")

@section("breadcrumb")
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contact Us</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- Page Conttent -->
    <main class="page-content section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div>
                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 col-sm-12">
                    <div class="contact-form">
                        <div class="contact-form-info">
                            <div class="contact-title">
                                <h3>FEEDBACK</h3>
                            </div>
                            <form action="{{ route('send-email') }}" method="post">
                                @csrf
                                <div class="contact-page-form">
                                    <div class="contact-input">
                                        <div class="contact-inner">
                                            <input name="name" id="name" required type="text" placeholder="Name" value="{{ old('name') }}">
                                        </div>
                                        <div class="contact-inner">
                                            <input name="email" id="email" required type="email" placeholder="Email" value="{{ old('email') }}">
                                        </div>
                                        <div class="contact-inner">
                                            <input name="phone" id="phone" required type="text" placeholder="Phone" value="{{ old('phone') }}">
                                        </div>
                                        <div class="contact-inner">
                                            <input name="subject" id="subject" required type="text" placeholder="Subject" value="{{ old('subject') }}">
                                        </div>
                                        <div class="contact-inner contact-message">
                                            <textarea name="message" id="message" required placeholder="Message">{{old('message')}}</textarea>
                                        </div>
                                        <div class="captcha mb-3 ml-2">
                                            <span>{!! captcha_img() !!}</span>
                                            <button type="button" class="btn btn-default ml-3" id="refresh"><i class="fa fa-refresh" ></i></button>
                                        </div>
                                        <input id="captcha" type="text" class="form-control mb-3" placeholder="Enter Captcha" name="captcha" required>

                                        @if(Session::has('error'))
                                            <p class="text-danger ml-2 mb-2">{{ Session::get('error') }}</p>
                                        @endif
                                    </div>
                                    <div class="contact-submit-btn">
                                        <button class="submit-btn" type="submit">Send Email</button>
                                        <p class="form-messege"></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-12">
                    <div class="contact-infor">
                        <div class="contact-title">
                            <h3>CONTACT US</h3>
                        </div>
                        <div class="contact-dec">
                            <p class="text-justify">Timepiece Haus was born out of Sydney, Australia and services all around the globe. Built out of passion by a team of watch enthusiasts to bring other watch lovers the best shopping experience possible.</p>
                        </div>
                        <div class="contact-address">
                            <ul>
                                <li>Address : {{$siteFooter['address']}}.</li>
                                <li>Email: {{$siteFooter['company_email']}}.</li>
                                <li>Phone: {{$siteFooter['phone_no']}}.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--// Page Conttent -->

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
