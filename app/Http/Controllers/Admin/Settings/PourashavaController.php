<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\Zila;
use Illuminate\Http\Request;
use App\Models\Pourashava;
use App\Http\Controllers\Controller;
use App\Models\Division;

class PourashavaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['pourashavas'] = Pourashava::all();
        $this->data['divisions'] = Division::all();
        $this->data['zilas'] = Zila::all();
        return view('admin.settings.pourashava_index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'names.*' => 'required|string',
            'zila_id' => ['required', 'integer', 
                function ($attribute, $value, $fail) {
                    if (! Zila::find($value)) {
                        $fail('The zila is invalid.');
                    }
                },
            ]
        ]);
        
        foreach($request->input('names') as $name) {
            Pourashava::upsert([
                'name'    => $name,
                'zila_id' => $request->input('zila_id'),
            ], 'name');
        }

        $request->session()->flash('message', ' পৌরসভার তথ্য সংরক্ষণ করা হয়েছে। ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pourashava  $Pourashava
     * @return \Illuminate\Http\Response
     */
    public function show(Pourashava $Pourashava)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pourashava  $Pourashava
     * @return \Illuminate\Http\Response
     */
    public function edit(Pourashava $Pourashava)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pourashava  $Pourashava
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pourashava $pourashava)
    {
        $request->validate([
            'names.*' => 'required|string',
            'zila_id' => ['required', 'integer', 
                function ($attribute, $value, $fail) {
                    if (! Zila::find($value)) {
                        $fail('The zila is invalid.');
                    }
                },
            ]
        ]);

        foreach($request->input('names') as $key => $name) {
            if($key == 0) {
                $pourashava->update([
                    'name'    => $name,
                    'zila_id' =>  $request->input('zila_id'),
                ]);
                continue;
            }

            Pourashava::upsert([
                'name'    => $name,
                'zila_id' => $request->input('zila_id'),
            ], 'name');
        }

        $request->session()->flash('message', ' পৌরসভার তথ্য সংরক্ষণ করা হয়েছে। ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pourashava  $Pourashava
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pourashava $Pourashava)
    {
        //
    }
}
