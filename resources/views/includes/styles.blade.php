<!-- CSS
	============================================ -->
@stack("before-styles")

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
<!-- Icon Font CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vendor/simple-line-icons.css') }}">

<!-- Plugins CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/plugins/animation.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/slick.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/fancy-box.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/plugins/jqueryui.min.css') }}">

<!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from avobe) -->
<!--
<script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>
-->

<!-- Main Style CSS (Please use minify version for better website load performance) -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<!-- custom -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<!--<link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">-->

@stack("after-styles")
