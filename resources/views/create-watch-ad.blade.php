@extends('layouts.app')

@section("title", "Sell Your Watch Quickly and Easily on Timepiece")

@push("after-styles")
    <link rel="stylesheet" href="{{ asset('css/jquery-steps/jquery.steps.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-steps/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-steps/steps.css') }}">
    <style>
        a#steps-uid-0-t-2 {
            background: #c89979;
            color: white;
            line-height: 100%;
        }
        .length{
            width: auto;
        }


        @media (max-width: 600px) {
            .watch-draft{
                margin-left: 0 !important;
            }
            .wizard > .steps > ul > li {
                width: 100%;
            }
            a#steps-uid-0-t-2 {

                line-height: 27px;
            }
            .text-center {
              text-align: left !important; */
            }
            .gap{
                margin-left: 1rem !important;
            }

        }

.content.clearfix {
    overflow: scroll !important;
    height: 50rem;
}

.content.clearfix::-webkit-scrollbar {
  width: 10px;
  
}

/ Track /
.content.clearfix::-webkit-scrollbar-track {
  background: #779797; 
}
 
/ Handle /
.content.clearfix::-webkit-scrollbar-thumb {
  background: #004040; 
}

/ Handle on hover /
.content.clearfix::-webkit-scrollbar-thumb:hover {
  background: #004040; 
}



    </style>
@endpush

