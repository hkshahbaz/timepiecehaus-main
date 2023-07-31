@extends('layouts.app')

@section("title", "About Us")

@section("breadcrumb")
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">About Us</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- Page Conttent -->
    <main class="about-us-page section-ptb">

        <div class="about-us_area section-pb">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-us_img">
                            <img src="{{ asset('admin/images/about-us.jpg') }}" alt="About Us Image">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-us_content">
                            <h3 class="heading mb-20">Welcome to Timepiece Haus.</h3>
                            <p class="short-desc mb-20">
                                <strong>We connect millions of buyers and sellers around the world to browse and
                                    securely shop the best watches around the globe.</strong>
                            </p>
                            <p class="short-desc mb-20 text-justify">
                                Timepiece Haus was born out of Sydney, Australia and services all around the globe.
                                Built out of passion by a team of watch enthusiasts to bring other watch lovers the best
                                shopping experience possible.
                            </p>
                            <p class="short-desc mb-20 text-justify">
                                Partnering with many reputable vendors across the globe, Timepiece Haus has access to
                                the world’s leading brands and exclusive watches before they reach the market. Here you
                                will find your favorite watches from Rolex, Tag to Omega and much more.
                            </p>
                            <p class="short-desc mb-20">
                                Shop now, shop with confidence. Timepiece Haus.
                            </p>
                            <div class="munoz-btn-ps_left slide-btn">
                                <a class="btn" href="{{ url('shop') }}">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="testimonials-area bg-gray section-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class=" testimonials-area">
                            <div class="row testimonial-two">
                                <h1 class="text-center mt-20 mb-20"
                                    style="font-size: 36px; font-weight: 500; color: #000;">
                                    We’re Here to Help !
                                    <a class="theme-color" style="text-decoration: underline;"
                                                      href="{{ route('contact-us') }}">
                                        Contact us
                                    </a>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--// Page Conttent -->


    @include("includes.brands")
    {{--    @include("includes.newsletter")--}}
@endsection
