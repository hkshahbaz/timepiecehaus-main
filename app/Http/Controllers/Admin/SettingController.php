<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $headers = Setting::whereType('header')->orderBy('field_type', 'asc')->get();
        $footers = Setting::whereType('footer')->orderBy('field_type', 'asc')->get();
        return view('admin.settings', compact('headers', 'footers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->except("_token", "type");
        $type = $request->type;
        try{
            foreach ($data as $key => $value) {
                Setting::whereType($type)->whereName($key)->update(['value' => $value]);
            }
            session()->flash('success', true);
            session()->flash('msg', 'Settings updated successfully!!');
        }catch (\Exception $ex){
            session()->flash('error', true);
            session()->flash('msg', 'Something went wrong!');
            return redirect()->route('settings.index');
        }
        return redirect()->route('settings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Setting $setting
     * @return Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Setting $setting
     * @return Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Setting $setting
     * @return Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Setting $setting
     * @return Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
