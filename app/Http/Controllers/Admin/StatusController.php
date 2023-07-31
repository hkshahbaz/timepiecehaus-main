<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StatusRequest;
use App\Status;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StatusController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.statuses.index';
        $this->baseRoute = 'statuses.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $statuses = Status::withTrashed()->orderBy('type', 'asc');
            return DataTables::eloquent($statuses)
                ->addIndexColumn()
                ->editColumn('name', function (Status $status){
                    return "<label class='label ".$status->background_color." label-roundless'>$status->name</label>";
                })
                ->editColumn('status', function (Status $status) {
                    return view('admin.statuses.status', compact('status'))->render();
                })
                ->addColumn('actions', function (Status $status) {
                    return view('admin.statuses.actions', compact('status'))->render();
                })
                ->rawColumns(['name', 'status', 'actions'])
                ->toJson();
        }

        return view($this->view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(StatusRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('type', 'name', 'background_color');
                $data['status'] = 'Active';
                Status::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Status added successfully!');
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
     * @param Status $status
     * @return Response
     */
    public function edit(Status $status)
    {
        return view($this->view, compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StatusRequest $request
     * @param int $id
     * @return Response
     */
    public function update(StatusRequest $request, Status $status)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('type', 'name', 'background_color');
                $data['status'] = 'Active';
                $status->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Status updated successfully!');
            } catch (Exception $ex) {
                session()->flash('error', true);
                session()->flash('msg', 'Something went wrong!');
                return redirect()->back()->withInput();
            }
        }
        return redirect()->route($this->baseRoute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Status $status
     * @return Response
     * @throws Exception
     */
    public function destroy(Status $status)
    {
        if (request()->ajax()) {
            if (isset($status) && !empty($status)) {
                if ($status->delete()) {
                    return response()->json(['success' => true, 'message' => 'Status deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $status = Status::withTrashed()->where('id', $id)->first();
            if (isset($status) && !empty($status)) {
                if ($status->restore()) {
                    return response()->json(['success' => true, 'message' => 'Status restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $status = Status::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($status->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Status deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
