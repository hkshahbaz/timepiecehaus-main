@if($products->count())
    @foreach($products as $key => $product)
        <div class="col-lg-4 col-md-6">
            <!-- single-product-area start -->
            <div class="single-product-area mt-30">
                <div class="product-thumb">
                    @php
                        if($product->productPictures()->count()){
                            if(file_exists('admin/images/products/'.$product->productPictures()->first()->picture)){
                                $picturePath = asset('admin/images/products/'.$product->productPictures()->first()->picture);
                            }
                            else{
                                $picturePath = asset('admin/images/default-watch-picture.gif');
                            }
                        }else{
                            $picturePath = asset('admin/images/default-watch-picture.gif');
                        }
                    @endphp
                    <a href="{{ route('shop.product.detail', $product->id) }}"
                       tabindex="0">
                        <img class="primary-images" alt="picture.png"
                             src="{{ $picturePath }}">
                    </a>
                    @auth
                        @php
                            $count = auth()->user()->wishLists()->whereProductId($product->id)->count();
                        @endphp
                        <a class="wishlist-icon" href="javascript:void(0)" data-is-added="0"
                           data-product-id="{{ $product->id }}">
                            <span class="product-item-icon-heart">
                                <i class="fa @if($count) fa-heart @else fa-heart-o @endif" aria-hidden="true"></i>
                            </span>
                        </a>
                    @else
                        <a href="javascript:void(0)" onclick="showLoginDialog()">
                            <span class="product-item-icon-heart">
                                 <i class="fa fa-heart-o" aria-hidden="true"></i>
                            </span>
                        </a>
                    @endauth
                    <div class="label-product label_new">New</div>
                </div>
                <div class="product-caption text-left pl-2">
                    <h4 class="product-name"><a
                            href="{{ route('shop.product.detail', $product->id) }}"
                            tabindex="0">{{ str_limit($product->name,30) }}</a>
                    </h4>
                    <div class="price-box">
                        <span class="bg-success indicator" title="Available now"></span>
                        <span class="new-price text-float-left ">
                            {{$product->currency->symbol}}{{$product->price}}
                        </span>
                    </div>
                    <div class="text-muted text-xs" style="font-size: 10px;">
                        <div class="text-muted text-xs" style="font-size: 10px;">
                            @if(intval($product->shipping_cost) == 0)
                                Free Shipping
                            @else
                                Shipping Cost: ${{ $product->shipping_cost }}
                            @endif
                        </div>
                        @if($product->vendor)
                        <div class="national flex">
                            <span>
                                <img src="{{ asset('admin/images/flags/'.$product->vendor->country->flag) }}"
                                     class="flag-icon" alt="{{ $product->vendor->country->flag }}">
                            </span>
                            <span class="caption country-name">{{$product->vendor->country->code}}</span>
                        </div>
                        <div class="text-muted text-xs pt-2" style="font-size: 12px;">
                            @if(($product->vendor()->first())->orderRequests()->count())
                                Verified Dealer
                            @else
                                New Dealer
                            @endif
                        </div>
                        @endif
                        @php
                            $count = $product->productRatings()->count();
                            $avgRating = round($product->productRatings()->avg('rating'), 1);
                            $total = 5;
                            $diff = $total - $avgRating;
                            $difff = fmod($avgRating,1);
                        @endphp
                        <div class="text-nowrap">
                            @for($i=1; $i <= $total; $i++)
                                @if($i <= $avgRating)
                                    <span class="product-rating">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </span>
                                @elseif($difff > 0 && $difff < 1)
                                    <span class="product-rating">
                                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                                    </span>
                                    @php $difff = round($difff, 0) @endphp
                                @else
                                    <span class="product-rating">
                                        <i class="fa fa-star-o" aria-hidden="true"></i>
                                    </span>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                <!-- single-product-area end -->
            </div>
        </div>
    @endforeach
@else
    <div class="col-md-12 text-center mt-5 pt-5">
        <h1>No Watch Found!</h1>
    </div>
@endif
