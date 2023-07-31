@extends("admin.layouts.app")

@section("title", "Order Management")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <!-- Column selectors -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title text-semibold">List Orders</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            {{--                            <li><a data-action="reload"></a></li>--}}
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <table class="table" id="ordersDataTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Sr. No.</th>
                        <th>Product Name</th>
                        <th>Buyer</th>
                        <th>Product Owner</th>
                        <th>Price</th>
                        <th>Shipping Cost</th>
                        <th>Total Cost</th>
                        <th>Message</th>
                        <th>Approved/Rejected At</th>
                        <th>Payed At</th>
                        <th>Deliver At</th>
                        <th>Received At</th>
                        <th>Completed At</th>
                        <th>Status</th>
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

            var orderTable = $('#ordersDataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: "{{ route('orders.index') }}",
                columns: [
                    {data: 'id', name: 'id', visible: false},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'name', name: 'product.name'},
                    {data: 'user', name: 'user.first_name'},
                    {data: 'vendor', name: 'user.first_name'},
                    {data: 'price', name: 'price'},
                    {data: 'shipping_cost', name: 'shipping_cost'},
                    {data: 'total_cost', name: 'total_cost', searchable: false, orderable: false},
                    {data: 'message', name: 'message'},
                    {data: 'approved_or_rejected_at', name: 'approved_or_rejected_at'},
                    {data: 'payment_done_at', name: 'payment_done_at'},
                    {data: 'deliver_at', name: 'deliver_at'},
                    {data: 'received_at', name: 'received_at'},
                    {data: 'completed_at', name: 'completed_at'},
                    {data: 'status', name: 'status.name'},
                ],
                buttons: {
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9,10,11,12,13,14]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9,10,11,12,13,14]

                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9,10,11,12,13,14]

                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                            className: 'btn bg-blue btn-icon',
                            columns: [1, 2, 3, 4, 5, 6, 7, 8, 9,10,11,12,13,14]
                        }
                    ]
                }
            });
        });
    </script>
@endpush

