<?php

namespace App\Http\Controllers\Admin;

use App\ClaspType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClaspTypeRequest;
use App\Status;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClaspTypeController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.claspTypes.index';
        $this->baseRoute = 'claspTypes.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $claspTypes = ClaspType::withTrashed()->with('status');
            return DataTables::eloquent($claspTypes)
                ->addIndexColumn()
                ->editColumn('status', function (ClaspType $claspType) {
                    return view('admin.claspTypes.status', compact('claspType'))->render();
                })
                ->addColumn('actions', function (ClaspType $claspType) {
                    return view('admin.claspTypes.actions', compact('claspType'))->render();
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
     * @param ClaspTypeRequest $request
     * @return Response
     */
    public function store(ClaspTypeRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                ClaspType::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Clasp Type created successfully!');
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
     * @param ClaspType $claspType
     * @return Response
     */
    public function edit(ClaspType $claspType)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'claspType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClaspTypeRequest $request
     * @param ClaspType $claspType
     * @return Response
     */
    public function update(ClaspTypeRequest $request, ClaspType $claspType)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                $claspType->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Clasp Type updated successfully!');
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
     * @param ClaspType $claspType
     * @return Response
     * @throws Exception
     */
    public function destroy(ClaspType $claspType)
    {
        if (request()->ajax()) {
            if (isset($claspType) && !empty($claspType)) {
                if ($claspType->delete()) {
                    return response()->json(['success' => true, 'message' => 'Clasp Type deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $claspType = ClaspType::withTrashed()->where('id', $id)->first();
            if (isset($claspType) && !empty($claspType)) {
                if ($claspType->restore()) {
                    return response()->json(['success' => true, 'message' => 'Clasp Type restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $claspType = ClaspType::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($claspType->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Clasp Type deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
