<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span>
                - @yield("title")</h4>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{ route("dashboard") }}"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active">@yield("title")</li>
        </ul>
    </div>
</div>
