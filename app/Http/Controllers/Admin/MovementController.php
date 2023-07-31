<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MovementRequest;
use App\Movement;
use App\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use  DataTables;

class MovementController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.movements.index';
        $this->baseRoute = 'movements.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $movements = Movement::withTrashed()->with('status');
            return DataTables::eloquent($movements)
                ->addIndexColumn()
                ->editColumn('status', function (Movement $movement) {
                    return view('admin.movements.status', compact('movement'))->render();
                })
                ->addColumn('actions', function (Movement $movement) {
                    return view('admin.movements.actions', compact('movement'))->render();
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
     * @param MovementRequest $request
     * @return Response
     */
    public function store(MovementRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'status_id');
                Movement::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Movement created successfully!');
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
     * @param Movement $movement
     * @return Response
     */
    public function edit(Movement $movement)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'movement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MovementRequest $request
     * @param Movement $movement
     * @return Response
     */
    public function update(MovementRequest $request, Movement $movement)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only( 'name', 'status_id');
                $movement->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Movement updated successfully!');
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
     * @param Movement $movement
     * @return Response
     * @throws Exception
     */
    public function destroy(Movement $movement)
    {
        if (request()->ajax()) {
            if (isset($movement) && !empty($movement)) {
                if ($movement->delete()) {
                    return response()->json(['success' => true, 'message' => 'Movement deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $movement = Movement::withTrashed()->where('id', $id)->first();
            if (isset($movement) && !empty($movement)) {
                if ($movement->restore()) {
                    return response()->json(['success' => true, 'message' => 'Movement restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $movement = Movement::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($movement->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Movement deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
