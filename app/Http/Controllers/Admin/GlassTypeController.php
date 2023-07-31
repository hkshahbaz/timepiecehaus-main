<?php

namespace App\Http\Controllers\Admin;

use App\GlassType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GlassTypeRequest;
use App\Status;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GlassTypeController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.glassTypes.index';
        $this->baseRoute = 'glassTypes.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $glassTypes = GlassType::withTrashed()->with('status');
            return DataTables::eloquent($glassTypes)
                ->addIndexColumn()
                ->editColumn('status', function (GlassType $glassType) {
                    return view('admin.glassTypes.status', compact('glassType'))->render();
                })
                ->addColumn('actions', function (GlassType $glassType) {
                    return view('admin.glassTypes.actions', compact('glassType'))->render();
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
     * @param GlassTypeRequest $request
     * @return Response
     */
    public function store(GlassTypeRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                GlassType::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Glass Type created successfully!');
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
     * @param GlassType $glassType
     * @return Response
     */
    public function edit(GlassType $glassType)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'glassType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GlassTypeRequest $request
     * @param GlassType $glassType
     * @return Response
     */
    public function update(GlassTypeRequest $request, GlassType $glassType)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                $glassType->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Glass Type updated successfully!');
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
     * @param GlassType $glassType
     * @return Response
     * @throws Exception
     */
    public function destroy(GlassType $glassType)
    {
        if (request()->ajax()) {
            if (isset($glassType) && !empty($glassType)) {
                if ($glassType->delete()) {
                    return response()->json(['success' => true, 'message' => 'Glass Type deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }


    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $glassType = GlassType::withTrashed()->where('id', $id)->first();
            if (isset($glassType) && !empty($glassType)) {
                if ($glassType->restore()) {
                    return response()->json(['success' => true, 'message' => 'Glass Type restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $glassType = GlassType::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($glassType->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Glass Type deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
