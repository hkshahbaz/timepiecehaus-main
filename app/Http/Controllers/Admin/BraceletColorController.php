<?php

namespace App\Http\Controllers\Admin;

use App\BraceletColor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BraceletColorRequest;
use App\Status;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BraceletColorController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.braceletColors.index';
        $this->baseRoute = 'braceletColors.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $braceletColors = BraceletColor::withTrashed()->with('status');
            return DataTables::eloquent($braceletColors)
                ->addIndexColumn()
                ->editColumn('status', function (BraceletColor $braceletColor) {
                    return view('admin.braceletColors.status', compact('braceletColor'))->render();
                })
                ->addColumn('actions', function (BraceletColor $braceletColor) {
                    return view('admin.braceletColors.actions', compact('braceletColor'))->render();
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
     * @param BraceletColorRequest $request
     * @return Response
     */
    public function store(BraceletColorRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                BraceletColor::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Bracelet Color created successfully!');
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
     * @param BraceletColor $braceletColor
     * @return Response
     */
    public function edit(BraceletColor $braceletColor)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'braceletColor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BraceletColorRequest $request
     * @param BraceletColor $braceletColor
     * @return Response
     */
    public function update(BraceletColorRequest $request, BraceletColor $braceletColor)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                $braceletColor->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Bracelet Color updated successfully!');
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
     * @param BraceletColor $braceletColor
     * @return Response
     * @throws Exception
     */
    public function destroy(BraceletColor $braceletColor)
    {
        if (request()->ajax()) {
            if (isset($braceletColor) && !empty($braceletColor)) {
                if ($braceletColor->delete()) {
                    return response()->json(['success' => true, 'message' => 'Bracelet Color deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $braceletColor = BraceletColor::withTrashed()->where('id', $id)->first();
            if (isset($braceletColor) && !empty($braceletColor)) {
                if ($braceletColor->restore()) {
                    return response()->json(['success' => true, 'message' => 'Bracelet Color restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $braceletColor = BraceletColor::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($braceletColor->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Bracelet Color deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
