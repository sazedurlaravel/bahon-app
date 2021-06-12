<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Zila;
use Illuminate\Http\Request;

class ZilaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['zilas'] = Zila::all();
        $this->data['divisions'] = Division::all();
        return view('admin.settings.zila_index', $this->data);
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
            'division_id' => ['required', 'integer', 
                function ($attribute, $value, $fail) {
                    if (! Division::find($value)) {
                        $fail('The division is invalid.');
                    }
                },
            ]
        ]);
        
        foreach($request->input('names') as $name) {
            Zila::upsert([
                'name'        => $name,
                'division_id' => $request->input('division_id'),
            ], 'name');
        }

        $request->session()->flash('message', 'Zila Saved.');
        $request->session()->flash('alert-type', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zila  $zila
     * @return \Illuminate\Http\Response
     */
    public function show(Zila $zila)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zila  $zila
     * @return \Illuminate\Http\Response
     */
    public function edit(Zila $zila)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zila  $zila
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zila $zila)
    {
        $request->validate([
            'names.*' => 'required|string',
            'division_id' => ['required', 'integer', 
                function ($attribute, $value, $fail) {
                    if (! Division::find($value)) {
                        $fail('The division is invalid.');
                    }
                },
            ]
        ]);
        
        foreach($request->input('names') as $key => $name) {
            if($key == 0) {
                $zila->update([
                    'name'        => $name,
                    'division_id' => $request->input('division_id'),
                ]);
                continue;
            }

            Zila::upsert([
                'name'        => $name,
                'division_id' => $request->input('division_id'),
            ], 'name');
        }

        $request->session()->flash('message', 'Zila Saved.');
        $request->session()->flash('alert-type', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zila  $zila
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zila $zila)
    {
        //
    }
}
