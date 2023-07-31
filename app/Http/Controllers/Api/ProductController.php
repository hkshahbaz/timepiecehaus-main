<?php

namespace App\Http\Controllers\Api;

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
use App\Order;
use App\DialFeature;
use App\DialNumeral;
use App\GlassType;
use App\HandDetail;
use App\Http\Controllers\Controller;
use App\Movement;
use App\Product;
use App\ProductCategory;
use App\ProductFunction;
use App\ProductPicture;
use App\Traits\StoreImageTrait;
use App\WaterResistance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use StoreImageTrait;
    public $successStatus = 200;
    public $createStatus = 201;
    public $badRequest = 400;
    public $accessForbidden = 403;
    public $serverErrorStatus = 500;
    public $notFoundStatus = 404;
    public $tokenString = 'm';
    private $imagePath;

    public function __construct()
    {
        $this->imagePath = 'admin/images/products/';
    }

    public function storeAddStep1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'product_type_id' => 'required|exists:product_types,id',
            'product_category_id' => 'required|exists:product_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'modal' => 'required',
            'condition_id' => 'required|exists:conditions,id',
            'delivery_scope_id' => 'required|exists:delivery_scopes,id',
            'gender' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['messages' => $validator->messages()->all()], $this->badRequest);
        }
        $data = $request->only('name', 'product_type_id', 'product_category_id', 'brand_id', 'modal', 'condition_id', 'delivery_scope_id', 'gender', 'description', 'price',
            'reference_number', 'shipping_cost', 'case_diameter_length', 'case_diameter_width', 'movement_id', 'movement_caliber', 'base_caliber', 'power_reserve',
            'number_of_jewels', 'frequency', 'case_material_id', 'bezel_material_id', 'thickness', 'glass_type_id', 'water_resistance_id', 'dial_id', 'dial_numeral_id',
            'bracelet_material_id', 'bracelet_color_id', 'clasp_type_id', 'clasp_material_id');
        $data['user_id'] = auth()->user()->id;
        $product = Product::create($data);
        $product->dialFeatures()->attach($request->dial_features);
        $product->handDetails()->attach($request->hand_detail);
        $product->productFunctions()->attach($request->product_functions);
        $product->caseMoreSettings()->attach($request->case_more_settings);
        $product->caliberMoreSettings()->attach($request->caliber_more_settings);
        return response()->json($product,$this->createStatus);
    }

    public function updateStep1(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'product_type_id' => 'required|exists:product_types,id',
            'product_category_id' => 'required|exists:product_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'modal' => 'required',
            'condition_id' => 'required|exists:conditions,id',
            'delivery_scope_id' => 'required|exists:delivery_scopes,id',
            'gender' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['messages' => $validator->messages()->all()], $this->badRequest);
        }
        $data = $request->only('name', 'product_type_id', 'product_category_id', 'brand_id', 'modal', 'condition_id', 'delivery_scope_id', 'gender', 'description', 'price',
            'reference_number', 'shipping_cost', 'case_diameter_length', 'case_diameter_width', 'movement_id', 'movement_caliber', 'base_caliber', 'power_reserve',
            'number_of_jewels', 'frequency', 'case_material_id', 'bezel_material_id', 'thickness', 'glass_type_id', 'water_resistance_id', 'dial_id', 'dial_numeral_id',
            'bracelet_material_id', 'bracelet_color_id', 'clasp_type_id', 'clasp_material_id');
        $data['user_id'] = auth()->user();
        $product = Product::findOrFail($id);
        $product->update($data);
        if ($product) {
            $caliber_more_setting_ids = ($request->caliberMoreSettings != NULL) ? $request->caliberMoreSettings : [];
            $case_more_setting_ids = ($request->caseMoreSettings != NULL) ? $request->caseMoreSettings : [];
            $product_function_ids = ($request->product_functions != NULL) ? $request->product_functions : [];
            $dial_feature_ids = ($request->dial_features != NULL) ? $request->dial_features : [];
            $hand_detail_ids = ($request->hand_detail != NULL) ? $request->hand_detail : [];
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
    }


    public function allProduct()
    {
         $products = DB::table('products')->select('products.id', 'products.name', 'products.price','users.first_name','users.last_name', 'product_pictures.picture','countries.flag',DB::raw('AVG(product_ratings.rating) as rating'))->groupBy('products.id')
            ->leftJoin('users', 'products.user_id', '=', 'users.id')
            ->leftJoin('countries', 'products.user_id', '=', 'countries.id')
            ->leftJoin('product_pictures', 'products.id', '=', 'product_pictures.id')
            ->leftJoin('product_ratings', 'products.id', '=', 'product_ratings.product_id')
            ->where('products.is_draft', '=', 0)
            ->get();
        return response()->json(['allProduct' => $products], $this->successStatus);
    }

    public function topBrand()
    {
        $brands = Brand::select('id', 'name')->whereIn('id', array(403, 353, 339, 62, 230, 361, 440, 80, 363, 30))->get();
        return response()->json(['topBrand' => $brands], $this->successStatus);
    }

     public function getProductDetail($id)
    {
        $productDetail = DB::table('products')
            ->select('products.id', 'products.name as product_name', 'products.shipping_cost', 'product_pictures.picture', 'products.price',
                'products.gender', 'products.year_of_production', 'movements.name as movement_name',
                'conditions.name as condition', 'statuses.name as status_name', 'delivery_scopes.name as scope_of_delivery',
                'users.first_name', 'users.last_name','users.id as user_id', 'countries.name as country_name', 'countries.flag',
                DB::raw('AVG(product_ratings.rating) as rating'), 'products.description', 'products.reference_number',
                'brands.name as brand', 'products.modal', 'movements.name', 'case_materials.name as case_material',
                'bracelet_materials.name as bracelet_material')->groupBy('product_ratings.product_id')
            ->leftJoin('product_pictures', 'products.id', '=', 'product_pictures.id')
            ->leftJoin('conditions', 'products.condition_id', '=', 'conditions.id')
            ->leftJoin('delivery_scopes', 'products.delivery_scope_id', '=', 'delivery_scopes.id')
            ->leftJoin('statuses', 'products.status_id', '=', 'statuses.id')
            ->leftJoin('users', 'products.user_id', '=', 'users.id')
            ->leftJoin('countries', 'products.country_id', '=', 'countries.id')
            ->leftJoin('product_ratings', 'products.id', '=', 'product_ratings.product_id')
            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->leftJoin('movements', 'products.movement_id', '=', 'movements.id')
            ->leftJoin('case_materials', 'products.case_material_id', '=', 'case_materials.id')
            ->leftJoin('bracelet_materials', 'products.bracelet_material_id', '=', 'bracelet_materials.id')
            ->where('products.id', '=', $id)
            ->where('products.is_draft', '=', 0)
            ->first();
        $product=DB::table('products')->select('brand_id')->where('products.id','=',$id)->get();
        $productRelatedBrand=DB::table("products")
            ->select('products.id', 'products.name', 'users.first_name', 'users.last_name', 'products.price', 'product_pictures.picture', 'countries.flag', DB::raw('AVG(product_ratings.rating) as rating'))->groupBy('products.id')
            ->leftJoin('users', 'products.user_id', '=', 'users.id')
            ->leftJoin('countries', 'products.user_id', '=', 'countries.id')
            ->leftJoin('product_pictures', 'products.id', '=', 'product_pictures.id')
            ->leftJoin('product_ratings', 'products.id', '=', 'product_ratings.product_id')
            ->where('products.is_draft', '=', 0)
            ->where('products.brand_id','=',$product[0]->brand_id)->limit(3)->get();
        return response()->json(['getProductDetail' => $productDetail,'productRelatedBrand'=>$productRelatedBrand], $this->successStatus);
    }

    public function getAllBecomeVendor()
    {
        $productType = DB::table('product_types')->select('product_types.id', 'product_types.name')->get();
        $brands = Brand::select('id', 'name')->get();
        $categories = DB::table('product_categories')->select('product_categories.id', 'product_categories.name')->get();
        $conditions = Condition::select('id', 'name')->get();
        $deliveryScope = DeliveryScope::select('id', 'name')->get();
        $movements = Movement::select('id', 'name')->get();
        $caliberMoreSettings = DB::table('more_settings')->select('id', 'name','type')->get();
        $caseMaterials = CaseMaterial::select('id', 'name')->get();
        $bezelMaterial = BezelMaterial::select('id', 'name')->get();
        $glasses = GlassType::select('id', 'name')->get();
        $waterResistances = WaterResistance::select('id', 'name')->get();
        $dials = Dial::select('id', 'name')->get();
        $dialNumerals = DialNumeral::select('id', 'name')->get();
        $dialFeatures = DialFeature::select('id', 'name')->get();
        $handDetails = HandDetail::select('id', 'name')->get();
        $braceletColor = BraceletColor::select('id', 'name')->get();
        $braceletMaterial = BraceletMaterial::select('id', 'name')->get();
        $claspType = ClaspType::select('id', 'name')->get();
        $claspMaterial = ClaspMaterial::select('id', 'name')->get();
        $productFunctions = ProductFunction::select('id', 'name')->get();
        return response()->json(['productType' => $productType, 'getAllBrand' => $brands, 'getAllCategory' => $categories, 'getAllCondition' => $conditions,
            'getAllDeliveryOfScope' => $deliveryScope, 'getAllMovement' => $movements, 'getAllCaliberAndCaseMoreSetting' => $caliberMoreSettings,
            'getAllCaseMaterial' => $caseMaterials, 'getAllBezelMaterial' => $bezelMaterial, 'getAllGlassType' => $glasses, 'getAllWaterResistance' => $waterResistances,
            'getAllDial' => $dials, 'getAllDialNumeral' => $dialNumerals, 'getAllDialFeature' => $dialFeatures, 'getAllHandDetail' => $handDetails, 'getAllBraceletColor' => $braceletColor
            , 'getAllBraceletMaterial' => $braceletMaterial, 'claspType' => $claspType, 'getAllClaspMaterial' => $claspMaterial, 'getAllProductFunction' => $productFunctions], $this->successStatus);
    }

   public function uploadFile(Request $request, Product $product)
    {
      
        if ($request->type == 'ownership' && $request->has('picture2')) {
            $data['picture'] = $this->verifyAndStoreImage($request, 'picture2', $this->imagePath);
            $data['type'] = 'ownership';
            $picture = $product->productOwnershipPictures()->create($data);
            $picture['picture'] = asset($this->imagePath . $data['picture']);

            return response()->json(['message' => 'Image Uploaded Successfully!!']);
        } else if ($request->type == 'ownership' && $request->has('picture1')) {
            $data['picture'] = $this->verifyAndStoreImage($request, 'picture1', $this->imagePath);
            $data['type'] = 'ownership';
            $picture = $product->productOwnershipPictures()->create($data);
            $picture['picture'] = asset($this->imagePath . $data['picture']);
            return response()->json(['message' => 'Image Uploaded Successfully!!']);
        } else if ($request->type == 'product' && $request->has('files')) {
            $files = $request->file('files');
            if (count((array)$files) > 0) {
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
                return response()->json($pictures, $this->successStatus);
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
                    return response()->json(['message' => 'Ownership Image removed successfully!']);
                } catch (\Exception $ex) {
                    return response()->json(['message' => 'Something went wrong!']);
                }
            } else if ($request->type === 'product') {
                try {
                    $id = $request->id;
                    ProductPicture::whereType('product')->whereId($id)->delete();
//                    $product = Product::whereId($request->product_id)->first();
//                    $pictures = $product->productPictures()->get();
                    return response()->json(['message' => 'Product Image removed successfully!']);
                } catch (\Exception $ex) {
                    return response()->json(['message' => 'Something went wrong!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Error!']);
    }

    public function getAllHome()
    {
        $productsAsc = DB::table('products')
            ->select('products.id', 'products.name', 'products.price', 'product_pictures.picture')
            ->leftJoin('product_pictures', 'products.id', '=', 'product_pictures.id')
            ->orderBy('id', 'asc')
            ->whereIsDraft(0)
            ->whereStatusId(3)
            ->get();
        $productsDesc = DB::table('products')
            ->select('products.id', 'products.name', 'products.price', 'product_pictures.picture')
            ->leftJoin('product_pictures', 'products.id', '=', 'product_pictures.id')
            ->orderBy('id', 'desc')
            ->whereIsDraft(0)
            ->whereStatusId(3)
            ->get();
        $brands = Brand::select('id', 'name')->whereIn('id', array(403, 353, 339, 62, 230, 361, 440, 80, 363, 30))->get();
        $topCategories = ProductCategory::select('id', 'name', 'picture')->wherein('id', array(4, 10))->get();
        return response()->json(['getAllProductsAsc' => $productsAsc, 'getAllProductsDesc' => $productsDesc, 'topBrand' => $brands, 'topCategories' => $topCategories], $this->successStatus);
    }

    public function getAllProductsDesc()
    {
        $productsAsc = DB::table('products')
            ->select('products.id', 'products.name', 'products.price', 'product_pictures.picture')
            ->leftJoin('product_pictures', 'products.id', '=', 'product_pictures.id')
            ->orderBy('id', 'desc')
            ->whereIsDraft(0)
            ->whereStatusId(3)
            ->get();
        return response()->json($productsAsc, $this->successStatus);
    }
    
     public function productSearchByName(Request $request)
    {
         
        $productSearch = DB::table('products')
            ->select('products.id', 'products.name', 'products.price', 'product_pictures.picture','users.first_name','users.last_name','countries.flag',DB::raw('AVG(product_ratings.rating) as rating'))->groupBy('products.id')

            ->leftJoin('users', 'products.user_id', '=', 'users.id')
            ->leftJoin('product_pictures', 'products.id', '=', 'product_pictures.id')
            ->leftJoin('countries', 'products.user_id', '=', 'countries.id')
            ->leftJoin('product_ratings', 'products.id', '=', 'product_ratings.product_id')
            ->where('products.name', 'like', "%{$request->get('name')}%")
            ->whereIsDraft(0)
            ->get();
        return response()->json(['productSearchByName' =>$productSearch], $this->successStatus);
    }
    public function productSearchByKey(Request $request)
    {
        $productsname= $request->name;
        $productsAsc =Product::select('id', 'name')
            ->where('products.name', 'like', "%{$productsname}%")
            ->whereIsDraft(0)
            ->get();
        return response()->json(['productSearchByKey'=>$productsAsc], $this->successStatus);
    }
    public function myWatch(){
        $myWatches = DB::table('products')
            ->select('products.id', 'products.name', 'products.price',
                'product_pictures.picture','users.first_name','users.last_name',
                'countries.flag',DB::raw('AVG(product_ratings.rating) as rating'))->groupBy('products.id')

            ->leftJoin('users', 'products.user_id', '=', 'users.id')
            ->leftJoin('product_pictures', 'products.id', '=', 'product_pictures.id')
            ->leftJoin('countries', 'products.user_id', '=', 'countries.id')
            ->leftJoin('product_ratings', 'products.id', '=', 'product_ratings.product_id')
            ->where('products.user_id','=',auth()->user()->id)
            ->where('is_draft','=',0)
             ->get();
         $soldes = DB::table('orders')
            ->select('orders.id','products.id as product_id', 'products.name', 'products.price',
                'users.first_name','users.last_name','product_pictures.picture','countries.flag',DB::raw('AVG(product_ratings.rating) as rating'))->groupBy('products.id')
            ->leftJoin('products', 'orders.product_id', '=', 'products.id')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('product_pictures', 'products.id', '=', 'product_pictures.id')
            ->leftJoin('countries', 'products.user_id', '=', 'countries.id')
            ->leftJoin('product_ratings', 'products.id', '=', 'product_ratings.product_id')
            ->where('vendor_id','=',auth()->user()->id)
            ->where('is_draft','=',0)
            ->where('orders.status_id','=',17)
            ->get();
        return response()->json(['myWatches'=>$myWatches,'sold'=>$soldes],$this->successStatus);
    }
    public function getUserProduct($id){
        $userProduct = DB::table('products')
            ->select('products.id', 'products.name', 'products.price',
                'product_pictures.picture', 'users.first_name', 'users.last_name',
                'countries.flag', DB::raw('AVG(product_ratings.rating) as rating'))->groupBy('products.id')
            ->leftJoin('users', 'products.user_id', '=', 'users.id')
            ->leftJoin('product_pictures', 'products.id', '=', 'product_pictures.id')
            ->leftJoin('countries', 'products.user_id', '=', 'countries.id')
            ->leftJoin('product_ratings', 'products.id', '=', 'product_ratings.product_id')
            ->where('products.user_id', '=', $id)
            ->where('is_draft', '=', 0)
            ->get();
         return response()->json(["userProduct"=>$userProduct],$this->successStatus);
    }
    public function deleteMyWatch($id)
    {
        $myWatche['product']= DB::table('products')->where('id','=',$id)->where('products.user_id','=',auth()->user()->id)->delete();
        $myWatche['product_dial_feature']= DB::table('product_dial_feature')->where('product_id','=',$id)->delete();
        $myWatche['product_product_function']= DB::table('product_product_function')->where('product_id','=',$id)->delete();
        $myWatche['product_ratings']= DB::table('product_ratings')->where('product_id','=',$id)->delete();
        $myWatche['product_pictures']= DB::table('product_pictures')->where('product_id','=',$id)->delete();
        $myWatche['product_more_setting']= DB::table('product_more_setting')->where('product_id','=',$id)->delete();
        $myWatche['product_hand_detail']= DB::table('product_hand_detail')->where('product_id','=',$id)->delete();
        $myWatche['product_hand_detail']= DB::table('product_hand_detail')->where('product_id','=',$id)->delete();
        $myWatche['wish_lists']= DB::table('wish_lists')->where('product_id','=',$id)->delete();


        if ($myWatche){
            return response()->json(['message'=>"product delete successfully"], $this->successStatus);
        }else{
            return response()->json(['message'=>"product do not  delete successfully"], $this->successStatus);
        }
    }
}
