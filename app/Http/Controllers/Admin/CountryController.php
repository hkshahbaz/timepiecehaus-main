<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Status;
use App\Traits\StoreImageTrait;
use DataTables;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CountryController extends Controller
{
    use StoreImageTrait;

    private $view;
    private $baseRoute;
    private $imagePath;
    private $defaultImage;
    private $notFoundImage;

    public function __construct()
    {
        $this->view = 'admin.countries.index';
        $this->baseRoute = 'countries.index';
        $this->imagePath = 'admin/images/flags/';
        $this->defaultImage = 'admin/images/default-image.png';
        $this->notFoundImage = 'admin/images/image-not-found.png';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $countries = Country::withTrashed()->with('status');
            return DataTables::eloquent($countries)
                ->addIndexColumn()
                ->editColumn('is_currency_enabled', function (Country $country) {
                    return ($country->is_currency_enabled == 1) ? 'Enabled' : 'Disabled';
                })
                ->editColumn('flag', function (Country $country) {
                    if (is_null($country->flag)) {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->defaultImage) . "' alt='" . $country->name . "' />";
                    } else if (file_exists($this->imagePath . $country->flag)) {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->imagePath . $country->flag) . "' alt='" . $country->name . "' />";
                    } else {
                        return "<img class='img-responsive' width='100px' src='" . asset($this->notFoundImage) . "' alt='" . $country->name . "' />";
                    }
                })
                ->editColumn('status', function (Country $country) {
                    return view('admin.countries.status', compact('country'))->render();
                })
                ->addColumn('actions', function (Country $country) {
                    return view('admin.countries.actions', compact('country'))->render();
                })
                ->rawColumns(['flag', 'is_currency_enabled', 'status', 'actions'])
                ->toJson();
        }
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CountryRequest $request
     * @return Response
     */
    public function store(CountryRequest $request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'currency', 'code', 'symbol', 'sequence', 'is_currency_enabled', 'status_id');
                $data['flag'] = $this->verifyAndStoreImage($request, 'flag', $this->imagePath);
                Country::create($data);
                session()->flash('success', true);
                session()->flash('msg', 'Country created successfully!');
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
     * @param Country $country
     * @return Response
     */
    public function edit(Country $country)
    {
        $statuses = Status::whereType('active-inactive')->pluck('name', 'id');
        return view($this->view, compact('statuses', 'country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CountryRequest $request
     * @param Country $country
     * @return Response
     */
    public function update(CountryRequest $request, Country $country)
    {
        $validated = $request->validated();
        if (!$validated) {
            return redirect()->back()
                ->withErrors($validated)
                ->withInput();
        } else {
            try {
                $data = $request->only('name', 'currency', 'code', 'symbol', 'sequence', 'is_currency_enabled', 'status_id');
                if ($request->hasFile('flag')) {
                    $data['flag'] = $this->verifyAndStoreImage($request, 'flag', $this->imagePath);
                    if (!is_null($country->flag))
                        unlink($this->imagePath . $country->flag);
                }
                $country->update($data);
                session()->flash('success', true);
                session()->flash('msg', 'Country updated successfully!');
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
     * @param Country $country
     * @return Response
     * @throws Exception
     */
    public function destroy(Country $country)
    {
        if (request()->ajax()) {
            if (isset($country) && !empty($country)) {
                if ($country->delete()) {
                    return response()->json(['success' => true, 'message' => 'Country deleted successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function restore(Request $request, $id)
    {
        if (request()->ajax()) {
            $country = Country::withTrashed()->where('id', $id)->first();
            if (isset($country) && !empty($country)) {
                if ($country->restore()) {
                    return response()->json(['success' => true, 'message' => 'Country restored successfully!']);
                }
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }

    public function permanentDelete(Request $request, $id)
    {
        $country = Country::onlyTrashed()->whereId($id)->first();
        if (request()->ajax()) {
            if ($country->forceDelete()) {
                return response()->json(['success' => true, 'message' => 'Country deleted permanently successfully!']);
            }
        }
        return response()->json(['success' => false, 'message' => 'Something went wrong!']);
    }
}
