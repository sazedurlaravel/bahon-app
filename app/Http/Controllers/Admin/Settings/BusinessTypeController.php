<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\BusinessType;
use App\Models\OwnershipType;
use Illuminate\Http\Request;

class BusinessTypeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->data['business_types'] = BusinessType::all();
        $this->data['ownerships']     = OwnershipType::all();
        return view('admin.settings.business_type', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
       

        $request->validate([
            'names.*'            => 'required|string',
            'ownership_type_id' => ['required', 'integer',
                function ($attribute, $value, $fail) {
                    if (!OwnershipType::find($value)) {
                        $fail('The Ownership is invalid.');
                    }
                },
            ],
        ]);

        foreach ($request->input('names') as $name) {
            BusinessType::upsert([
                'admin_id'           => auth()->user()->id,
                'name'               => $name,
                'ownership_type_id' => $request->input('ownership_type_id'),
            ], 'name');
        }

        $request->session()->flash('message', ' নতুন ব্যবসার ধরণ সংরক্ষণ করা হয়েছে।');
        $request->session()->flash('alert-type', 'success');
        return redirect()->back();
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
        //
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
            'names.*'            => 'required|string',
            'ownership_type_id' => ['required', 'integer',
                function ($attribute, $value, $fail) {
                    if (!OwnershipType::find($value)) {
                        $fail('The Ownership is invalid.');
                    }
                },
            ],
        ]);

        //    dd( BusinessType::findOrFail($id));

        foreach ($request->input('names') as $name) {

            $businessType = BusinessType::findOrFail($id);
            $businessType->update([
                'admin_id'           => auth()->user()->id,
                'name'               => $name,
                'ownership_type_id' => $request->input('ownership_type_id'),
            ]);
            continue;
        }

        $request->session()->flash('message', 'ব্যবসার ধরণ সংরক্ষণ করা হয়েছে।');
        $request->session()->flash('alert-type', 'success');
        return redirect()->back();
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
