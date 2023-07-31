<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WaterResistanceRequest;
use App\Status;
use App\WaterResistance;
use Exception;
use Illuminate\Http\Request;
use  DataTables;

class WaterResistanceController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.waterResistances.index';
        $this->baseRoute = 'waterResistances.index';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $waterResistances= WaterResistance::withTrashed()->with('status');
            return DataTables::eloquent($waterResistances)
                ->addIndexColumn()
                ->editColumn('status', function (WaterResistance $waterResistance) {
                    return view('admin.waterResistances.status', compact('waterResistance'))->render();
                })
                ->addColumn('actions', function (WaterResistance $waterResistance) {
                    return view('admin.waterResistances.actions', compact('waterResistance'))->render();
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
     * @param  WaterResistanceRequest  $request
     * @return WaterResistanceRequest Response
     */
    public function store(WaterResistanceRequest $request)
    {
        $validated= $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'status_id');
                WaterResistance::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Water resistance created successfully!');
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
     * @param  WaterResistance  $waterResistance
     * @return   WaterResistance Response
     */
    public function edit(WaterResistance $waterResistance)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'waterResistance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  WaterResistanceRequest  $request
     * @param  WaterResistance  $waterResistance
     * @return WaterResistance  Response
     */
    public function update(WaterResistanceRequest $request, WaterResistance $waterResistance)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'status_id');
                $waterResistance->update($data);
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
     * @param WaterResistance $waterResistance
     * @return  $waterResistance Response
     * @throws Exception
     */
    public function destroy(WaterResistance $waterResistance)
    {
        if (request()->ajax()) {
            if (isset($waterResistance) && !empty($waterResistance)) {
                if ($waterResistance->delete()) {
                    return response()->json(['success' => true, 'message' => 'Water resistance deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $waterResistance = WaterResistance::withTrashed()->where('id', $id)->first();
            if (isset($waterResistance) && !empty($waterResistance)) {
                if ($waterResistance->restore()) {
                    return response()->json(['success' => true, 'message' => 'Water resistance restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $waterResistance= WaterResistance::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($waterResistance->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Water resistance deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
