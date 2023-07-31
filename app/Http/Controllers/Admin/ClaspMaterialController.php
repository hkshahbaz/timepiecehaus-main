<?php

namespace App\Http\Controllers\Admin;

use App\ClaspMaterial;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClaspMaterialRequest;
use App\Status;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClaspMaterialController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.claspMaterials.index';
        $this->baseRoute = 'claspMaterials.index';
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $claspMaterials= ClaspMaterial::withTrashed()->with('status');
            return DataTables::eloquent($claspMaterials)
                ->addIndexColumn()
                ->editColumn('status', function (ClaspMaterial $claspMaterial) {
                    return view('admin.claspMaterials.status', compact('claspMaterial'))->render();
                })
                ->addColumn('actions', function (ClaspMaterial $claspMaterial) {
                    return view('admin.claspMaterials.actions', compact('claspMaterial'))->render();
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
     * @param  ClaspMaterialRequest  $request
     * @return   Response

     */
    public function store(ClaspMaterialRequest $request)
    {
        $validated= $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'status_id');
                ClaspMaterial::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Clasp Materials created successfully!');
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
     * @param ClaspMaterial $claspMaterial
     * @return Response
     */
    public function edit(ClaspMaterial $claspMaterial)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'claspMaterial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClaspMaterialRequest $request
     * @param ClaspMaterial $claspMaterial
     * @return Response
     */
    public function update(ClaspMaterialRequest $request, ClaspMaterial $claspMaterial)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'status_id');
                $claspMaterial->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Watre resistance updated successfully!');
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
     * @param ClaspMaterial $claspMaterial
     * @return Response
     * @throws Exception
     */
    public function destroy(ClaspMaterial $claspMaterial)
    {
        if (request()->ajax()) {
            if (isset($claspMaterial) && !empty($claspMaterial)) {
                if ($claspMaterial->delete()) {
                    return response()->json(['success' => true, 'message' => 'Clasp Materials deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $claspMaterial = ClaspMaterial::withTrashed()->where('id', $id)->first();
            if (isset($claspMaterial) && !empty($claspMaterial)) {
                if ($claspMaterial->restore()) {
                    return response()->json(['success' => true, 'message' => 'Clasp Material restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $claspMaterial= ClaspMaterial::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($claspMaterial->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Clasp Material deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
