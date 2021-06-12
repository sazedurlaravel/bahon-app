<?php

namespace App\Http\Controllers\PourashavaFrontend;

use App\Models\User;
use App\Models\Admin;
use App\Models\UserWallet;
use App\Models\Information;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Facades\WalletHelper;
use App\Models\UserWalletTransaction;

class HomeController extends Controller
{
    public function index($pourashava_slug)
    {
        if(Admin::role('pourashava_admin')->where('pourashava_url', $pourashava_slug)->exists())
        {
            $this->data['pname']=Admin::role('pourashava_admin')->where('pourashava_url', $pourashava_slug)->first();
            if($this->data){
                $super=Admin::role('pourashava_admin')->first();
                $this->data['information']=Information::where("admin_id",$super->id)->first();
                $this->data['pourashava_slug']=$pourashava_slug;
                return view('pourashava_frontend.index',$this->data);
            }

            // $super=Admin::role('pourashava_admin')->first();
            // $this->data['information']=Information::where("admin_id",$super->id)->first();
            // return($this->data);
            // return view('pourashava_frontend.index',$this->data);
            
            return view('pourashava_frontend.index', compact('pourashava_slug'));
        }

        return abort(404);
    }
    
    /**
     * User dashboard
     *
     * @param string $pourashava_slug
     * 
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function dashboard($pourashava_slug)
    {
        if (auth()->user() && auth()->user()->pourashavaAdmin->pourashava_url === $pourashava_slug) {
            return view('user.home', compact('pourashava_slug'));
        }

        return back();
    }

    public function userWallet($pourashava_slug) {
        if (Admin::role('pourashava_admin')->where('pourashava_url', $pourashava_slug)->exists()) {
            $userId  = session('userInfo')['userId'];
            $wallets = UserWallet::query()->where('user_id', $userId)->get();
            return view('pourashava_frontend.wallet', compact('pourashava_slug', 'wallets'));
        }
        return abort(404);

    }

    public function walletRequest(Request $request) {
        $pourashava_slug = $request->pourashava_slug;

        if (Admin::role('pourashava_admin')->where('pourashava_url', $pourashava_slug)->exists()) {
            $user = session('userInfo');

            $guard = 'user';
            $request->validate([
                'amount' => 'required|numeric',
            ]);

            WalletHelper::request($guard, $user['userId'], $request->amount);

            $request->session()->flash('message', ' ওয়ালেট  রিকুয়েস্ট  এডমিনের কাছে পাঠানো হয়েছে। ');
            $request->session()->flash('alert-type', 'success');
            return redirect()->back();
        }
        return abort(404);

    }

    public function walletUpdate(Request $request, $pourashava_slug, $wallet_id) {

        if (Admin::role('pourashava_admin')->where('pourashava_url', $pourashava_slug)->exists()) {
            $userId = session('userInfo')['userId'];

            UserWallet::query()->findOrFail($wallet_id)->update([
                'amount' => $request->amount,
            ]);

            $request->session()->flash('message', 'ওয়ালেট  রিকুয়েস্ট  এডমিনের কাছে পাঠানো হয়েছে। ');
            $request->session()->flash('alert-type', 'success');
            return redirect()->back();
        }

        return back();
    }

    public function transactionHistory($pourashava_slug){
        if (auth()->user() && auth()->user()->pourashavaAdmin->pourashava_url === $pourashava_slug) {

            $user =User::find(Auth::user()->id);
            foreach($user->wallets as $wallet)  {
                $id = $wallet->id;
            }
            $userWalletTransactions = UserWalletTransaction::where('wallet_id',$id)->get();

            return view('pourashava_frontend.user-wallet-transaction',compact('userWalletTransactions'));
        }
    }
}
