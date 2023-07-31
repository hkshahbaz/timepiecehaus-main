<?php

namespace App\Http\Controllers;

use App\BezelMaterial;
use App\BraceletColor;
use App\BraceletMaterial;
use App\Brand;
use App\CaseMaterial;
use App\ClaspMaterial;
use App\ClaspType;
use App\Condition;
use App\Country;
use App\DeliveryScope;
use App\Dial;
use App\DialFeature;
use App\DialNumeral;
use App\GlassType;
use App\HandDetail;
use App\Imports\ProductImport;
use App\Imports\ProductsImport;
use App\MoreSetting;
use App\Movement;
use App\Product;
use App\ProductCategory;
use App\ProductFunction;
use App\ProductPicture;
use App\ProductType;
use App\SuspiciousReport;
use App\Traits\StoreImageTrait;
use App\WaterResistance;
use Carbon\Carbon;
use Excel;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

class ShopController extends Controller
{
    use StoreImageTrait;
    private $imagePath;

    public function __construct()
    {
        $this->imagePath = 'admin/images/products/';
    }

    public function index(Request $request)
    {
        $allProducts = Product::whereStatusId(3)->whereIsDraft(0)->get();

        // Range Values
        $min_price = 0;
        $max_price = $allProducts->max('price');

        //selected values
        $min = 0;
        $max = $max_price;

        $products = Product::whereIsDraft(0)->whereStatusId(3);
        $sortBy = 'id';
        $sortOrder = 'desc';

        if ($request->has('seller')) {
            if ($request->get('seller') != "" && !is_null($request->get('seller')) &&
                $request->get('seller') != 0) {
                $seller = $request->get('seller');
                $products = $products->where('user_id', $seller);
            }
        }

        if ($request->has('name')) {
            if ($request->get('name') != "" && !is_null($request->get('name'))) {
                $name = $request->get('name');
                $products = $products->where('name', 'like', '%' . $name . '%');
            }
        }

        if ($request->has('brand')) {
            if ($request->get('brand') != 0) {
                $brand = $request->get('brand');
                $products = $products->whereBrandId($brand);
            }
        }

        if ($request->has('min') && $request->has('max')) {
            $min = $request->get('min');
            $max = $request->get('max');
            $products = $products->where('price', '>=', $min);
            $products = $products->where('price', '<=', $max);
        }

        if ($request->has('sortBy')) {
            $sortOrder = $request->get('sortOrder');
            $sortBy = $request->get('sortBy');
        }

        if ($request->has('category')) {
            if ($request->get('category') != 0) {
                $category = $request->get('category');
                $products = $products->whereProductCategoryId($category);
            }
        }

        $products = $products->orderBy($sortBy, $sortOrder);

        if (request()->ajax()) {
            $products = $products->paginate(9);

            // Append Sort Order
            $products = $products->appends(Input::only('sortBy', 'sortOrder'));
            if ($request->has('min') && $request->has('max')) {
                $products = $products->appends(Input::only('min', 'max'));
            }

            if ($request->has('seller')) {
                if ($request->get('seller') != "" && !is_null($request->get('seller')) &&
                    $request->get('seller') != 0) {
                    $seller = $request->get('seller');
                    $products = $products->where('user_id', $seller);
                }
            }

            // Append Category
            if ($request->has('category')) {
                if ($request->get('category') != 0) {
                    $products = $products->appends(Input::only('category'));
                }
            }

            // Append Brand
            if ($request->has('brand')) {
                if ($request->get('brand') != 0) {
                    $products = $products->appends(Input::only('brand'));
                }
            }

            // Append Brand
            if ($request->has('name')) {
                if ($request->get('name') != '' && !is_null($request->get('name'))) {
                    $products = $products->appends(Input::only('name'));
                }
            }

            // Append Seller
            if ($request->has('seller')) {
                if ($request->get('seller') != 0) {
                    $products = $products->appends(Input::only('seller'));
                }
            }

            if($products->count()){
                $paginationView = view('shop-partials.product-pagination', compact('products'))->render();
            }else{
                $paginationView = '';
            }
            $productsView = view('shop-partials.product-item', compact('products'))->render();
            return response()->json([
                'productsView' => $productsView,
                'paginationView' => $paginationView,
                'success' => true
            ]);
        }

        $products = $products->paginate(12);

        // Append Category
        if ($request->has('category')) {
            if ($request->get('category') != 0) {
                $products = $products->appends(Input::only('category'));
            }
        }

        // Append Brand
        if ($request->has('brand')) {
            if ($request->get('brand') != 0) {
                $products = $products->appends(Input::only('brand'));
            }
        }

        // Append name
        if ($request->has('name')) {
            if ($request->get('name') != '' && !is_null($request->get('name'))) {
                $products = $products->appends(Input::only('name'));
            }
        }

        if ($request->has('min') && $request->has('max')) {
            $products = $products->appends(Input::only('min', 'max'));
        }

        $products = $products->appends(Input::only('sortBy', 'sortOrder'));
        return view('shop', compact('products', 'max_price', 'min_price', 'min', 'max'));
    }