@section("breadcrumb")
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Become A Vendor</li>
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
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form enctype="multipart/form-data" id="create-ad-form" method="post">
                        <div>
                            <h3 class="active">Watch Details</h3>
                            <section>
                                <h1>Watch Details</h1><br>
                                <legend class="h3 text-default text-center text-sm-left p-b-3">Offer <span
                                        class="text-muted h6">(* Required field)</span></legend>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="product_type_id">Name <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="name" id="name1"
                                               value="{{ set_input_default_value('name', $product, '') }}"
                                               class="required form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="product_type_id">Type of watch <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        @php
                                            $pProductTypes->prepend('Please Select', '');
                                        @endphp
                                        {!! Form::select('product_type_id', $pProductTypes, old('product_type_id', set_input_default_value('product_type_id', $product, '')), ['id' => 'product_type_id', 'class' => 'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="brand_id">Brand <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        @php
                                            $pBrands->prepend('Please Select', '');
                                        @endphp
                                        {!! Form::select('brand_id', $pBrands, old('brand_id', set_input_default_value('brand_id', $product, '')), ['id' => 'brand_id', 'class' => 'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="product_category_id">Product Category <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        @php
                                            $pProductCategories->prepend('Please Select', '');
                                        @endphp
                                        {!! Form::select('product_category_id', $pProductCategories, old('product_category_id', set_input_default_value('product_category_id', $product, '')), ['id' => 'product_category_id', 'class' => 'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="modal">Model <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input id="modal" name="modal" required type="text"
                                               class="required form-control"
                                               value="{{ set_input_default_value('modal', $product, '') }}">
                                        <small>You can be more specific about the model name and indicate the exact
                                            model.
                                        </small>
                                    </div>
                                </div>
                                <br>
                                <input type="hidden" name="product_id" id="product_id"
                                       value="{{ set_input_default_value('id', $product, 0) }}">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="reference_number">Reference number </label>
                                        <i
                                            class="icon-info text-muted cursor-pointer"
                                            data-toggle="popover"
                                            data-title="Where can I find the reference number?"
                                            data-content="You can usually find the reference number on the case back, lugs, dial, or in your watch's documents. You also may find it by searching on the internet."
                                            data-placement="right" data-container="body">
                                        </i>
                                    </div>
                                    <div class="col-md-8">
                                        <input id="reference_number" name="reference_number" type="text"
                                               value="{{ set_input_default_value('reference_number', $product, '') }}"
                                               class="form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="condition_id">Condition <span class="text-danger">*</span></label>
                                        <i id="condition-popover" class="cursor-pointer icon-info">
                                        </i>
                                    </div>
                                    <div class="col-md-8">
                                        @php
                                            $pConditions->prepend('Please Select', '');
                                        @endphp
                                        {!! Form::select('condition_id', $pConditions, old('condition_id', set_input_default_value('condition_id', $product, '')), ['id' => 'condition_id', 'class' => 'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="delivery_scope_id">Scope of delivery <span
                                                class="text-danger">*</span></label>
                                        <i
                                            class="icon-info text-muted cursor-pointer"
                                            data-toggle="popover"
                                            data-title="Did you know?"
                                            data-content="The watch's original box and papers make your ad even more attractive."
                                            data-placement="right" data-container="body">
                                        </i>
                                    </div>
                                    <div class="col-md-8">
                                        @php
                                            $pScopeOfDelivery->prepend('Please Select', '');
                                        @endphp
                                        {!! Form::select('delivery_scope_id', $pScopeOfDelivery, old('delivery_scope_id', set_input_default_value('delivery_scope_id', $product, '')), ['id' => 'delivery_scope_id', 'class' => 'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <br>
                                <legend class="h3 text-default text-center text-sm-left mt-4">Basic Info <span
                                        class="text-muted h6">(* Required field)</span></legend>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="gender">Gender <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        @php
                                            $genders = collect([
                                                "" => "Please Select",
                                                "Men's Watch" => "Men's Watch",
                                                "Unisex" => "Unisex",
                                                "Women's Watch" => "Women's Watch"
                                            ]);
                                        @endphp
                                        {!! Form::select('gender', $genders, old('gender', set_input_default_value('gender', $product, '')), ['id' => 'gender', 'class' => 'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="year_of_production">Year of production <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input id="year_of_production" name="year_of_production" type="number"
                                               minlength="4" maxlength="4" class="required form-control" min="1000"
                                               @if(set_input_default_value('approximation_unknown', $product, 1) == 0) disabled
                                               @endif
                                               value="{{ set_input_default_value('year_of_production', $product, '') }}"><br>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <input class="approximation display-inline-block mr-3"
                                                       @if(set_input_default_value('approximation_unknown', $product, 1) == 1) checked
                                                       @endif
                                                       type="radio"
                                                       name="approximation_unknown" value="1"> Approximation
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <input class="approximation display-inline-block mr-3" type="radio"
                                                       @if(set_input_default_value('approximation_unknown', $product, 1) == 0) checked
                                                       @endif
                                                       name="approximation_unknown" value="0"> Unknown
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label>Case Diameter</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="case_diameter_width" name="case_diameter_width" placeholder="mm"
                                               type="number"
                                               value="{{ set_input_default_value('case_diameter_width', $product, '') }}"
                                               class="form-control">
                                        <small>Case Diameter Width is in millimeter (mm)</small>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="case_diameter_length" name="case_diameter_length" placeholder="mm"
                                               type="number"
                                               value="{{ set_input_default_value('case_diameter_length', $product, '') }}"
                                               class="form-control">
                                        <small>Case Diameter Length is in millimeter (mm)</small>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="movement_id">Movement</label>
                                    </div>
                                    <div class="col-md-8">
                                        @php
                                            $pMovements->prepend('Please Select', '');
                                        @endphp
                                        {!! Form::select('movement_id', $pMovements, old('movement_id', set_input_default_value('movement_id', $product, '')), ['id' => 'movement_id', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="description">Description <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea id="description" required name="description"
                                                  placeholder="Type here..."
                                                  type="text"
                                                  class="form-control">{{ set_input_default_value('description', $product, '') }}</textarea>
                                    </div>
                                </div>
                                <br>
                                <legend class="h3 text-default text-center text-sm-left mt-4">Price <span
                                        class="text-muted h6">(* Required field)</span></legend>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="price">Price<span class="text-danger">*</span></label>
                                        <i
                                            class="icon-info text-muted cursor-pointer"
                                            data-toggle="popover"
                                            data-title="How do I figure out the right sales price?"
                                            data-content="Use the free appraisal tool on Timepiece. We compare your watch with 400,000 offers from around the world and then give you a suggested price.."
                                            data-placement="right" data-container="body">
                                        </i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-xs-6 ml-3 mr-0 pr-0">
                                                <input id="price" name="price" type="number" step="0.01" min="1"
                                                       class="required form-control"
                                                       value="{{ set_input_default_value('price', $product, '0.00') }}">
                                            </div>
                                            <div class="col-md-2 ml-0 pl-0">
                                                {!! Form::select('country_id', $pCurrencies, old('country_id', set_input_default_value('country_id', $product, '')), ['id' => 'currency_id', 'class' => 'length gap form-control', 'style' => '    font-size: 0.9rem !important;', 'required'], $pCurrenciesAttributes) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="shipping_cost">Shipping Cost<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12 mr-0 pr-0">
                                                <input id="shipping_cost" name="shipping_cost" type="number" step="0.01"
                                                       min="0.00"
                                                       class="required form-control"
                                                       value="{{ set_input_default_value('shipping_cost', $product, '0.00') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <legend class="h3 text-default text-center text-sm-left mt-4">Additional information
                                    <span class="text-muted h5">(Optional)</span></legend>
                                <hr>
                                <div class="col-md-11 offset-1">
                                    <div class="faq-style-wrap section-pb" id="faq-five">

                                        <!-- Panel-default -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    <a id="octagon" class="collapsed" role="button"
                                                       data-toggle="collapse" data-target="#faq-collapse1"
                                                       aria-expanded="false" aria-controls="faq-collapse1"> <span
                                                            class="button-faq"></span>Caliber</a>
                                                </h5>
                                            </div>
                                            <div id="faq-collapse1" class="collapse" aria-expanded="true"
                                                 role="tabpanel" data-parent="#faq-five" style="">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="movement_caliber">Movement/Caliber</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input id="movement_caliber" name="movement_caliber"
                                                                   type="text"
                                                                   value="{{ set_input_default_value('movement_caliber', $product, '') }}"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="base_caliber">Base caliber</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input id="base_caliber" name="base_caliber" type="text"
                                                                   value="{{ set_input_default_value('base_caliber', $product, '') }}"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="power_reserve">Power reserve</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input id="power_reserve" name="power_reserve" type="text"
                                                                   value="{{ set_input_default_value('power_reserve', $product, '') }}"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="number_of_jewels">Number of jewels</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input id="number_of_jewels" name="number_of_jewels"
                                                                   value="{{ set_input_default_value('number_of_jewels', $product, 0) }}"
                                                                   type="text"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="frequency">Frequency</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input id="frequency" name="frequency" type="text"
                                                                   value="{{ set_input_default_value('frequency', $product, '') }}"
                                                                   class="form-control">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="caliber_more_setting_ids">More Settings</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                @php
                                                                    $selectedCaliberMoreSettings = [];
                                                                    if($product){
                                                                        $selectedCaliberMoreSettings = $product->caliberMoreSettings()->pluck('id')->toArray();
                                                                    }
                                                                @endphp
                                                                @foreach($pCaliberMoreSettings as $key => $value)
                                                                    <div
                                                                        class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                        <input type="checkbox"
                                                                               name="caliber_more_setting_ids[]"
                                                                               value="{{ $key }}"
                                                                            @php if(in_array($key, $selectedCaliberMoreSettings)) echo 'checked'; @endphp>
                                                                        <span class="ml-3">{{ $value }}</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <!--// Panel-default -->

                                        <!-- Panel-default -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse"
                                                       data-target="#faq-collapse2" aria-expanded="false"
                                                       aria-controls="faq-collapse2"> <span class="button-faq"></span>Case</a>
                                                </h5>
                                            </div>
                                            <div id="faq-collapse2" class="collapse" aria-expanded="false"
                                                 role="tabpanel" data-parent="#faq-five">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="confirm">Case material</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            @php
                                                                $pCaseMaterials->prepend('Please Select', '');
                                                            @endphp
                                                            {!! Form::select('case_material_id', $pCaseMaterials,
                                                            old('case_material_id', set_input_default_value('case_material_id', $product, '')), ['id' => 'case_material_id', 'class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="confirm">Bezel material</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            @php
                                                                $pBezelMaterials->prepend('Please Select', '');
                                                            @endphp
                                                            {!! Form::select('bezel_material_id', $pBezelMaterials,
                                                            old('bezel_material_id', set_input_default_value('bezel_material_id', $product, '')), ['id' => 'bezel_material_id', 'class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="confirm">Thickness</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input id="thickness" name="thickness" type="text"
                                                                   value="{{ set_input_default_value('thickness', $product, '') }}"
                                                                   class="form-control">
                                                            <small>Thickness is in millimeter (mm)</small>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="confirm">Glass</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            @php
                                                                $pGlassTypes->prepend('Please Select', '');
                                                            @endphp
                                                            {!! Form::select('glass_type_id', $pGlassTypes,
                                                            old('glass_type_id', set_input_default_value('glass_type_id', $product, '')),
                                                            ['id' => 'glass_type_id', 'class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="confirm">Water resistance</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            @php
                                                                $pWaterResistances->prepend('Please Select', '');
                                                            @endphp
                                                            {!! Form::select('water_resistance_id', $pWaterResistances,
                                                            old('water_resistance_id', set_input_default_value('water_resistance_id', $product, '')),
                                                            ['id' => 'water_resistance_id', 'class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="case_more_setting_ids">More Settings</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                @php
                                                                    $selectedCaseMoreSettings = [];
                                                                    if($product){
                                                                        $selectedCaseMoreSettings = $product->caseMoreSettings()->pluck('id')->toArray();
                                                                    }
                                                                @endphp
                                                                @foreach($pCaseMoreSettings as $key => $value)
                                                                    <div
                                                                        class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                        <input type="checkbox"
                                                                               name="case_more_setting_ids[]"
                                                                               value="{{ $key }}"
                                                                            @php if(in_array($key, $selectedCaseMoreSettings)) echo 'checked'; @endphp>
                                                                        <span class="ml-3">{{ $value }}</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--// Panel-default -->

                                        <!-- Panel-default -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse"
                                                       data-target="#faq-collapse3" aria-expanded="false"
                                                       aria-controls="faq-collapse3"> <span class="button-faq"></span>Dial
                                                        and Hands</a>
                                                </h5>
                                            </div>
                                            <div id="faq-collapse3" class="collapse" role="tabpanel"
                                                 data-parent="#faq-five">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="dial_id">Dial</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            @php
                                                                $pDials->prepend('Please Select', '');
                                                            @endphp
                                                            {!! Form::select('dial_id', $pDials,
                                                            old('dial_id', set_input_default_value('dial_id', $product, '')),
                                                            ['id' => 'dial_id', 'class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="dial_numeral_id">Dial Numerals</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            @php
                                                                $pDialNumerals->prepend('Please Select', '');
                                                            @endphp
                                                            {!! Form::select('dial_numeral_id', $pDialNumerals,
                                                            old('dial_numeral_id', set_input_default_value('dial_numeral_id', $product, '')),
                                                            ['id' => 'dial_numeral_id', 'class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="dial_feature_ids">Dial Features</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                @php
                                                                    $selectedDialFeatures = [];
                                                                    if($product){
                                                                        $selectedDialFeatures = $product->dialFeatures()->pluck('id')->toArray();
                                                                    }
                                                                @endphp
                                                                @foreach($pDialFeatures as $key => $value)
                                                                    <div
                                                                        class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                        <input type="checkbox"
                                                                               name="dial_feature_ids[]"
                                                                               value="{{ $key }}"
                                                                            @php if(in_array($key, $selectedDialFeatures)) echo 'checked'; @endphp>
                                                                        <span
                                                                            class="ml-3">{{ $value }}</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="hand_detail_ids">Hand Details</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                @php
                                                                    $selectedHandDetails = [];
                                                                    if($product){
                                                                        $selectedHandDetails = $product->handDetails()->pluck('id')->toArray();
                                                                    }
                                                                @endphp
                                                                @foreach($pHandDetails as $key => $value)
                                                                    <div
                                                                        class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                        <input type="checkbox"
                                                                               name="hand_detail_ids[]"
                                                                               value="{{ $key }}"
                                                                            @php if(in_array($key, $selectedHandDetails)) echo 'checked'; @endphp>
                                                                        <span class="ml-3">{{ $value }}</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--// Panel-default -->

                                        <!-- Panel-default -->
                                        <div class="panel panel-default ">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    <a class="collapsed " role="button" data-toggle="collapse"
                                                       data-target="#faq-collapse4" aria-expanded="false"
                                                       aria-controls="faq-collapse4"> <span class="button-faq"></span>Bracellet/Strap</a>
                                                </h5>
                                            </div>
                                            <div id="faq-collapse4" class="collapse" role="tabpanel"
                                                 data-parent="#faq-five">
                                                <div class="panel-body scroll-vertical">
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="confirm">Bracelet material</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            @php
                                                                $pBraceletMaterials->prepend('Please Select', '');
                                                            @endphp
                                                            {!! Form::select('bracelet_material_id', $pBraceletMaterials,
                                                             old('bracelet_material_id', set_input_default_value('bracelet_material_id', $product, '')),
                                                              ['id' => 'bracelet_material_id', 'class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="confirm">Bracelet color</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            @php
                                                                $pBraceletColors->prepend('Please Select', '');
                                                            @endphp
                                                            {!! Form::select('bracelet_color_id', $pBraceletColors,
                                                             old('bracelet_color_id', set_input_default_value('bracelet_color_id', $product, '')),
                                                              ['id' => 'bracelet_color_id', 'class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="confirm">Type of clasp</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            @php
                                                                $pClaspTypes->prepend('Please Select', '');
                                                            @endphp
                                                            {!! Form::select('clasp_type_id', $pClaspTypes, old('clasp_type_id',
                                                             set_input_default_value('clasp_type_id', $product, '')),
                                                             ['id' => 'clasp_type_id', 'class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-4 text-center">
                                                            <label for="confirm">Clasp material</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            @php
                                                                $pClaspTypes->prepend('Please Select', '');
                                                            @endphp
                                                            {!! Form::select('clasp_material_id', $pClaspMaterials,
                                                             old('clasp_material_id', set_input_default_value('clasp_material_id', $product, '')),
                                                              ['id' => 'clasp_material_id', 'class' => 'form-control']) !!}
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <!--// Panel-default -->

                                        <!-- Panel-default -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    <a class="collapsed" role="button" data-toggle="collapse"
                                                       data-target="#faq-collapse5" aria-expanded="false"
                                                       aria-controls="faq-collapse5"> <span class="button-faq"></span>Functions</a>
                                                </h5>
                                            </div>
                                            <div id="faq-collapse5" class="collapse" role="tabpanel"
                                                 data-parent="#faq-five">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        @php
                                                            $selectedProductFunctions = [];
                                                            if($product){
                                                                $selectedProductFunctions = $product->productFunctions()->pluck('id')->toArray();
                                                            }
                                                        @endphp
                                                        @foreach($pProductFunctions as $key => $value)
                                                            <div
                                                                class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                <input type="checkbox"
                                                                       name="product_function_ids[]"
                                                                       value="{{ $key }}"
                                                                    @php if(in_array($key, $selectedProductFunctions)) echo 'checked'; @endphp>
                                                                <span class="ml-3">{{ $value }}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--// Panel-default -->
                                    </div>
                                </div>
                                <!-- <input id="brand" name="brand" type="text" class="required form-control">
                                <input id="brand" name="brand" type="text" class="required form-control">
                                <input id="brand" name="brand" type="text" class="required form-control">
                                <label for="confirm">Confirm Password *</label>
                                <input id="confirm" name="confirm" type="password" class="required form-control">
                                <p>(*) Mandatory</p>
                                <select name="countries" class="form-control required" id="countries">
                                    <option value="pakistan">Pakistan</option>
                                    <option value="pakistan1">Pakistan1</option>
                                    <option value="pakistan2">Pakistan2</option>
                                </select> -->
                            </section>
                            <h3>Pictures</h3>
                            <section>
                                <h4>Pictures</h4><br>
                                <p class="ml-2">Take photos of your watch as proof of ownership.</p><br>
                                <hr>
                                <h5>Pictures of your watch</h5><br>
                                <p class="ml-2">Good pictures put the finishing touch on your ad. Take pictures of your
                                    watch from all angles in order to attract the most buyers.</p><br>
                                <p class="ml-2">Select files or drag here</p>
                                <div class="col-md-12">
                                    <div class="upload-pictures">
                                        <i class="fa fa-camera upload-cam cursor-pointer product-image-upload"
                                           aria-hidden="true"></i><br>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-default mt-5 product-image-upload">
                                                Upload
                                            </button>
                                        </div>
                                        <input type="file" id="files" name="files[]" class="display-none" multiple>
                                    </div>
                                    <p class="text-muted text-center mt-1">Upload up to 10 images</p><br>
                                    @php
                                        $pictures = $product->productPictures()->get();
                                        $count = $pictures->count();
                                    @endphp
                                    <div class="row" id="uploaded-images" data-count="{{ $count }}">
                                        @foreach($pictures as $key => $picture)
                                            <div class="col-md-3 mt-2" id="p-{{ $picture->id }}">
                                                <img class="img-fixed-height"
                                                     src="{{ asset('admin/images/products/'.$picture->picture) }}">
                                                <i class="cross-btn delete-product-image"
                                                   data-id="{{ $picture->id }}">✕</i>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                    <hr>
                                    @php
                                        $ownershipPictures = $product->productOwnershipPictures()->get();
                                        $count = $ownershipPictures->count();
                                        $ownershipPictures = $ownershipPictures->getIterator();
                                        $current = current($ownershipPictures);
                                        $next = next($ownershipPictures);
                                    @endphp
                                    <h5>Proof of ownership</h5>
                                    <p class="ml-2">Please upload photos showing your watch set to the following times.
                                        This shows us that the watch is actually in your possession.</p>
                                        @php $time = $product->proof_time ?? rand(1, 12).':'.rand(00, 59) @endphp
                                        <center><h4 style="color:green;">{{ $time }}</h4></center>
                                        <br/>
                                    <div class="row">
                                        <div class="col-md-3">
                                            @php
                                                if($current){
                                                    $id = $current->id;
                                                    $picture = asset('admin/images/products/'.$current->picture);
                                                    $count = 1;
                                                }else{
                                                    $id = 0;
                                                    $picture = asset('assets/images/banner/about-us_bg.jpg');
                                                    $count = 0;
                                                }
                                            @endphp
                                            <img class="img-fixed-height" id="ownership-1" data-count="{{ $count }}"
                                                 src="{{ $picture }}"> <i
                                                data-id="{{ $id }}" class="cross-btn" id="ownership-i-1">&#10005;</i>
                                            <button type="button" class="btn btn-default upload upload-ownership1"
                                                    @if($current) style="display: none;" @endif>
                                                upload
                                            </button>
                                            <input type="text" id="proof-time" name="proof_time" hidden value="{{ $time }}" >
                                            <input type="file" id="picture1" name="picture1" style="display: none;">
                                            <input type="hidden" value="ownership" name="type">
                                        </div>
                                        <div class="col-md-3">
                                            @php
                                                if($next){
                                                    $id = $next->id;
                                                    $picture = asset('admin/images/products/'.$next->picture);
                                                    $count = 1;
                                                }else{
                                                    $id = 0;
                                                    $picture = asset('assets/images/banner/about-us_bg.jpg');
                                                    $count = 0;
                                                }
                                            @endphp
                                            <img class="img-fixed-height" id="ownership-2" data-count="{{ $count }}"
                                                 src="{{ $picture }}"> <i
                                                data-id="{{ $id }}" class="cross-btn" id="ownership-i-2">&#10005;</i>
                                            <button type="button" class="btn btn-default upload upload-ownership2"
                                                    @if($next) style="display: none;" @endif>
                                                upload
                                            </button>
                                            <input type="file" id="picture2" name="picture2" style="display: none;">
                                            <input type="hidden" value="ownership" name="type">
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                </div>
                            </section>
                            <h3 >Personal Information</h3>
                            <section>
                                <h4>Personal Information</h4><br>
                                <p class="ml-2">Please review your personal information.</p>
                                <input type="hidden" name="user_id" id="product_id" value="{{auth()->user()->id}}">
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="first_name">First Name</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input id="first_name" name="first_name" value="{{ $user->first_name }}"
                                               type="text" class="required form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="last_name">Last Name</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input id="last_name" name="last_name" value="{{ $user->last_name }}"
                                               type="text" class="required form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="street">Street</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input id="street" name="street" value="{{ $user->street }}" type="text"
                                               class="required form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="street_line_2">Street line 2</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input id="street_line_2" name="street_line_2"
                                               value="{{ $user->street_line_2 }}" type="text" class="form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="country_id">Country</label>
                                    </div>
                                    <div class="col-md-8">
                                        @php
                                            $countries->prepend('Select Country', '');
                                        @endphp
                                        {!! Form::select('country_id', $countries, old('country_id', $user->country_id),
                                         ['id' => 'country_id', 'class' => 'form-control', 'required']) !!}
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="city">City</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input id="city" name="city" value="{{ $user->city }}" type="text"
                                               class="required form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input id="state" name="state" value="{{ $user->state }}" type="text"
                                               placeholder="State" class="required form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <input id="zip_code" name="zip_code" value="{{ $user->zip_code }}" type="text"
                                               placeholder="Zip Code" class="required form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="phone_no">Phone No.</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input id="phone_no" name="phone_no" value="{{ $user->phone_no }}" type="text"
                                               class="required form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                        <label for="mobile_no">Mobile No.</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input id="mobile_no" name="mobile_no" value="{{ $user->mobile_no }}"
                                               type="text" class="required form-control">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 text-center">
                                    </div>
                                    <div class="col-md-8">
                                        <input type="checkbox" id="display_name"
                                               name="display_name" @if($user->display_name) checked @endif>
                                        <span class="ml-1">I would like to show my name</span><br><br>
                                        <div class="text-personal">
                                            <p>Your data is secure Timepiece strictly adheres to all applicable
                                                data protection laws.</p>
                                            <p>Your personal information will never be published and is only used during
                                                the registration process and when selling items on Timepiece.</p>
                                            <p>Your personal information will never be published and is only
                                                used during the registration process and when selling items on
                                                Timepiece.</p>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </section>
                            <h3>Summary</h3>
                            <section>
                                <h4>
                                    <legend>Payment</legend>
                                </h4>
                                <br>
                                <p class="ml-2">Please select a payment method and submit your ad.</p>
                                <hr>
                                <br>
                                <legend>Preview</legend>
                                <br>
                                <div class="preview-box row ml-4">
                                    <div class="col-md-3 ">
                                        @php
                                            if($pictures->count() >= 1){
                                                $picture = $pictures->first();
                                                $pic = asset('admin/images/products/'.$picture->picture);
                                            } else {
                                                $pic = asset('admin/images/default-watch-picture.gif');
                                            }
                                        @endphp
                                        <img class="prev-image-box full-width"
                                             src="{{ $pic }}">
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="text-sm">
                                            <span style="color: red;"><strong>Draft</strong></span>
                                            <span
                                                class="product-name">{{ set_input_default_value('name', $product, 'Watch Name') }}</span>
                                        </h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 product-Function">
                                                <ul>
                                                    <li>Movement</li>
                                                    <li>Case material</li>
                                                    <li>Year</li>
                                                    <li>Condition</li>
                                                    <li>Price</li>
                                                    <br>
                                                    <li>
                                                        <small>Private seller</small>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 product-Function">
                                                <ul>
                                                    <li><span class="product-movement">-</span></li>
                                                    <li><span class="product-case-material">-</span></li>
                                                    <li><span class="product-year-of-production">-</span></li>
                                                    <li><span class="product-condition">-</span></li>
                                                    <li><strong><span class="product-price">-</span></strong></li>
                                                </ul>
                                            </div>
                                        </div>
                                        @if($user->country)
                                            <div class="flag-icon-steps">
                                                <img src="{{ asset('admin/images/flags/'.$user->country->flag) }}"
                                                     alt="{{ $user->country->name }}">
                                                <span class="caption country-name">{{ $user->country->code }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <div class="listing-fee">
                                    <h4>
                                        <legend>Listing Fee</legend>
                                    </h4>
                                    <br>
                                    <div class="listing-fee-cal ml-4">
                                        <div class="listing-price p-3">
                                            Listing fee<span class="float-right listing-fee" id="listing-fee">
                                                {{ set_input_default_value('symbol', $product->currency, '') }}
                                                {{ set_input_default_value('listing_fee', $product, '0.00') }}
                                            </span>
                                            <input type="hidden"
                                                   value="{{ set_input_default_value('listing_fee', $product, '') }}"
                                                   id="listing_fee" name="listing_fee">
                                        </div>
                                    </div>
                                    <p class="mt-2 ml-4">You pay 4.5% of the watch's price, with a minimum fee of USD5
                                        and a maximum fee of USD299 per ad. With a money-back guarantee!</p>
                                    <hr>
                                    <h4>
                                        <legend>Total Charges</legend>
                                    </h4>
                                    <br>
                                    <div class="listing-fee-cal ml-4 mb-3">
                                        <div class="listing-price p-3">
                                            Total charges<span class="float-right" id="total_amount_span">
                                                {{ set_input_default_value('symbol', $product->currency, '') }}
                                                @php
                                                    $total = set_input_default_value('listing_fee', $product, '0.00') + set_input_default_value('price', $product, '0.00');
                                                @endphp
                                                {{ $total }}
                                            </span>
                                            <input type="hidden" value="{{ $total }}" id="total_amount"
                                                   name="total_amount">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="payment-box mb-5">
                                    <ul>
                                        <li class="media">
                                            <div class="media-body">
                                                <div id="paypal-button-container"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <br><br>
                            </section>
                        </div>
                    </form>
                </div>
                <div class="col-md-3 mt-5 ">
                    <div class="watch-draft sticky-wrapper is-sticky" id="sticky-wrapper"
                         style="height: 690px;">
                        <div class="jq-private-seller-sidebar-sticky p-t-3" style="width: 323px;">
                            <div class="card covered">
                                <div class="card-header">
                                    @php
                                        if($pictures->count() >= 1){
                                            $picture = $pictures->first();
                                            $pic = asset('admin/images/products/'.$picture->picture);
                                        } else {
                                            $pic = asset('admin/images/default-watch-picture.gif');
                                        }
                                    @endphp
                                    <img src="{{ $pic }}" alt=""
                                         class="full-width"></div>
                                <div class="card-body p-x-3 p-b-3">
                                    <p class="text-uppercase m-b-0 text-muted">Title</p>
                                    <p class="text-lg"><span class="product-name">Rolex</span></p>
                                    <p class="text-uppercase m-b-0 text-muted">price</p>
                                    <p class="text-lg"
                                       id="price">{{ set_input_default_value('symbol', $product->currency, '') }}{{ set_input_default_value('price', $product, '0.00') }}</p>
                                </div>
                            </div>
                            <br>
                            <div class="notification info p-a-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex">
                                        <i class="fa fa-lightbulb-o" style="font-size:24px;color:#c39052"></i>
                                        <p class="text-lg m-y-0 align-self-center">With a money-back guarantee</p>
                                    </div>
                                    <div class="divider">
                                    </div>
                                    <div>
                                        If you haven't sold your watch within 6 months, we will refund your listing fee.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
@endsection

@push('after-main-scripts')
    <script type="text/javascript" src="{{ asset('js/jquery-validate/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-steps/jquery.steps.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script
        src="https://www.paypal.com/sdk/js?client-id=AdrblDc13uITTkwdArkM-89Bb85cEZ8-eh0DyRh3TjtUfYEijRQX4koMvimLO5WQ652_iqE1fKxP-5ZF">
    </script>
    <script type="text/javascript">
        var form = $("#create-ad-form");
        form.validate({
            errorPlacement: function errorPlacement(error, element) {
                element.after(error);
            },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
        var total_amount = 0;
        var year_of_production = null;
        var listing_fee = 0;
        var paypal_visa = null;
        var approximation_unknown = parseInt('{{ set_input_default_value('approximation_unknown', $product, 1) }}');
        var _token = $('meta[name="csrf-token"]').attr('content');
        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function (event, currentIndex, newIndex) {
                form.validate().settings.ignore = ":disabled,:hidden";
                if (form.valid() && currentIndex === 0) {
                    var caliber_more_setting_ids = [];
                    $.each($("input[name='caliber_more_setting_ids[]']:checked"), function () {
                        caliber_more_setting_ids.push($(this).val());
                    });

                    var case_more_setting_ids = [];
                    $.each($("input[name='case_more_setting_ids[]']:checked"), function () {
                        case_more_setting_ids.push($(this).val());
                    });

                    var dial_feature_ids = [];
                    $.each($("input[name='dial_feature_ids[]']:checked"), function () {
                        dial_feature_ids.push($(this).val());
                    });

                    var hand_detail_ids = [];
                    $.each($("input[name='hand_detail_ids[]']:checked"), function () {
                        hand_detail_ids.push($(this).val());
                    });

                    var product_function_ids = [];
                    $.each($("input[name='product_function_ids[]']:checked"), function () {
                        product_function_ids.push($(this).val());
                    });

                    if (approximation_unknown == 1) {
                        year_of_production = $("#year_of_production").val();
                        $("span.product-year-of-production").html(year_of_production);
                    } else if (approximation_unknown == 0) {
                        year_of_production = null;
                        $("span.product-year-of-production").html('-');
                    }

                    let data = {
                        product_id: $('#product_id').val(),
                        name: $('#name1').val(),
                        proof_time: $('#proof-time').val(),
                        product_type_id: $('#product_type_id').val(),
                        brand_id: $('#brand_id').val(),
                        product_category_id: $('#product_category_id').val(),
                        modal: $('#modal').val(),
                        reference_number: $('#reference_number').val(),
                        condition_id: $('#condition_id').val(),
                        delivery_scope_id: $('#delivery_scope_id').val(),
                        gender: $('#gender').val(),
                        year_of_production: $('#year_of_production').val(),
                        case_diameter_width: $('#case_diameter_width').val(),
                        case_diameter_length: $('#case_diameter_length').val(),
                        movement_id: $('#movement_id').val(),
                        country_id: $('#currency_id').val(),
                        description: $('#description').val(),
                        price: $('#price').val(),
                        shipping_cost: $('#shipping_cost').val(),
                        movement_caliber: $('#movement_caliber').val(),
                        base_caliber: $('#base_caliber').val(),
                        power_reserve: $('#power_reserve').val(),
                        number_of_jewels: $('#number_of_jewels').val(),
                        frequency: $('#frequency').val(),
                        case_material_id: $('#case_material_id').val(),
                        bezel_material_id: $('#bezel_material_id').val(),
                        thickness: $('#thickness').val(),
                        glass_type_id: $('#glass_type_id').val(),
                        water_resistance_id: $('#water_resistance_id').val(),
                        dial_id: $('#dial_id').val(),
                        dial_numeral_id: $('#dial_numeral_id').val(),
                        bracelet_material_id: $('#bracelet_material_id').val(),
                        bracelet_color_id: $('#bracelet_color_id').val(),
                        clasp_type_id: $('#clasp_type_id').val(),
                        clasp_material_id: $('#clasp_material_id').val(),
                        caliber_more_setting_ids: caliber_more_setting_ids,
                        case_more_setting_ids: case_more_setting_ids,
                        dial_feature_ids: dial_feature_ids,
                        hand_detail_ids: hand_detail_ids,
                        product_function_ids: product_function_ids,
                        approximation_unknown: approximation_unknown,
                        listing_fee: listing_fee,
                        _token: _token
                    };
                    return $.ajax({
                        url: '{{ route('store-ad') }}',
                        method: 'POST',
                        data: data,
                        dataType: 'json',
                        success: function (response) {
                            if (response.success === true) {
                                var product = response.product;
                                $("#product_id").val(product.id);
                                swal("Saved to draft!", 'Ad saved to draft. Click ok to continue!', "success");
                                return form.valid();
                            } else {
                                swal("Error!", response.message, "error");
                            }
                            return false;
                        },
                        error: function (err) {
                            console.log(err);
                            return false;
                        }
                    });
                } else if (form.valid() && currentIndex === 1) {
                    if ($("#uploaded-images").data('count') === 0 && newIndex === 2) {
                        swal("Upload Error!", 'Upload at least one watch image!', "error");
                        return false;
                    }
                    if ($("#ownership-1").data('count') === 0 && newIndex === 2 || $("#ownership-2").data('count') === 0 && newIndex === 2) {
                        swal("Upload Error!", 'Upload ownership images!', "error");
                        return false;
                    }
                    return form.valid();
                } else if (form.valid() && currentIndex === 2) {
                    if (newIndex !== 1) {
                        $("#paypal-button-container").empty();
                        let personalInfoData = {
                            first_name: $('#first_name').val(),
                            Last_name: $('#Last_name').val(),
                            street: $('#street').val(),
                            street_line_2: $('#street_line_2').val(),
                            country_id: $('#country_id').val(),
                            city: $('#city').val(),
                            state: $('#state').val(),
                            zip_code: $('#zip_code').val(),
                            phone_no: $('#phone_no').val(),
                            mobile_no: $('#mobile_no').val(),
                            listing_fee: $('#listing-fee').text(),
                            display_name: ($('#display_name').val() === 'on') ? 1 : 0,
                            _token: _token
                        };

                        paypal.Buttons({
                            createOrder: function (data, actions) {
                                return actions.order.create({
                                    purchase_units: [{
                                        amount: {
                                            value: listing_fee
                                        }
                                    }]
                                });
                            },
                            onApprove: function (data, actions) {
                                // Capture the funds from the transaction
                                return actions.order.capture().then(function (details) {
                                    if (data.orderID) {
                                        var product_id = $("#product_id").val();
                                        $.ajax({
                                            url: base_url + '/set-ad-completed/' + product_id,
                                            method: 'POST',
                                            dataType: 'json',
                                            data: {
                                                _token: _token,
                                                paypal_order_id: data.orderID,
                                                paypal_payer_id: data.payerID
                                            },
                                            success: function (response) {
                                                if (response.success === true) {
                                                    swal({
                                                        title: "Ad Completed!",
                                                        text: response.message,
                                                        icon: "success"
                                                    })
                                                        .then((value) => {
                                                            window.location.href = base_url + '/watch/' + product_id;
                                                        });
                                                    return true;
                                                }
                                                swal("Error!", response.message, "error");
                                                return true;
                                            },
                                            error: function (err) {
                                                console.log(err);
                                            }
                                        });
                                    } else {
                                        swal("Payment Error!", 'Something went wrong!', "error");
                                    }
                                });
                            }
                        }).render('#paypal-button-container');
                        return $.ajax({
                            url: '{{ route('shop-update-profile') }}',
                            method: 'POST',
                            data: personalInfoData,
                            success: function (response) {
                                if (response.success === true) {
                                    swal("Personal Info!", 'Personal Info Updated Successfully!', "success");
                                    return true;
                                } else {
                                    swal("Personal Info Error!", 'Something went wrong!', "error");
                                }
                                return false;
                            },
                            error: function (err) {
                                console.log(err);
                                return false;
                            }
                        });
                    }
                    return true;
                } else if (form.valid() && currentIndex === 3) {
                    return form.valid();
                }
            },
            onFinishing: function (event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return false;
            },
            onFinished: function (event, currentIndex) {
                form.submit();
            }
        });

        $(".approximation").on('click', function () {
            if (this.value === '0') {
                $("input#year_of_production").prop("disabled", true).val('').removeClass('required');
            } else if (this.value === '1') {
                $("input#year_of_production").prop("disabled", false).addClass('required');
            }
            $("span.year-of-production").html('-');
            approximation_unknown = this.value;
        });
        $(".paypal_visa").on('click', function () {
            paypal_visa = this.value;
        });

        /*Initialize elements */


        let base_url = $('meta[name="base-url"]').attr('content');

        //name
        let span_name = $('span.product-name');
        let input_name = $('input#name1');
        span_name.html(input_name.val());
        input_name.on('keyup', function (event) {
            span_name.html($(this).val());
        });

        //price
        let input_price = $("input#price");
        let p_price = $('p#price');
        let span_listing_fee = $('span.listing-fee');
        let span_product_price = $('span.product-price');
        let currencyText = $("#currency_id option:selected").data('symbol');

        var price = parseFloat(input_price.val()).toFixed(2);

        span_product_price.html(currencyText + price);
        span_listing_fee.html(currencyText + calculateListingFee(price));
        p_price.html(currencyText + price);

        input_price.on('keyup', function (event) {
            price = parseFloat(input_price.val()).toFixed(2);
            p_price.html(currencyText + price);
            span_product_price.html(currencyText + price);
            span_listing_fee.html(currencyText + calculateListingFee(price));
        });

        $("select#currency_id").on('change', function (event) {
            currencyText = $("#currency_id option:selected").data('symbol');
            p_price.html(currencyText + price);
            span_product_price.html(currencyText + price);
            span_listing_fee.html(currencyText + calculateListingFee(price));
        });

        input_price.mousewheel(function (e) {
            price = parseFloat(input_price.val()).toFixed(2);
            p_price.html(currencyText + price);
            span_product_price.html(currencyText + price);
            span_listing_fee.html(currencyText + calculateListingFee(price));
        });

        $(function () {
            $('[data-toggle="popover"]').popover();
        });

        $('[data-toggle="popover"]').popover();

        $('body').on('click', function (e) {
            $('[data-toggle="popover"]').each(function () {
                //the 'is' for buttons that trigger popups
                //the 'has' for icons within a button that triggers a popup
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }
            });
        });

        let options = {
            content: '<div> \n' +
                '               <span class=\'text-nowrap\'>\n' +
                '                        <strong>Unworn</strong>\n' +
                '                     </span>\n' +
                '                     <br/>\n' +
                '                     <p>\n' +
                '                        Mint condition, without signs of wear</p>\n' +
                '                  <span class=\'text-nowrap\'>\n' +
                '                        <strong>Very good</strong>\n' +
                '                     </span>\n' +
                '                     <br/>\n' +
                '                     <p>\n' +
                '                        Worn with little to no signs of wear</p>\n' +
                '                  <span class=\'text-nowrap\'>\n' +
                '                        <strong>Good</strong>\n' +
                '                     </span>\n' +
                '                     <br/>\n' +
                '                     <p>\n' +
                '                        Light signs of wear or scratches</p>\n' +
                '                  <span class=\'text-nowrap\'>\n' +
                '                        <strong>Fair</strong>\n' +
                '                     </span>\n' +
                '                     <br/>\n' +
                '                     <p>\n' +
                '                        Obvious signs of wear or scratches</p>\n' +
                '                  <span class=\'text-nowrap\'>\n' +
                '                        <strong>Poor</strong>\n' +
                '                     </span>\n' +
                '                     <br/>\n' +
                '                     <p>\n' +
                '                        Heavy signs of wear or scratches</p>\n' +
                '                  <span class=\'text-nowrap\'>\n' +
                '                        <strong>Incomplete</strong>\n' +
                '                     </span>\n' +
                '                     <br/>\n' +
                '                     <p>\n' +
                '                        Components missing, non-functional</p>\n' +
                '                  </div>',
            html: true,
            placement: 'right'
        };
        $('#condition-popover').popover(options);

        $('html').on('click', function (e) {
            if (typeof $(e.target).data('original-title') == 'undefined' &&
                !$(e.target).parents().is('.popover.in')) {
                $('[data-original-title]').popover('hide');
            }
        });
        $(function () {
            let count = 0;

            //Uploading Product Ownership 2nd Pictures
            $(".upload-ownership2").on('click', function () {
                $('input#picture2').trigger('click');
            });
            $('input#picture2').on('change', function (event) {
                let formData = new FormData();
                let files = $('#picture2')[0].files[0];
                formData.append('picture2', files);
                formData.append('type', 'ownership');
                formData.append('_token', _token);
                var this_ = $(this);
                $.ajax({
                    url: '{!! url('upload-file') !!}/' + $("#product_id").val(),
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success === true) {
                            let picture = response.picture;
                            $(".upload-ownership2").hide();
                            let ownership_2 = $("#ownership-2");
                            ownership_2.attr('src', picture.picture).attr('data-count', 1).data('count', 1)
                                .attr('data-id', picture.id).data('id', picture.id);
                            ownership_2.next().data('id', picture.id).attr('data-id', picture.id);
                        } else {
                            swal("Upload Error!", 'File not uploaded!', "error");
                        }
                        this_.val('');
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            });

            $("#ownership-i-2, #ownership-i-1").on('click', function (event) {
                let id = $(this).data('id');
                var this_ = $(this);
                if (id !== 0) {
                    $.ajax({
                        url: '{!! url('remove-file') !!}',
                        type: 'post',
                        data: {
                            id: id,
                            type: 'ownership',
                            _token: _token
                        },
                        success: function (response) {
                            if (response.success === true) {
                                this_.data('id', 0).attr('data-id', 0);
                                $(this_).prev().attr('src', '{{ asset('assets/images/banner/about-us_bg.jpg') }}')
                                    .data('count', 0).attr('data-count', 0);
                                this_.next().show();
                            } else {
                                swal("Remove Error!", 'Something went wrong!', "error");
                            }
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    });
                }
            });

            $("#uploaded-images").on('click', '.delete-product-image', function (event) {
                let id = $(this).data('id');
                var this_ = $(this);
                if (id !== 0) {
                    $.ajax({
                        url: '{!! url('remove-file') !!}',
                        type: 'post',
                        data: {
                            id: id,
                            product_id: $("#product_id").val(),
                            type: 'product',
                            _token: _token
                        },
                        success: function (response) {
                            if (response.success === true) {
                                this_.data('id', 0).attr('data-id', 0);
                                $(this_).prev().remove();
                                $(this_).remove();
                                $("div#p-" + id).remove();
                                var full_width = $(".full-width");
                                var id_ = full_width.data('id');
                                var pictures = response.pictures;
                                if (id_ === id) {
                                    if (pictures.length > 0) {
                                        full_width.attr('data-id', pictures[0].id).data('id', pictures[0].id)
                                            .attr('src', '{{ asset('admin/images/products/') }}/' + pictures[0].picture);
                                    } else {
                                        full_width.attr('src', '{{ asset('admin/images/default-watch-picture.gif') }}')
                                            .data('id', 0).attr('data-id', 0);
                                    }
                                }
                                count = pictures.length;
                                $("#uploaded-images").data('count', count).attr('data-count', count);
                            } else {
                                swal("Remove Error!", 'Something went wrong!', "error");
                            }
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    });
                }
            });

            //Uploading Product Ownership 2nd Pictures
            $(".upload-ownership1").on('click', function () {
                $('input#picture1').trigger('click');
            });
            $('input#picture1').on('change', function (event) {
                let formData = new FormData();
                let files = $('#picture1')[0].files[0];
                formData.append('picture1', files);
                formData.append('type', 'ownership');
                formData.append('_token', _token);
                var this_ = $(this);
                $.ajax({
                    url: '{!! url('upload-file') !!}/' + $("#product_id").val(),
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success === true) {
                            let picture = response.picture;
                            $(".upload-ownership1").hide();
                            let ownership_1 = $("#ownership-1");
                            ownership_1.attr('src', picture.picture).attr('data-count', 1).data('count', 1)
                                .attr('data-id', picture.id).data('id', picture.id);
                            ownership_1.next().data('id', picture.id).attr('data-id', picture.id);
                        } else {
                            swal("Upload Error!", 'Something went wrong!', "error");
                        }
                        this_.val('');
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            });

            $(".product-image-upload").on('click', function (event) {
                event.preventDefault();
                if ($("#uploaded-images").data('count') < 10) {
                    $("#files").trigger('click');
                }
            });
            //Uploading Product Pictures
            $("#files").on('change', function (event) {
                let formData = new FormData();

                let length = this.files.length;
                let left = 10 - count;
                let this_ = $(this);
                if (length > left) {
                    swal("Upload Error!", 'Please select ' + left + ' or less images to upload', "error");
                    return false;
                }
                for (let x = 0; x < length; x++) {
                    formData.append('files[]', this.files[x]);
                }
                formData.append('type', 'product');
                formData.append('_token', _token);

                $.ajax({
                    url: '{!! url('upload-file') !!}/' + $("#product_id").val(),
                    type: 'post',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success === true) {
                            let pictures = response.pictures;
                            let uploaded_images = $("#uploaded-images");
                            if (uploaded_images.data('count') === 0) {
                                $(".full-width").attr('src', pictures[0].picture).attr('data-id', pictures[0].id).data('id', pictures[0].id);
                            }
                            for (var i = 0; i < pictures.length; i++) {
                                uploaded_images.append('<div class="col-md-3 mt-2" id="p-' + pictures[i].id + '"><img class="img-fixed-height" src="' + pictures[i].picture + '"><i class="cross-btn delete-product-image" data-id="' + pictures[i].id + '">&#10005;</i></div>');
                            }
                            uploaded_images.attr('data-count', response.count).data('count', response.count);
                            count = response.count;
                        } else {
                            swal("Upload Error!", 'Something went wrong!', "error");
                        }
                        this_.val('');
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            });

            //removed finish button of steps
            $("#steps-uid-0 .actions a[href='#finish']").remove();

            $("select#movement_id").on('change', function () {
                var movement_text = $(":selected", this).text();

                if (movement_text === "Please Select") {
                    movement_text = '-';
                }
                $("span.product-movement").html(movement_text);
            });

            $("select#case_material_id").on('change', function () {
                var case_material_text = $(":selected", this).text();

                if (case_material_text === "Please Select") {
                    case_material_text = '-';
                }
                $("span.product-case-material").html(case_material_text);
            });

            $("input#year_of_production").on('keyup', function () {
                $("span.year-of-production").html($(this).val());
            });

            var span_product_condition = $("span.product-condition");
            var select_condition = $("select#condition_id");
            var condition_text = $(":selected", select_condition).text();
            if (condition_text === "Please Select") {
                condition_text = '-';
            }
            span_product_condition.html(condition_text);

            select_condition.on('change', function () {
                condition_text = $(":selected", this).text();
                if (condition_text === "Please Select") {
                    condition_text = '-';
                }
                span_product_condition.html(condition_text);
            });


        });

        function calculateListingFee(price) {
            listing_fee = ((parseFloat(price)).toFixed(2) * 4.5) / 100;
            if (listing_fee < 5.00) {
                listing_fee = 5.00;
            } else if (listing_fee > 299) {
                listing_fee = 299.00;
            }
            listing_fee = listing_fee.toFixed(2);
            $("#listing_fee").val(listing_fee);
            total_amount = (parseFloat(price) + parseFloat(listing_fee)).toFixed(2);
            $('#total_amount').val(total_amount);
            $("#total_amount_span").html(currencyText + '' + total_amount);
            return listing_fee;
        }
    </script>
@endpush
