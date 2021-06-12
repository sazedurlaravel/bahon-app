<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\OwnershipType;
use Illuminate\Http\Request;

class OwnershipTypeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->data['ownerships'] = OwnershipType::all();
        return view('admin.settings.ownership_type', $this->data);
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
            'names.*' => 'required|string',
        ]);

        foreach ($request->input('names') as $name) {
            OwnershipType::updateOrCreate([
                'admin_id' => auth()->user()->id,
                'name'     => $name,
            ]);
        }

        $request->session()->flash('message', ' নতুন মালিকানার ধরণ সংরক্ষণ করা হয়েছে ');
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
            'names.*' => 'required|string',
        ]);

        foreach ($request->input('names') as $key => $name) {
            if ($key == 0) {
                $ownershipType = OwnershipType::findOrFail($id);
                $ownershipType->update([
                    'name' => $name,
                ]);
                continue;
            }

            OwnershipType::updateOrCreate([
                'admin_id' => auth()->user()->id,
                'name'     => $name,
            ]);
        }

        $request->session()->flash('message', 'মালিকানার ধরণ সংরক্ষণ করা হয়েছে ');
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
