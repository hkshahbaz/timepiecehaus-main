<?php

namespace App\Http\Controllers\Admin;

use App\BraceletMaterial;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BraceletMaterialRequest;
use App\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use  DataTables;

class BraceletMaterialController extends Controller
{
    private $view;
    private $base_route;

    public function __construct()
    {
        $this->view = 'admin.braceletMaterials.index';
        $this->base_route = 'braceletMaterials.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $bezelMaterials = BraceletMaterial::withTrashed()->with('status');
            return DataTables::eloquent($bezelMaterials)
                ->addIndexColumn()
                ->editColumn('status', function (BraceletMaterial $braceletMaterial) {
                    return view('admin.braceletMaterials.status', compact('braceletMaterial'))->render();
                })
                ->addColumn('actions', function (BraceletMaterial $braceletMaterial) {
                    return view('admin.braceletMaterials.actions', compact('braceletMaterial'))->render();
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
     * @param Request $request
     * @return Response
     */
    public function store(BraceletMaterialRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                BraceletMaterial::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Bracelet Material created successfully!');
            } catch (Exception $ex) {
                session()->flash('error', true);
                session()->flash('msg', 'Something went wrong!');
                return redirect()->back()->withInput()->withErrors($validated);
            }
        }
        return redirect()->route($this->base_route);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param BraceletMaterial $braceletMaterial
     * @return Response
     */
    public function edit(BraceletMaterial $braceletMaterial)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'braceletMaterial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BraceletMaterialRequest $request
     * @param BraceletMaterial $braceletMaterial
     * @return Response
     */
    public function update(BraceletMaterialRequest $request, BraceletMaterial $braceletMaterial)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                $braceletMaterial->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Bracelet Material updated successfully!');
            } catch (Exception $ex) {
                session()->flash('error', true);
                session()->flash('msg', 'Something went wrong!');
                return redirect()->back()->withInput()->withErrors($validated);
            }
        }
        return redirect()->route($this->base_route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BraceletMaterial $braceletMaterial
     * @return Response
     * @throws Exception
     */
    public function destroy(BraceletMaterial $braceletMaterial)
    {
        if (request()->ajax()) {
            if (isset($braceletMaterial) && !empty($braceletMaterial)) {
                if ($braceletMaterial->delete()) {
                    return response()->json(['success' => true, 'message' => 'Bracelet Material deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $braceletMaterial = BraceletMaterial::withTrashed()->where('id', $id)->first();
            if (isset($braceletMaterial) && !empty($braceletMaterial)) {
                if ($braceletMaterial->restore()) {
                    return response()->json(['success' => true, 'message' => 'Bracelet Material restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $braceletMaterial = BraceletMaterial::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($braceletMaterial->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Bracelet Material deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
