<?php

namespace App\Http\Controllers\Admin;

use App\CaseMaterial;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CaseMaterialRequest;
use App\Status;
use  DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CaseMaterialController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.caseMaterials.index';
        $this->baseRoute = 'caseMaterials.index';
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $caseMaterials= CaseMaterial::withTrashed()->with('status');
            return DataTables::eloquent($caseMaterials)
                ->addIndexColumn()
                ->editColumn('status', function (CaseMaterial $caseMaterial) {
                    return view('admin.caseMaterials.status', compact('caseMaterial'))->render();
                })
                ->addColumn('actions', function (CaseMaterial $caseMaterial) {
                    return view('admin.caseMaterials.actions', compact('caseMaterial'))->render();
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
     * @param  CaseMaterialRequest  $request
     * @return   Response

     */
    public function store(CaseMaterialRequest $request)
    {
        $validated= $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'status_id');
                CaseMaterial::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Case Materials created successfully!');
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
     * @param CaseMaterial $caseMaterial
     * @return Response
     */
    public function edit(CaseMaterial $caseMaterial)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'caseMaterial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CaseMaterialRequest $request
     * @param CaseMaterial $caseMaterial
     * @return Response
     */
    public function update(CaseMaterialRequest $request, CaseMaterial $caseMaterial)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'status_id');
                $caseMaterial->update($data);
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
     * @param CaseMaterial $caseMaterial
     * @return Response
     * @throws Exception
     */
    public function destroy(CaseMaterial $caseMaterial)
    {
        if (request()->ajax()) {
            if (isset($caseMaterial) && !empty($caseMaterial)) {
                if ($caseMaterial->delete()) {
                    return response()->json(['success' => true, 'message' => 'Case Materials deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $caseMaterial = CaseMaterial::withTrashed()->where('id', $id)->first();
            if (isset($caseMaterial) && !empty($caseMaterial)) {
                if ($caseMaterial->restore()) {
                    return response()->json(['success' => true, 'message' => 'Case Material restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $caseMaterial= CaseMaterial::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($caseMaterial->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Case Material deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
