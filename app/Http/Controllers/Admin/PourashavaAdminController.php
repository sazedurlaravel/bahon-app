<?php

namespace App\Http\Controllers\Admin;

use App\Models\Zila;
use App\Models\Admin;
use App\Models\Division;
use App\Models\Pourashava;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\AdminAccountRenewFee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Facades\MdlSmsHelper;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PourashavaAdminRequest;

class PourashavaAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->data['pourashavaAdmins'] = Admin::role( 'pourashava_admin' )->latest( 'id' )->get();
        return view( 'admin.pourashava_admins.index', $this->data );
    }

    public function deactive() {
        $this->data['pourashavaAdmins'] = Admin::role( 'pourashava_admin' )->deactive()->latest( 'id' )->get();
        return view( 'admin.pourashava_admins.index', $this->data );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      
        $this->data['divisions']   = Division::all();
        $this->data['zilas']       = Zila::all();
        $this->data['pourashavas'] = Pourashava::all();
        return view( 'admin.pourashava_admins.form', $this->data );
        
            $request->session()->flash('message', ' দুঃখিত আপনার পর্যাপ্ত ব্যালেন্স নাই । দয়া করে ব্যালেন্স যোগ করুন ');
            $request->session()->flash('alert-type', 'error');
            return back();
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( PourashavaAdminRequest $request ) {

        //    dd($request->all());
        // generate random password
        $password = rand( 10000000, 99999999 );
        // generate validation end date
        $validTo = date( 'm' ) > 6 ? now()->addYear()->month( 6 )->day( 30 ) : now()->month( 6 )->day( 30 );

        $pourashavaAdmin            = new Admin();
        $pourashavaAdmin->parent_id = auth()->user()->id;
        // picture is exist
        if ( $request->hasFile( 'picture' ) ) {
            $path                     = $request->file( 'picture' )->store( 'admin_profile' );
            $pourashavaAdmin->picture = $path;
        }

        if ( $request->hasFile( 'picture' ) ) {
            $path                             = $request->file( 'pourashava_logo' )->store( 'pourashava_logo' );
            $pourashavaAdmin->pourashava_logo = $path;
        }

        $pourashavaAdmin->name                    = $request->input( 'name' );
        $pourashavaAdmin->email                   = $request->input( 'email' );
        $pourashavaAdmin->mobile                  = $request->input( 'mobile' );
        $pourashavaAdmin->password                = Hash::make( $password );
        $pourashavaAdmin->pourashava_id           = $request->input( 'pourashava_id' );
        $pourashavaAdmin->pourashava_name         = $request->input( 'pourashava_name' );
        $pourashavaAdmin->pourashava_url          = Str::slug( $request->input( 'pourashava_url' ), '_' );
        $pourashavaAdmin->post_code               = $request->input( 'post_code' );
        $pourashavaAdmin->admin_account_renew_fee = $request->input( 'admin_account_renew_fee' );
        $pourashavaAdmin->user_registration_fee   = $request->input( 'user_registration_fee' );
        $pourashavaAdmin->user_account_renew_fee  = $request->input( 'user_account_renew_fee' );
        // validation end date
        $pourashavaAdmin->valid_to = $validTo;
        $pourashavaAdmin->save();

        // assign role
        $pourashavaAdmin->assignRole( 'pourashava_admin' );

        // set admin account renew fee free for first one year
        AdminAccountRenewFee::create( [
            'admin_id'       => $pourashavaAdmin->id,
            'valid_from'     => now(),
            'valid_to'       => $validTo,
            'transaction_id' => 'n/a',
            'pay_from'       => 'n/a',
            'pay_to'         => 'n/a',
            'amount'         => 0,
        ] );

        //Balance minus when registration
       $admin = Admin::find(Auth::user()->id);
      
       //Balance minus when approved
       $admin = Admin::find(Auth::user()->id);
       foreach ($admin->wallets as $key => $walt) {
           AdminWallet::find($walt->id)->update([
                  'amount'=>$walt->amount - $admin->user_registration_fee,
           ]);
       }

        // send password to pourashava admin via sms
        $login_url = route( 'admin.login' );
        $message   = "Welcome to Digital Pouroshova Management System. Your Pouroshova registration has been successful. Email: {$pourashavaAdmin->email} and Password: {$password} to Login {$login_url}. PoweredBy UP Automation & Asessment Fvt.Ltd.";

        // send sms on mobile
        $contact = "88{$pourashavaAdmin->mobile}";
        MdlSmsHelper::send($contact, $message);

        $request->session()->flash( 'message', ' পৌরসভা অ্যাডমিনের তথ্য সংরক্ষণ করা হয়েছে। ' );
        $request->session()->flash( 'alert-type', 'success' );
        return redirect()->route( 'admin.pourashava_admins.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show( Admin $pourashava_admin ) {
        $this->data['pourashavaAdmin'] = $pourashava_admin;
        return view( 'admin.pourashava_admins.show', $this->data );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit( Admin $pourashava_admin ) {
        $this->data['divisions']       = Division::all();
        $this->data['zilas']           = Zila::all();
        $this->data['pourashavas']     = Pourashava::all();
        $this->data['pourashavaAdmin'] = $pourashava_admin;
        return view( 'admin.pourashava_admins.form', $this->data );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update( PourashavaAdminRequest $request, Admin $pourashava_admin ) {
        // picture is exist
        if ( $request->hasFile( 'picture' ) ) {
            // delete old picture if exist
            Storage::delete( $pourashava_admin->picture );
            $path                      = $request->file( 'picture' )->store( 'admin_profile' );
            $pourashava_admin->picture = $path;
        }

        if ( $request->hasFile( 'pourashava_logo' ) ) {
              // delete old picture if exist
              Storage::delete( $pourashava_admin->pourashava_logo );
            $path                              = $request->file( 'pourashava_logo' )->store( 'pourashava_logo' );
            $pourashava_admin->pourashava_logo = $path;
        }
        $pourashava_admin->name   = $request->input( 'name' );
        $pourashava_admin->email  = $request->input( 'email' );
        $pourashava_admin->mobile = $request->input( 'mobile' );
        $pourashava_admin->pourashava_name= $request->input( 'pourashava_name' );

        $pourashava_admin->admin_account_renew_fee = $request->input( 'admin_account_renew_fee' );
        $pourashava_admin->user_registration_fee   = $request->input( 'user_registration_fee' );
        $pourashava_admin->user_account_renew_fee  = $request->input( 'user_account_renew_fee' );
        $pourashava_admin->save();

        $request->session()->flash( 'message', ' পৌরসভা অ্যাডমিনের তথ্য সংরক্ষণ করা হয়েছে। ' );
        $request->session()->flash( 'alert-type', 'success' );
        return redirect()->route( 'admin.pourashava_admins.index' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy( Admin $pourashava_admin ) {
        //
    }
}
