@extends("admin.layouts.app")
@section("title", "Dashboard")
@section("content")
    <!-- Quick stats boxes -->
    <div class="row">
        <div class="col-lg-3">
            <!-- Members online -->
            <div class="panel bg-teal-400">
                <div class="panel-body">
                    <h3 class="no-margin">{{ number_format((float) $totalUsers) }}</h3>
                    Total Vendors
                </div>
                <div class="container-fluid">
                    <div id="members-online"></div>
                </div>
            </div>
            <!-- /members online -->
        </div>
        <div class="col-lg-3">
            <!-- Current server load -->
            <div class="panel bg-pink-400">
                <div class="panel-body">
                    <h3 class="no-margin">{{ $totalPendingOrders }}</h3>
                    Pending Orders
                </div>
                <div id="server-load"></div>
            </div>
            <!-- /current server load -->
        </div>
        <div class="col-lg-3">
            <!-- Today's revenue -->
            <div class="panel bg-blue-400">
                <div class="panel-body">
                    <h3 class="no-margin">{{ $totalCompletedOrders }}</h3>
                     Completed Orders
                </div>
                <div id="today-revenue"></div>
            </div>
            <!-- /today's revenue -->
        </div>
        <div class="col-lg-3">
            <!-- Today's revenue -->
            <div class="panel bg-green-400" >
                <div class="panel-body">
                    <h3 class="no-margin">{{$totalOrders}}</h3>
                    Total Orders
                </div>
                <div id="today-revenue"></div>
            </div>
            <!-- /today's revenue -->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <!-- Members online -->
            <div class="panel bg-grey-400">
                <div class="panel-body">
                    <h3 class="no-margin">${{ number_format((float) $totalEarning) }}</h3>
                    Total Earning
                </div>
                <div class="container-fluid">
                    <div id="members-online"></div>
                </div>
            </div>
            <!-- /members online -->
        </div>
        <div class="col-lg-3">
            <!-- Members online -->
            <div class="panel bg-blue-700">
                <div class="panel-body">
                    <h3 class="no-margin">{{ number_format((float) $totalActiveProducts) }}</h3>
                    Total Active Products
                </div>
                <div class="container-fluid">
                    <div id="members-online"></div>
                </div>
            </div>
            <!-- /members online -->
        </div>
        <div class="col-lg-3">
            <!-- Members online -->
            <div class="panel bg-orange-400">
                <div class="panel-body">
                    <h3 class="no-margin">{{ number_format((float) $totalDraftedProducts) }}</h3>
                    Total Drafted Products
                </div>
                <div class="container-fluid">
                    <div id="members-online"></div>
                </div>
            </div>
            <!-- /members online -->
        </div>
        <div class="col-lg-3">
            <!-- Members online -->
            <div class="panel bg-success-600">
                <div class="panel-body">
                    <h3 class="no-margin">${{ number_format((float) $totalPayable) }}</h3>
                    Total Payable
                </div>
                <div class="container-fluid">
                    <div id="members-online"></div>
                </div>
            </div>
            <!-- /members online -->
        </div>
    </div>
    <!-- /quick stats boxes -->
@endsection
