<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Village;
use App\Models\WardNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $this->data['wardnumbers'] = WardNumber::where("admin_id",Auth::guard('admin')->user()->id)->get();
      $this->data['villages'] = Village::where("admin_id",Auth::guard('admin')->user()->id)->get();
      return view('admin.settings.village.index', $this->data);
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
            'wardnumber_id' => ['required','integer',
                function ($attribute, $value, $fail) {
                    if (! WardNumber::find($value)) {
                        $fail('The wardnumber is invalid.');
                    }
                },
            ]
        ]);

        foreach($request->input('names') as $name) {
            Village::upsert([
                'name'        => $name,
                'wardnumber_id' => $request->input('wardnumber_id'),
                'admin_id' => auth()->id()
            ], 'name');
        }

        $request->session()->flash('message', 'নতুন গ্রাম সংরক্ষণ করা হলো।');
        $request->session()->flash('alert-type', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Village $village)
    {
      $request->validate([
          'names.*' => 'required|string',
          'wardnumber_id' => ['required', 'integer',
              function ($attribute, $value, $fail) {
                  if (! WardNumber::find($value)) {
                      $fail('The wardnumbe is invalid.');
                  }
              },
          ]
      ]);

      foreach($request->input('names') as $key => $name) {

          if($key == 0) {
              $village->update([
                  'name'        => $name,
                  'wardnumber_id' => $request->input('wardnumber_id'),
                  'admin_id' => auth()->id()
              ]);
              continue;
          }
          Village::upsert([
              'name'        => $name,
              'wardnumber_id' => $request->input('wardnumber_id'),
              'admin_id' => auth()->id(),
          ], 'name');
      }

      $request->session()->flash('message', 'গ্রাম সংরক্ষণ করা হলো।');
      $request->session()->flash('alert-type', 'success');
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
