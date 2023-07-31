@extends('layouts.app')

@section("title", "Watch Detail")

@section("breadcrumb")
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item "><a href="javaScript:void(0)">{{ $product->brand->name }}</a></li>
                        <li class="breadcrumb-item "><a href="javaScript:void(0)">{{ $product->modal}}</a></li>
                        <li class="breadcrumb-item active"><a href="javaScript:void(0)">Reference
                                number {{ $product->reference_number }}</a></li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- main-content-wrap start -->
    <div class="main-content-wrap shop-page section-ptb">
        <div class="container">
            <div class="row  product-details-inner">
                <div class="col-lg-5 col-md-6">
                    <!-- Product Details Left -->
                    <div class="product-large-slider">
                        @php
                            $productPictures = $product->productPictures()->get();
                        @endphp
                        @foreach($productPictures as $picture)
                            @if ($loop->first)
                                @php
                                    if(file_exists('admin/images/products/'.$picture->picture))
                                        $picturePath = asset('admin/images/products/'.$picture->picture);
                                    else
                                        $picturePath = asset('admin/images/default-watch-picture.gif');
                                @endphp
                            @endif
                            @if ($loop->first)
                                <div class="pro-large-img img-zoom">
                                    <img src="{{ $picturePath }}"
                                         alt="product-details" height="500px"/>
                                    <a href="{{ $picturePath }}"
                                       data-fancybox="images"><i
                                            class="fa fa-search"></i></a>
                                </div>
                            @else
                                @if(file_exists('admin/images/products/'.$picture->picture))
                                    @php
                                        $picturePath = asset('admin/images/products/'.$picture->picture);
                                    @endphp
                                    <div class="pro-large-img img-zoom">
                                        <img src="{{ $picturePath }}"
                                             alt="product-details" height="500px"/>
                                        <a href="{{ $picturePath }}"
                                           data-fancybox="images"><i
                                                class="fa fa-search"></i></a>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="product-nav">
                        @foreach($productPictures as $picture)
                            @if ($loop->first)
                                @php
                                    if(file_exists('admin/images/products/'.$picture->picture))
                                            $picturePath = asset('admin/images/products/'.$picture->picture);
                                        else
                                            $picturePath = asset('admin/images/default-watch-picture.gif');
                                @endphp
                                <div class="pro-nav-thumb">
                                    <img src="{{ $picturePath }}"
                                         alt="product-details" height="100px"/>
                                </div>
                            @else
                                @if(file_exists('admin/images/products/'.$picture->picture))
                                    @php
                                        $picturePath = asset('admin/images/products/'.$picture->picture);
                                    @endphp
                                    <div class="pro-nav-thumb">
                                        <img src="{{ $picturePath }}"
                                             alt="product-details" height="100px"/>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content">
                        <div class="product-info">
                            <h3>{{ $product->name }}</h3>
                            <div class="product-rating d-flex">
                                @php
                                    $count = $product->productRatings()->count();
                                    $avgRating = round($product->productRatings()->avg('rating'), 1);
                                    $total = 5;
                                    $diff = $total - $avgRating;
                                    $difff = fmod($avgRating,1);
                                @endphp
                                <ul class="d-flex">
                                    @for($i=1; $i <= $total; $i++)
                                        <li>
                                            @if($i <= $avgRating)
                                                <span class="product-rating"><i class="fa fa-star"
                                                                                aria-hidden="true"></i></span>
                                            @elseif($difff > 0 && $difff < 1)
                                                <span class="product-rating"><i class="fa fa-star-half-o"
                                                                                aria-hidden="true"></i></span>
                                                @php $difff = round($difff, 0) @endphp
                                            @else
                                                <span class="product-rating"><i class="fa fa-star-o"
                                                                                aria-hidden="true"></i></span>
                                            @endif
                                        </li>
                                    @endfor
                                </ul>
                                <a href="#reviews">(<span class="count">{{ $count }}</span> customer review)</a>
                            </div>
                            <div class="price-box">
                                <span class="new-price">{{$product->currency->symbol}}{{ $product->price }}</span>
                            </div>
                            <p class="text-justify">{{ $product->description }}</p>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="single-add-to-cart">
                                        @auth
                                            @if($product->user_id !== auth()->user()->id)
                                                <a class="add-to-cart btn btn-sm color-white"
                                                   href="{{ route('checkout.index', [$product->id]) }}">Buy Now</a>
                                            @else
                                                <p>This product is owned by you.</p>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="single-add-to-cart">
                                        <div class="single-add-to-cart">
                                            @auth
                                                @if($product->user_id != auth()->user()->id &&
                                                auth()->user()->suspiciousReports()->where('product_id', $product->id)->count() == 0)
                                                    <a class="add-to-cart btn btn-sm color-white" data-toggle="modal"
                                                       data-target="#orderDetailModal"
                                                       href="#">Report</a>
                                                @elseif($product->user_id == auth()->user()->id)
                                                @else
                                                    <p>This product is Reported by you.</p>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade modal-wrapper" id="orderDetailModal" role="dialog">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div class="modal-inner-area">
                                                <div class="container">
                                                    <div class="row ">
                                                        <div class="col-md-12">
                                                            <h3 class="text-center">Report<span id="orderNo"></span>
                                                            </h3>
                                                            <hr>
                                                            <form action="{{ route('report-product') }}" method="post">
                                                                @csrf
                                                                @method('post')
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label data-error="wrong"
                                                                                   data-success="right"
                                                                                   for="form3">Name</label>
                                                                            <input type="text" name="name" id="name"
                                                                                   class="form-control validate">
                                                                        </div>
                                                                        <input type="hidden" name="product_id"
                                                                               id="product_id" value="{{$product->id }}"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label data-error="wrong"
                                                                                   data-success="right" for="form3">Phone
                                                                                No</label>
                                                                            <input type="text" name="phone_no"
                                                                                   id="phone_no"
                                                                                   class="form-control validate">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label data-error="wrong"
                                                                                   data-success="right" for="form3">Email</label>
                                                                            <input type="text" name="email" id="email"
                                                                                   class="form-control validate">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label data-error="wrong"
                                                                                   data-success="right" for="form3">Message</label>
                                                                            <textarea type="text" name="message"
                                                                                      id="message"
                                                                                      class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="float-right">
                                                                    <button type="submit" class="btn bg-slate">Submit
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

                            <ul class="single-add-actions">
                                <li class="add-to-wishlist">
                                    @auth
                                        @php
                                            $addedToWishlist = auth()->user()->wishLists()->whereProductId($product->id)->count();
                                        @endphp
                                        <a class="add_to_wishlist wishlist-icon" data-product-id="{{ $product->id }}"
                                           data-is-added="{{$addedToWishlist}}">
                                            <i class="theme-color fa @if($addedToWishlist) fa-heart @else fa-heart-o @endif"></i>
                                            Add to Wishlist
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="add_to_wishlist"
                                           onclick="showLoginDialog()">
                                            <i class="theme-color fa fa-heart-o"></i> Add to Wishlist
                                        </a>
                                    @endauth
                                </li>
                            </ul>
                            <ul class="stock-cont">
                                <li class="product-sku"><strong>Condition:</strong> <span><a
                                            href="#">{{ $product->condition->name }}</a></span>
                                </li>
                                <li class="product-stock-status"><strong>Scope of Delivery:</strong> <a
                                        href="#">{{ $product->deliveryScope->name }}</a></li>
                                <li class="product-stock-status"><strong>Availability:</strong> <a
                                        href="#">{{ $product->status->name }}</a></li>
                                <li class="product-stock-status"><strong>Expected Delivery:</strong> <a
                                        href="#">Oct 5, 2019 - Oct 14, 2019</a></li>
                            </ul>
                            <div class="share-product-socail-area">
                                <p>Share this product</p>
                                <ul class="single-product-share">
                                    <li><a target="_blank"
                                           href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('shop.product.detail', [$product->id])) }}"><i
                                                class="fa fa-facebook"></i></a></li>
                                    <li><a target="_blank"
                                           href="https://api.whatsapp.com/send?text={{ urlencode(route('shop.product.detail', [$product->id])) }}"><i
                                                class="fa fa-whatsapp"></i></a></li>
                                    <li><a target="_blank"
                                           href="https://web.skype.com/share?url={{ urlencode(route('shop.product.detail', [$product->id])) }}"><i
                                                class="fa fa-skype"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-description-area section-pt">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-details-tab">
                            <ul role="tablist" class="nav">
                                <li class="active" role="presentation">
                                    <a data-toggle="tab" role="tab" href="#description" class="active">Description</a>
                                </li>
                                <li role="presentation">
                                    <a data-toggle="tab" role="tab" href="#product-details">Properties</a>
                                </li>
                                @auth
                                    @if(auth()->user()->id !== $product->user_id)
                                        <li role="presentation">
                                            <a data-toggle="tab" role="tab" href="#reviews">Reviews</a>
                                        </li>
                                    @endif
                                @endauth
                                {{--                                <li role="presentation">--}}
                                {{--                                    <a data-toggle="tab" role="tab" href="#seller">Seller</a>--}}
                                {{--                                </li>--}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="product_details_tab_content tab-content">
                            <!-- Start Single Content -->
                            <div class="product_tab_content tab-pane active " id="description" role="tabpanel">
                                <div class="product_description_wrap  mt-30">
                                    <div class="product_desc mb-30">
                                        <p class="text-justify">{{ $product->description }}</p>
                                    </div>

                                </div>
                            </div>
                            <div class="product_tab_content tab-pane" id="product-details" role="tabpanel">
                                <div class="review_address_inner mt-30">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-responsive" style="border-top:none ">
                                                <thead>
                                                <tr>
                                                    <th class="plantmore-product-thumbnail "><h3 class="info">Basic
                                                            Info</h3></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th>Reference Number</th>
                                                    <td>{{  $product->reference_number  }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Brand</th>
                                                    <td>{{!is_null($product->brand) ? $product->brand->name  : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Model</th>
                                                    <td>{{ $product->modal }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Movement</th>
                                                    <td>{{ !is_null($product->movement) ? $product->movement->name  : ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Case material</th>
                                                    <td>{{ !is_null($product->caseMaterial) ? $product->caseMaterial->name  : ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Bracelet material</th>
                                                    <td>{{  !is_null($product->braceletMaterial) ? $product->braceletMaterial->name : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Year</th>
                                                    <td>{{  $product->year_of_production }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Condition</th>
                                                    <td>{{ !is_null($product->condition) ? $product->condition->name : ''}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Scope of delivery</th>
                                                    <td>{{ !is_null($product->deliveryScope) ? $product->deliveryScope->name : '' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Gender</th>
                                                    <td>{{ $product->gender }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Location</th>
                                                    <td>{{!is_null($product->currency) ? $product->currency->name : '' }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-responsive">
                                                <thead>
                                                <tr>
                                                    <th class="plantmore-product-thumbnail"><h3 class="info">
                                                            Caliber</h3></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>

                                                    <th>Movement</th>
                                                    <td>{{ !is_null($product->movement) ? $product->movement->name :'' }} </td>
                                                </tr>

                                                <tr>
                                                    <th>Movement/Caliber</th>
                                                    <td>{{  $product->movement_caliber }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Base Caliber</th>
                                                    <td>{{ $product->base_caliber }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Power Reserve</th>
                                                    <td>{{ $product->power_reserve }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Number of Jewels</th>
                                                    <td>{{ $product->number_of_jewels }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table class="table table-responsive">
                                                <thead>
                                                <tr>
                                                    <th class="plantmore-product-thumbnail"><h3 class="info">Case</h3>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th>Case material</th>
                                                    <td>{{ !is_null($product->caseMaterial) ? $product->caseMaterial->name :'' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Case diameter</th>
                                                    <td>
                                                        @if(isset($product->case_diameter_length) && isset($product->case_diameter_width)){{ $product->case_diameter_length }}
                                                        cm
                                                        <sup>x</sup> {{ $product->case_diameter_width }} cm @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Water resistance</th>
                                                    <td>{{ !is_null($product->waterResistance) ? $product->waterResistance->name :''}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Bezel material</th>
                                                    <td>{{ !is_null($product->caseMaterial) ? $product->caseMaterial->name :'' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Glass</th>
                                                    <td>{{ !is_null($product->glassType) ?  $product->glassType->name :''}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Dial</th>
                                                    <td>{{ !is_null($product->dial) ? $product->dial->name :'' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Dial numerals</th>
                                                    <td>{{ !is_null($product->dialNumeral) ? $product->dialNumeral->name :'' }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th class="plantmore-product-thumbnail"><h3 class="info">
                                                            Bracelet/strap</h3></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th>Bracelet material</th>
                                                    <td>{{ !is_null($product->braceletMaterial) ? $product->braceletMaterial->name  :''}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Bracelet color</th>
                                                    <td>{{ !is_null($product->braceletColor) ? $product->braceletColor->name :'' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Clasp</th>
                                                    <td>{{ !is_null($product->claspType) ? $product->claspType->name :'' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Clasp material</th>
                                                    <td>{{ !is_null($product->caseMaterial) ? $product->caseMaterial->name :'' }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-responsive">
                                                <thead>
                                                <tr>
                                                    <th class="plantmore-product-thumbnail"><h3 class="info">
                                                            Functions</h3></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($product->productFunctions as $productFuction)
                                                    <tr>
                                                        <td>{{ $productFuction->name }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- End product details Content -->
                            <!-- End Single Content -->
                            <!-- Start Single Content -->
                            <div class="product_tab_content tab-pane" id="reviews" role="tabpanel">
                                @foreach($product->productRatings()->get() as $review)
                                    <div class="review_address_inner mt-30">
                                    @php
                                        if(file_exists('admin/images/'.$review->user->picture))
                                            $picturePath = asset('admin/images/'.$review->user->picture);
                                        else
                                            $picturePath = asset('admin/images/default-user-image.jpg');
                                    @endphp
                                    <!-- Start Single Review -->
                                        <div class="pro_review">
                                            <div class="review_thumb">
                                                <img alt="review images" width="60px" height="60px"
                                                     src="{{ $picturePath }}">
                                            </div>
                                            <div class="review_details">
                                                <div class="review_info mb-10">
                                                    @php
                                                        $rating = $review->rating;
                                                        $diff = abs(5 - $rating);
                                                    @endphp
                                                    <ul class="d-flex">
                                                        @for($i=1; $i <= 5; $i++)
                                                            <li>
                                                                @if($i <= $rating)
                                                                    <span class="product-rating">
                                                                        <i class="fa fa-star"></i>
                                                                    </span>
                                                                @else
                                                                    <span class="product-rating">
                                                                        <i class="fa fa-star-o"></i>
                                                                    </span>
                                                                @endif
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                    <h5>{{ ucfirst($review->user->first_name) }} -
                                                        <span> {{ (new Carbon\Carbon($review->created_at))->format('F j, Y') }}</span>
                                                    </h5>
                                                </div>
                                                <p>{{ $review->review }}</p>
                                            </div>
                                        </div>
                                        <!-- End Single Review -->
                                    </div>
                            @endforeach
                            <!-- Start Rating Area -->
                                <div class="rating_wrap mt-50">
                                    <h5 class="rating-title-1">Add a review </h5>
                                    <h6 class="rating-title-2">Your Rating</h6>
                                    <div class="rating_list">
                                        <div class="review_info mb-10">
                                            <ul class="d-flex" id="stars-products">
                                                <li class="product-rating cursor-pointer" data-value="1">
                                                    <i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="product-rating cursor-pointer" data-value="2">
                                                    <i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="product-rating cursor-pointer" data-value="3">
                                                    <i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="product-rating cursor-pointer" data-value="4">
                                                    <i class="fa fa-star-o"></i>
                                                </li>
                                                <li class="product-rating cursor-pointer" data-value="5">
                                                    <i class="fa fa-star-o"></i>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- End RAting Area -->
                                <div class="comments-area comments-reply-area">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form action="{{ route('ratings.store') }}" method="POST"
                                                  class="comment-form-area">
                                                @csrf
                                                <input type="hidden" required="required" name="rating" id="rating">
                                                <input type="hidden" name="product_id" id="product_id"
                                                       value="{{ $product->id }}">
                                                <div class="comment-form-comment mt-15">
                                                    <label>Review</label>
                                                    <textarea class="comment-notes" required="required" name="review"
                                                              placeholder="Enter Review Here"></textarea>
                                                </div>
                                                <div class="comment-form-submit text-right mt-15">
                                                    <input type="submit" value="Submit" class="comment-submit">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            {{--                            <!-- Start Seller Content -->--}}
                            {{--                            <div class="product_tab_content tab-pane  " id="seller" role="tabpanel">--}}
                            {{--                                <div class="product_description_wrap  mt-30">--}}
                            {{--                                    <div class="product_desc mb-30">--}}
                            {{--                                        <div class="row">--}}
                            {{--                                            <div class="col-md-6">--}}
                            {{--                                                <div class="ml-5">--}}
                            {{--                                                    @php--}}
                            {{--                                                        if(file_exists(public_path('admin/images/products/'.$product->vendor->picture)))--}}
                            {{--                                                                $sellerPicture = asset('admin/images/users/'.$picture->picture);--}}
                            {{--                                                            else--}}
                            {{--                                                                $sellerPicture = asset('admin/images/default-user-image.jpg');--}}
                            {{--                                                    @endphp--}}
                            {{--                                                    <img alt="seller.png" class="flag-icon-for-seller ml-5"--}}
                            {{--                                                         src="{{ $sellerPicture  }}">--}}
                            {{--                                                    <p>--}}
                            {{--                                                        <strong>Name:{{!is_null($product->vendor) ? $product->vendor->first_name : ''}}</strong>--}}
                            {{--                                                    </p>--}}
                            {{--                                                    <p>--}}
                            {{--                                                        <strong>Tel:{{ !is_null($product->vendor) ? $product->vendor->fax_no : ''}}</strong>--}}
                            {{--                                                    </p>--}}
                            {{--                                                    <p>--}}
                            {{--                                                        <strong>Mobile: {{ !is_null($product->vendor) ? $product->vendor->mobile_no : ''}}</strong>--}}
                            {{--                                                    </p>--}}
                            {{--                                                    <p>we speak</p>--}}
                            {{--                                                </div>--}}
                            {{--                                                <div class="national flex">--}}
                            {{--                                                    <span><img alt="flag.png" class="flag-icon-for-seller ml-5"--}}
                            {{--                                                               src="{{ asset('/admin/images/flags/'.$product->currency->flag) }}"></span>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="col-md-6">--}}
                            {{--                                                <h3>Seller</h3>--}}
                            {{--                                            </div>--}}


                            {{--                                        </div>--}}
                            {{--                                        <div class="view-listing-btn text-center mt-5">--}}
                            {{--                                            <a href="{{ url('shop?seller='.$product->user_id) }}"--}}
                            {{--                                               class="btn btn-default text-center">VIEW CURRENT LISTING</a>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}

                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                            <!-- End Seller Content -->--}}

                        </div>
                    </div>
                </div>
            </div>

            {{--            <div class="related-product-area section-pt">--}}
            {{--                <div class="row">--}}
            {{--                    <div class="col-lg-12">--}}
            {{--                        <div class="section-title">--}}
            {{--                            <h3> Related Product</h3>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="row product-active-lg-4">--}}
            {{--                    <div class="col-lg-12">--}}
            {{--                        <!-- single-product-area start -->--}}
            {{--                        <div class="single-product-area mt-30">--}}
            {{--                            <div class="product-thumb">--}}
            {{--                                <a href="product-details.html">--}}
            {{--                                    <img class="primary-image" src="{{ asset('assets/images/product/product-02.png') }}"--}}
            {{--                                         alt="">--}}
            {{--                                </a>--}}
            {{--                                <div class="label-product label_new">New</div>--}}
            {{--                                <div class="action-links">--}}
            {{--                                    <a href="wishlist.html" class="wishlist-btn" title="Add to Wish List"><i--}}
            {{--                                            class="icon-heart"></i></a>--}}
            {{--                                </div>--}}
            {{--                                <ul class="watch-color">--}}
            {{--                                    <li class="twilight"><span></span></li>--}}
            {{--                                    <li class="pigeon"><span></span></li>--}}
            {{--                                    <li class="portage"><span></span></li>--}}
            {{--                                </ul>--}}
            {{--                            </div>--}}
            {{--                            <div class="product-caption">--}}
            {{--                                <h4 class="product-name"><a href="product-details.html">Simple Product 002</a></h4>--}}
            {{--                                <div class="price-box">--}}
            {{--                                    <span class="new-price">$49.00</span>--}}
            {{--                                    <span class="old-price">$90.00</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- single-product-area end -->--}}
            {{--                    </div>--}}
            {{--                    <div class="col-lg-12">--}}
            {{--                        <!-- single-product-area start -->--}}
            {{--                        <div class="single-product-area mt-30">--}}
            {{--                            <div class="product-thumb">--}}
            {{--                                <a href="product-details.html">--}}
            {{--                                    <img class="primary-image" src="{{ asset('assets/images/product/product-03.png') }}"--}}
            {{--                                         alt="">--}}
            {{--                                </a>--}}

            {{--                                <div class="action-links">--}}

            {{--                                    <a href="wishlist.html" class="wishlist-btn" title="Add to Wish List"><i--}}
            {{--                                            class="icon-heart"></i></a>--}}

            {{--                                </div>--}}
            {{--                                <ul class="watch-color">--}}
            {{--                                    <li class="twilight"><span></span></li>--}}
            {{--                                    <li class="pigeon"><span></span></li>--}}
            {{--                                </ul>--}}
            {{--                            </div>--}}
            {{--                            <div class="product-caption">--}}
            {{--                                <h4 class="product-name"><a href="product-details.html">Simple Product 003</a></h4>--}}
            {{--                                <div class="price-box">--}}
            {{--                                    <span class="new-price">$55.00</span>--}}
            {{--                                    <span class="old-price">$76.00</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- single-product-area end -->--}}
            {{--                    </div>--}}
            {{--                    <div class="col-lg-12">--}}
            {{--                        <!-- single-product-area start -->--}}
            {{--                        <div class="single-product-area mt-30">--}}
            {{--                            <div class="product-thumb">--}}
            {{--                                <a href="product-details.html">--}}
            {{--                                    <img class="primary-image" src="{{ asset('assets/images/product/product-04.png') }}"--}}
            {{--                                         alt="">--}}
            {{--                                </a>--}}
            {{--                                <div class="label-product label_new">New</div>--}}
            {{--                                <div class="action-links">--}}

            {{--                                    <a href="wishlist.html" class="wishlist-btn" title="Add to Wish List"><i--}}
            {{--                                            class="icon-heart"></i></a>--}}

            {{--                                </div>--}}
            {{--                                <ul class="watch-color">--}}
            {{--                                    <li class="twilight"><span></span></li>--}}
            {{--                                    <li class="portage"><span></span></li>--}}
            {{--                                    <li class="pigeon"><span></span></li>--}}
            {{--                                </ul>--}}
            {{--                            </div>--}}
            {{--                            <div class="product-caption">--}}
            {{--                                <h4 class="product-name"><a href="product-details.html">Simple Product 004</a></h4>--}}
            {{--                                <div class="price-box">--}}
            {{--                                    <span class="new-price">$64.00</span>--}}
            {{--                                    <span class="old-price">$72.00</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- single-product-area end -->--}}
            {{--                    </div>--}}
            {{--                    <div class="col-lg-12">--}}
            {{--                        <!-- single-product-area start -->--}}
            {{--                        <div class="single-product-area mt-30">--}}
            {{--                            <div class="product-thumb">--}}
            {{--                                <a href="product-details.html">--}}
            {{--                                    <img class="primary-image" src="{{ asset('assets/images/product/product-05.png') }}"--}}
            {{--                                         alt="">--}}
            {{--                                </a>--}}
            {{--                                <div class="label-product label_new">New</div>--}}
            {{--                                <div class="action-links">--}}

            {{--                                    <a href="wishlist.html" class="wishlist-btn" title="Add to Wish List"><i--}}
            {{--                                            class="icon-heart"></i></a>--}}

            {{--                                </div>--}}
            {{--                                <ul class="watch-color">--}}
            {{--                                    <li class="twilight"><span></span></li>--}}
            {{--                                    <li class="portage"><span></span></li>--}}
            {{--                                    <li class="pigeon"><span></span></li>--}}
            {{--                                </ul>--}}
            {{--                            </div>--}}
            {{--                            <div class="product-caption">--}}
            {{--                                <h4 class="product-name"><a href="product-details.html">Simple Product 005</a></h4>--}}
            {{--                                <div class="price-box">--}}
            {{--                                    <span class="new-price">$44.00</span>--}}
            {{--                                    <span class="old-price">$49.00</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- single-product-area end -->--}}
            {{--                    </div>--}}
            {{--                    <div class="col-lg-12">--}}
            {{--                        <!-- single-product-area start -->--}}
            {{--                        <div class="single-product-area mt-30">--}}
            {{--                            <div class="product-thumb">--}}
            {{--                                <a href="product-details.html">--}}
            {{--                                    <img class="primary-image" src="{{ asset('assets/images/product/product-01.png') }}"--}}
            {{--                                         alt="">--}}
            {{--                                </a>--}}
            {{--                                <div class="label-product label_new">New</div>--}}
            {{--                                <div class="action-links">--}}

            {{--                                    <a href="wishlist.html" class="wishlist-btn" title="Add to Wish List"><i--}}
            {{--                                            class="icon-heart"></i></a>--}}

            {{--                                </div>--}}
            {{--                                <ul class="watch-color">--}}
            {{--                                    <li class="twilight"><span></span></li>--}}
            {{--                                    <li class="portage"><span></span></li>--}}
            {{--                                    <li class="pigeon"><span></span></li>--}}
            {{--                                </ul>--}}
            {{--                            </div>--}}
            {{--                            <div class="product-caption">--}}
            {{--                                <h4 class="product-name"><a href="product-details.html">Simple Product 001</a></h4>--}}
            {{--                                <div class="price-box">--}}
            {{--                                    <span class="new-price">$42.00</span>--}}
            {{--                                    <span class="old-price">$49.00</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- single-product-area end -->--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            {{--            <div class="related-product-area section-pt">--}}
            {{--                <div class="row">--}}
            {{--                    <div class="col-lg-12">--}}
            {{--                        <div class="section-title">--}}
            {{--                            <h3>Upsell Products</h3>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="row product-active-lg-4">--}}
            {{--                    <div class="col-lg-12">--}}
            {{--                        <!-- single-product-area start -->--}}
            {{--                        <div class="single-product-area mt-30">--}}
            {{--                            <div class="product-thumb">--}}
            {{--                                <a href="product-details.html">--}}
            {{--                                    <img class="primary-image" src="{{ asset('assets/images/product/product-12.png') }}"--}}
            {{--                                         alt="">--}}
            {{--                                </a>--}}
            {{--                                <div class="label-product label_new">New</div>--}}
            {{--                                <div class="action-links">--}}

            {{--                                    <a href="wishlist.html" class="wishlist-btn" title="Add to Wish List"><i--}}
            {{--                                            class="icon-heart"></i></a>--}}

            {{--                                </div>--}}
            {{--                                <ul class="watch-color">--}}
            {{--                                    <li class="twilight"><span></span></li>--}}
            {{--                                    <li class="pigeon"><span></span></li>--}}
            {{--                                    <li class="portage"><span></span></li>--}}
            {{--                                </ul>--}}
            {{--                            </div>--}}
            {{--                            <div class="product-caption">--}}
            {{--                                <h4 class="product-name"><a href="product-details.html">Simple Product 002</a></h4>--}}
            {{--                                <div class="price-box">--}}
            {{--                                    <span class="new-price">$49.00</span>--}}
            {{--                                    <span class="old-price">$90.00</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- single-product-area end -->--}}
            {{--                    </div>--}}
            {{--                    <div class="col-lg-12">--}}
            {{--                        <!-- single-product-area start -->--}}
            {{--                        <div class="single-product-area mt-30">--}}
            {{--                            <div class="product-thumb">--}}
            {{--                                <a href="product-details.html">--}}
            {{--                                    <img class="primary-image" src="{{ asset('assets/images/product/product-13.png') }}"--}}
            {{--                                         alt="">--}}
            {{--                                </a>--}}

            {{--                                <div class="action-links">--}}

            {{--                                    <a href="wishlist.html" class="wishlist-btn" title="Add to Wish List"><i--}}
            {{--                                            class="icon-heart"></i></a>--}}

            {{--                                </div>--}}
            {{--                                <ul class="watch-color">--}}
            {{--                                    <li class="twilight"><span></span></li>--}}
            {{--                                    <li class="pigeon"><span></span></li>--}}
            {{--                                </ul>--}}
            {{--                            </div>--}}
            {{--                            <div class="product-caption">--}}
            {{--                                <h4 class="product-name"><a href="product-details.html">Simple Product 003</a></h4>--}}
            {{--                                <div class="price-box">--}}
            {{--                                    <span class="new-price">$55.00</span>--}}
            {{--                                    <span class="old-price">$76.00</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- single-product-area end -->--}}
            {{--                    </div>--}}
            {{--                    <div class="col-lg-12">--}}
            {{--                        <!-- single-product-area start -->--}}
            {{--                        <div class="single-product-area mt-30">--}}
            {{--                            <div class="product-thumb">--}}
            {{--                                <a href="product-details.html">--}}
            {{--                                    <img class="primary-image" src="{{ asset('assets/images/product/product-14.png') }}"--}}
            {{--                                         alt="">--}}
            {{--                                </a>--}}
            {{--                                <div class="label-product label_new">New</div>--}}
            {{--                                <div class="action-links">--}}

            {{--                                    <a href="wishlist.html" class="wishlist-btn" title="Add to Wish List"><i--}}
            {{--                                            class="icon-heart"></i></a>--}}

            {{--                                </div>--}}
            {{--                                <ul class="watch-color">--}}
            {{--                                    <li class="twilight"><span></span></li>--}}
            {{--                                    <li class="portage"><span></span></li>--}}
            {{--                                    <li class="pigeon"><span></span></li>--}}
            {{--                                </ul>--}}
            {{--                            </div>--}}
            {{--                            <div class="product-caption">--}}
            {{--                                <h4 class="product-name"><a href="product-details.html">Simple Product 004</a></h4>--}}
            {{--                                <div class="price-box">--}}
            {{--                                    <span class="new-price">$64.00</span>--}}
            {{--                                    <span class="old-price">$72.00</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- single-product-area end -->--}}
            {{--                    </div>--}}
            {{--                    <div class="col-lg-12">--}}
            {{--                        <!-- single-product-area start -->--}}
            {{--                        <div class="single-product-area mt-30">--}}
            {{--                            <div class="product-thumb">--}}
            {{--                                <a href="product-details.html">--}}
            {{--                                    <img class="primary-image" src="{{ asset('assets/images/product/product-15.png') }}"--}}
            {{--                                         alt="">--}}
            {{--                                </a>--}}
            {{--                                <div class="label-product label_new">New</div>--}}
            {{--                                <div class="action-links">--}}

            {{--                                    <a href="wishlist.html" class="wishlist-btn" title="Add to Wish List"><i--}}
            {{--                                            class="icon-heart"></i></a>--}}

            {{--                                </div>--}}
            {{--                                <ul class="watch-color">--}}
            {{--                                    <li class="twilight"><span></span></li>--}}
            {{--                                    <li class="portage"><span></span></li>--}}
            {{--                                    <li class="pigeon"><span></span></li>--}}
            {{--                                </ul>--}}
            {{--                            </div>--}}
            {{--                            <div class="product-caption">--}}
            {{--                                <h4 class="product-name"><a href="product-details.html">Simple Product 005</a></h4>--}}
            {{--                                <div class="price-box">--}}
            {{--                                    <span class="new-price">$44.00</span>--}}
            {{--                                    <span class="old-price">$49.00</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- single-product-area end -->--}}
            {{--                    </div>--}}
            {{--                    <div class="col-lg-12">--}}
            {{--                        <!-- single-product-area start -->--}}
            {{--                        <div class="single-product-area mt-30">--}}
            {{--                            <div class="product-thumb">--}}
            {{--                                <a href="product-details.html">--}}
            {{--                                    <img class="primary-image" src="{{ asset('assets/images/product/product-01.png') }}"--}}
            {{--                                         alt="">--}}
            {{--                                </a>--}}
            {{--                                <div class="label-product label_new">New</div>--}}
            {{--                                <div class="action-links">--}}

            {{--                                    <a href="wishlist.html" class="wishlist-btn" title="Add to Wish List"><i--}}
            {{--                                            class="icon-heart"></i></a>--}}

            {{--                                </div>--}}
            {{--                                <ul class="watch-color">--}}
            {{--                                    <li class="twilight"><span></span></li>--}}
            {{--                                    <li class="portage"><span></span></li>--}}
            {{--                                    <li class="pigeon"><span></span></li>--}}
            {{--                                </ul>--}}
            {{--                            </div>--}}
            {{--                            <div class="product-caption">--}}
            {{--                                <h4 class="product-name"><a href="product-details.html">Simple Product 001</a></h4>--}}
            {{--                                <div class="price-box">--}}
            {{--                                    <span class="new-price">$42.00</span>--}}
            {{--                                    <span class="old-price">$49.00</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <!-- single-product-area end -->--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

        </div>
    </div>
    <!-- main-content-wrap end -->
@endsection

@push('after-main-scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            //on hover
            var selectedStar = 0;
            $('#stars-products li').on('mouseover', function () {
                var onStar = parseInt($(this).data('value'), 10);
                //alert(onStar);  // The star currently mouse on
                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.product-rating').each(function (e) {
                    if (e < onStar)
                        $(this).find('i').addClass('fa-star').removeClass('fa-star-o');
                    else
                        $(this).find('i').removeClass('fa-star').addClass('fa-star-o');
                });
            }).on('mouseout', function () {
                $(this).parent().children('li.product-rating').each(function (e) {
                    if (e < selectedStar)
                        $(this).find('i').removeClass('fa-star-o').addClass('fa-star');
                    else
                        $(this).find('i').removeClass('fa-star').addClass('fa-star-o');

                });
            });
            $('#stars-products li').on('click', function () {
                var onStar = parseInt($(this).data('value'), 10);
                var stars = $(this).parent().children('li.product-rating');
                selectedStar = onStar;
                for (var i = 0; i < stars.length; i++) {
                    var star = $(stars[i]).find('i')[0];
                    $(star).addClass('fa-star-o');
                }
                for (i = 0; i < onStar; i++) {
                    var star = $(stars[i]).find('i')[0];
                    $(star).removeClass('fa-star-o');
                    $(star).addClass('fa-star');
                }
                $("input#rating").val(selectedStar);
            });
        });
    </script>
@endpush
