@extends('layouts.app')

@section("title", "My Account")

@section("breadcrumb")
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- main-content-wrap start -->

    <div class="main-content-wrap section-ptb my-account-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="account-dashboard">
                        <div class="dashboard-upper-info">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-md-12">
                                    <div class="d-single-info">
                                        <p class="user-name">Hello <span>{{ $user->getFullName() }}.</span></p>
                                        <p>(not {{ $user->email }}? <a class="theme-color" href="{{ route('logout') }}"
                                                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log
                                                Out</a>)</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="d-single-info">
                                        <p>Need Assistance? Customer service at.</p>
                                        <p>admin@timepiece.com.</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="d-single-info">
                                        <p class="mb-0"> E-mail them at.</p>
                                        <p>support@timepiece.com</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-2">
                                <!-- Nav tabs -->
                                <ul role="tablist" class="nav flex-column dashboard-list">
{{--                                    <li><a href="#dashboard" data-toggle="tab" class="nav-link active">Dashboard</a></li>--}}
                                    <li><a href="#my-orders" data-toggle="tab" class="nav-link">My Orders</a></li>
                                    <li><a href="#order-requests" data-toggle="tab" class="nav-link">Order Request's</a>
                                    </li>
                                    <li><a href="#pending-ads" data-toggle="tab" class="nav-link">Pending Ad's</a></li>
                                    <li><a href="#my-watches" data-toggle="tab" class="nav-link">My Watches</a></li>
                                    <li><a href="#suspicious-report" data-toggle="tab" class="nav-link">Suspicious
                                            Report</a></li>
                                    <li><a href="#account-details" data-toggle="tab" class="nav-link">Account
                                            details</a></li>
{{--                                    <li><a href="#settings" data-toggle="tab" class="nav-link">Settings</a></li>--}}
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                           class="nav-link">
                                            logout
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                            <div class="col-md-12 col-lg-10">
                                <!-- Tab panes -->
                                <div class="tab-content dashboard-content">
{{--                                    <div class="tab-pane active" id="dashboard">--}}
{{--                                        <h3>Dashboard </h3>--}}
{{--                                        <p>From your account dashboard. you can easily check &amp; view your <a--}}
{{--                                                href="#">recent orders</a>, manage your <a href="#">shipping and billing--}}
{{--                                                addresses</a> and <a href="#">edit your password and account--}}
{{--                                                details.</a></p>--}}
{{--                                    </div>--}}
                                    <div class="tab-pane active" id="my-orders">
                                        <h3>My Orders</h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Sr. #</th>
                                                    <th>Order #</th>
                                                    <th>Product name</th>
                                                    <th>Vendor Name</th>
                                                    <th>Price</th>
                                                    <th>Shipping Cost</th>
                                                    <th>Total Cost</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if($myOrders->count() == 0)
                                                    <tr>
                                                        <td colspan="7" class="text-center">No Orders Found!</td>
                                                    </tr>
                                                @else
                                                    @foreach($myOrders  as  $key => $value)
                                                        <tr>
                                                            <td>{{$key + 1}}</td>
                                                            <td>{{ 'TP#'.$value->id }}</td>
                                                            <td>{{ $value->product->name }}</td>
                                                            <td>{{ ($value->vendor) ? $value->vendor->getFullName() : '' }}</td>
                                                            <td>${{ $value->price }}</td>
                                                            <td>${{ $value->shipping_cost }}</td>
                                                            @php $total_cost = $value->price + $value->shipping_cost; @endphp
                                                            <td>${{ $total_cost }}</td>
                                                            <td>{{ $value->status->name }}</td>
                                                            <td>
                                                                @if( $value->status_id == 12)
                                                                    <a href="javascript:void(0)"
                                                                       onclick="renderPayPalButton('{{ $total_cost }}','{{ $value->id }}')"
                                                                       class="view pay-with-paypal"
                                                                       data-price="">Pay</a>
                                                                    <br>
                                                                @elseif($value->status_id == 15)
                                                                    @php
                                                                        $statuses = App\Status::whereIn('id', [16])->pluck('name', 'id');
                                                                        $statuses->prepend("Select Status", "");
                                                                    @endphp
                                                                    {!! Form::select('status_id', $statuses, old('status_id'),
                                                                    ['class' => 'form-control order_status_id', 'required',
                                                                    'onchange' => 'updateStatus('.$value->id.', this.value, this)',
                                                                    'data-placeholder' => "Select Status", "data-append-url" => 'my-orders']) !!}
                                                                    <br>
                                                                @endif
                                                                <a href="javascript:void(0)"
                                                                   onclick="getOrderDetail({{$value->id}}, this)"
                                                                   class="view">view</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="order-requests">
                                        <h3>Order Requests</h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Order #</th>
                                                    <th>Product name</th>
                                                    <th>Customer Name</th>
                                                    <th>Price</th>
                                                    <th>Shipping Cost</th>
                                                    <th>Total Cost</th>
                                                    <th>Status</th>
                                                    <th>View</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if($orderRequests->count() == 0)
                                                    <tr>
                                                        <td colspan="7" class="text-center">No Order Request Found!</td>
                                                    </tr>
                                                @else
                                                    @foreach($orderRequests as $key => $value)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{ 'TP#'.$value->id }}</td>
                                                            <td>{{ $value->product->name }}</td>
                                                            <td>{{ $value->user->getFullName() }}</td>
                                                            <td>${{ $value->price }}</td>
                                                            <td>${{ $value->shipping_cost }}</td>
                                                            @php $total_cost = $value->price + $value->shipping_cost; @endphp
                                                            <td>${{ $total_cost }}</td>
                                                            <td>{{ $value->status->name }}</td>
                                                            <td><a href="javascript:void(0)"
                                                                   onclick="getOrderDetail('{{$value->id}}', this)"
                                                                   class="view">view</a></td>
                                                            <td class="text-center">
                                                                @php
                                                                    $statuses = collect([]);
                                                                    if ($value->status_id != 13 && $value->status_id != 12
                                                                    && $value->status_id != 15 && $value->status_id != 17) {
                                                                        $statuses = App\Status::whereType('order-status');
                                                                        if ($value->status_id == 11) {
                                                                            $statuses = $statuses->whereIn('id', [12, 13]);
                                                                        } else if ($value->status_id == 14) {
                                                                            $statuses = $statuses->whereIn('id', [15]);
                                                                        } else if ($value->status_id == 16) {
                                                                            $statuses = $statuses->whereIn('id', [17]);
                                                                        }
                                                                        $statuses = $statuses->pluck('name', 'id');
                                                                    }
                                                                @endphp
                                                                @if($value->status_id == 12)
                                                                    Waiting For Payment
                                                                @elseif($value->status_id == 13)
                                                                    -
                                                                @elseif($value->status_id == 15)
                                                                    -
                                                                @elseif($value->status_id == 17)
                                                                    -
                                                                @else
                                                                    @php $statuses->prepend("Select Status", ""); @endphp
                                                                    {!! Form::select('status_id', $statuses, old('status_id'),
                                                                    ['class' => 'form-control order_status_id', 'required',
                                                                    'onchange' => 'updateStatus('.$value->id.', this.value, this)',
                                                                    'data-placeholder' => "Select Status", "data-append-url" => 'order-requests']) !!}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pending-ads">
                                        <h3>Pending Ad's</h3>
                                        
                                        @if(Session::has('upload-error'))
                                            <br/>
                                                <p class="alert alert-danger">{{ Session::get('upload-error') }}</p>
                                            <br/>
                                        @endif
                                        <h5>Instructions:</h5>
                                        <ul style="list-style-type: disc" class="mb-4">
                                            <li>Lorem ipsum, or lipsum as it is sometimes known,</li>
                                            <li>Lorem ipsum, or lipsum as it is sometimes known,</li>
                                            <li>Lorem ipsum, or lipsum as it is sometimes known,</li>
                                            <li>Lorem ipsum, or lipsum as it is sometimes known,</li>
                                        </ul>

                                        <form action="{{ route('import-watch') }}" method="POST"
                                              style="margin-bottom: 20px;" enctype="multipart/form-data">
                                            @csrf
                                            <label><span class="font-weight-bold">Upload More Ad</span>
                                                <input type="file" required name="file" style="padding: 3px;" class="form-control"
                                                       accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                            </label>
                                            <button type="submit" style="height:39px; border: #28a745;"
                                                    class="view bg-success">Upload
                                            </button>
                                            <a href="{{ route('download-sample-file') }}" target="_blank" class="view bg-primary pull-right">Download Sample File</a>
                                        </form>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Watch Name</th>
                                                    <th>Price</th>
                                                    <th>Listing Fee</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if($pendingAds->count() == 0)
                                                    <tr>
                                                        <td colspan="7" class="text-center">No Pending Ad Found!</td>
                                                    </tr>
                                                @else
                                                
                                                    @foreach($pendingAds as $key => $pendingAd)
                                                    
                                                        <tr id="p-{{ $pendingAd->id }}">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $pendingAd->name }}</td>
                                                            <td>{{ ($pendingAd->currency) ? $pendingAd->currency->symbol : '' }}{{ number_format((float)$pendingAd->price, 2, '.', '') }}</td>
                                                            <td>{{ ($pendingAd->currency)?$pendingAd->currency->symbol : '' }}{{ number_format((float)$pendingAd->listing_fee, 2, '.', '') }}</td>
                                                            <td>{{ $pendingAd->status->name }}</td>
                                                            <td>{{ $pendingAd->created_at->format('Y-m-d h:i:s') }}</td>
                                                            <td>
                                                                <a href="{{ route('sell-watch', [$pendingAd->id]) }}"
                                                                   class="view bg-success">Edit</a>
                                                                <a data-id="{{ $pendingAd->id }}"
                                                                   class="view bg-warning delete-pending-ad"
                                                                   href="javascript:void(0)">Delete</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="suspicious-report">
                                        <h3>Suspicious Report</h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Name</th>
                                                    <th>User Name</th>
                                                    <th>Product Name</th>
                                                    <th>Phone No</th>
                                                    <th>Message</th>
                                                    <th>Responded Text</th>
                                                    <th>Created At</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if($suspiciousReports->count() == 0)
                                                    <tr>
                                                        <td colspan="7" class="text-center">No Pending Ad Found!</td>
                                                    </tr>
                                                @else
                                                    @foreach($suspiciousReports as $key => $suspiciousReport)
                                                        <tr id="p-{{ $suspiciousReport->id }}">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $suspiciousReport->name }}</td>
                                                            <td>{{ !is_null($suspiciousReport->user->first_name) ? $suspiciousReport->user->first_name : '' }} {{ !is_null($suspiciousReport->user->last_name) ? $suspiciousReport->user->last_name : ''}}</td>
                                                            <td>{{ !is_null($suspiciousReport->product->name) ? $suspiciousReport->product->name : '' }}</td>
                                                            <td>{{ $suspiciousReport->phone_no  }}</td>
                                                            <td>{{ $suspiciousReport->message}}</td>
                                                            @if($suspiciousReport->responded_text==null)
                                                                <td>-</td>
                                                            @else
                                                                <td> {{ $suspiciousReport->responded_text }}</td>
                                                            @endif
                                                            <td>{{ $suspiciousReport->created_at->format('Y-m-d') }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="my-watches">
                                        <h3>My Watches</h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Order #</th>
                                                    <th>Watch Name</th>
                                                    <th>Price</th>
                                                    <th>Listing Fee</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if($myWatches->count() == 0)
                                                    <tr>
                                                        <td colspan="7" class="text-center">No Active Ad!</td>
                                                    </tr>
                                                @else
                                                    @foreach($myWatches as $key => $myWatch)
                                                        <tr id="p-{{ $myWatch->id }}">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ 'TP#'.$myWatch->id }}</td>
                                                            <td>{{ $myWatch->name }}</td>
                                                            <td>{{ $myWatch->currency->symbol }}{{ number_format((float)$myWatch->price, 2, '.', '') }}</td>
                                                            <td>{{ $myWatch->currency->symbol }}{{ number_format((float)$myWatch->listing_fee, 2, '.', '') }}</td>
                                                            <td>{{ $myWatch->status->name }}</td>
                                                            <td>{{ $myWatch->created_at->format('Y-m-d h:i:s') }}</td>
                                                            <td>
                                                                <a href="{{ route('shop.product.detail',[$myWatch->id]) }}"
                                                                   class="view">view</a></td>
                                                            <td class="text-center">
                                                        </tr>
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
{{--                                    <div class="tab-pane fade" id="settings">--}}
{{--                                        <h3>Settings</h3>--}}
{{--                                        <form action="{{ route('update-subscriptions') }}" method="post">--}}
{{--                                            @csrf--}}
{{--                                            <div class="login-form-container">--}}
{{--                                                <h4>Portal settings</h4>--}}
{{--                                                <hr>--}}
{{--                                                <br>--}}
{{--                                                <div class="checkbox-wrap">--}}
{{--                                                    <label id="checkout-box-2">--}}
{{--                                                        <input class="checkbox" type="checkbox" name="stay_logged_in"--}}
{{--                                                               @if(!is_null($user->userSetting)) @if($user->userSetting->stay_logged_in == 1) checked--}}
{{--                                                               value="1" @else value="0" @endif @else value="0" @endif>--}}
{{--                                                        <strong>--}}
{{--                                                            Stay logged in--}}
{{--                                                        </strong><br>--}}
{{--                                                        <p class="ml-3">By selecting "Stay logged in", you will have to--}}
{{--                                                            log--}}
{{--                                                            in less frequently on this device. For security reasons, you--}}
{{--                                                            should only select this option when using a personal--}}
{{--                                                            device.</p>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                                <div class="checkbox-wrap">--}}
{{--                                                    <label id="checkout-box-2">--}}
{{--                                                        <input class="checkbox" type="checkbox"--}}
{{--                                                               name="dont_send_follow_up_emails"--}}
{{--                                                               @if(!is_null($user->userSetting)) @if($user->userSetting->dont_send_follow_up_emails == 1) checked--}}
{{--                                                               value="1" @else value="0" @endif @else value="0" @endif>--}}

