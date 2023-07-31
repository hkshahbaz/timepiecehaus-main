@stack("before-core-script")

<!-- Core JS files -->
<script src="{{ asset('admin/global_assets/js/plugins/loaders/pace.min.js') }}"></script>
<script src="{{ asset('admin/global_assets/js/core/libraries/jquery.min.js') }}"></script>
<script src="{{ asset('admin/global_assets/js/core/libraries/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
<!-- /core JS files -->

@stack("before-app-script")

<script src="{{ asset('admin/global_assets/js/plugins/notifications/pnotify.min.js') }}"></script>
<script src="{{ asset('admin/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/app.js') }}"></script>
<script src="{{ asset('admin/global_assets/js/demo_pages/components_notifications_pnotify.js') }}"></script>

@stack("after-app-script")
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        var $select = $('.select').select2({
            minimumResultsForSearch: Infinity
        });

        // Trigger value change when selection is made
        $select.on('change', function () {
            $(this).trigger('blur');
        });
    });
</script>
<script src="{{ asset('admin/js/custom.js') }}"></script>
