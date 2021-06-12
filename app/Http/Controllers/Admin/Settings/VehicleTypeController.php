<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['vehicleTypes'] = VehicleType::where('admin_id', auth()->user()->id)->get();
        return view('admin.settings.vehicle_types.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.vehicle_types.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'fee'  => 'required|numeric',
        ]);

        VehicleType::create([
            'admin_id' => auth()->user()->id,
            'type'     => $request->input('type'),
            'fee'      => $request->input('fee'),
        ]);

        $request->session()->flash('message', ' গাড়ীর ধরণ/শ্রেণী সংরংক্ষণ করা হয়েছে। ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->route('admin.settings.vehicle_types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleType $vehicleType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleType $vehicleType)
    {
        $this->data['vehicleType'] = $vehicleType;
        return view('admin.settings.vehicle_types.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VehicleType $vehicleType)
    {
        $request->validate([
            'type' => 'required|string',
            'fee'  => 'required|numeric',
        ]);

        $vehicleType->update([
            'type' => $request->input('type'),
            'fee'  => $request->input('fee'),
        ]);

        $request->session()->flash('message', ' গাড়ীর ধরণ/শ্রেণী সংরংক্ষণ করা হয়েছে। ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->route('admin.settings.vehicle_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleType  $vehicleType
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleType $vehicleType)
    {
        //
    }
}
