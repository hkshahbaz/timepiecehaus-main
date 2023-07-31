<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Status;
use App\Traits\StoreImageTrait;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    use StoreImageTrait;

    private $view;
    private $baseRoute;
    private $imagePath;

    public function __construct()
    {
        $this->view = 'admin.brands.index';
        $this->baseRoute = 'brands.index';
        $this->imagePath = 'admin/images/products/brands/';
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
            $brands = Brand::withTrashed()->with('status');
            return DataTables::eloquent($brands)
                ->addIndexColumn()
                ->editColumn('picture', function (Brand $brand) {
                    if (is_null($brand->picture)) {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->defaultImage) . "' alt='" . $brand->name . "' />";
                    } else if (file_exists($this->imagePath . $brand->picture)) {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->imagePath . $brand->picture) . "' alt='" . $brand->name . "' />";
                    } else {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->notFoundImage) . "' alt='" . $brand->name . "' />";
                    }
                })
                ->editColumn('show_on_nav', function (Brand $brand) {
                    return ($brand->show_on_nav) ? 'Yes' : 'No';
                })
                ->editColumn('status', function (Brand $brand) {
                    return view('admin.brands.status', compact('brand'))->render();
                })
                ->addColumn('actions', function (Brand $brand) {
                    return view('admin.brands.actions', compact('brand'))->render();
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
     * @param BrandRequest $request
     * @return Response
     */
    public function store(BrandRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'show_on_nav', 'sequence', 'status_id');
                $data['picture'] = $this->verifyAndStoreImage($request, 'picture', $this->imagePath);

                Brand::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Brand created successfully!');
            } catch (\Exception $ex) {
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
     * @param Brand $brand
     * @return Response
     */
    public function edit(Brand $brand)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BrandRequest $request
     * @param Brand $brand
     * @return Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'show_on_nav', 'sequence', 'status_id');
                if($request->hasFile('picture')){
                    $data['picture'] = $this->verifyAndStoreImage($request, 'picture', $this->imagePath);
                    if (!is_null($brand->picture)){
                        unlink($this->imagePath . $brand->picture);
                }
                }
                $brand->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Brand updated successfully!');
            } catch (\Exception $ex) {
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
     * @param Brand $brand
     * @return Response
     * @throws \Exception
     */
    public function destroy(Brand $brand)
    {
        if (request()->ajax()) {
            if (isset($brand) && !empty($brand)) {
                if ($brand->delete()) {
                    return response()->json(['success' => true, 'message' => 'Brand deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $brand = Brand::withTrashed()->where('id', $id)->first();
            if (isset($brand) && !empty($brand)) {
                if ($brand->restore()) {
                    return response()->json(['success' => true, 'message' => 'Brand restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $brand = Brand::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($brand->forceDelete()) {
                unlink($this->imagePath.$brand->picture);
                return response()->json(['success' => true, 'message' => 'Brand deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
