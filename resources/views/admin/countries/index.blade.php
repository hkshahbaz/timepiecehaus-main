@extends("admin.layouts.app")

@section("title", "Country Management")

@section("content")
    @php
        if(!isset($country)){
            $country = null;
        }
    @endphp
    <div class="row">
        <div class="col-md-12">
            <!-- Column selectors -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title text-semibold">@isset($country) Update Country @else Create New
                        Country @endisset</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="panel-body">
                    @if(!isset($country))
                        {{ Form::open(['route' => ['countries.store'], 'files' => true, 'class' => 'form-horizontal']) }}
                    @else
                        {{ Form::model($country, ['route' => ['countries.update', $country->id], 'files' => true, 'class' => 'form-horizontal']) }}
                        {{ method_field('PATCH') }}
                    @endif
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <label class="control-label" for="name">Name <span class="text-danger">*</span></label>
                            {!! Form::text('name', old('name'), ['id'=> 'name','class' => 'form-control', 'required', 'placeholder' => 'Name']) !!}
                            {!! $errors->first('name', '<label id="name-error" class="validation-error-label" for="name">:message</label>') !!}
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <label class="control-label" for="currency">Currency <span
                                    class="text-danger">*</span></label>
                            {!! Form::text('currency', old('currency'), ['id'=> 'currency','class' => 'form-control', 'required', 'placeholder' => 'Currency']) !!}
                            {!! $errors->first('currency', '<label id="currency-error" class="validation-error-label" for="currency">:message</label>') !!}
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12">
                            <label class="control-label" for="code">Code <span class="text-danger">*</span></label>
                            {!! Form::text('code', old('code'), ['id'=> 'code','class' => 'form-control', 'required', 'placeholder' => 'Code']) !!}
                            {!! $errors->first('code', '<label id="code-error" class="validation-error-label" for="code">:message</label>') !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 mt-20">
                            <label class="control-label" for="symbol">Symbol <span class="text-danger">*</span></label>
                            {!! Form::text('symbol', old('symbol'), ['id'=> 'symbol','class' => 'form-control', 'required', 'placeholder' => 'Symbol']) !!}
                            {!! $errors->first('symbol', '<label id="symbol-error" class="validation-error-label" for="symbol">:message</label>') !!}
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 mt-20">
                            @php
                                if(is_null($country))
                                    $required = 'required';
                                else
                                    $required = '';
                            @endphp
                            <label for="flag">Flag @if($required != '')<span class="text-danger">*</span>@else <span
                                    class="text-success">(optional)</span> @endif</label>
                            {!! Form::file('flag', ['class' => 'file-styled-primary', 'id' => 'flag', $required]) !!}
                            {!! $errors->first('flag', '<label id="flag-error" class="validation-error-label" for="flag">:message</label>') !!}
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 mt-20">
                            <label class="control-label" for="sequence">Sequence <span
                                    class="text-danger">*</span></label>
                            {!! Form::number('sequence', old('sequence'), ['min' => '0', 'id'=> 'sequence','class' => 'form-control', 'required', 'placeholder' => 'Sequence']) !!}
                            {!! $errors->first('sequence', '<label id="sequence-error" class="validation-error-label" for="sequence">:message</label>') !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 mt-20">
                            <label for="is_currency_enabled">Currency Enabled <span class="text-danger">*</span></label>
                            @php $options = collect(['1' => 'Enabled', '0' => 'Disabled'])  @endphp
                            {!! Form::select('is_currency_enabled', $options, old('is_currency_enabled'), ['id' => 'is_currency_enabled', 'class' => 'select', 'required']) !!}
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 mt-20">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            @php $statuses->prepend("Select Status", ""); @endphp
                            {!! Form::select('status_id', $statuses, old('status_id'), ['id' => 'status_id', 'class' => 'select', 'required', 'data-placeholder' => "Select Status"]) !!}
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-4 col-xs-12 mt-20 text-right">
                            <button type="submit" class="btn bg-slate-700 mt-27">@isset($country) Update @else
                                    Create @endisset</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- Column selectors -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title text-semibold">List Countries</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            {{--                            <li><a data-action="reload"></a></li>--}}
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <table class="table" id="countriesDataTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Sr. No.</th>
                        <th>Name</th>
                        <th>Currency</th>
                        <th>Code</th>
                        <th>Symbol</th>
                        <th>Flag</th>
                        <th>Sequence</th>
                        <th>Enabled / Disabled</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <!-- /column selectors -->
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

            $('#countriesDataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: "{{ route('countries.index') }}",
                columns: [
                    {data: 'id', name: 'id', visible: false},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'name', name: 'name'},
                    {data: 'currency', name: 'currency'},
                    {data: 'code', name: 'code'},
                    {data: 'symbol', name: 'symbol'},
                    {data: 'flag', name: 'flag'},
                    {data: 'sequence', name: 'sequence'},
                    {data: 'is_currency_enabled', name: 'is_currency_enabled'},
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

