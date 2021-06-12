<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Zila;
use App\Models\Village;
use App\Models\Division;
use App\Models\Pourashava;
use App\Models\WardNumber;
use App\Models\VehicleType;
use App\Models\BusinessType;
use Illuminate\Http\Request;
use App\Models\OwnershipType;
use App\Models\BusinessHolderUser;
use App\Http\Controllers\Controller;
use App\Helpers\Facades\MdlSmsHelper;
use App\Http\Requests\BusinessHolderRequest;

class BusinessHolderUserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (auth()->user()->hasRole('pourashava_admin') || auth()->user()->hasRole('digital_center_admin')) {
            $pourashavaAdmin     = auth()->user()->hasRole('pourashava_admin') ? auth()->user() : auth()->user()->parentAdmin;
            $this->data['users'] = User::where('pourashava_admin_id', $pourashavaAdmin->id)->latest('id')->get();
        } else {
            $this->data['users'] = User::latest('id')->get();
        }

        return view('admin.business-holders.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $pourashavaAdmin        = auth()->user()->hasRole('pourashava_admin') ? auth()->user() : auth()->user()->parentAdmin;
        $this->data['wards']    = WardNumber::query()->where('admin_id', $pourashavaAdmin->id)->pluck('number', 'id');
        $this->data['villages'] = Village::pluck('name', 'id');
        
        $pourashavaAdmin = auth()->user()->hasRole('pourashava_admin') ? auth()->user() : auth()->user()->parentAdmin;
        $this->data['vehicleTypes'] = $pourashavaAdmin->vehicleTypes;
        $this->data['divisions'] = Division::all();
        $this->data['zilas'] = Zila::all();
        $this->data['pourashavas'] = Pourashava::all();
        $this->data['user'] = new User;
        return view('admin.business-holders.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BusinessHolderRequest $request) {

        dd('okk');
         // check permission
         if(auth()->user()->cannot('create_user')) {
            return abort(403);
        }

        // check transaction valid or not


        // generate random password
        $password = rand(10000000, 99999999);
        // generate validation end date
        $validTo = date('m') > 6 ? now()->addYear()->month(6)->day(30) : now()->month(6)->day(30);

        /**
         * get pourashavaAdmin
         * if pourashava admin , get direct auth
         * elseif digital uddogta admin, get auth parentAdmin
         */
        $pourashavaAdmin = auth()->user()->hasRole('pourashava_admin') ? auth()->user() : auth()->user()->parentAdmin;
        
        // get generate registration no
        $previousRegistrationNo = User::where('pourashava_admin_id', $pourashavaAdmin->id)->latest('id')->first();

        $registrationNo = strval($previousRegistrationNo ? intval($previousRegistrationNo->registration_no) + 1 : intval($pourashavaAdmin->post_code . '000001'));

        $user                      = new User();
        $user->admin_id            = auth()->user()->id;
        $user->pourashava_admin_id = $pourashavaAdmin->id;
        $user->registration_no     = $registrationNo;
        // picture is exist
        if($request->hasFile('picture')) {
            $path          = $request->file('picture')->store('user_profile');
            $user->picture = $path;
        }
        $user->vehicle_type_id        = $request->input('vehicle_type_id');
        $user->name                   = $request->input('name');
        $user->email                  = $request->input('email');
        $user->mobile                 = $request->input('mobile');
        $user->password               = Hash::make($password);
        $user->father_or_husband_name = $request->input('father_or_husband_name');
        $user->mother_name            = $request->input('mother_name');
        $user->village                = $request->input('village');
        $user->word_no                = $request->input('word_no');
        $user->age                    = $request->input('age');
        $user->birth_day              = $request->input('birth_day');
        $user->nid_no                 = $request->input('nid_no');
        $user->pourashava_id          = $request->input('pourashava_id');
        $user->post_code              = $request->input('post_code');
        $user->permanent_address      = $request->input('permanent_address');
        $user->valid_to               = $validTo;
        $user->save();

        // store user registration pay info
        $userRegistrationFee = UserRegistrationFee::create([
            'user_id'        => $user->id,
            'transaction_id' => $request->input('transaction_id'),
            'pay_from'       => $request->input('pay_from'),
            'pay_to'         => 'n/a',
            'amount'         => $pourashavaAdmin->user_registration_fee,
        ]);

        // set user account renew fee free for first one year
        UserAccountRenewFee::create([
            'user_id'       => $user->id,
            'valid_from'     => now(),
            'valid_to'       => $validTo,
            'transaction_id' => 'n/a',
            'pay_from'       => 'n/a',
            'pay_to'         => 'n/a',
            'amount'         => 0,
        ]);

        // send password to user via sms
        $login_url = url('/');
        $message = "Welcome to Digital Pouroshova Management System. Your Pouroshova registration has been successful. Email: {$user->email} and Password: {$password} to Login {$login_url}. PoweredBy UP Automation & Asessment Fvt.Ltd.";
        $registrationMessage = "{$user->name}, your Online Registration Successfully.bahon Card Charge Paid BDT. {$pourashavaAdmin->user_registration_fee}TK. Payment by UP E- Wallet Tnx.ID {$userRegistrationFee->transaction_id}. Card Delivery Date {$user->created_at->format('d-m-Y')} Powered By Savar Paurashava.";
        // send sms on mobile
        $contact = "88{$user->mobile}";
        MdlSmsHelper::send($contact, $message);
        MdlSmsHelper::send($contact, $registrationMessage);

        $request->session()->flash('message', ' সেবা ব্যবহারকারীর তথ্য সংরক্ষণ করা হয়েছে ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->route('admin.business-holders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $this->data['user'] = User::query()->findOrFail($id);
        return view('admin.business-holders.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $this->data['wards']    = WardNumber::pluck('number', 'id');
        $this->data['villages'] = Village::pluck('name', 'id');

        $this->data['user'] = User::findOrFail($id);

        return view('admin.business-holders.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        if (auth()->user()->hasRole('super_admin')) {
            $user = User::query()->findOrFail($id);
            $user->update($request->all());
            $card_no = $request->card_no;
            $pin_no  = $request->pin_no;
            $message = "{$user->name}  Your Card Number: {$card_no} And Pin Number {$pin_no}";
            // send sms on mobile
            $contact = "88{$user->mobile}";
            MdlSmsHelper::send($contact, $message);

            // send sms on mobile

            //   $contacts = "88{$user->mobile}";
            // $this->mdlSmsSend($contacts, $message);

            $request->session()->flash('message', ' সেবা ব্যবহারকারীর তথ্য আপডেট  হয়েছে ');
            $request->session()->flash('alert-type', 'success');
            return redirect()->route('admin.business_holders.index');

        } else {

        }
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