{{--                                                        Please don't send me a follow-up e-mail after I make a request.--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                                <br><br>--}}
{{--                                                <h4>E-mail settings</h4>--}}
{{--                                                <hr>--}}
{{--                                                <div class="checkbox-wrap">--}}
{{--                                                    <label id="checkout-box-2">--}}
{{--                                                        <input type="checkbox" name="" id="select_all">--}}
{{--                                                        <strong>--}}
{{--                                                            I would like to receive information about products and--}}
{{--                                                            services--}}
{{--                                                            offered by--}}
{{--                                                        </strong><br>--}}
{{--                                                        <p class="ml-3">Never miss anything important again.</p>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                                <br>--}}
{{--                                                <div class="checkbox-wrap ml-5">--}}
{{--                                                    <label id="checkout-box-2">--}}
{{--                                                        <input type="checkbox" name="newsletter" class="checkbox"--}}
{{--                                                               @if(!is_null($user->userSetting)) @if($user->userSetting->newsletter == 1) checked--}}
{{--                                                               value="1" @else value="0" @endif @else value="0" @endif>--}}
{{--                                                        <strong>--}}
{{--                                                            Timepiece Newsletter--}}
{{--                                                        </strong><br>--}}
{{--                                                        <p class="ml-3">Receive information and offers from Chrono24--}}
{{--                                                            directly in your inbox.</p>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                                <div class="checkbox-wrap ml-5">--}}
{{--                                                    <label id="checkout-box-2">--}}
{{--                                                        <input type="checkbox" name="live_auctions" class="checkbox"--}}
{{--                                                               @if(!is_null($user->userSetting)) @if($user->userSetting->live_auctions == 1) checked--}}
{{--                                                               value="1" @else value="0" @endif @else value="0" @endif>--}}
{{--                                                        <strong>--}}
{{--                                                            Timepiece Live Auctions--}}
{{--                                                        </strong><br>--}}
{{--                                                        <p class="ml-3">All dates and information about our live--}}
{{--                                                            auctions.</p>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                                <div class="checkbox-wrap ml-5">--}}
{{--                                                    <label id="checkout-box-2">--}}
{{--                                                        <input type="checkbox" name="listings_from_partners"--}}
{{--                                                               class="checkbox"--}}
{{--                                                               @if(!is_null($user->userSetting)) @if($user->userSetting->listings_from_partners == 1) checked--}}
{{--                                                               value="1" @else value="0" @endif @else value="0" @endif>--}}
{{--                                                        <strong>--}}
{{--                                                            Current Listings from Our Partners--}}
{{--                                                        </strong><br>--}}
{{--                                                        <p class="ml-3">We regularly receive attractive offers from our--}}
{{--                                                            partners, which we gladly forward to our customers.</p>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                                <div class="checkbox-wrap ml-5">--}}
{{--                                                    <label id="checkout-box-2">--}}
{{--                                                        <input type="checkbox" name="guide" class="checkbox"--}}
{{--                                                               @if(!is_null($user->userSetting)) @if($user->userSetting->guide == 1) checked--}}
{{--                                                               value="1" @else value="0" @endif @else value="0" @endif>--}}
{{--                                                        <strong>--}}
{{--                                                            Timepiece Guide--}}
{{--                                                        </strong><br>--}}
{{--                                                        <p class="ml-3">Tips and tricks to help you get the most out of--}}
{{--                                                            Timepiece.</p>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                                <div class="checkbox-wrap ml-5">--}}
{{--                                                    <label id="checkout-box-2">--}}
{{--                                                        <input type="checkbox" name="price_alarm" class="checkbox"--}}
{{--                                                               @if(!is_null($user->userSetting)) @if($user->userSetting->price_alarm == 1) checked--}}
{{--                                                               value="1" @else value="0" @endif @else value="0" @endif>--}}
{{--                                                        <strong>--}}
{{--                                                            Timepiece Price Alarm--}}
{{--                                                        </strong><br>--}}
{{--                                                        <p class="ml-3">Receive a notification when the price of an item--}}
{{--                                                            on your Notepad changes</p>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                                <div class="checkbox-wrap ml-5">--}}
{{--                                                    <label id="checkout-box-2">--}}
{{--                                                        <input type="checkbox" name="stay_up_to_date" class="checkbox"--}}
{{--                                                               @if(!is_null($user->userSetting)) @if($user->userSetting->stay_up_to_date == 1) checked--}}
{{--                                                               value="1" @else value="0" @endif @else value="0" @endif>--}}
{{--                                                        <strong>--}}
{{--                                                            Stay up to date in the future--}}
{{--                                                        </strong><br>--}}
{{--                                                        <p class="ml-3">You'll be subscribed to new topics--}}
{{--                                                            automatically.</p>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
{{--                                                <br>--}}
{{--                                                <div class="col-md-5">--}}
{{--                                                    <strong>My preferred language:</strong>--}}
{{--                                                    @php--}}
{{--                                                        $preferred_language = collect(['english' => 'English', 'german' => 'German'])--}}
{{--                                                    @endphp--}}
{{--                                                    {!! Form::select('preferred_language', $preferred_language, old('preferred_language', !is_null($user->userSetting) ? $user->userSetting->$preferred_language : ''), ['id' => 'preferred_language', 'class' => 'form-control', 'required']) !!}--}}
{{--                                                </div>--}}
{{--                                                <div class="button-box text-right">--}}
{{--                                                    <button class="btn default-btn" type="submit">Save Changes</button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
                                    <div class="tab-pane fade" id="account-details">
                                        <h3>Account details </h3>
                                        <div class="login">
                                            <div class="login-form-container">
                                                <form action="{{ route('update-profile') }}" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="account-login-form mt-5">
                                                        <div class="user-img">
                                                            @php
                                                                if (is_null($user->picture)) {
                                                                    $picture = asset('admin/images/default-user-image.jpg');
                                                                } elseif(file_exists('admin/images/users/'.$user->picture)) {
                                                                    $picture = asset('admin/images/users/'.$user->picture);
                                                                }else{
                                                                    $picture = asset('admin/images/default-user-image.jpg');
                                                                }
                                                            @endphp
                                                            <img class="img-responsive" alt="{{ $user->picture }}"
                                                                 src="{{ $picture }}"><br>
                                                            <input class="mt-2 " type="file" id="picture" name="picture"
                                                                   accept="image/*">
                                                        </div>
                                                        <br><br>
                                                        <h4 class="theme-color">Personal Information</h4>
                                                        <hr>
                                                        <br>
                                                        <div class="account-input-box">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>First Name </label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="first_name"
                                                                           value="{{ $user->first_name}}"
                                                                           class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Last Name</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="last_name"
                                                                           value="{{ $user->last_name}}"
                                                                           class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Company <sup>(optional)</sup></label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="company"
                                                                           value="{{ $user->company}}"
                                                                           class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Gender</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    @php
                                                                        $genders = collect(['male' => 'Male', 'female' => 'Female', 'other' => 'Other'])
                                                                    @endphp
                                                                    {!! Form::select('gender', $genders, old('gender', $user->gender), ['id' => 'gender', 'class' => 'form-control', 'required']) !!}
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Date of Birth</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="date" class="form-control"
                                                                           placeholder="MM/DD/YYYY"
                                                                           value="{{ old('date_of_birth', !is_null($user->date_of_birth) ? date('Y-m-d',  intval(strtotime($user->date_of_birth))) : '') }}"
                                                                           id="date_of_birth" name="date_of_birth"
                                                                           required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <h4 class="theme-color">Contact information</h4>
                                                        <hr>
                                                        <div class="account-input-box">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Email </label>
                                                                </div>

                                                                <div class="col-md-10">
                                                                    <input type="email" name="email" id="email" required
                                                                           value="{{ $user->email}}"
                                                                           disabled="disabled">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Phone No.</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="phone_no" id="phone_no"
                                                                           required
                                                                           value="{{ $user->phone_no}}">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Mobile No.</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="mobile_no" id="mobile_no"

                                                                           value="{{ $user->mobile_no}}">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Fax No.</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="fax_no" id="fax_no"
                                                                           value="{{ $user->fax_no}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <h4 class="theme-color">Address</h4>
                                                        <hr>
                                                        <div class="account-input-box">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Street </label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="street" id="street"
                                                                           class="form-control"
                                                                           value="{{ $user->street}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Street line 2</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="street_line_2"
                                                                           id="street_line_2" class="form-control"
                                                                           value="{{ $user->street_line_2 }}">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Zip Code</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="zip_code" id="zip_code"
                                                                           class="form-control"
                                                                           value="{{ $user->zip_code }}"
                                                                           required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>City</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="city" id="city"
                                                                           class="form-control"
                                                                           value="{{ $user->city }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>State</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="state" id="state"
                                                                           class="form-control"
                                                                           value="{{ $user->state}}">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Country</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    @php
                                                                        $countries->prepend('Select Country', '');
                                                                    @endphp
                                                                    {!! Form::select('country_id', $countries, old('country_id', $user->country_id), ['id' => 'country_id', 'class' => 'form-control', 'required']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <h4 class="theme-color">More about me</h4>
                                                        <hr>
                                                        <div class="account-input-box">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Occupation </label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <input type="text" name="occupation" id="occupation"
                                                                           class="form-control" {{ $user->occupation }}>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Time Zone</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    @php
                                                                        $timezones->prepend('Select Timezone', '');
                                                                    @endphp
                                                                    {!! Form::select('timezone_id', $timezones, old('timezone_id', $user->timezone_id), ['id' => 'timezone_id', 'class' => 'form-control', 'required']) !!}
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>Language </label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    @php
                                                                        $languages->prepend('Select Language', '');
                                                                    @endphp
                                                                    {!! Form::select('language_id', $languages, old('timezone_id', $user->language_id), ['id' => 'language_id', 'class' => 'form-control', 'required']) !!}
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label>About me </label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <textarea class="col-12 form-control" type="text"
                                                                              name="about" id="about"
                                                                              placeholder="">{{ $user->about }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="button-box mt-3 text-right">
                                                        <button class="btn default-btn" type="submit">Save Changes
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main-content-wrap end -->
    <div class="modal fade modal-wrapper" id="payPalModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-inner-area">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h1>Pay with PayPal</h1>
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-wrapper" id="orderDetailModal" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-inner-area">
                        <div class="container">
                            <div class="row ">
                                <div class="col-md-12">
                                    <h3 class="mt-3 mb-3">Order No.<span id="orderNo"></span>
                                        <span class=" mr-5 float-right">Total: $<span id="total"></span></span></h3>
                                    <div class="table-responsive">

                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th colspan="2" class="text-center">Order Detail</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th>Customer Name</th>
                                                <td id="customer-name">Bill Gates</td>
                                            </tr>
                                            <tr>
                                                <th>Vendor Name</th>
                                                <td id="vendor-name">Bill Gates</td>
                                            </tr>
                                            <tr>
                                                <th>Product Name</th>
                                                <td id="product-name">Bill Gates</td>
                                            </tr>

                                            <tr>
                                                <th>Status</th>
                                                <td id="status">Bill Gates</td>
                                            </tr>
                                            <tr>
                                                <th>Price</th>
                                                <td id="price">Bill Gates</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping Cost</th>
                                                <td id="shipping-cost">Bill Gates</td>
                                            </tr>
                                            <tr>
                                                <th>Approved at</th>
                                                <td id="approved-at"></td>
                                            </tr>
                                            <tr>
                                                <th>Payment Done at</th>
                                                <td id="payment-done-at"></td>
                                            </tr>
                                            <tr>
                                                <th>Delivered at</th>
                                                <td id="delivered-at">Bill Gates</td>
                                            </tr>
                                            <tr>
                                                <th>Recieved at</th>
                                                <td id="received-at">Bill Gates</td>
                                            </tr>

                                            <tr>
                                                <th>Completed at</th>
                                                <td id="completed-at">Bill Gates</td>
                                            </tr>


                                            </tbody>

                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push("after-main-scripts")
    <script
        src="https://www.paypal.com/sdk/js?client-id=AdrblDc13uITTkwdArkM-89Bb85cEZ8-eh0DyRh3TjtUfYEijRQX4koMvimLO5WQ652_iqE1fKxP-5ZF"></script>
    <script>
        $(document).ready(function () {
            var base_url = $('meta[name="base-url"]').attr('content');
            var _token = $('meta[name="csrf-token"]').attr('content');
            $('#select_all').on('click', function () {
                if (this.checked) {
                    $('.checkbox').each(function () {
                        this.checked = true;
                        this.value = 1;
                    });
                } else {
                    $('.checkbox').each(function () {
                        this.checked = false;
                        this.value = 0;
                    });
                }
            });
            $('.checkbox').on('click', function () {
                if (this.checked) {
                    this.checked = true;
                    this.value = 1;
                } else {
                    this.checked = false;
                    this.value = 0;
                }
                if ($('.checkbox:checked').length == $('.checkbox').length) {
                    $('#select_all').prop('checked', true);
                } else {
                    $('#select_all').prop('checked', false);
                }
            });

            $(".delete-pending-ad").on('click', function () {
                var ad_id = $(this).data('id');
                $.ajax({
                    url: base_url + '/delete-pending-ad/' + ad_id,
                    method: 'POST',
                    dataType: 'json',
                    data: {_token: _token},
                    success: function (response) {
                        if (response.success === true) {
                            $("tr#p-" + ad_id).remove();
                            swal('Success', response.message, 'success');
                        } else {
                            swal('Error', response.message, 'error');
                        }
                    },
                    error: function (err) {
                        swal('Error', response.message, 'error');
                        console.log(err);
                    }
                });
            });
        });
        window.onload = function () {
            var currentTabId = location.hash;
            $('a[href="' + currentTabId + '"]').trigger('click');
        };

        function renderPayPalButton(total_amount, order_id) {
            var _token = $('meta[name=csrf-token]').attr('content');
            var base_url = $('meta[name=base-url]').attr('content');
            var _this = $(this);
            $("#paypal-button-container").empty();
            paypal.Buttons({
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: total_amount
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    // Capture the funds from the transaction
                    return actions.order.capture().then(function (details) {
                        if (details.id) {
                            $("#payPalModal").modal('hide');
                            $.ajax({
                                url: base_url + '/update-status/' + order_id,
                                method: 'POST',
                                dataType: 'json',
                                data: {
                                    _token: _token,
                                    status_id: 14,
                                },
                                success: function (response) {
                                    if (response.success === true) {
                                        swal({
                                            title: "Success!",
                                            text: 'Payment Executed!',
                                            icon: "success"
                                        }).then((value) => {
                                            window.location.reload();
                                        });
                                    } else {
                                        swal("Error!", response.message, "error");
                                    }
                                },
                                error: function (err) {
                                    console.log(err);
                                }
                            });
                        } else {
                            swal("Payment Error!", 'Something went wrong!', "error");
                        }
                    });
                }
            }).render('#paypal-button-container');
            $("#payPalModal").modal('show');
        }

        function updateStatus(order_id, status_id, _this) {
            let _token = $('meta[name=csrf-token]').attr('content');
            let base_url = $('meta[name=base-url]').attr('content');
            let attach_url = "#" + $(_this).data('append-url');
            var url = base_url + '/update-status/' + order_id;

            if (status_id !== "") {
                swal({
                    title: "Are you sure?",
                    text: "Once you update status, you will not be able to recover this action!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            url: url,
                            method: 'POST',
                            dataType: 'json',
                            data: {
                                _token: _token,
                                status_id: status_id,
                            },
                            success: function (response) {
                                if (response.success === true) {
                                    swal({
                                        title: "Success!",
                                        text: response.message,
                                        icon: "success"
                                    }).then((value) => {
                                        window.location.href = window.location.origin + window.location.pathname + attach_url;
                                        window.location.reload();
                                    });
                                } else {
                                    swal("Error!", response.message, "error");
                                }
                            },
                            error: function (err) {
                                console.log(err);
                            }
                        });
                    } else {
                        $(_this).val('');
                    }
                });
            }
        }

        function getOrderDetail(order_id, _this) {
            let _token = $('meta[name=csrf-token]').attr('content');
            let base_url = $('meta[name=base-url]').attr('content');
            var url = base_url + '/get-order-detail/' + order_id;
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: {
                    _token: _token
                },
                success: function (response) {
                    if (response.success === true) {
                        $("#orderNo").html('');
                        $("#total").html('');
                        $("#customer-name").html('');
                        $("#vendor-name").html('');
                        $("#product-name").html('');
                        $("#status").html('');
                        $("#price").html('');
                        $("#shipping-cost").html('');
                        $("#approved-at").html('-');
                        $("#payment-done-at").html('-');
                        $("#delivered-at").html('-');
                        $("#received-at").html('-');
                        $("#completed-at").html('-');

                        var order = response.order;
                        $("#orderNo").html(' TP#' + order.id);
                        $("#total").html(order.price + order.shipping_cost);
                        $("#customer-name").html(order.user.first_name + ' ' + order.user.last_name);
                        $("#vendor-name").html(order.vendor.first_name + ' ' + order.vendor.last_name);
                        $("#product-name").html(order.product.name);
                        $("#status").html(order.status.name);
                        $("#price").html('$'+order.price);
                        $("#shipping-cost").html('$'+order.shipping_cost);
                        if (order.approved_or_rejected_at == null) {
                            $("#approved-at").html('-');
                        } else {
                            $("#approved-at").html(order.approved_or_rejected_at);
                        }

                        if (order.payment_done_at == null) {
                            $("#payment-done-at").html('-');
                        } else {

                            $("#payment-done-at").html(order.payment_done_at);
                        }
                        if (order.deliver_at == null) {
                            $("#delivered-at").html('-');
                        } else {
                            $("#delivered-at").html(order.deliver_at);
                        }
                        if (order.received_at == null) {
                            $("#received-at").html('-');
                        } else {
                            $("#received-at").html(order.received_at);
                        }
                        if (order.completed_at == null) {
                            $("#completed-at").html('-');
                        } else {
                            $("#completed-at").html(order.completed_at);
                        }
                        $("div#orderDetailModal").modal('show');
                    } else {
                        console.log(response);
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    </script>
@endpush