    public function productDetail(Product $product)
    {
        return view('product-detail', compact('product'));
    }

    public function sell(Product $product)
    {
        $pProductTypes = ProductType::whereStatusId(1)->pluck('name', 'id');
        $pBrands = Brand::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
        $pProductCategories = ProductCategory::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
        $pConditions = Condition::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
        $pScopeOfDelivery = DeliveryScope::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
        $pMovements = Movement::whereStatusId(1)->orderBy('name', 'asc')->pluck('name', 'id');
        $pCaliberMoreSettings = MoreSetting::whereStatusId(1)->whereType('caliber')->pluck('name', 'id');
        $pCaseMoreSettings = MoreSetting::whereStatusId(1)->whereType('case')->pluck('name', 'id');
        $pCaseMaterials = CaseMaterial::whereStatusId(1)->pluck('name', 'id');
        $pBezelMaterials = BezelMaterial::whereStatusId(1)->pluck('name', 'id');
        $pGlassTypes = GlassType::whereStatusId(1)->pluck('name', 'id');
        $pWaterResistances = WaterResistance::whereStatusId(1)->pluck('name', 'id');
        $pDials = Dial::whereStatusId(1)->pluck('name', 'id');
        $pDialNumerals = DialNumeral::whereStatusId(1)->pluck('name', 'id');
        $pDialFeatures = DialFeature::whereStatusId(1)->pluck('name', 'id');
        $pHandDetails = HandDetail::whereStatusId(1)->pluck('name', 'id');
        $pBraceletMaterials = BraceletMaterial::whereStatusId(1)->pluck('name', 'id');
        $pBraceletColors = BraceletColor::whereStatusId(1)->pluck('name', 'id');
        $pClaspTypes = ClaspType::whereStatusId(1)->pluck('name', 'id');
        $pClaspMaterials = ClaspMaterial::whereStatusId(1)->pluck('name', 'id');
        $pProductFunctions = ProductFunction::whereStatusId(1)->pluck('name', 'id');
        $pCurrencies = Country::whereIsCurrencyEnabled(1)->whereStatusId(1)->pluck('code', 'id');

        $pCurrenciesAttributes = collect(Country::whereIsCurrencyEnabled(1)->whereStatusId(1)->get())
            ->mapWithKeys(function ($item) {
                return [$item->id => ['data-symbol' => $item->symbol]];
            })->all();
        $user = auth()->user();

        $countries = Country::whereStatusId(1)->pluck('name', 'id');
        if ($product)
            if ($product->is_draft === 0)
                $product = new Product();

        return view('create-watch-ad',
            compact('pProductTypes', 'pBrands', 'pProductCategories', 'pConditions', 'pScopeOfDelivery', 'pMovements',
                'pCaliberMoreSettings', 'pCaseMoreSettings', 'pCaseMaterials', 'pBezelMaterials', 'pGlassTypes',
                'pWaterResistances', 'pDials', 'pDialNumerals', 'pDialFeatures', 'pHandDetails', 'pBraceletMaterials',
                'pBraceletColors', 'pClaspTypes', 'pClaspMaterials', 'pProductFunctions', 'pCurrencies', 'user', 'countries', 'pCurrenciesAttributes', 'product'));
    }

