@extends("admin.layouts.app")

@section("title", "Brand Management")

@section("content")
    @php
        if(!isset($brand)){
            $brand = null;
        }
    @endphp
    <div class="row">
        <div class="col-md-12">
            <!-- Column selectors -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title text-semibold">@isset($brand) Update Brand @else Create New
                        Brand @endisset</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            {{--                            <li><a data-action="reload"></a></li>--}}
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="panel-body">
                    @if(!isset($brand))
                        {{ Form::open(['route' => ['brands.store'], 'files' => true, 'class' => 'form-horizontal']) }}
                    @else
                        {{ Form::model($brand, ['route' => ['brands.update', $brand->id], 'files' => true, 'class' => 'form-horizontal']) }}
                        {{ method_field('PATCH') }}
                    @endif
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <label class="control-label" for="name">Name <span class="text-danger">*</span></label>
                            {!! Form::text('name', old('name'), ['id'=> 'name','class' => 'form-control', 'required', 'placeholder' => 'Name']) !!}
                            {!! $errors->first('name', '<label id="name-error" class="validation-error-label" for="name">:message</label>') !!}
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            @php
                                if(is_null($brand))
                                    $required = 'required';
                                else
                                    $required = '';
                            @endphp
                            <label for="picture">Picture @if($required != '')<span class="text-danger">*</span>@else
                                    <span class="text-success">(optional)</span> @endif</label>
                            {!! Form::file('picture', ['class' => 'file-styled-primary', 'id' => 'picture', $required]) !!}
                            {!! $errors->first('picture', '<label id="picture-error" class="validation-error-label" for="picture">:message</label>') !!}
                        </div>
                    </div>
                    <div class="row mt-15">
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <label for="show_on_nav">Show On Nav <span class="text-danger">*</span></label>
                            @php
                                $options = collect(['0' => 'No', '1' => 'Yes']);
                            @endphp
                            {!! Form::select('show_on_nav', $options, old('show_on_nav'), ['id' => 'show_on_nav', 'class' => 'select', 'required']) !!}
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <label for="sequence">Sequence <span class="text-danger">*</span></label>
                            {!! Form::number('sequence', old('sequence'), ['id'=> 'sequence','min' => '0', 'class' => 'form-control', 'required', 'placeholder' => 'Sequence']) !!}
                            {!! $errors->first('sequence', '<label id="sequence-error" class="validation-error-label" for="sequence">:message</label>') !!}
                        </div>
                    </div>
                    <div class="row mt-15">
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            @php $statuses->prepend("Select Status", ""); @endphp
                            {!! Form::select('status_id', $statuses, old('status_id'), ['id' => 'status_id', 'class' => 'select', 'required', 'data-placeholder' => "Select Status"]) !!}
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6 col-xs-12 text-right mt-28">
                            <button type="submit" class="btn bg-slate-700">@isset($brand) Update @else
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
                    <h5 class="panel-title text-semibold">List Brands</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            {{--                            <li><a data-action="reload"></a></li>--}}
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <table class="table" id="brandsDataTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Sr. No.</th>
                        <th>Name</th>
                        <th>Picture</th>
                        <th>Show On Nav</th>
                        <th>Sequence</th>
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

            $('#brandsDataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: "{{ route('brands.index') }}",
                columns: [
                    {data: 'id', name: 'id', visible: false},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'name', name: 'name'},
                    {data: 'picture', name: 'picture'},
                    {data: 'show_on_nav', name: 'show_on_nav'},
                    {data: 'sequence', name: 'sequence'},
                    {data: 'status', name: 'status.name'},
                    {data: 'actions', name: 'actions'}
                ],
                buttons: {
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                            className: 'btn bg-blue btn-icon',
                            columns: [1, 2, 3, 4, 5, 6, 7]
                        }
                    ]
                }
            });
        });
    </script>
@endpush

