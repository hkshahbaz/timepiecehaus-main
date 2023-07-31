<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("admin.includes.head")
<body>

@include("admin.includes.navbar")

<!-- Page container -->
<div class="page-container @yield('has-detached-right-pace-done')">

    <!-- Page content -->
    <div class="page-content">
        <!-- main sidebar -->
        <div class="sidebar sidebar-main">
            <div class="sidebar-content">

                @include("admin.includes.sidebar-user")
                @include("admin.includes.sidebar")

            </div>
        </div>
        <!-- /main sidebar -->

        <!-- Main content -->
        <div class="content-wrapper">
        @include("admin.includes.header")

            <!-- Content area -->
            <div class="content">

                @yield("content")

                @include("admin.includes.footer")
            </div>
            <!-- /Content area -->
        </div>
        <!-- /Main content -->
    </div>
</div>
@include("admin.includes.messages")
</body>
</html>
