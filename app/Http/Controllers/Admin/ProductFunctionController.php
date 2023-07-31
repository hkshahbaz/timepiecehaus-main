<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductFunctionRequest;
use App\ProductFunction;
use App\Status;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductFunctionController extends Controller
{

    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.productFunctions.index';
        $this->baseRoute = 'productFunctions.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $productFunctions = ProductFunction::withTrashed()->with('status');
            return DataTables::eloquent($productFunctions)
                ->addIndexColumn()
                ->editColumn('status', function (ProductFunction $productFunction) {
                    return view('admin.productFunctions.status', compact('productFunction'))->render();
                })
                ->addColumn('actions', function (ProductFunction $productFunction) {
                    return view('admin.productFunctions.actions', compact('productFunction'))->render();
                })
                ->rawColumns(['status', 'actions'])
                ->toJson();
        }
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param ProductFunctionRequest $request
     * @return Response
     */
    public function store(ProductFunctionRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                ProductFunction::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Product Function created successfully!');
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
     * @param ProductFunction $productFunction
     * @return Response
     */
    public function edit(ProductFunction $productFunction)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'productFunction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductFunctionRequest $request
     * @param ProductFunction $productFunction
     * @return Response
     */
    public function update(ProductFunctionRequest $request, ProductFunction $productFunction)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                $productFunction->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Product Function updated successfully!');
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
     * @param ProductFunction $productFunction
     * @return Response
     * @throws Exception
     */
    public function destroy(ProductFunction $productFunction)
    {
        if (request()->ajax()) {
            if (isset($productFunction) && !empty($productFunction)) {
                if ($productFunction->delete()) {
                    return response()->json(['success' => true, 'message' => 'Product Function deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $productFunction = ProductFunction::withTrashed()->where('id', $id)->first();
            if (isset($productFunction) && !empty($productFunction)) {
                if ($productFunction->restore()) {
                    return response()->json(['success' => true, 'message' => 'Product Function restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $productFunction = ProductFunction::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($productFunction->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Product Function deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
