<?php

namespace App\Http\Controllers\Admin;

use App\DialFeature;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DialFeatureRequest;
use App\Status;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DialFeatureController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.dialFeatures.index';
        $this->baseRoute = 'dialFeatures.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $dialFeatures = DialFeature::withTrashed()->with('status');
            return DataTables::eloquent($dialFeatures)
                ->addIndexColumn()
                ->editColumn('status', function (DialFeature $dialFeature) {
                    return view('admin.dialFeatures.status', compact('dialFeature'))->render();
                })
                ->addColumn('actions', function (DialFeature $dialFeature) {
                    return view('admin.dialFeatures.actions', compact('dialFeature'))->render();
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
     * @param DialFeatureRequest $request
     * @return Response
     */
    public function store(DialFeatureRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                DialFeature::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Dial Feature created successfully!');
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
     * @param DialFeature $dialFeature
     * @return Response
     */
    public function edit(DialFeature $dialFeature)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'dialFeature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DialFeatureRequest $request
     * @param DialFeature $dialFeature
     * @return Response
     */
    public function update(DialFeatureRequest $request, DialFeature $dialFeature)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                $dialFeature->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Dial Feature updated successfully!');
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
     * @param DialFeature $dialFeature
     * @return Response
     * @throws Exception
     */
    public function destroy(DialFeature $dialFeature)
    {
        if (request()->ajax()) {
            if (isset($dialFeature) && !empty($dialFeature)) {
                if ($dialFeature->delete()) {
                    return response()->json(['success' => true, 'message' => 'Dial Feature deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $dialFeature = DialFeature::withTrashed()->where('id', $id)->first();
            if (isset($dialFeature) && !empty($dialFeature)) {
                if ($dialFeature->restore()) {
                    return response()->json(['success' => true, 'message' => 'Dial Feature restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $dialFeature = DialFeature::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($dialFeature->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Dial Feature deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
