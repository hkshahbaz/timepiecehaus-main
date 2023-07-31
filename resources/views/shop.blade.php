@extends('layouts.app')

@section("title", "Watch")

@section("breadcrumb")
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
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
            <div class="row">
                <div class="col-lg-3 order-lg-1 order-2">
                    @include("shop-partials.product-sidebar")
                </div>
                <div class="col-lg-9 order-lg-2 order-1">
                    <!-- shop-product-wrapper start -->
                    <div class="shop-product-wrapper">
                    @include("shop-partials.shop-head-filter")
                    <!-- shop-products-wrap start -->
                        <div class="shop-products-wrap">
                            <div class="tab-content">
                                <div class="tab-pane active" id="grid">
                                    <div class="shop-product-wrap">
                                        <div class="row" id="products-div">
                                            @include("shop-partials.product-item")
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop-products-wrap end -->
                        @include("shop-partials.product-pagination")
                    </div>
                    <!-- shop-product-wrapper end -->
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
    <input type="hidden" id="min" name="min" min="0" value="{{ intval($min) }}">
    <input type="hidden" id="max" name="max" min="0" value="{{ intval($max) }}">
@endsection

@push("after-main-scripts")
    <script type="text/javascript">
        var _token = $('meta[name="csrf-token"]').attr('content');
        var base_url = $('meta[name="base-url"]').attr('content');
        var category = $("input#category").val();
        var brand = $("input#brand").val();
        var seller = $("input#seller").val();
        var name = $("input#name").val();
        var min = $("input#min").val();
        var max = $("input#max").val();
        var data = {name: name};
        $(function () {
            $("#shop-sort-by").on('change', function () {
                data.category = category;
                data.brand = brand;
                data.seller = seller;
                data.sortBy = $(this).find(':selected').data('name');
                data.sortOrder = $(this).find(':selected').data('order');
                sendAjaxCall();
            });

            $("#product-filter-btn").on('click', function () {
                data.category = category;
                data.brand = brand;
                data.seller = seller;
                data.sortBy = $(this).find(':selected').data('name');
                data.sortOrder = $(this).find(':selected').data('order');
                sendAjaxCall();
            });
            let price_slider = $("#price-slider");
            price_slider.slider({
                range: true,
                min: {{ $min_price }},
                max: {{ $max_price }},
                values: [min, max],
                slide: function (event, ui) {
                    $("#min-price").val('$' + ui.values[0]);
                    $("#max-price").val('$' + ui.values[1]);
                    data.min = ui.values[0];
                    data.max = ui.values[1];
                }
            });

            data.min = price_slider.slider("values", 0);
            data.max = price_slider.slider("values", 1);

            $("#min-price").val('$' + min);
            $("#max-price").val('$' + max);
        });

        function sendAjaxCall() {
            console.log(data);
            var url = base_url + '/shop';
            $.ajax({
                url: url,
                data: data,
                dataType: 'json',
                method: 'GET',
                success: function (response) {
                    $("#products-div").empty().append(response.productsView);
                    $(".paginatoin-area").empty().append(response.paginationView);
                },
                error: function (err) {
                    // console.log(err);
                }
            });
        }

    </script>
@endpush
