<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Facades\FileStorageHelper;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Facades\MdlSmsHelper;
use App\Http\Requests\DigitalCenterAdminRequest;

class DigitalCenterAdminController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['digitalCenterAdmins'] = Admin::role('digital_center_admin')->latest('id')->get();
        return view('admin.digital_center_admins.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.digital_center_admins.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DigitalCenterAdminRequest $request)
    {
        // generate random password
        $password = rand(10000000, 99999999);

        $digital_center_admin           = new Admin();
        $digital_center_admin->parent_id = auth()->user()->id;
        
        // upload picture
        $path = FileStorageHelper::upload($request->file('picture'), 'admin_profile', null, 300, 300);
        $path && $digital_center_admin->picture = $path;
        
        $digital_center_admin->name          = $request->input('name');
        $digital_center_admin->designation          = $request->input('designation');
        $digital_center_admin->email         = $request->input('email');
        $digital_center_admin->mobile        = $request->input('mobile');
        $digital_center_admin->password      = Hash::make($password);
        $digital_center_admin->save();

        // assign role
        $digital_center_admin->assignRole('digital_center_admin');

        // send password to pourashava admin via sms
        $login_url = route('admin.login');
        $message = "Welcome to Digital Pouroshova Management System. Your Pouroshova registration has been successful. Email: {$digital_center_admin->email} and Password: {$password} to Login {$login_url}. PoweredBy UP Automation & Asessment Fvt.Ltd.";
        
        // send sms on mobile
        $contact = "88{$digital_center_admin->mobile}";
        MdlSmsHelper::send($contact, $message);

        $request->session()->flash('message', ' ডিজিটাল উদ্যোক্তা অ্যাডমিনের তথ্য সংরক্ষণ করা হয়েছে। ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->route('admin.digital_center_admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $digital_center_admin)
    {
        $this->data['digitalCenterAdmin'] = $digital_center_admin;
        return view('admin.digital_center_admins.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $digital_center_admin)
    {
        $this->data['digitalCenterAdmin'] = $digital_center_admin;
        return view('admin.digital_center_admins.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(DigitalCenterAdminRequest $request, Admin $digital_center_admin)
    {
        // upload picture
        $path = FileStorageHelper::upload($request->file('picture'), 'admin_profile', $digital_center_admin->picture, 300, 300);
        $path && $digital_center_admin->picture = $path;
        
        $digital_center_admin->name        = $request->input('name');
        $digital_center_admin->email       = $request->input('email');
        $digital_center_admin->mobile      = $request->input('mobile');
        $digital_center_admin->save();

        $request->session()->flash('message', ' ডিজিটাল উদ্যোক্তা অ্যাডমিনের তথ্য সংরক্ষণ করা হয়েছে। ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->route('admin.digital_center_admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $digital_center_admin)
    {
        //
    }
}
