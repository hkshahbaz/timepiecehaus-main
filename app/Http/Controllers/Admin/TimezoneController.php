<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TimezoneRequest;
use App\Status;
use App\Timezone;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TimezoneController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.timezones.index';
        $this->baseRoute = 'timezones.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $timezones = Timezone::withTrashed()->with('status');
            return DataTables::eloquent($timezones)
                ->addIndexColumn()
                ->editColumn('status', function (Timezone $timezone) {
                    return view('admin.timezones.status', compact('timezone'))->render();
                })
                ->addColumn('actions', function (Timezone $timezone) {
                    return view('admin.timezones.actions', compact('timezone'))->render();
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
     * @param TimezoneRequest $request
     * @return Response
     */
    public function store(TimezoneRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'identifier', 'status_id');
                Timezone::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Timezone created successfully!');
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
     * @param Timezone $timezone
     * @return Response
     */
    public function edit(Timezone $timezone)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'timezone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TimezoneRequest $request
     * @param Timezone $timezone
     * @return Response
     */
    public function update(TimezoneRequest $request, Timezone $timezone)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'identifier', 'status_id');
                $timezone->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Timezone updated successfully!');
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
     * @param Timezone $timezone
     * @return Response
     * @throws Exception
     */
    public function destroy(Timezone $timezone)
    {
        if (request()->ajax()) {
            if (isset($timezone) && !empty($timezone)) {
                if ($timezone->delete()) {
                    return response()->json(['success' => true, 'message' => 'Timezone deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $timezone = Timezone::withTrashed()->where('id', $id)->first();
            if (isset($timezone) && !empty($timezone)) {
                if ($timezone->restore()) {
                    return response()->json(['success' => true, 'message' => 'Timezone restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $timezone = Timezone::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($timezone->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Timezone deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
