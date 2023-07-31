<?php

namespace App\Http\Controllers\Admin;

use App\DeliveryScope;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeliveryScopeRequest;
use App\Status;
use Exception;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeliveryScopeController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.deliveryScopes.index';
        $this->baseRoute = 'deliveryScopes.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $deliveryScopes = DeliveryScope::withTrashed()->with('status');
            return DataTables::eloquent($deliveryScopes)
                ->addIndexColumn()
                ->editColumn('status', function (DeliveryScope $deliveryScope) {
                    return view('admin.deliveryScopes.status', compact('deliveryScope'))->render();
                })
                ->addColumn('actions', function (DeliveryScope $deliveryScope) {
                    return view('admin.deliveryScopes.actions', compact('deliveryScope'))->render();
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
     * @param DeliveryScopeRequest $request
     * @return Response
     */
    public function store(DeliveryScopeRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                DeliveryScope::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Delivery Scope created successfully!');
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
     * @param DeliveryScope $deliveryScope
     * @return Response
     */
    public function edit(DeliveryScope $deliveryScope)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'deliveryScope'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DeliveryScopeRequest $request
     * @param DeliveryScope $deliveryScope
     * @return Response
     */
    public function update(DeliveryScopeRequest $request, DeliveryScope $deliveryScope)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id');
                $deliveryScope->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Delivery Scope updated successfully!');
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
     * @param DeliveryScope $deliveryScope
     * @return Response
     * @throws Exception
     */
    public function destroy(DeliveryScope $deliveryScope)
    {
        if (request()->ajax()) {
            if (isset($deliveryScope) && !empty($deliveryScope)) {
                if ($deliveryScope->delete()) {
                    return response()->json(['success' => true, 'message' => 'Delivery Scope deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $deliveryScope = DeliveryScope::withTrashed()->where('id', $id)->first();
            if (isset($deliveryScope) && !empty($deliveryScope)) {
                if ($deliveryScope->restore()) {
                    return response()->json(['success' => true, 'message' => 'Delivery Scope restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $deliveryScope = DeliveryScope::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($deliveryScope->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Delivery Scope deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
