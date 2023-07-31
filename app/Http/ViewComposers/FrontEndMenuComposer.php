<?php

namespace App\Http\ViewComposers;

use App\Brand;
use App\ProductCategory;
use App\Setting;
use Illuminate\Contracts\View\View;

class FrontEndMenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        if (auth()->check()) {
            $data['wishListItemsCount'] = auth()->user()->wishLists()->count();
        } else {
            $data['wishListItemsCount'] = 0;
        }
        $data['homeBrands'] = Brand::whereIn('id', [403, 353, 30, 471, 363, 52, 94])->get();

        $data['siteFooter'] = Setting::whereType('footer')->pluck('value', 'name', 'address', 'phone_no', 'fax_no', 'company_email');
//        dd($data['siteFooter']);
        $data['categories'] = ProductCategory::whereStatusId(1)->whereShowOnNav(1)->orderBy('sequence', 'asc')
            ->orderBy('name', 'asc')->pluck('name', 'id');
        $data['brands'] = Brand::whereStatusId(1)->whereShowOnNav(1)->orderBy('sequence', 'asc')->pluck('name', 'id');
        $view->with($data);
    }
}
