<!-- JS
============================================ -->

<!-- Modernizer JS -->
<script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<!-- jQuery JS -->
<script src="{{ asset('assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>

@stack("before-plugin-scripts")

<!-- Plugins JS -->
<script src="{{ asset('assets/js/plugins/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/countdown.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/image-zoom.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/fancybox.js') }}"></script>
<script src="{{ asset('assets/js/plugins/scrollup.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jqueryui.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/ajax-contact.js') }}"></script>


<!-- Vendor & Plugins JS (Please remove the comment from below vendor.min.js & plugins.min.js for better website load performance and remove js files from avobe) -->
<!--
<script src="{{ asset('assets/js/vendor/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/plugins.min.js') }}"></script>
-->

<script src="{{ asset('js/sweet-alert/sweetalert.min.js') }}"></script>

@stack("before-main-scripts")

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

@stack("after-main-scripts")
