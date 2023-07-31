<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ColorRequest;
use App\Status;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ColorController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.colors.index';
        $this->baseRoute = 'colors.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $colors = Color::withTrashed()->with('status');
            return DataTables::eloquent($colors)
                ->addIndexColumn()
                ->editColumn('status', function (Color $color) {
                    return view('admin.colors.status', compact('color'))->render();
                })
                ->addColumn('actions', function (Color $color) {
                    return view('admin.colors.actions', compact('color'))->render();
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
     * @param ColorRequest $request
     * @return Response
     */
    public function store(ColorRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                Color::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Color created successfully!');
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
     * @param Color $color
     * @return Response
     */
    public function edit(Color $color)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ColorRequest $request
     * @param Color $color
     * @return Response
     */
    public function update(ColorRequest $request, Color $color)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                $color->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Color updated successfully!');
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
     * @param Color $color
     * @return Response
     * @throws Exception
     */
    public function destroy(Color $color)
    {
        if (request()->ajax()) {
            if (isset($color) && !empty($color)) {
                if ($color->delete()) {
                    return response()->json(['success' => true, 'message' => 'Color deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $color = Color::withTrashed()->where('id', $id)->first();
            if (isset($color) && !empty($color)) {
                if ($color->restore()) {
                    return response()->json(['success' => true, 'message' => 'Color restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $color = Color::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($color->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Color deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
