<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Status;
use App\User;
use DB;
use Excel;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Throwable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     * @throws Throwable
     */
    public function index(Request $request)
    {
        $noOfItems = 10;
        $statuses = Status::whereType('product-availability-status')->pluck('name', 'id');
        $statuses->prepend('Select Status', '');
        $statuses2 = Status::whereType('product-availability-status')->pluck('name', 'id');
        $statuses2->prepend('Select Status', '');

        if ($request->ajax()) {
            $fullUrl = $request->fullUrl();
            $fullUrl = explode('?', $fullUrl, 2);

            $products = Product::with(['brand', 'productCategory', 'productRatings', 'vendor'])->latest();
            $products = $this->createQuery($products, $request);
            $products = $products->paginate($noOfItems);
            $productsView = view('admin.products.single-product-item', compact('products', 'statuses'))->render();
            $products = $products->appends(Input::except('page'));
            $paginationView = view('admin.products.pagination', compact('products'))->render();

            return response()->json([
                'productsView' => $productsView,
                'paginationView' => $paginationView,
                'success' => true
            ]);
        }

        $products = Product::with(['brand', 'productCategory', 'productRatings', 'vendor'])->latest();
        $products = $this->createQuery($products, $request);
        $products = $products->paginate($noOfItems);

        $vendors = User::whereHas('roles', function ($query) {
            $query->where('name', 'vendor');
        })->orderBy('first_name', 'asc')->get()->pluck('full_name', 'id');
        $vendors->prepend('Select Vendor', '');

        $adStatuses = collect([
            '' => 'Select Ad Status',
            '1' => 'Drafted',
            '0' => 'Completed'
        ]);

        $products = $products->appends(Input::except('page'));
        return view('admin.products.index', compact('products', 'vendors', 'adStatuses', 'statuses'));
    }


    public function createQuery($products, $request)
    {
        if ($request->has('is_draft')) {
            if (!is_null($request->is_draft) && $request->is_draft != '') {
                $is_draft = $request->is_draft;
                $products = $products->where('is_draft', $is_draft);
            }
        }
        if ($request->has('status_id')) {
            if (!is_null($request->status_id) && $request->status_id != '') {
                $status_id = $request->status_id;
                $products = $products->where('status_id', $status_id);
            }
        }
        if ($request->has('user_id')) {
            if (!is_null($request->user_id) && $request->user_id != '') {
                $user_id = $request->user_id;
                $products = $products->where('user_id', $user_id);
            }
        }

        if ($request->has('price_range')) {
            $price_range = $request->price_range;
            $products = $products->orWhere(function ($query) use ($price_range) {
                $query->where('price', '>=', $price_range[0]);
                $query->where('price', '<=', $price_range[1]);
            });
        }

        if ($request->has('case_diameter_width')) {
            $case_diameter_width = $request->case_diameter_width;
            $products = $products->orWhere(function ($query) use ($case_diameter_width) {
                $query->where('case_diameter_width', '>=', $case_diameter_width[0]);
                $query->where('case_diameter_width', '<=', $case_diameter_width[1]);
            });
        }

        if ($request->has('case_diameter_length')) {
            $case_diameter_length = $request->case_diameter_length;
            $products = $products->orWhere(function ($query) use ($case_diameter_length) {
                $query->where('case_diameter_length', '>=', $case_diameter_length[0]);
                $query->where('case_diameter_length', '<=', $case_diameter_length[1]);
            });
        }

        if ($request->has('brand_id')) {
            $brand_id = $request->brand_id;
            $products = $products->orWhereIn('brand_id', $brand_id);
        }

        if ($request->has('condition_id')) {
            $condition_id = $request->condition_id;
            $products = $products->orWhereIn('condition_id', $condition_id);
        }

        if ($request->has('movement_id')) {
            $movement_id = $request->movement_id;
            $products = $products->orWhereIn('movement_id', $movement_id);
        }

        if ($request->has('delivery_scope_id')) {
            $delivery_scope_id = $request->delivery_scope_id;
            $products = $products->orWhereIn('delivery_scope_id', $delivery_scope_id);
        }

        if ($request->has('product_type_id')) {
            $product_type_id = $request->product_type_id;
            $products = $products->orWhereIn('product_type_id', $product_type_id);
        }

        if ($request->has('product_category_id')) {
            $product_category_id = $request->product_category_id;
            $products = $products->orWhereIn('product_category_id', $product_category_id);
        }

        if ($request->has('gender')) {
            $gender = $request->gender;
            $products = $products->orWhereIn('gender', $gender);
        }

        if ($request->has('product_function_id')) {
            $product_function_id = $request->product_function_id;
            $products = $products->orWhereHas('productFunctions', function ($query) use ($product_function_id) {
                $query->whereIn('product_function_id', $product_function_id);
            });
        }

        if ($request->has('case_more_setting_id')) {
            $case_more_setting_id = $request->case_more_setting_id;
            $products = $products->orWhereHas('caseMoreSettings', function ($query) use ($case_more_setting_id) {
                $query->whereIn('more_setting_id', $case_more_setting_id);
            });
        }

        if ($request->has('caliber_more_setting_id')) {
            $caliber_more_setting_id = $request->caliber_more_setting_id;
            $products = $products->orWhereHas('caliberMoreSettings', function ($query) use ($caliber_more_setting_id) {
                $query->whereIn('more_setting_id', $caliber_more_setting_id);
            });
        }

        if ($request->has('glass_type_id')) {
            $glass_type_id = $request->glass_type_id;
            $products = $products->orWhereIn('glass_type_id', $glass_type_id);
        }

        if ($request->has('water_resistance_id')) {
            $water_resistance_id = $request->water_resistance_id;
            $products = $products->orWhereIn('water_resistance_id', $water_resistance_id);
        }

        if ($request->has('case_material_id')) {
            $case_material_id = $request->case_material_id;
            $products = $products->orWhereIn('case_material_id', $case_material_id);
        }

        if ($request->has('bezel_material_id')) {
            $bezel_material_id = $request->bezel_material_id;
            $products = $products->orWhereIn('bezel_material_id', $bezel_material_id);
        }

        if ($request->has('dial_id')) {
            $dial_id = $request->dial_id;
            $products = $products->orWhereIn('dial_id', $dial_id);
        }

        if ($request->has('dial_numeral_id')) {
            $dial_numeral_id = $request->dial_numeral_id;
            $products = $products->orWhereIn('dial_numeral_id', $dial_numeral_id);
        }

        if ($request->has('dial_feature_id')) {
            $dial_feature_id = $request->dial_feature_id;
            $products = $products->orWhereHas('dialFeatures', function ($query) use ($dial_feature_id) {
                $query->whereIn('dial_feature_id', $dial_feature_id);
            });
        }

        if ($request->has('hand_detail_id')) {
            $hand_detail_id = $request->hand_detail_id;
            $products = $products->orWhereHas('handDetails', function ($query) use ($hand_detail_id) {
                $query->whereIn('hand_detail_id', $hand_detail_id);
            });
        }

        if ($request->has('bracelet_material_id')) {
            $bracelet_material_id = $request->bracelet_material_id;
            $products = $products->orWhereIn('bracelet_material_id', $bracelet_material_id);
        }

        if ($request->has('bracelet_color_id')) {
            $bracelet_color_id = $request->bracelet_color_id;
            $products = $products->orWhereIn('bracelet_color_id', $bracelet_color_id);
        }

        if ($request->has('clasp_type_id')) {
            $clasp_type_id = $request->clasp_type_id;
            $products = $products->orWhereIn('clasp_type_id', $clasp_type_id);
        }

        if ($request->has('clasp_material_id')) {
            $clasp_material_id = $request->clasp_material_id;
            $products = $products->orWhereIn('clasp_material_id', $clasp_material_id);
        }
        return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return Response
     */
    public function show(Product $product)
    {
        $products = Product::with('vendor', 'productPictures', 'productOwnershipPictures', 'deliveryScope', 'productType', 'movement', 'glassType', 'caseMaterial', 'bezelMaterial', 'waterResistance', 'dial', 'dialNumeral', 'brand', 'productCategory', 'currency', 'braceletMaterial', 'braceletColor', 'claspType', 'claspMaterial', 'dialFeatures', 'handDetails', 'caseMoreSettings', 'caliberMoreSettings', 'productRatings')->get();
        return view('admin.products.product-detail', compact('products', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function updateStatus(Product $product, Request $request)
    {
        if ($request->has('status_id')) {
            $status_id = $request->status_id;
            $product->status_id = $status_id;
            $product->save();
            return \response()->json(['success' => true,
                'message' => 'Status updated successfully!',
                'status' => '<label class="label label-roundless ' . $product->status->background_color . '">' . $product->status->name . '</label>']);
        }
        return \response()->json(['success' => false, 'message' => 'Invalid Product!']);
    }
}
