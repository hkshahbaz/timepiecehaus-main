<!-- footer Start -->
<footer>
    <div class="footer-top section-pb section-pt-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">

                    <div class="widget-footer mt-40">
                        <h6 class="title-widget">Contact Info</h6>

                        <div class="footer-addres">
                            <div class="widget-content mb--20">
                                <p>Address: {{$siteFooter['address']}}</p>
                                <p>Phone: <a href="tel:">{{$siteFooter['phone_no']}}.</a></p>
                                <p>Email: <a href="">{{$siteFooter['company_email']}}.</a></p>
                            </div>
                        </div>
                        <ul class="social-icons">
                            <li>
                                <a class="facebook social-icon" href="#" title="Facebook" target="_blank"><i
                                        class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a class="twitter social-icon" href="#" title="Twitter" target="_blank"><i
                                        class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a class="instagram social-icon" href="#" title="Instagram" target="_blank"><i
                                        class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a class="linkedin social-icon" href="#" title="Linkedin" target="_blank"><i
                                        class="fa fa-linkedin"></i></a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widget-footer mt-40">
                        <h6 class="title-widget">Information</h6>
                        <ul class="footer-list">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ route('about-us') }}">About Us</a></li>
                            <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                            <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('login') }}">Become a Vendor</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widget-footer mt-40">
                        <h6 class="title-widget">Extras</h6>
                        <ul class="footer-list">
                            <li><a href="{{ route('wishList.index') }}">Wishlist</a></li>
                            <li><a href="{{ route('my-account') }}">My Account</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="widget-footer mt-40">
                        <h6 class="title-widget">Get the app</h6>
                        <p>GreenLife App is now available on Google Play & App Store. Get it now.</p>
                        <ul class="footer-list">
                            <li><img src="{{ asset('assets/images/brand/img-googleplay.jpg') }}" alt=""></li>
                            <li><img src="{{ asset('assets/images/brand/img-appstore.jpg') }}" alt=""></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="copy-left-text">
                        <p>Copyright &copy; <a href="#">Timepiece Haus</a> {{ date('Y') }}. All Right Reserved.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="copy-right-image">
                        <img src="{{ asset('assets/images/icon/img-payment.png') }}" alt="">
                        </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer End -->
