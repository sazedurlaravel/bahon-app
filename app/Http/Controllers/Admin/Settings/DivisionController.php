<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Facades\DivisionRepository;

class DivisionController extends Controller
{
    private $division;

    public function __construct(DivisionRepository $division)
    {
        $this->division = $division;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['divisions'] = $this->division::all();
        return view('admin.settings.division_index', $this->data);
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
            'names.*' => 'required|string'
        ]);
        
        foreach($request->input('names') as $name) {
            Division::updateOrCreate([
                'name' => $name
            ]);
        }

        $request->session()->flash('message', ' নতুন বিভাগটি সংরক্ষণ করা হলো। ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(Division $division)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Division $division)
    {
        $request->validate([
            'names.*' => 'required|string'
        ]);
        
        foreach($request->input('names') as $key => $name) {
            if($key == 0) {
                $division->update([
                    'name' => $name
                ]);
                continue;
            }
            
            Division::updateOrCreate([
                'name' => $name
            ]);
        }

        $request->session()->flash('message', ' বিভাগটি সংরক্ষণ করা হলো। ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Division $division)
    {
        if(count($division->zilas)) {

        }
    }
}
