@extends('layouts.app')

@section("title", "Wishlist")

@section("breadcrumb")
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Wishlist</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- main-content-wrap start -->
    <div class="main-content-wrap section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#" class="cart-table">
                        <div class="table-content table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="plantmore-product-thumbnail">Images</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="plantmore-product-price">Unit Price</th>
                                    <th class="plantmore-product-stock-status">Status</th>
                                    <th class="plantmore-product-add-cart">Add to cart</th>
                                    <th class="plantmore-product-remove">Remove</th>
                                </tr>
                                </thead>
                                <tbody id="wishListBody">
                                @if($products->count() > 0)
                                    @foreach($products as $product)
                                        @php
                                            $picture = $product->productPictures()->first()->picture;
                                        $count = $product->productPictures()->count();
                                        @endphp
                                        <tr id="product-{{$product->id}}">
                                            <td class="plantmore-product-thumbnail">
                                                @if($count > 0)
                                                    @php
                                                        if(!file_exists('admin/images/products/'.$picture)){
                                                            $picture = asset('admin/images/default-watch-picture.gif');
                                                        }else{
                                                            $picture = asset('admin/images/products/'.$picture);
                                                        }
                                                    @endphp
                                                    <a href="{{ $picture }}"
                                                       target="_blank">
                                                        <img width="100px" height="120px" alt="{{ $product->name }}"
                                                             src="{{ $picture }}">
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="plantmore-product-name">
                                                <a href="{{ route('shop.product.detail', [$product->id]) }}">
                                                    {{ $product->name }}
                                                </a>
                                            </td>
                                            <td class="plantmore-product-price">
                                                <span class="amount">
                                                    {{ $product->currency->symbol }}{{ $product->price }}
                                                </span>
                                            </td>

                                            <td class="plantmore-product-stock-status">
                                                <span class="in-stock">{{ $product->status->name }}</span>
                                            </td>
                                            <td class="plantmore-product-add-cart">
                                                <a href="{{ route('checkout.index',[$product->id]) }}">
                                                    Buy Now
                                                </a>
                                            </td>
                                            <td class="plantmore-product-remove">
                                                <a href="javascript:void(0);"
                                                   onclick="deleteProductFromWishList({{$product->id}})">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">No Records Found!</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-main-scripts')
    <script type="text/javascript" src="{{ asset('js/wishList.js') }}"></script>
@endpush
