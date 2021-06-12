<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\BusinessType;
use App\Models\CapitalRange;
use App\Models\OwnershipType;
use Illuminate\Http\Request;

class CapitalRangeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->data['capital_ranges'] = CapitalRange::all();
        return view('admin.settings.capital_range.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $this->data['ownership_types'] = OwnershipType::pluck('name', 'id');
        $this->data['business_types']  = BusinessType::pluck('name', 'id');
        $this->data['capital_range']   = new CapitalRange;
        return view('admin.settings.capital_range.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
       
    //    dd($request->all());
        $request->validate([
            'business_type_id' => 'required',
            'capital_range'    => 'required',
            'licence_fee'      => 'required',
            'business_tax'     => 'required',
        ]);

        $capital_range = new CapitalRange;

        $capital_range->admin_id         = auth()->user()->id;
        $capital_range->business_type_id = $request->input('business_type_id');
        $capital_range->capital_range    = $request->input('capital_range');
        $capital_range->licence_fee      = $request->input('licence_fee');
        $capital_range->business_tax     = $request->input('business_tax');
        $capital_range->signboard_tax    = $request->input('signboard_tax');
        $capital_range->service_charge   = $request->input('service_charge');
        //  dd($capital_range);
        $capital_range->save();

        $request->session()->flash('message', '  ব্যবসার মূলধন পরিসর তথ্য সংরক্ষণ করা হয়েছে। ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->route('admin.settings.capital_ranges.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $this->data['ownership_types'] = OwnershipType::pluck('name', 'id');
        $this->data['business_types']  = BusinessType::pluck('name', 'id');
        $this->data['capital_range'] = CapitalRange::findOrFail($id);
        return view('admin.settings.capital_range.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
       
        $request->validate([
            'business_type_id' => 'required',
            'capital_range'    => 'required',
            'licence_fee'      => 'required',
            'business_tax'     => 'required',
        ]);
        
       
        $capital_range = CapitalRange::query()->findOrFail($id);
        $capital_range->update($request->all());

        $request->session()->flash('message', 'ব্যবসার মূলধন পরিসর তথ্য সংরক্ষণ করা হয়েছে। ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->route('admin.settings.capital_ranges.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
