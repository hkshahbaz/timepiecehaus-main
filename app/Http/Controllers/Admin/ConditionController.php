<?php

namespace App\Http\Controllers\Admin;

use App\Condition;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ConditionRequest;
use App\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class ConditionController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.conditions.index';
        $this->baseRoute = 'conditions.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $conditions = Condition::withTrashed()->with('status');
            return DataTables::eloquent($conditions)
                ->addIndexColumn()
                ->editColumn('status', function (Condition $condition) {
                    return view('admin.conditions.status', compact('condition'))->render();
                })
                ->addColumn('actions', function (Condition $condition) {
                    return view('admin.conditions.actions', compact('condition'))->render();
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
     * @param ConditionRequest $request
     * @return Response
     */
    public function store(ConditionRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'status_id');
                Condition::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Condition created successfully!');
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
     * @param Condition $condition
     * @return Response
     */
    public function edit(Condition $condition)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'condition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ConditionRequest $request
     * @param Condition $condition
     * @return Response
     */
    public function update(ConditionRequest $request, Condition $condition)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'status_id');
                $condition->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Condition updated successfully!');
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
     * @param Condition $condition
     * @return Response
     * @throws Exception
     */
    public function destroy(Condition $condition)
    {
        if (request()->ajax()) {
            if (isset($condition) && !empty($condition)) {
                if ($condition->delete()) {
                    return response()->json(['success' => true, 'message' => 'Condition deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $condition = Condition::withTrashed()->where('id', $id)->first();
            if (isset($condition) && !empty($condition)) {
                if ($condition->restore()) {
                    return response()->json(['success' => true, 'message' => 'Condition restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $condition = Condition::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($condition->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Condition deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
