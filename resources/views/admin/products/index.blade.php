@extends("admin.layouts.app")

@section("title", "Product List")
@section("has-detached-right-pace-done", "has-detached-right pace-done")
@section("content")
    @php use Illuminate\Support\Facades\Request; @endphp
    <!-- Detached content -->
    <div class="container-detached">
        <div class="content-detached">
            <!-- List -->
            <ul class="media-list" id="products-list">
                @include("admin.products.single-product-item")
            </ul>
            <!-- /list -->

            <!-- Pagination -->
            <div id="pagination" class="text-center content-group-lg pt-20">
                @include("admin.products.pagination")
            </div>
            <!-- /pagination -->
        </div>
    </div>
    <!-- /detached content -->

    @include("admin.products.product-sidebar")
@endsection

@push("before-app-script")
    <script src="{{ asset('admin/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('admin/global_assets/js/plugins/media/fancybox.min.js') }}"></script>
    <script src="{{ asset('admin/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/sliders/ion_rangeslider.min.js')}}"></script>
    <script src="{{asset('admin/global_assets/js/plugins/ui/moment/moment_locales.min.js')}}"></script>
@endpush

@push("after-app-script")
    <script src="{{ asset('admin/js/product.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var _token = $('meta[name="csrf-token"]').attr('content');
            var base_url = $('meta[name="base-url"]').attr('content');
            var price_range = [];
            var case_diameter_width = [];
            var case_diameter_length = [];

            // Lightbox
            $('[data-popup="lightbox"]').fancybox({
                padding: 3
            });
            // Uniform.js - custom checkboxes
            $('.styled').uniform();

            $("#filterForm").on("submit", function (event) {
                event.preventDefault();
                let is_draft = $("#is_draft").val();
                let status_id = $("#filter_status_id").val();
                let user_id = $("#user_id").val();
                let brand_ids = [];
                $.each($("input[name='brand_id']:checked"), function () {
                    brand_ids.push($(this).val());
                });
                let condition_ids = [];
                $.each($("input[name='condition_id']:checked"), function () {
                    condition_ids.push($(this).val());
                });
                let movement_ids = [];
                $.each($("input[name='movement_id']:checked"), function () {
                    movement_ids.push($(this).val());
                });
                let delivery_scope_ids = [];
                $.each($("input[name='delivery_scopes_id']:checked"), function () {
                    delivery_scope_ids.push($(this).val());
                });
                let product_type_ids = [];
                $.each($("input[name='product_type_id']:checked"), function () {
                    product_type_ids.push($(this).val());
                });
                let product_category_ids = [];
                $.each($("input[name='product_category_id']:checked"), function () {
                    product_category_ids.push($(this).val());
                });
                let genders = [];
                $.each($("input[name='gender']:checked"), function () {
                    genders.push($(this).val());
                });
                let product_function_ids = [];
                $.each($("input[name='product_function_id']:checked"), function () {
                    product_function_ids.push($(this).val());
                });
                let case_more_setting_ids = [];
                $.each($("input[name='case_more_setting_id']:checked"), function () {
                    case_more_setting_ids.push($(this).val());
                });
                let caliber_more_setting_ids = [];
                $.each($("input[name='caliber_setting_id']:checked"), function () {
                    caliber_more_setting_ids.push($(this).val());
                });
                let glass_type_ids = [];
                $.each($("input[name='glass_type_id']:checked"), function () {
                    glass_type_ids.push($(this).val());
                });
                let water_resistance_ids = [];
                $.each($("input[name='water_resistance_id']:checked"), function () {
                    water_resistance_ids.push($(this).val());
                });
                let case_material_ids = [];
                $.each($("input[name='case_material_id']:checked"), function () {
                    case_material_ids.push($(this).val());
                });
                let bezel_material_ids = [];
                $.each($("input[name='bezel_material_id']:checked"), function () {
                    bezel_material_ids.push($(this).val());
                });
                let dial_ids = [];
                $.each($("input[name='dial_id']:checked"), function () {
                    dial_ids.push($(this).val());
                });
                let dial_numeral_ids = [];
                $.each($("input[name='dial_numeral_id']:checked"), function () {
                    dial_numeral_ids.push($(this).val());
                });
                let dial_feature_ids = [];
                $.each($("input[name='dial_feature_id']:checked"), function () {
                    dial_feature_ids.push($(this).val());
                });
                let hand_detail_ids = [];
                $.each($("input[name='hand_detail_id']:checked"), function () {
                    hand_detail_ids.push($(this).val());
                });
                let bracelet_material_ids = [];
                $.each($("input[name='bracelet_material_id']:checked"), function () {
                    bracelet_material_ids.push($(this).val());
                });
                let bracelet_color_ids = [];
                $.each($("input[name='bracelet_color_id']:checked"), function () {
                    bracelet_color_ids.push($(this).val());
                });
                let clasp_type_ids = [];
                $.each($("input[name='clasp_type_id']:checked"), function () {
                    clasp_type_ids.push($(this).val());
                });
                let clasp_material_ids = [];
                $.each($("input[name='clasp_material_id']:checked"), function () {
                    clasp_material_ids.push($(this).val());
                });

                $.ajax({
                    url: '{!! route('products.index') !!}',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        status_id: status_id,
                        user_id: user_id,
                        is_draft: is_draft,
                        brand_id: brand_ids,
                        condition_id: condition_ids,
                        movement_id: movement_ids,
                        delivery_scope_id: delivery_scope_ids,
                        product_type_id: product_type_ids,
                        product_category_id: product_category_ids,
                        gender: genders,
                        product_function_id: product_function_ids,
                        case_more_setting_id: case_more_setting_ids,
                        caliber_more_setting_id: caliber_more_setting_ids,
                        glass_type_id: glass_type_ids,
                        water_resistance_id: water_resistance_ids,
                        case_material_id: case_material_ids,
                        bezel_material_id: bezel_material_ids,
                        dial_id: dial_ids,
                        dial_numeral_id: dial_numeral_ids,
                        price_range: price_range,
                        case_diameter_width: case_diameter_width,
                        case_diameter_length: case_diameter_length,
                        dial_feature_id: dial_feature_ids,
                        hand_detail_id: hand_detail_ids,
                        bracelet_material_id: bracelet_material_ids,
                        bracelet_color_id: bracelet_color_ids,
                        clasp_type_id: clasp_type_ids,
                        clasp_material_id: clasp_material_ids,
                    },
                    success: function (response) {
                        $("#products-list").html(response.productsView);
                        $("#pagination").html(response.paginationView);
                        $('.status_id').select2();
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            });
            $("#price-range-slider").ionRangeSlider({
                type: "double",
                grid: true,
                min: 0,
                max: {{ $maxPrice }},
                from: 0,
                to: 0,
                onFinish: function (data) {
                    price_range = [data.from, data.to];
                }
            });

            let price_range_slider = $("#price-range-slider").data("ionRangeSlider");
            @php
                if(Request::has('price_range')){
                $price_range = Request::get('price_range');
            @endphp
            price_range_slider.update({
                from: {{$price_range[0]}},
                to: {{$price_range[1]}}
            });
            @php
                }
            @endphp

            $("#case-diameter-width-slider").ionRangeSlider({
                type: "double",
                grid: true,
                min: 0,
                max: {{ $maxDiameterWidth }},
                from: 0,
                to: 0,
                onFinish: function (data) {
                    case_diameter_width = [data.from, data.to];
                }
            });

            let case_diameter_width_slider = $("#case-diameter-width-slider").data("ionRangeSlider");
            @php
                if(Request::has('case_diameter_width')){
                $case_diameter_width = Request::get('case_diameter_width');
            @endphp
            case_diameter_width_slider.update({
                from: {{$case_diameter_width[0]}},
                to: {{$case_diameter_width[1]}}
            });
            @php
                }
            @endphp

            $("#case-diameter-length-slider").ionRangeSlider({
                type: "double",
                grid: true,
                min: 0,
                max: {{ $maxDiameterLength }},
                from: 0,
                to: 0,
                onFinish: function (data) {
                    case_diameter_length = [data.from, data.to];
                }
            });

            let case_diameter_length_slider = $("#case-diameter-length-slider").data("ionRangeSlider");
            @php

                if(Request::has('case_diameter_length')){
                $case_diameter_length = Request::get('case_diameter_length');
            @endphp
            case_diameter_length_slider.update({
                from: {{$case_diameter_length[0]}},
                to: {{$case_diameter_length[1]}}
            });
            @php
                }
            @endphp
        });
    </script>
@endpush

