<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LanguageRequest;
use App\Language;
use App\Http\Controllers\Controller;
use App\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DataTables;

class LanguageController extends Controller
{
    private $view;
    private $baseRoute;

    public function __construct()
    {
        $this->view = 'admin.languages.index';
        $this->baseRoute = 'languages.index';
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $glassTypes = Language::withTrashed()->with('status');
            return DataTables::eloquent($glassTypes)
                ->addIndexColumn()
                ->editColumn('status', function (Language $language) {
                    return view('admin.languages.status', compact('language'))->render();
                })
                ->addColumn('actions', function (Language $language) {
                    return view('admin.languages.actions', compact('language'))->render();
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
     * @param LanguageRequest $request
     * @return Response
     */
    public function store(LanguageRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id','abbreviation');
                Language::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Language created successfully!');
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
     * @param Language $language
     * @return Response
     */
    public function edit(Language $language)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LanguageRequest $request
     * @param Language $language
     * @return Response
     */
    public function update(LanguageRequest $request, Language $language)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'status_id','abbreviation');
                $language->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Language updated successfully!');
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
     * @param Language $language
     * @return Response
     * @throws Exception
     */
    public function destroy(Language $language)
    {
        if (request()->ajax()) {
            if (isset($language) && !empty($language)) {
                if ($language->delete()) {
                    return response()->json(['success' => true, 'message' => 'Language deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $language = Language::withTrashed()->where('id', $id)->first();
            if (isset($language) && !empty($language)) {
                if ($language->restore()) {
                    return response()->json(['success' => true, 'message' => 'Language restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $language = Language::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($language->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Language deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
