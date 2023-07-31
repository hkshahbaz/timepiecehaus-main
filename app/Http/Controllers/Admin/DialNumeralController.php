<?php

namespace App\Http\Controllers\Admin;

use App\DialNumeral;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DialNumeralRequest;
use App\Status;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DialNumeralController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.dialNumerals.index';
        $this->baseRoute = 'dialNumerals.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $dialNumerals = DialNumeral::withTrashed()->with('status');
            return DataTables::eloquent($dialNumerals)
                ->addIndexColumn()
                ->editColumn('status', function (DialNumeral $dialNumeral) {
                    return view('admin.dialNumerals.status', compact('dialNumeral'))->render();
                })
                ->addColumn('actions', function (DialNumeral $dialNumeral) {
                    return view('admin.dialNumerals.actions', compact('dialNumeral'))->render();
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
     * @param DialNumeralRequest $request
     * @return Response
     */
    public function store(DialNumeralRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                DialNumeral::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Dial Numeral created successfully!');
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
     * @param DialNumeral $dialNumeral
     * @return Response
     */
    public function edit(DialNumeral $dialNumeral)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'dialNumeral'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DialNumeralRequest $request
     * @param DialNumeral $dialNumeral
     * @return Response
     */
    public function update(DialNumeralRequest $request, DialNumeral $dialNumeral)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                $dialNumeral->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Dial Numeral updated successfully!');
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
     * @param DialNumeral $dialNumeral
     * @return Response
     * @throws Exception
     */
    public function destroy(DialNumeral $dialNumeral)
    {
        if (request()->ajax()) {
            if (isset($dialNumeral) && !empty($dialNumeral)) {
                if ($dialNumeral->delete()) {
                    return response()->json(['success' => true, 'message' => 'Dial Numeral deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $dialNumeral = DialNumeral::withTrashed()->where('id', $id)->first();
            if (isset($dialNumeral) && !empty($dialNumeral)) {
                if ($dialNumeral->restore()) {
                    return response()->json(['success' => true, 'message' => 'Dial Numeral restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $dialNumeral = DialNumeral::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($dialNumeral->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Dial Numeral deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
