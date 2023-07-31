<!-- haeader bottom Start -->
<style>
    .navbar-light .navbar-toggler {
color: rgba(0,0,0,.5);
border-color: rgba(0,0,0,.1);
background-color: white;
}
.text-center-resp{
    text-align:center;
}
@media (max-width: 780px){
    .main-menu-area ul > li {
    display: list-item;
    position: relative;
    padding: 15px 0px;
    margin-right: 55px;
}
.text-center-resp{
    text-align:left;
}
.main-menu-area .mega-menu {
    background: #ffffff;
    left: -59px;
    width: 190% !important;
}
.header-sticky.is-sticky {
    position: relative;
    width: 100%;
    z-index: 999999999;
    top: 0;
}
#remove{
    display: none;
}
    }
</style>
<div class="haeader-bottom-area bg-gren header-sticky">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="main-menu-area white_text">
                    <!--  Start Mainmenu Nav-->
                    
                      <nav class="main-navigation text-center-resp navbar navbar-expand-lg navbar-light bg-gren">
                      <button style="float:right;" class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                    
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul>
                            <li class="{{ Request::is(['/']) ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                            <li class="{{ Request::is(['shop']) ? 'active' : '' }}"><a href="{{ route('shop.index') }}">Shop</a>
                                <ul class="mega-menu" style="width: 900px;">
                                    <li><a href="#">Brands</a>
                                        <hr>
                                        <ul style="float: left;">
                                            @php
                                                $records = $brands->chunk(12, true);
                                            @endphp
                                            @foreach($records[0] as  $key => $value)
                                                <li><a href="{{ url('shop?brand='.$key) }}">{{$value}}</a></li>
                                            @endforeach
                                        </ul>
                                        <ul style="float: right;">
                                            @foreach($records[1] as  $key => $value)
                                                <li><a href="{{ url('shop?brand='.$key) }}">{{$value}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>

                                    <li><a class="ml-5" href="javascript:void(0);">Categories</a>
                                        <hr>
                                        <ul class="ml-5" style="margin-top: 18px;">
                                            @foreach($categories as  $key => $value)
                                                <li><a href="{{ url('shop?category='.$key) }}">{{$value}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li id="remove"><a href="javascript:void(0);">Services</a>
                                        <hr>
                                        <ul>
                                            <li><a href="javascript:void(0);">Wish List Page</a></li>
                                            <br>
                                            <li style="font-size: 20px; color: #c89979;">Epos</li>
                                            <li>Buy directly from the manufacturer</li>
                                            <li><img src="{{asset('assets/images/brand/teaser-xs.jpg')}}"></li>
                                        </ul>
                                    </li>
                                </ul>

                            </li>
                            <li class="{{ Request::is(['sell-watch']) ? 'active' : '' }}"><a href="{{ route('sell-watch') }}">Become a Vendor</a></li>
                            <li class="{{ Request::is(['faq']) ? 'active' : '' }}"><a
                                    href="{{ route('faq') }}">FAQ's</a></li>
                            <li class="{{ Request::is(['about-us']) ? 'active' : '' }}"><a
                                    href="{{ route('about-us') }}">About Us</a></li>
                            <li class="{{ Request::is(['contact-us']) ? 'active' : '' }}"><a
                                    href="{{ route('contact-us') }}">Contact Us</a></li>
                            <li class="{{ Request::is(['my-account', 'login']) ? 'active' : '' }}">
                                @auth
                                    <a href="{{ route('my-account') }}">{{ auth()->user()->getFullName()}}</a>
                                @else
                                    <a href="{{ route('login') }}">Login / Register</a>
                                @endauth
                            </li>
                        </ul>
                    </div>

                    </nav>
                    
                </div>
            </div>
            <div class="col-5 col-md-6 d-block d-lg-none">
                <div class="logo"><a href="{{ url('/') }}"><img src="{{ asset('admin/images/logo.png') }}" alt=""></a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-7 d-block d-lg-none">
                <div class="right-blok-box text-white d-flex">
                    <div class="user-wrap">
                        <a href="{{ route('wishList.index') }}"><span class="cart-total">2</span> <i
                                class="icon-heart"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- haeader bottom End -->
