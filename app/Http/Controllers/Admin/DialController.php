<?php

namespace App\Http\Controllers\Admin;

use App\Dial;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DialRequest;
use App\Status;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DialController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.dials.index';
        $this->baseRoute = 'dials.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $dials = Dial::withTrashed()->with('status');
            return DataTables::eloquent($dials)
                ->addIndexColumn()
                ->editColumn('status', function (Dial $dial) {
                    return view('admin.dials.status', compact('dial'))->render();
                })
                ->addColumn('actions', function (Dial $dial) {
                    return view('admin.dials.actions', compact('dial'))->render();
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
     * @param DialRequest $request
     * @return Response
     */
    public function store(DialRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                Dial::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Dial created successfully!');
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
     * @param Dial $dial
     * @return Response
     */
    public function edit(Dial $dial)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'dial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DialRequest $request
     * @param Dial $dial
     * @return Response
     */
    public function update(DialRequest $request, Dial $dial)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                $dial->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Dial updated successfully!');
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
     * @param Dial $dial
     * @return Response
     * @throws Exception
     */
    public function destroy(Dial $dial)
    {
        if (request()->ajax()) {
            if (isset($dial) && !empty($dial)) {
                if ($dial->delete()) {
                    return response()->json(['success' => true, 'message' => 'Dial deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $dial = Dial::withTrashed()->where('id', $id)->first();
            if (isset($dial) && !empty($dial)) {
                if ($dial->restore()) {
                    return response()->json(['success' => true, 'message' => 'Dial restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $dial = Dial::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($dial->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Dial deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
