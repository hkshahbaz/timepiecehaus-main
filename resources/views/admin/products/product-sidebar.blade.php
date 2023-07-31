<!-- Detached sidebar -->
<div class="sidebar-detached">
    <div class="sidebar sidebar-default sidebar-separate">
        <div class="sidebar-content">
            <!-- Filter -->
            <div class="sidebar-category">
                <div class="category-title">
                    <span>Filter products</span>
                    <ul class="icons-list">
                        <li><a href="#" data-action="collapse"></a></li>
                    </ul>
                </div>

                <div class="category-content">
                    <form id="filterForm">
                        <button type="submit" class="btn bg-blue btn-block">Filter</button>
                        <hr>
                        <div class="card card-body border-top-danger">
                            <legend class="text-size-mini text-muted no-border no-padding">Vendors</legend>
                            @php
                                $user_id  = '';
                                if(Request::has('user_id')){
                                    $user_id = Request::get("user_id");
                                }
                            @endphp
                            {!! Form::select('user_id', $vendors, $user_id, ['id' => 'user_id', 'class' => 'select']) !!}
                        </div>
                        <br>
                        <div class="card card-body border-top-danger">
                            <legend class="text-size-mini text-muted no-border no-padding">Availability</legend>
                            @php
                                $status_id  = '';
                                if(Request::has('status_id')){
                                    $status_id = Request::get("status_id");
                                }
                            @endphp
                            {!! Form::select('status_id', $statuses, $status_id, ['id' => 'filter_status_id', 'class' => 'select']) !!}
                        </div>
                        <br>
                        <div class="card card-body border-top-danger">
                            <legend class="text-size-mini text-muted no-border no-padding">Ad Status</legend>
                            @php
                                $is_draft  = '';
                                if(Request::has('is_draft')){
                                    $is_draft = Request::get("is_draft");
                                }
                            @endphp
                            {!! Form::select('is_draft', $adStatuses, $is_draft, ['id' => 'is_draft', 'class' => 'select']) !!}
                        </div>
                        <hr>
                        <div class="card card-body border-top-danger">
                            <legend class="text-size-mini text-muted no-border no-padding">Price Range</legend>
                            <input type="text" class="form-control ion-pips-height-helper" id="price-range-slider"
                                   data-fouc>
                        </div>
                        <hr>
                        <div class="card card-body border-top-danger">
                            <legend class="text-size-mini text-muted no-border no-padding">Case diameter Width</legend>
                            <input type="text" class="form-control ion-pips-height-helper"
                                   id="case-diameter-width-slider" data-fouc>
                        </div>
                        <hr>
                        <div class="card card-body border-top-danger">
                            <legend class="text-size-mini text-muted no-border no-padding">Case diameter Height</legend>
                            <input type="text" class="form-control ion-pips-height-helper"
                                   id="case-diameter-length-slider" data-fouc>
                        </div>
                        <hr>
                        <!-- brands -->
                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Brands</legend>
                            <div class="has-feedback has-feedback-left form-group">
                                <input type="search" class="form-control filterSearch" placeholder="Search Brand">
                                <div class="form-control-feedback">
                                    <i class="icon-search4 text-size-small text-muted"></i>
                                </div>
                            </div>
                            <div class="has-scroll filterList">
                                @php
                                    $brand_ids= [];
                                    if(Request::has('brand_id')){
                                        $brand_ids = Request::get('brand_id');
                                    }
                                @endphp
                                @foreach($brands as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $brand_ids)) checked @endif name="brand_id"
                                                   type="checkbox" class="styled brand_id"
                                                   value="{{ $key }}">
                                            {{ ucfirst($value) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- product categories -->
                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Categories</legend>
                            <div class="has-feedback has-feedback-left form-group">
                                <input type="search" class="form-control filterSearch" placeholder="Search Categories">
                                <div class="form-control-feedback">
                                    <i class="icon-search4 text-size-small text-muted"></i>
                                </div>
                            </div>
                            <div class="has-scroll filterList">
                                @php

                                    $product_category_ids= [];
                                    if(Request::has('product_category_id')){
                                        $product_category_ids = Request::get('product_category_id');
                                    }
                                @endphp
                                @foreach($categories as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $product_category_ids)) checked
                                                   @endif name="product_category_id" type="checkbox"
                                                   class="styled product_category_id" value="{{ $key }}">
                                            {{ ucfirst($value) }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- product types -->
                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Type of Watch</legend>
                            <div class="has-scroll filterList">
                                @php

                                    $product_type_ids= [];
                                    if(Request::has('product_type_id')){
                                        $product_type_ids = Request::get('product_type_id');
                                    }
                                @endphp
                                @foreach($productTypes as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $product_type_ids)) checked
                                                   @endif name="product_type_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- conditions -->
                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Conditions</legend>
                            <div class="has-scroll filterList">
                                @php

                                    $condition_ids= [];
                                    if(Request::has('condition_id')){
                                        $condition_ids = Request::get('condition_id');
                                    }
                                @endphp
                                @foreach($conditions as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $condition_ids)) checked
                                                   @endif name="condition_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- functions -->
                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Functions</legend>
                            <div class="has-feedback has-feedback-left form-group">
                                <input type="search" class="form-control filterSearch" placeholder="Search Function">
                                <div class="form-control-feedback">
                                    <i class="icon-search4 text-size-small text-muted"></i>
                                </div>
                            </div>
                            <div class="has-scroll filterList">
                                @php

                                    $product_function_ids= [];
                                    if(Request::has('product_function_id')){
                                        $product_function_ids = Request::get('product_function_id');
                                    }
                                @endphp
                                @foreach($productFunctions as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $product_function_ids)) checked
                                                   @endif name="product_function_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- case settings -->
                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Case Settings</legend>
                            <div class="has-feedback has-feedback-left form-group">
                                <input type="search" class="form-control filterSearch" placeholder="Search Function">
                                <div class="form-control-feedback">
                                    <i class="icon-search4 text-size-small text-muted"></i>
                                </div>
                            </div>
                            <div class="has-scroll filterList">
                                @php

                                    $case_more_setting_ids= [];
                                    if(Request::has('case_more_setting_id')){
                                        $case_more_setting_ids = Request::get('case_more_setting_id');
                                    }
                                @endphp
                                @foreach($caseMoreSettings as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $case_more_setting_ids)) checked
                                                   @endif name="case_more_setting_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- caliber settings -->
                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Caliber Settings</legend>
                            <div class="has-feedback has-feedback-left form-group">
                                <input type="search" class="form-control filterSearch" placeholder="Search Function">
                                <div class="form-control-feedback">
                                    <i class="icon-search4 text-size-small text-muted"></i>
                                </div>
                            </div>
                            <div class="has-scroll filterList">
                                @php

                                    $caliber_setting_ids= [];
                                    if(Request::has('caliber_setting_id')){
                                        $caliber_setting_ids = Request::get('caliber_setting_id');
                                    }
                                @endphp
                                @foreach($caliberMoreSettings as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $caliber_setting_ids)) checked
                                                   @endif name="caliber_setting_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- movements -->
                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Movements</legend>
                            <div class="has-feedback has-feedback-left form-group">
                                <input type="search" class="form-control filterSearch" placeholder="Search Function">
                                <div class="form-control-feedback">
                                    <i class="icon-search4 text-size-small text-muted"></i>
                                </div>
                            </div>
                            <div class="has-scroll filterList">
                                @php

                                    $movement_ids= [];
                                    if(Request::has('movement_id')){
                                        $movement_ids = Request::get('movement_id');
                                    }
                                @endphp
                                @foreach($movements as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $movement_ids)) checked
                                                   @endif name="movement_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- genders -->
                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Gender</legend>
                            @php

                                $gender_ids= [];
                                if(Request::has('gender')){
                                    $gender_ids = Request::get('gender');
                                }
                            @endphp
                            <div class="has-scroll filterList">
                                @foreach($genders as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $gender_ids)) checked
                                                   @endif name="gender" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- water resistance -->
                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Water Resistance</legend>
                            @php

                                $water_resistance_ids= [];
                                if(Request::has('water_resistance_id')){
                                   $water_resistance_ids = Request::get('water_resistance_id');
                                }
                            @endphp
                            <div class="has-scroll filterList">
                                @foreach($waterResistances as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $water_resistance_ids)) checked
                                                   @endif name="water_resistance_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Delivery Scopes</legend>
                            @php

                                $delivery_scopes_ids= [];
                                if(Request::has('delivery_scopes_id')){
                                   $delivery_scopes_ids = Request::get('delivery_scopes_id');
                                }
                            @endphp
                            <div class="has-scroll filterList">
                                @foreach($deliveryScopes as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $delivery_scopes_ids)) checked
                                                   @endif name="delivery_scopes_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Case Materials</legend>
                            @php

                                $case_material_ids= [];
                                if(Request::has('case_material_id')){
                                   $case_material_ids = Request::get('case_material_id');
                                }
                            @endphp
                            <div class="has-scroll filterList">
                                @foreach($caseMaterials as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $case_material_ids)) checked
                                                   @endif name="case_material_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Bezel Materials</legend>
                            @php

                                $bezel_material_ids = [];
                                if(Request::has('bezel_material_id')){
                                   $bezel_material_ids = Request::get('bezel_material_id');
                                }
                            @endphp
                            <div class="has-scroll filterList">
                                @foreach($bezelMaterials as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $bezel_material_ids)) checked
                                                   @endif name="bezel_material_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Dial</legend>
                            @php

                                $dial_ids= [];
                                if(Request::has('dial_id')){
                                   $dial_ids = Request::get('dial_id');
                                }
                            @endphp
                            <div class="has-scroll filterList">
                                @foreach($dial as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $dial_ids)) checked
                                                   @endif name="dial_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Dial Numerals</legend>
                            @php

                                $dial_numeral_ids= [];
                                if(Request::has('dial_numeral_id')){
                                   $dial_numeral_ids = Request::get('dial_numeral_id');
                                }
                            @endphp
                            <div class="has-scroll filterList">
                                @foreach($dialNumerals as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $dial_numeral_ids)) checked
                                                   @endif name="dial_numeral_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Dial Features</legend>
                            <div class="has-scroll filterList">
                                @php

                                    $dial_feature_ids = [];
                                    if(Request::has('dial_feature_id')){
                                       $dial_feature_ids = Request::get('dial_feature_id');
                                    }
                                @endphp
                                @foreach($dialFeatures as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $dial_feature_ids)) checked
                                                   @endif name="dial_feature_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Glass Types</legend>
                            @php

                                $glass_type_ids = [];
                                if(Request::has('glass_type_id')){
                                   $glass_type_ids = Request::get('glass_type_id');
                                }
                            @endphp
                            <div class="has-scroll filterList">
                                @foreach($glassTypes as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $glass_type_ids)) checked
                                                   @endif name="glass_type_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Hand Details</legend>
                            @php

                                $hand_detail_ids = [];
                                if(Request::has('hand_detail_id')){
                                   $hand_detail_ids = Request::get('hand_detail_id');
                                }
                            @endphp
                            <div class="has-scroll filterList">
                                @foreach($handDetails as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $hand_detail_ids)) checked
                                                   @endif name="hand_detail_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Bracelet Materials</legend>
                            @php

                                $bracelet_material_ids = [];
                                if(Request::has('bracelet_material_id')){
                                   $bracelet_material_ids = Request::get('bracelet_material_id');
                                }
                            @endphp
                            <div class="has-scroll filterList">
                                @foreach($braceletMaterials as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $bracelet_material_ids)) checked
                                                   @endif name="bracelet_material_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Bracelet Colors</legend>
                            @php

                                $bracelet_color_ids = [];
                                if(Request::has('bracelet_color_id')){
                                   $bracelet_color_ids = Request::get('bracelet_color_id');
                                }
                            @endphp
                            <div class="has-scroll filterList">
                                @foreach($braceletColors as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $bracelet_color_ids)) checked
                                                   @endif name="bracelet_color_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Clasp Types</legend>
                            @php

                                $clasp_type_ids = [];
                                if(Request::has('clasp_type_id')){
                                   $clasp_type_ids = Request::get('clasp_type_id');
                                }
                            @endphp
                            <div class="has-scroll filterList">
                                @foreach($claspTypes as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $clasp_type_ids)) checked
                                                   @endif name="clasp_type_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group outer-list-div">
                            <legend class="text-size-mini text-muted no-border no-padding">Clasp Materials</legend>
                            @php

                                $clasp_material_ids = [];
                                if(Request::has('clasp_material_id')){
                                   $clasp_material_ids = Request::get('clasp_material_id');
                                }
                            @endphp
                            <div class="has-scroll filterList">
                                @foreach($claspMaterials as $key => $value)
                                    <div class="checkbox">
                                        <label class="display-block">
                                            <input @if(in_array($key, $clasp_material_ids)) checked
                                                   @endif name="clasp_material_id" type="checkbox"
                                                   class="styled" value="{{ $key }}">
                                            {{ $value }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /filter -->
        </div>
    </div>
</div>
<!-- /detached sidebar -->
