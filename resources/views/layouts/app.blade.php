<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include("includes.head")

<body>
<div class="main-wrapper">
    <!--  Header Start -->
    <header class="header">

        @include("includes.header-top")
        @include("includes.header-mid")
        @include("includes.header-bottom")

    </header>
    <!--  Header End -->
    @yield("breadcrumb")

    @yield('content')

    @include("includes.footer")

</div>

@include('includes.scripts')
</body>
</html>
