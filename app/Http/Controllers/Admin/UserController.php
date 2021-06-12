<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\User;
use App\Models\Zila;
use App\Models\Admin;
use App\Models\Division;
use App\Models\Pourashava;
use App\Models\UserWallet;
use App\Models\AdminWallet;
use App\Models\VehicleType;
use App\Helpers\MdlSmsTrait;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\UserAccountRenewFee;
use App\Models\UserRegistrationFee;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Facades\MdlSmsHelper;
use App\Models\UserWalletTransaction;
use App\Models\AdminWalletTransaction;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // check permission
        if(auth()->user()->cannot('view_user')) {
            return abort(403);
        }

        if(auth()->user()->hasRole('pourashava_admin') || auth()->user()->hasRole('digital_uddogta_admin')) {
            $pourashavaAdmin = auth()->user()->hasRole('pourashava_admin') ? auth()->user() : auth()->user()->parentAdmin;
            $this->data['users'] = User::where('pourashava_admin_id', $pourashavaAdmin->id)->latest('id')->get();
        } else {
            $this->data['users'] = User::latest('id')->get();
        }

        return view('admin.users.index', $this->data);
    }

    public function deactive()
    {
        // check permission
        if(auth()->user()->cannot('view_user')) {
            return abort(403);
        }

        if(auth()->user()->hasRole('pourashava_admin') || auth()->user()->hasRole('digital_uddogta_admin')) {
            $pourashavaAdmin = auth()->user()->hasRole('pourashava_admin') ? auth()->user() : auth()->user()->parentAdmin;
            $this->data['users'] = User::deactive()->where('pourashava_admin_id', $pourashavaAdmin->id)->latest('id')->get();
        } else {
            $this->data['users'] = User::deactive()->latest('id')->get();
        }

        return view('admin.users.index', $this->data);
    }

    public function card(User $user)
    {
       
        // check permission
        if(auth()->user()->cannot('view_user')) {
            return abort(403);
        }

            $this->data['user'] = $user;
            // return view('admin.users.card', $this->data);
            return $pdf = PDF::loadView('admin.users.card', $this->data);
            // return $pdf->stream($this->data['user']->registration_no . '.pdf');

        // $data['user'] = $user;
        // $pdf = PDF::loadView('admin.users.card', $data);
  
        // return $pdf->download($data['user']->registration_no . '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
        // check permission
        if(auth()->user()->cannot('create_user')) {
            return abort(403);
        }

       //Balance minus when approved
       $admin = Admin::find(Auth::user()->id);
      
       foreach ($admin->wallets as $key => $walt) {
           $wallet = AdminWallet::find($walt->id);
           $balance = $wallet->amount;
           
       }

    
       if ($balance >= $admin->user_registration_fee) {
            $pourashavaAdmin = auth()->user()->hasRole('pourashava_admin') ? auth()->user() : auth()->user()->parentAdmin;
            $this->data['vehicleTypes'] = VehicleType::all();
            $this->data['divisions'] = Division::all();
            $this->data['zilas'] = Zila::all();
            $this->data['pourashavas'] = Pourashava::all();
            return view('admin.users.form', $this->data);

       }else{
        $request->session()->flash('message', ' দুঃখিত আপনার পর্যাপ্ত ব্যালেন্স নাই । দয়া করে ব্যালেন্স যোগ করুন ');
        $request->session()->flash('alert-type', 'error');
        return back();
       }

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
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
        $user->card_no                  = $request->input('card_no');
        $user->pin_no                 = $request->input('pin_no');
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

         //Balance minus when registration
       $admin = Admin::find(Auth::user()->id);
      
       //Balance minus when approved
       $admin = Admin::find(Auth::user()->id);
       foreach ($admin->wallets as $key => $walt) {
           $x = $walt;
          
           
       } 
       AdminWallet::find($x->id)->update([
                  'amount'=>$x->amount - $admin->user_registration_fee,
           ]);

       AdminWalletTransaction::create([
           'wallet_id'=>$x->id,
           'transaction_id'=>$request->input('transaction_id'),
           'amount'=>$admin->user_registration_fee,
           'service_name'=>'User Registration'
       ]);

       UserWallet::create([
        'user_id'=>$user->id,
        'amount'=>$admin->user_registration_fee,
        'status'=>"1",
        ]);

       foreach ($user->wallets as $key => $walt) {
        $y = $walt;
       
          
    } 
    
    UserWallet::find($y->id)->update([
            'amount'=>$y->amount - $admin->user_registration_fee,
            ]);

    UserWalletTransaction::create([
        'wallet_id'=>$y->id,
        'transaction_id'=>$request->input('transaction_id'),
        'amount'=>$admin->user_registration_fee,
        'service_name'=>'Registration Fee'
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
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // check permission
        if(auth()->user()->cannot('view_user')) {
            return abort(403);
        }

        $this->data['user'] = $user;
        return view('admin.users.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // check permission
        if(auth()->user()->cannot('edit_user')) {
            return abort(403);
        }

        $pourashavaAdmin = auth()->user()->hasRole('pourashava_admin') ? auth()->user() : auth()->user()->parentAdmin;
        $this->data['vehicleTypes'] = $pourashavaAdmin->vehicleTypes;
        $this->data['divisions'] = Division::all();
        $this->data['zilas'] = Zila::all();
        $this->data['pourashavas'] = Pourashava::all();
        $this->data['user'] = $user;
        return view('admin.users.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // check permission
        if(auth()->user()->cannot('edit_user')) {
            return abort(403);
        }

        // picture is exist
        if($request->hasFile('picture')) {
            // delete old picture if exist
            Storage::delete($user->picture);
            $path          = $request->file('picture')->store('user_profile');
            $user->picture = $path;
        }
        $user->name                   = $request->input('name');
        $user->email                  = $request->input('email');
        $user->mobile                 = $request->input('mobile');
        $user->father_or_husband_name = $request->input('father_or_husband_name');
        $user->mother_name            = $request->input('mother_name');
        $user->age                    = $request->input('age');
        $user->save();

        $request->session()->flash('message', ' সেবা ব্যবহারকারীর তথ্য সংরক্ষণ করা হয়েছে ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
