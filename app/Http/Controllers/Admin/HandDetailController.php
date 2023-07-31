<?php

namespace App\Http\Controllers\Admin;

use App\HandDetail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HandDetailRequest;
use App\Status;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HandDetailController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.handDetails.index';
        $this->baseRoute = 'handDetails.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $handDetails = HandDetail::withTrashed()->with('status');
            return DataTables::eloquent($handDetails)
                ->addIndexColumn()
                ->editColumn('status', function (HandDetail $handDetail) {
                    return view('admin.handDetails.status', compact('handDetail'))->render();
                })
                ->addColumn('actions', function (HandDetail $handDetail) {
                    return view('admin.handDetails.actions', compact('handDetail'))->render();
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
     * @param HandDetailRequest $request
     * @return Response
     */
    public function store(HandDetailRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                HandDetail::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Hand Detail created successfully!');
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
     * @param HandDetail $handDetail
     * @return Response
     */
    public function edit(HandDetail $handDetail)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'handDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HandDetailRequest $request
     * @param HandDetail $handDetail
     * @return Response
     */
    public function update(HandDetailRequest $request, HandDetail $handDetail)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                $handDetail->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Hand Detail updated successfully!');
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
     * @param HandDetail $handDetail
     * @return Response
     * @throws Exception
     */
    public function destroy(HandDetail $handDetail)
    {
        if (request()->ajax()) {
            if (isset($handDetail) && !empty($handDetail)) {
                if ($handDetail->delete()) {
                    return response()->json(['success' => true, 'message' => 'Hand Detail deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $handDetail = HandDetail::withTrashed()->where('id', $id)->first();
            if (isset($handDetail) && !empty($handDetail)) {
                if ($handDetail->restore()) {
                    return response()->json(['success' => true, 'message' => 'Hand Detail restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $handDetail = HandDetail::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($handDetail->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Hand Detail deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
