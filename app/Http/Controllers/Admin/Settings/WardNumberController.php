<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\WardNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WardNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $this->data['wardnumbers']=WardNumber::where("admin_id",Auth::guard('admin')->user()->id)->get();
          return view('admin.settings.word_number.index',$this->data);
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
            'numbers.*' => 'required|integer'
        ]);

        foreach($request->input('numbers') as $number) {
            WardNumber::updateOrCreate([
                'number' => $number,
                'admin_id' => auth()->id()
            ]);
        }

        $request->session()->flash('message', ' নতুন ওয়ার্ড সংরক্ষণ করা হলো। ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->back();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WardNumber $wardnumber)
    {
      $request->validate([
          'numbers.*' => 'required|integer'
      ]);

      foreach($request->input('numbers') as $key => $number) {
          if($key == 0) {
              $wardnumber->update([
                  'number' => $number,
                  'admin_id' => auth()->id()
              ]);
              continue;
          }

          WardNumber::updateOrCreate([
              'number' => $number,
              'admin_id' => auth()->id()
          ]);
      }

      $request->session()->flash('message', ' ওয়ার্ড সংরক্ষণ করা হলো। ');
      $request->session()->flash('alert-type', 'success');
      return redirect()->back();
    }
}
