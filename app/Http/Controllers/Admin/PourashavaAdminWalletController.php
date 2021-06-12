<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserWallet;
use App\Models\AdminWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Facades\WalletHelper;
use App\Models\AdminWalletTransaction;

class PourashavaAdminWalletController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $this->data['wallets'] = AdminWallet::query()->where('admin_id', Auth::user()->id)->get();
        return view('admin.pourashava_admin_wallet.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $user = Auth::user();

        $guard = 'admin';
        $request->validate([
            'amount' => 'required|numeric',
        ]);

        

        WalletHelper::request($guard, $user->id, $request->amount);

        $request->session()->flash('message', ' ওয়ালেট  রিকুয়েস্ট  এডমিনের কাছে পাঠানো হয়েছে। ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->back();
    }

    public function get_wallet_request() {

        $poura_admin = auth()->user()->hasRole('pourashava_admin') ? auth()->user() : auth()->user()->parentAdmin;

        $this->data['wallets'] = UserWallet::query()->whereHas('user', function ($query) use ($poura_admin) {
            $query->where('pourashava_id', $poura_admin->pourashava_id);
        })->get();
        return view('admin.pourashava_admin_wallet.get_wallet_request', $this->data);
    }

    public function approve(Request $request, $id) {

        $user  = Auth::user();
        $guard = 'user'; //To Update User Wallet will

        WalletHelper::deposit($guard, $user->id, $id);

        $request->session()->flash('message', 'ওয়ালেট সফালভাবে এ্যাপ্রুভ হয়েছে।');
        $request->session()->flash('alert-type', 'success');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        AdminWallet::query()->findOrFail($id)->update([
            'amount' => $request->amount,
        ]);

        $request->session()->flash('message', 'ওয়ালেট  রিকুয়েস্ট  এডমিনের কাছে পাঠানো হয়েছে। ');
        $request->session()->flash('alert-type', 'success');
        return redirect()->back();

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

    public function transactionHistory(){
       
        $adminWalletTransactions = AdminWalletTransaction::all();
        return view('admin.admin-wallet-history',compact('adminWalletTransactions'));
    }
}
