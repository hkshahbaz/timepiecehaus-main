@extends("admin.layouts.app")

@section("title", "Vendor Management")

@section("content")
    <div class="row">
        <div class="col-md-12">
            <!-- Column selectors -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title text-semibold">List Vendors</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <table class="table" id="usersDataTable">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Sr. No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Detail</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <!-- /column selectors -->
        </div>
    </div>
    @include("admin.users.detail-modal")
@endsection


@push("before-app-script")
    <!-- Theme JS files -->
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
    {{--    <script src="{{ asset('admin/global_assets/js/demo_pages/datatables_extension_buttons_html5.js') }}"></script>--}}
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
            $('#usersDataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: "{{ route('users.index') }}",
                columns: [
                    {data: 'id', name: 'id', visible: false},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status', searchable: false},
                    {data: 'details', name: 'details', searchable: false},
                    {data: 'actions', name: 'actions'}
                ],
                buttons: {
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            className: 'btn btn-default',
                            exportOptions: {
                                columns: [1, 2, 3, 4, 5]
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                            className: 'btn bg-blue btn-icon',
                            columns: [1, 2, 3, 4, 5, 6]
                        }
                    ]
                }
            });
        });

        function getVendorDetail(id) {
            var base_url = $('meta[name="base-url"]').attr('content');
            var url = base_url + '/getUser/' + id;
            if (id != "" && id != undefined) {
                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    async: false,
                    success: function (response) {
                        if (response.success === true) {
                            var data = response.user;
                            $("#user_detail_modal").modal('show');

                            $('td#company').html(data.company);
                            $('td#gender').html(data.gender);
                            $('td#date_of_birth').html(data.date_of_birth);
                            $('td#phone_no').html(data.phone_no);
                            $('td#street').html(data.street);
                            $('td#street_line_2').html(data.street_line_2);
                            $('td#zip_code').html(data.zip_code);
                            $('td#city').html(data.city);
                            $('td#state').html(data.state);
                            $('td#country').html(data.country.name);
                            if (data.display_name == 0) {
                                $('td#display_name').html('No');
                            } else {
                                $('td#display_name').html('Yes');
                            }
                            $('td#timezone').html(data.timezone.name);
                            $('td#language').html(data.language.name);
                            $('td#occupation').html(data.occupation);
                            $('td#about').html(data.about);
                        } else {
                            new PNotify({
                                title: 'Error',
                                layout: 'center',
                                text: response.message,
                                icon: 'icon-blocked',
                                type: 'error'
                            });
                        }
                    },
                    error: function (err) {
                        console.log(err);
                        new PNotify({
                            title: 'Error',
                            layout: 'center',
                            text: 'Something went wrong!',
                            icon: 'icon-blocked',
                            type: 'error'
                        });
                    }
                });
            }
        }
    </script>
@endpush

