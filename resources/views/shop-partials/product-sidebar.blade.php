<div class="shop-sidebar-wrap">
    <div class="shop-box-area">

        <!--sidebar-categores-box start  -->
        <div class="sidebar-categores-box shop-sidebar mb-30">
            <h4 class="title">Categories</h4>
            <!-- category-sub-menu start -->
            <div class="mb-2">
                <ul id="sidebar-listing">
                    @php
                        $category =\Illuminate\Support\Facades\Request::get('category');
                        if($category == ''){
                            $category = 0;
                        }
                        $brand =\Illuminate\Support\Facades\Request::get('brand');
                        if($brand == ''){
                            $brand = 0;
                        }
                        $seller =\Illuminate\Support\Facades\Request::get('seller');
                        if($seller == ''){
                            $seller = 0;
                        }
                    @endphp
                    <input type="hidden" id="category" name="category" value="{{$category}}">
                    <input type="hidden" id="brand" name="brand" value="{{$brand}}">
                    <input type="hidden" id="seller" name="seller" value="{{$seller}}">
                    @foreach($categories as $key => $value)
                        <li class="mb-2 @if($key == $category) active @endif"><a href="{{ url('shop?category='.$key) }}">{{ $value }}</a></li>
                    @endforeach
                </ul>
            </div>
            <!-- category-sub-menu end -->
        </div>
        <!--sidebar-categores-box end  -->

        <!-- shop-sidebar start -->
        <div class="shop-sidebar mb-30">
            <h4 class="title">Filter By Price</h4>
            <!-- filter-price-content start -->
            <div class="filter-price-content">
                <form action="#" method="post">
                    <div id="price-slider" class="price-slider"></div>
                    <div class="filter-price-wapper">
                        <div class="filter-price-cont">
                            <span>Price:</span>
                            <div class="input-type">
                                <input type="text" id="min-price" readonly=""/>
                            </div>
                            <span>—</span>
                            <div class="input-type">
                                <input type="text" id="max-price" readonly=""/>
                            </div>
                        </div>
                        <a class="add-to-cart-button" href="javascript:void(0)" id="product-filter-btn">
                            <span>FILTER</span>
                        </a>
                    </div>
                </form>
            </div>
            <!-- filter-price-content end -->
        </div>
        <!-- shop-sidebar end -->
    </div>
</div>
