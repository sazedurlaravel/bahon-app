<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Facades\WalletHelper;
use App\Http\Controllers\Controller;
use App\Models\AdminWallet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller {

    public function index() {

        $user_id = 1;
        $amount  = 500;
        $guard   = "admin";
        $service = "Trade Licence";

        // $this->deposit($guard , $user_id, $amount);//Balance Transfer Admin to User

        // $this->payment($guard, $user_id, $service, $amount);//Payment by User

        $this->data['wallets'] = AdminWallet::query()->where('status', 0)->get();
        return view('admin.wallet', $this->data);

    }
    public function approve(Request $request, $id) {

        $user  = Auth::user();
        $guard = 'admin';

        WalletHelper::deposit($guard, $user->id, $id);

        $request->session()->flash('message', 'ওয়ালেট সফালভাবে এ্যাপ্রুভ হয়েছে।');
        $request->session()->flash('alert-type', 'success');
        return redirect()->back();
    }

    public function create() {
        return view('admin.pourashava_admin_wallet.form');
    }

    public function store(Request $request) {

    }

    public function show(AdminWallet $wallet) {
        //
    }

    public function edit(AdminWallet $walllet) {
        //
    }

    public function update(Request $request, AdminWallet $wallet) {
        //
    }

    public function destroy() {

    }

}