    public function storeAdStep1(Request $request)
    {
        try {
            $data = $request->except('_token', 'product_id', 'caliber_more_setting_ids',
                'case_more_setting_ids', 'dial_feature_ids', 'hand_detail_ids', 'product_function_ids');
            $data['user_id'] = auth()->id();
            $data['is_draft'] = 1;
            $data['status_id'] = 4;
            if (!$request->product_id) {
                $product = Product::create($data);
            } else {
                $product = Product::findOrFail($request->product_id);
                $product->update($data);
            }
            if ($product) {
                $caliber_more_setting_ids = ($request->caliber_more_setting_ids != NULL) ? $request->caliber_more_setting_ids : [];
                $case_more_setting_ids = ($request->case_more_setting_ids != NULL) ? $request->case_more_setting_ids : [];
                $product_function_ids = ($request->product_function_ids != NULL) ? $request->product_function_ids : [];
                $dial_feature_ids = ($request->dial_feature_ids != NULL) ? $request->dial_feature_ids : [];
                $hand_detail_ids = ($request->hand_detail_ids != NULL) ? $request->hand_detail_ids : [];

                if (count($caliber_more_setting_ids) > 0) {
                    $product->caliberMoreSettings()->sync($caliber_more_setting_ids);
                }
                if (count($case_more_setting_ids) > 0) {
                    $product->caseMoreSettings()->sync($case_more_setting_ids);
                }
                if (count($product_function_ids) > 0) {
                    $product->productFunctions()->sync($product_function_ids);
                }
                if (count($dial_feature_ids) > 0) {
                    $product->dialFeatures()->sync($dial_feature_ids);
                }
                if (count($caliber_more_setting_ids) > 0) {
                    $product->handDetails()->sync($hand_detail_ids);
                }
                return response()->json(['success' => true, 'message' => 'Step 1 completed successfully!', 'product' => $product]);
            }
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Error!']);
        }
    }

    public function uploadFile(Request $request, Product $product)
    {
        if ($request->type == 'ownership' && $request->has('picture2')) {
            $data['picture'] = $this->verifyAndStoreImage($request, 'picture2', $this->imagePath);
            $data['type'] = 'ownership';
            $picture = $product->productOwnershipPictures()->create($data);
            $picture['picture'] = asset($this->imagePath . $data['picture']);

            return response()->json([
                'success' => true,
                'message' => 'Image Uploaded Successfully!!',
                'picture' => $picture
            ]);
        } else if ($request->type == 'ownership' && $request->has('picture1')) {
            $data['picture'] = $this->verifyAndStoreImage($request, 'picture1', $this->imagePath);
            $data['type'] = 'ownership';
            $picture = $product->productOwnershipPictures()->create($data);
            $picture['picture'] = asset($this->imagePath . $data['picture']);
            return response()->json([
                'success' => true,
                'message' => 'Image Uploaded Successfully!!',
                'picture' => $picture
            ]);
        } else if ($request->type == 'product' && $request->has('files')) {
            $files = $request->file('files');
            if (count($files) > 0) {
                $pictures = [];
                foreach ($files as $key => $file) {
                    $destinationPath = $this->imagePath;
                    $extension = $file->getClientOriginalExtension();
                    $fileName = uniqid() . '.' . $extension;
                    $file->move($destinationPath, $fileName);

                    $data['picture'] = $fileName;
                    $data['type'] = 'product';
                    $picture = $product->productPictures()->create($data);
                    $picture['picture'] = asset($this->imagePath . $data['picture']);
                    $pictures[] = $picture;
                }
                $count = $product->productPictures()->count();
                return response()->json([
                    'success' => true,
                    'message' => 'Image Uploaded Successfully!!',
                    'count' => $count,
                    'pictures' => $pictures
                ]);
            }
        }
        return response()->json(['success' => false, 'message' => 'Error!']);
    }

