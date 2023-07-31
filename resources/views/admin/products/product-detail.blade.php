@extends("admin.layouts.app")

@section("title", "Product Detail")

@section("content")
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-flat">
                <div class="panel-heading mt-5">
                    <h3 class="panel-title">{{ucfirst($product->name)}}</h3>
                    <div class="heading-elements">
                        <div class="media-right text-center">
                            <h3 class="no-margin text-semibold"
                                id="price">{{$product->currency->symbol ?? ''}}{{ $product->price }}</h3>
                            @php
                                $avgRating = round($product->productRatings()->avg('rating'), 1);
                                $total = 5;
                                $diff = $total - $avgRating;
                                $diff = abs($diff - ($diff % 1)-1);
                            @endphp
                            <div class="text-nowrap">
                                @for($i=1; $i <= $total; $i++)
                                    @if($i <= $avgRating)
                                        <i class="icon-star-full2 text-size-base text-warning-300"></i>
                                    @elseif($diff > 0 && $diff < 1)
                                        <i class="icon-star-half text-size-base text-warning-300"></i>
                                        @php $diff = round($diff, 0) @endphp
                                    @else
                                        <i class="icon-star-empty3 text-size-base text-warning-300"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="text-muted" id="noOfReviews">{{ $product->productRatings()->count() }} reviews
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <h6 class="text-semibold"><b>Description</b></h6>
                    <p>{{$product->description}}</p>
                    <div class="row container-fluid">
                        <div class="col-sm-12">
                            <div class="content-group">
                            </div>
                        </div>
                    </div>
                    <h6 class="text-semibold">Product Image</h6>
                    <div class="row">
                        @if($product->productPictures()->count())
                        @foreach($product->productPictures()->get() as $key => $value)
                            @if($loop->first)
                                @php
                                   if(file_exists('admin/images/products/'.$value->picture))
                                       $picturePath = asset('admin/images/products/'.$value->picture);
                                   else
                                       $picturePath = asset('admin/images/default-watch-picture.gif');
                                @endphp
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="thumbnail">
                                        <div class="thumb">
                                            <img
                                                src="{{ $picturePath }}"
                                                alt="" style="height: 200px;">
                                            <div class="caption-overflow">
                                        <span>
                                            <a href="{{ $picturePath }}"
                                               target="_blank" class="btn bg-success-300 btn-xs btn-icon"><i
                                                    class="icon-zoomin3"></i></a>
                                            <a href="{{ $picturePath }}"
                                               target="_blank" class="btn bg-success-300 btn-xs btn-icon"><i
                                                    class="icon-download"></i></a>
                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @if(file_exists('admin/images/products/'.$value->picture))
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <div class="thumbnail">
                                            <div class="thumb">
                                                <img
                                                    src="{{ asset('admin/images/products/'.$value->picture) }}"
                                                    alt="" style="height: 200px;">
                                                <div class="caption-overflow">
                                        <span>
                                            <a href="{{ asset('admin/images/products/'.$value->picture) }}"
                                               target="_blank" class="btn bg-success-300 btn-xs btn-icon"><i
                                                    class="icon-zoomin3"></i></a>
                                            <a href="{{ asset('admin/images/products/'.$value->picture) }}"
                                               target="_blank" class="btn bg-success-300 btn-xs btn-icon"><i
                                                    class="icon-download"></i></a>
                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                            @else
                                   <div class="col-md-12">
                               <h3>No Product Image Added</h3>
                           </div>
                        @endif
                    </div>
                    <h6 class="text-semibold">OwnerShip Proof</h6>
                    <div class="row">
                        @if($product->productOwnershipPictures()->count())
                        @foreach($product->productOwnershipPictures()->get() as $key => $value)
                            @if($loop->first)
                                @php
                                    if(file_exists('admin/images/products/'.$value->picture))
                                          $picturePath = asset('admin/images/products/'.$value->picture);
                                      else
                                          $picturePath = asset('admin/images/default-watch-picture.gif');
                                @endphp
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="thumbnail">
                                    <div class="thumb">
                                        <img
                                            src="{{ $picturePath }}"
                                            alt="" style="height: 200px;">
                                        <div class="caption-overflow">
                                        <span>
                                            <a href="{{ $picturePath }}"
                                               target="_blank" class="btn bg-success-300 btn-xs btn-icon"><i
                                                    class="icon-zoomin3"></i></a>
                                            <a href="{{ $picturePath }}"
                                               target="_blank" class="btn bg-success-300 btn-xs btn-icon"><i
                                                    class="icon-download"></i></a>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                                @if(file_exists('admin/images/products/'.$value->picture))
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <div class="thumbnail">
                                            <div class="thumb">
                                                <img
                                                    src="{{ asset('admin/images/products/'.$value->picture) }}"
                                                    alt="" style="height: 200px;">
                                                <div class="caption-overflow">
                                        <span>
                                            <a href="{{ asset('admin/images/products/'.$value->picture) }}"
                                               target="_blank" class="btn bg-success-300 btn-xs btn-icon"><i
                                                    class="icon-zoomin3"></i></a>
                                            <a href="{{ asset('admin/images/products/'.$value->picture) }}"
                                               target="_blank" class="btn bg-success-300 btn-xs btn-icon"><i
                                                    class="icon-download"></i></a>
                                        </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                        @else
                            <div class="col-md-12">
                                <h3>No Ownership Image Added</h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 no-padding">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Product Functions</h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product->productFunctions()->get() as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Dial Features</h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product->dialFeatures()->get() as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-lg-12 col-md-12 col-sm-12 no-padding">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Hand Details</h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product->handDetails()->get() as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 no-padding">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Case More Settings</h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product->caseMoreSettings()->get() as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 no-padding">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Caliber More Settings</h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product->caliberMoreSettings()->get() as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-lg-3">
            <!-- Country -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Country</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <table class="table table-borderless table-xs content-group-sm">
                    <tbody>
                    <tr>
                        <td>Country Name:</td>
                        <td class="text-right"><span class="pull-right">{{$product->currency->name ?? ' '}}</span></td>
                    </tr>
                    <tr>
                        <td>Currency:</td>
                        <td class="text-right">{{$product->currency->currency ?? ' '}}</td>
                    </tr>
                    <tr>
                        <td>Code:</td>
                        <td class="text-right">{{$product->currency->code}}</td>
                    </tr>
                    <tr>
                        <td>Symbol:</td>
                        <td class="text-right">{{$product->currency->symbol}}</td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <!-- /Country -->
            <!-- Task details -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Properties</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <table class="table table-borderless table-xs content-group-sm">
                    <tbody>
                    <tr>
                        <td>Product Type</td>
                        <td class="text-right">{{$product->productType->name}}</td>
                    </tr>
                    <tr>
                        <td>Product Category</td>
                        <td class="text-right">{{$product->productCategory->name}}</td>
                    </tr>
                    <tr>
                        <td>Brand</td>
                        <td class="text-right">{{$product->brand->name}}</td>
                    </tr>
                    <tr>
                        <td>Modal</td>
                        <td class="text-right">{{$product->modal}}</td>
                    </tr>
                    <tr>
                        <td>Reference No</td>
                        <td class="text-right">{{$product->reference_number}}</td>
                    </tr>
                    <tr>
                        <td>Condition</td>
                        <td class="text-right">{{$product->currency->name}}</td>
                    </tr>
                    <tr>
                        <td>Delivery Scope</td>
                        <td class="text-right">{{$product->deliveryScope->name}}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td class="text-right">{{$product->gender}}</td>
                    </tr>
                    <tr>
                        <td>Year of Production</td>
                        <td class="text-right">{{$product->year_of_production}}</td>
                    </tr>
                    <tr>
                        <td>Approximation/Unknown</td>
                        <td class="text-right">@if($product->approximation_unknown) Approximately @else
                                Unknown @endif</td>
                        {{-- unknown = 0 or approaximately = 1 --}}
                    </tr>
                    <tr>
                        <td>Case Diameter</td>
                        <td class="text-right">{{$product->case_diameter_length}}
                            x {{$product->case_diameter_width}}</td>
                    </tr>
                    <tr>
                        <td>Movement</td>
                        <td class="text-right">{{ !is_null($product->movement) ? $product->movement->name : '' }}</td>
                    </tr>
                    <tr>
                        <td>Display Name</td>
                        <td class="text-right">{{$product->display_name}}</td>
                    </tr>
                    <tr>
                        <td>Company Charges</td>
                        <td class="text-right">{{$product->company_charges}}</td>
                    </tr>
                    <tr>
                        <td>No of Views</td>
                        <td class="text-right">{{$product->no_of_views}}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td class="text-right">
                            <label class="label label-roundless {{$product->status->background_color}}">
                                {{$product->status->name}}
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>Ad Status</td>
                        <td class="text-right">
                            <label
                                class="label label-roundless @if($product->is_draft) label-danger @else label-success @endif">
                                @if($product->is_draft) Drafted @else Completed @endif
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>Movement Caliber</td>
                        <td class="text-right">{{$product->movement_caliber}}</td>
                    </tr>
                    <tr>
                        <td>Base Caliber</td>
                        <td class="text-right">{{$product->base_caliber}}</td>
                    </tr>
                    <tr>
                        <td>Power Reserve</td>
                        <td class="text-right">{{$product->power_reserve}}</td>
                    </tr>
                    <tr>
                        <td>Number of Jewels</td>
                        <td class="text-right">{{$product->number_of_jewels}}</td>
                    </tr>
                    <tr>
                        <td>Frequency</td>
                        <td class="text-right">{{$product->frequency}} {{$product->frequency_measurement}}</td>
                    </tr>
                    <tr>
                        <td>Case Material</td>
                        <td class="text-right">{{ !is_null($product->caseMaterial) ? $product->caseMaterial->name : '' }}</td>
                    </tr>
                    <tr>
                        <td>Bezel Material</td>
                        <td class="text-right">{{ !is_null($product->bezelMaterial) ? $product->bezelMaterial->name : '' }}</td>
                    </tr>
                    <tr>
                        <td>Thickness</td>
                        <td class="text-right">{{$product->thickness}}</td>
                    </tr>
                    <tr>
                        <td>Glass Type</td>
                        <td class="text-right">{{ !is_null($product->glassType) ? $product->glassType->name : ''}}</td>
                    </tr>
                    <tr>
                        <td>Water Resistance</td>
                        <td class="text-right">{{ !is_null($product->waterResistance) ? $product->waterResistance->name : '' }}</td>
                    </tr>
                    <tr>
                        <td>Dial</td>
                        <td class="text-right">{{ !is_null($product->dial) ? $product->dial->name : '' }}</td>
                    </tr>
                    <tr>
                        <td>Dial Numeral</td>
                        <td class="text-right">{{ !is_null($product->dialNumeral) ? $product->dialNumeral->name : '' }}</td>
                    </tr>
                    <tr>
                        <td>Bracelet Material</td>
                        <td class="text-right">{{ !is_null($product->braceletMaterial) ? $product->braceletMaterial->name : '' }}</td>
                    </tr>
                    <tr>
                        <td>Bracelet Color</td>
                        <td class="text-right">{{ !is_null($product->braceletColor) ? $product->braceletColor->name : '' }}</td>
                    </tr>
                    <tr>
                        <td>Clasp Material</td>
                        <td class="text-right">{{ !is_null($product->claspMaterial) ? $product->claspMaterial->name : '' }}</td>
                    </tr>
                    <tr>
                        <td>Clasp Type</td>
                        <td class="text-right">{{ !is_null($product->claspType) ? $product->claspType->name : '' }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /task details -->
        </div>
    </div>
@endsection


@push("before-app-script")
    <!-- Theme JS files -->
    <script src="{{ asset('admin/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ asset('admin/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset('admin/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script
        src="{{ asset('admin/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js') }}"></script>
    <script
        src="{{ asset('admin/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js') }}"></script>
    <script
        src="{{ asset('admin/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js') }}"></script>
    <script src="{{ asset('admin/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
@endpush

@push("after-app-script")
    <script src="{{ asset('admin/global_assets/js/demo_pages/form_inputs.js') }}"></script>
    {{--    <script src="{{ asset('admin/global_assets/js/demo_pages/form_validation.js') }}"></script>--}}
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var validator = $(".form-horizontal").validate({
                ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
                errorClass: 'validation-error-label',
                successClass: 'validation-valid-label',
                highlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function (element, errorClass) {
                    $(element).removeClass(errorClass);
                },

                // Different components require proper error label placement
                errorPlacement: function (error, element) {

                    // Styled checkboxes, radios, bootstrap switch
                    if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container')) {
                        if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                            error.appendTo(element.parent().parent().parent().parent());
                        } else {
                            error.appendTo(element.parent().parent().parent().parent().parent());
                        }
                    }

                    // Unstyled checkboxes, radios
                    else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                        error.appendTo(element.parent().parent().parent());
                    }

                    // Input with icons and Select2
                    else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                        error.appendTo(element.parent());
                    }

                    // Inline checkboxes, radios
                    else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                        error.appendTo(element.parent().parent());
                    }

                    // Input group, styled file input
                    else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                        error.appendTo(element.parent().parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                validClass: "validation-valid-label",
                success: function (label) {
                    label.addClass("validation-valid-label").text("Success.")
                },
                rules: {
                    type: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    background_color: {
                        required: true
                    }
                },
                messages: {
                    custom: {
                        required: 'This field is required.'
                    },
                }
            });
        });
    </script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            $.extend($.fn.dataTable.defaults, {
                autoWidth: false,
                dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                language: {
                    search: '<span>Filter:</span> _INPUT_',
                    searchPlaceholder: 'Type to filter...',
                    lengthMenu: '<span>Show:</span> _MENU_',
                    paginate: {
                        'first': 'First',
                        'last': 'Last',
                        'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                        'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                    }
                }
            });

            $('#productFunctionsDataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: "{{ route('productFunctions.index') }}",
                columns: [
                    {data: 'id', name: 'id', visible: false},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status.name'},
                    {data: 'actions', name: 'actions'}
                ],
                buttons: {
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3]
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                            className: 'btn bg-blue btn-icon',
                            columns: [1, 2, 3, 4]
                        }
                    ]
                }
            });
        });
    </script>
@endpush

