<?php

namespace App\Http\Controllers\PourashavaFrontend;

use Auth;
use App\Models\Information;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PourashavaInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->data['informations'] = Information::where("admin_id",Auth::guard('admin')->user()->id)->latest('id')->get();
      return view('pourashava_frontend.information.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pourashava_frontend.information.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $information =new Information();

      $information->admin_id            = auth()->user()->id;
      // picture is exist
      if ( $request->hasFile( 'logo' ) ) {
          $path                     = $request->file( 'logo' )->store( 'logo' );
          $information->logo = $path;
      }

      $information->name            = $request->name;
      $information->youtube_url            = $request->youtube_url;
      $information->facebook_url          = $request->facebook_url;



      $information->save();
      $request->session()->flash( 'message', ' information তথ্য সংরক্ষণ করা হয়েছে ' );
      $request->session()->flash( 'alert-type', 'success' );
      return redirect()->route( 'admin.settings.pourashava_information.create' );
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
      $this->data['information']=Information::find($id);
      return view('pourashava_frontend.information.edit',  $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // picture is exist
      $information = Information::find($id);
      if ( $request->hasFile( 'logo' ) ) {
          // delete old picture if exist
        Storage::delete( $information->logo );
          $path                     = $request->file( 'logo' )->store( 'logo' );
          $information->logo = $path;
      }


      $information->admin_id            = auth()->user()->id;

      $information->name            = $request->name;
      $information->youtube_url            = $request->youtube_url;
      $information->facebook_url          = $request->facebook_url;



      $information->save();
      $request->session()->flash( 'message', ' information তথ্য সংরক্ষণ করা হয়েছে ' );
      $request->session()->flash( 'alert-type', 'success' );
      return redirect()->route( 'admin.settings.pourashava_information.create' );
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
