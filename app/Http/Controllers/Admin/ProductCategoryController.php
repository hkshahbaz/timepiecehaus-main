<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductCategoryRequest;
use App\ProductCategory;
use App\Status;
use App\Traits\StoreImageTrait;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductCategoryController extends Controller
{
    use StoreImageTrait;

    private $view;
    private $baseRoute;
    private $imagePath;

    public function __construct()
    {
        $this->view = 'admin.productCategories.index';
        $this->baseRoute = 'productCategories.index';
        $this->imagePath = 'admin/images/products/categories/';
        $this->defaultImage = 'admin/images/default-image.png';
        $this->notFoundImage = 'admin/images/image-not-found.png';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $productCategories = ProductCategory::withTrashed()->with('status');
            return DataTables::eloquent($productCategories)
                ->addIndexColumn()
                ->editColumn('picture', function (ProductCategory $productCategory) {
                    if (is_null($productCategory->picture)) {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->defaultImage) . "' alt='" . $productCategory->name . "' />";
                    } else if (file_exists($this->imagePath . $productCategory->picture)) {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->imagePath . $productCategory->picture) . "' alt='" . $productCategory->name . "' />";
                    } else {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->notFoundImage) . "' alt='" . $productCategory->name . "' />";
                    }
                })
                ->editColumn('show_on_nav', function (ProductCategory $productCategory) {
                    return ($productCategory->show_on_nav) ? 'Yes' : 'No';
                })
                ->editColumn('status', function (ProductCategory $productCategory) {
                    return view('admin.productCategories.status', compact('productCategory'))->render();
                })
                ->addColumn('actions', function (ProductCategory $productCategory) {
                    return view('admin.productCategories.actions', compact('productCategory'))->render();
                })
                ->rawColumns(['picture', 'status', 'actions'])
                ->toJson();
        }
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductCategoryRequest $request
     * @return Response
     */
    public function store(ProductCategoryRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'show_on_nav', 'sequence', 'status_id');
                $data['picture'] = $this->verifyAndStoreImage($request, 'picture', $this->imagePath);
                ProductCategory::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Product Category created successfully!');
            } catch (Exception $ex) {
                session()->flash('error', true);
                session()->flash('msg', 'Something went wrong!');
                return redirect()->back()->withInput()->withErrors($validated);
            }
        }
        return redirect()->route($this->baseRoute);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ProductCategory $productCategory
     * @return Response
     */
    public function edit(ProductCategory $productCategory)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'productCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductCategoryRequest $request
     * @param ProductCategory $productCategory
     * @return Response
     */
    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'show_on_nav', 'sequence', 'status_id');
                if ($request->hasFile('picture')) {
                    $data['picture'] = $this->verifyAndStoreImage($request, 'picture', $this->imagePath);
                    if (!is_null($productCategory->picture))
                        unlink($this->imagePath . $productCategory->picture);
                }
                $productCategory->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Product Category updated successfully!');
            } catch (Exception $ex) {
                session()->flash('error', true);
                session()->flash('msg', 'Something went wrong!');
                return redirect()->back()->withInput()->withErrors($validated);
            }
        }
        return redirect()->route($this->baseRoute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductCategory $productCategory
     * @return Response
     * @throws Exception
     */
    public function destroy(ProductCategory $productCategory)
    {
        if (request()->ajax()) {
            if (isset($productCategory) && !empty($productCategory)) {
                if ($productCategory->delete()) {
                    return response()->json(['success' => true, 'message' => 'Product Category deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $productCategory = ProductCategory::withTrashed()->where('id', $id)->first();
            if (isset($productCategory) && !empty($productCategory)) {
                if ($productCategory->restore()) {
                    return response()->json(['success' => true, 'message' => 'Product Category restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $productCategory = ProductCategory::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($productCategory->forceDelete()) {
                unlink($this->imagePath . $productCategory->picture);
                return response()->json(['success' => true, 'message' => 'Product Category deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
