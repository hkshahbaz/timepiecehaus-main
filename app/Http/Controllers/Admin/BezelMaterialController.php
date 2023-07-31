<?php

namespace App\Http\Controllers\Admin;

use App\BezelMaterial;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BezelMaterialRequest;
use App\Status;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BezelMaterialController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.bezelMaterials.index';
        $this->baseRoute = 'bezelMaterials.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $bezelMaterials = BezelMaterial::withTrashed()->with('status');
            return DataTables::eloquent($bezelMaterials)
                ->addIndexColumn()
                ->editColumn('status', function (BezelMaterial $bezelMaterial) {
                    return view('admin.bezelMaterials.status', compact('bezelMaterial'))->render();
                })
                ->addColumn('actions', function (BezelMaterial $bezelMaterial) {
                    return view('admin.bezelMaterials.actions', compact('bezelMaterial'))->render();
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
     * @param BezelMaterialRequest $request
     * @return Response
     */
    public function store(BezelMaterialRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                BezelMaterial::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Bezel Material created successfully!');
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
     * @param BezelMaterial $bezelMaterial
     * @return Response
     */
    public function edit(BezelMaterial $bezelMaterial)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'bezelMaterial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BezelMaterialRequest $request
     * @param BezelMaterial $bezelMaterial
     * @return Response
     */
    public function update(BezelMaterialRequest $request, BezelMaterial $bezelMaterial)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                $bezelMaterial->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Bezel Material updated successfully!');
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
     * @param BezelMaterial $bezelMaterial
     * @return Response
     * @throws Exception
     */
    public function destroy(BezelMaterial $bezelMaterial)
    {
        if (request()->ajax()) {
            if (isset($bezelMaterial) && !empty($bezelMaterial)) {
                if ($bezelMaterial->delete()) {
                    return response()->json(['success' => true, 'message' => 'Bezel Material deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $bezelMaterial = BezelMaterial::withTrashed()->where('id', $id)->first();
            if (isset($bezelMaterial) && !empty($bezelMaterial)) {
                if ($bezelMaterial->restore()) {
                    return response()->json(['success' => true, 'message' => 'Bezel Material restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $bezelMaterial = BezelMaterial::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($bezelMaterial->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Bezel Material deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
