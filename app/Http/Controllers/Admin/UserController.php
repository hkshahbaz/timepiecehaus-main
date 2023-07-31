<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $users = User::whereHas('roles', function ($query) {
                $query->where('name', 'vendor');
            })->withTrashed()->latest();

            return DataTables::eloquent($users)
                ->addIndexColumn()
                ->editColumn('status', function (User $user) {
                    return view('admin.users.status', compact('user'))->render();
                })
                ->addColumn('actions', function (User $user) {
                    return view('admin.users.actions', compact('user'))->render();
                })
                ->addColumn('details', function (User $user) {
                    return view('admin.users.details', compact('user'))->render();
                })
                ->rawColumns(['status', 'details', 'actions'])
                ->toJson();
        }

        return view('admin.users.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     * @throws Exception
     */
    public function destroy(User $user)
    {
        if (request()->ajax()) {
            if (isset($user) && !empty($user)) {
                if ($user->delete()) {
                    return response()->json(['success' => true, 'message' => 'User deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $user = User::withTrashed()->where('id', $id)->first();
            if (isset($user) && !empty($user)) {
                if ($user->restore()) {
                    return response()->json(['success' => true, 'message' => 'User restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $user = User::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($user->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'User deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function getUser($id)
    {
        $user = User::whereId($id)->withTrashed()->with('language', 'country', 'timezone')->first();
        if ($user) {
            return response()->json(['user' => $user, 'success' => true, 'message' => 'Vendor is valid!']);
        }
        return response()->json(['user' => [], 'success' => false, 'message' => 'Vendor detail not found!']);
    }
}
