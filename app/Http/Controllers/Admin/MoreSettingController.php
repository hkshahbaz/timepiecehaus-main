<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MoreSettingRequest;
use App\MoreSetting;
use App\Status;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MoreSettingController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.moreSettings.index';
        $this->baseRoute = 'moreSettings.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $waterResistances = MoreSetting::withTrashed()->with('status');
            return DataTables::eloquent($waterResistances)
                ->addIndexColumn()
                ->editColumn('status', function (MoreSetting $moreSetting) {
                    return view('admin.moreSettings.status', compact('moreSetting'))->render();
                })
                ->addColumn('actions', function (MoreSetting $moreSetting) {
                    return view('admin.moreSettings.actions', compact('moreSetting'))->render();
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
     * @param MoreSettingRequest $request
     * @return Response
     */
    public function store(MoreSettingRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('type', 'name', 'status_id');
                MoreSetting::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'More Setting created successfully!');
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
     * @param MoreSetting $moreSetting
     * @return Response
     */
    public function edit(MoreSetting $moreSetting)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'moreSetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MoreSettingRequest $moreSetting
     * @return Response
     */
    public function update(MoreSettingRequest $request, MoreSetting $moreSetting)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('type', 'name', 'status_id');
                $moreSetting->update($data);
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
     * @param MoreSetting $moreSetting
     * @return Response
     * @throws Exception
     */
    public function destroy(MoreSetting $moreSetting)
    {
        if (request()->ajax()) {
            if (isset($moreSetting) && !empty($moreSetting)) {
                if ($moreSetting->delete()) {
                    return response()->json(['success' => true, 'message' => 'More Setting deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $moreSetting = MoreSetting::withTrashed()->where('id', $id)->first();
            if (isset($moreSetting) && !empty($moreSetting)) {
                if ($moreSetting->restore()) {
                    return response()->json(['success' => true, 'message' => 'More Setting restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $moreSetting = MoreSetting::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($moreSetting->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'More Setting deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
