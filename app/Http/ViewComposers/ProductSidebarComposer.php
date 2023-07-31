<?php

namespace App\Http\ViewComposers;

use App\BezelMaterial;
use App\BraceletColor;
use App\BraceletMaterial;
use App\Brand;
use App\CaseMaterial;
use App\ClaspMaterial;
use App\ClaspType;
use App\Condition;
use App\DeliveryScope;
use App\Dial;
use App\DialFeature;
use App\DialNumeral;
use App\GlassType;
use App\HandDetail;
use App\Http\Requests\Admin\DialNumeralRequest;
use App\Http\Requests\Admin\MovementRequest;
use App\MoreSetting;
use App\Movement;
use App\Product;
use App\ProductCategory;
use App\ProductFunction;
use App\ProductType;
use App\WaterResistance;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ProductSidebarComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('admin') && Request::is(['products'])) {
                $data['maxPrice'] = Product::max('price');
                $data['maxDiameterWidth'] = Product::max('case_diameter_width');
                $data['maxDiameterLength'] = Product::max('case_diameter_length');

                $data['categories'] = ProductCategory::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['brands'] = Brand::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['productTypes'] = ProductType::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['productFunctions'] = ProductFunction::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['caseMoreSettings'] = MoreSetting::whereStatusId(1)->whereType('case')->orderBy('name', 'asc')->pluck('name', 'id');
                $data['caliberMoreSettings'] = MoreSetting::whereStatusId(1)->whereType('caliber')->orderBy('name', 'asc')->pluck('name', 'id');
                $data['deliveryScopes'] = DeliveryScope::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['conditions'] = Condition::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['movements'] = Movement::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['genders'] = collect([
                    "Men's watch/Unisex" => "Men's watch/Unisex",
                    "Women's watch" => "Women's watch"
                ]);
                $data['glassTypes'] = GlassType::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['waterResistances'] = WaterResistance::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['caseMaterials'] = CaseMaterial::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['bezelMaterials'] = BezelMaterial::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['dial'] = Dial::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['dialNumerals'] = DialNumeral::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['dialFeatures'] = DialFeature::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['handDetails'] = HandDetail::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['braceletMaterials'] = BraceletMaterial::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['braceletColors'] = BraceletColor::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['claspTypes'] = ClaspType::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
                $data['claspMaterials'] = ClaspMaterial::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');

                $view->with($data);
            }
        }
    }

}
