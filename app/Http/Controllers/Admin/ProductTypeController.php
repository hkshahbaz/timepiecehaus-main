<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductTypeRequest;
use App\ProductType;
use App\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class ProductTypeController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.productTypes.index';
        $this->baseRoute = 'productTypes.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $productTypes = ProductType::withTrashed()->with('status');
            return DataTables::eloquent($productTypes)
                ->addIndexColumn()
                ->editColumn('status', function (ProductType $productType) {
                    return view('admin.productTypes.status', compact('productType'))->render();
                })
                ->addColumn('actions', function (ProductType $productType) {
                    return view('admin.productTypes.actions', compact('productType'))->render();
                })
                ->rawColumns(['status', 'actions'])
                ->toJson();
        }
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductTypeRequest $request
     * @return Response
     */
    public function store(ProductTypeRequest $request)
    {
        $validated= $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'status_id');
                ProductType::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Product Type created successfully!');
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
     * @param ProductType $productType
     * @return Response
     */
    public function edit(ProductType $productType)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'productType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductTypeRequest $request
     * @param ProductType $productType
     * @return Response
     */
    public function update(ProductTypeRequest $request, ProductType $productType)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'status_id');
                $productType->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Product Type updated successfully!');
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
     * @param ProductType $productType
     * @return Response
     * @throws Exception
     */
    public function destroy(ProductType $productType)
    {
        if (request()->ajax()) {
            if (isset($productType) && !empty($productType)) {
                if ($productType->delete()) {
                    return response()->json(['success' => true, 'message' => 'Product Type deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $productType = ProductType::withTrashed()->where('id', $id)->first();
            if (isset($productType) && !empty($productType)) {
                if ($productType->restore()) {
                    return response()->json(['success' => true, 'message' => 'Product Type restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $productType = ProductType::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($productType->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Product Type deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
