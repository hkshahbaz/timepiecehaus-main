<?php

namespace App\Http\Controllers;

use App\Country;
use App\Language;
use App\Order;
use App\Product;
use App\SuspiciousReport;
use App\Timezone;
use App\Traits\StoreImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Matrix\Exception;

class UserController extends Controller
{
    use StoreImageTrait;
    private $imagePath;

    public function __construct()
    {
        $this->imagePath = 'admin/images/users/';
    }

    //my-account
    public function myAccount()
    {
        $countries = Country::whereStatusId(1)->pluck('name', 'id');
        $timezones = Timezone::whereStatusId(1)->pluck('name', 'id');
        $languages = Language::whereStatusId(1)->pluck('name', 'id');
        $user = auth()->user();

        // my orders
        $myOrders = auth()->user()->myOrders()->orderBy('id', 'desc')->get();

        // order requests
        $orderRequests = auth()->user()->orderRequests()->orderBy('id', 'desc')->get();

        // drafted ad's
        $pendingAds = auth()->user()->products()->with('currency','status')->whereIsDraft(1)->orderBy('id', 'desc')->get();

        $myWatches = auth()->user()->products()->whereIsDraft(0)->orderBy('id', 'desc')->get();

        $suspiciousReports= SuspiciousReport::where('user_id','=',auth()->user()->id)->get();

        return view('my-account', compact('countries', 'timezones', 'user', 'languages',
            'pendingAds', 'myOrders', 'orderRequests','myWatches','suspiciousReports'));
    }

    //update-profile
    public function updateProfile(Request $request)
    {
        try {
            $data = $request->only('first_name', 'last_name', 'company', 'gender', 'date_of_birth', 'phone_no', 'fax_no', 'mobile_no', 'street', 'street_line_2', 'zip_code', 'city', 'state', 'country_id', 'company_name','occupation', 'timezone_id', 'language_id', 'about');
            if ($request->has('picture')) {
                $data['picture'] = $this->verifyAndStoreImage($request, 'picture', $this->imagePath);
            }
            auth()->user()->update($data);
        } catch (\Exception $ex) {
            Log::error($ex);
        }
        return redirect()->route('my-account');
    }

    public function updateSubscriptions(Request $request)
    {
        try {
            $data['stay_logged_in'] = $request->has('stay_logged_in') ? 1 : 0;
            $data['dont_send_follow_up_emails'] = $request->has('dont_send_follow_up_emails') ? 1 : 0;
            $data['sorted_by'] = $request->sorted_by;
            $data['preferred_language'] = $request->preferred_language;
            $data['newsletter'] = $request->has('newsletter') ? 1 : 0;
            $data['live_auctions'] = $request->has('live_auctions') ? 1 : 0;
            $data['listings_from_partners'] = $request->has('listings_from_partners') ? 1 : 0;
            $data['guide'] = $request->has('guide') ? 1 : 0;
            $data['price_alarm'] = $request->has('price_alarm') ? 1 : 0;
            $data['stay_up_to_date'] = $request->has('stay_up_to_date') ? 1 : 0;

            auth()->user()->userSetting()->updateOrCreate(['user_id' => auth()->user()->id], $data);
        } catch (Exception $ex) {
            Log::error($ex);
        }
        return redirect()->route('my-account');
    }
}