    public function removeFile(Request $request)
    {
        if ($request->has('type')) {
            if ($request->type === 'ownership') {
                try {
                    $id = $request->id;
                    ProductPicture::whereType('ownership')->whereId($id)->delete();
                    return response()->json(['success' => true, 'message' => 'Ownership Image removed successfully!']);
                } catch (\Exception $ex) {
                    return response()->json(['success' => false, 'message' => 'Something went wrong!']);
                }
            } else if ($request->type === 'product') {
                try {
                    $id = $request->id;
                    ProductPicture::whereType('product')->whereId($id)->delete();
                    $product = Product::whereId($request->product_id)->first();
                    $pictures = $product->productPictures()->get();
                    return response()->json(['success' => true, 'message' => 'Product Image removed successfully!', 'pictures' => $pictures]);
                } catch (\Exception $ex) {
                    return response()->json(['success' => false, 'message' => 'Something went wrong!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Error!']);

    }

    public function updateProfile(Request $request)
    {
        try {
            $data = $request->except('_token');
            auth()->user()->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Personal Information Updated Successfully!!'
            ]);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Error!']);
        }
    }

    public function setAdCompleted(Request $request, Product $product)
    {
        try {
            $data = $request->only('paypal_order_id', 'paypal_payer_id');
            $data['is_draft'] = 0;
            $data['status_id'] = 3;
            $data['completed_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $product->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Watch Ad Completed Successfully. Click ok to see detail!',
                'product' => $product
            ]);
        } catch (\Exception $ex) {
            Log::error($ex);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ]);
        }
    }

    public function deletePendingAd(Request $request, Product $product)
    {
        try {
            if ($product->is_draft === 1) {
                $product->productPictures()->forceDelete();
                $product->productOwnershipPictures()->forceDelete();
                $product->handDetails()->forceDelete();
                $product->dialFeatures()->forceDelete();
                $product->caseMoreSettings()->forceDelete();
                $product->caliberMoreSettings()->forceDelete();
                $product->productFunctions()->forceDelete();
                $product->forceDelete();
                return response()->json(['success' => true, 'message' => 'Your Ad Deleted Successfully!'], 200);
            }
            return response()->json(['success' => false, 'message' => 'Invalid Ad!'], 400);
        } catch (\Exception $ex) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!'], 400);
        }
    }

    public function reportProduct(Request $request)
    {
        $data = $request->only('name', 'phone_no', 'product_id', 'email', 'message');
        $data['user_id'] = auth()->user()->id;
        SuspiciousReport::create($data);
        return redirect()->back();
    }

    public function importWatch(Request $request)
    {
        //validate the xls file
        $this->validate($request, array(
            'file' => 'required'
        ));
        if ($request->hasFile('file')) {
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx") {
                $r = new ProductsImport();
                $r->import($request->file('file'));
                // dd($r->failures());
                
                if($r->failures()){
                    session()->flash('upload-error', 'File is you added does not have valid data in it, Please recheck and upload again!');
                    return back();
                }else{
                    return back();
                }
            } else {
                session()->flash('upload-error', 'File is a ' . $extension . ' file! Please upload a valid csv file..!');
                return back();
            }
        }
    }

    public function downloadSampleFile(){
        $file= "sample-file.xlsx";
        $headers = [
            'Content-Type' => 'application/xlsx',
        ];
        return response()->download($file, 'sample-file.xlsx', $headers);
    }

}
