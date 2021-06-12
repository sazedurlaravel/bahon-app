<?php

namespace App\Helpers;

use DateTime;
use App\Models\Admin;
use App\Models\UserWallet;
use App\Models\AdminWallet;
use Illuminate\Support\Facades\Auth;
use App\Models\UserWalletTransaction;
use App\Models\AdminWalletTransaction;

class WalletHelper {
    public function request($guard, $user_id, $amount) {
        //Check User Role to Wallet Request Into UserWallet or AdminWallet

        if ($guard == 'admin') {
            $wallet = new AdminWallet;
            $column = 'admin_id';
        } elseif ($guard == 'user') {
            $wallet = new UserWallet;
            $column = 'user_id';
            // $data['pourashava_id'] = session('userInfo')['pourashavaId'] ? session('userInfo')['pourashavaId'] : null;
        }

        $data[$column]  = $user_id;
        $data['amount'] = $amount;
        $data['date']   = new DateTime();

        $wallet->create($data);

    }
    public function deposit($guard, $user_id, $id) {
        //Check User role to deposit Into UserWallet or AdminWallet

        if ($guard == 'admin') {
            $wallet         = new AdminWallet;
            $data['status'] = 1;

            //Balance minus when approved
            $admin = Admin::find(Auth::user()->id);
            $adminWallet = AdminWallet::find($id);
            foreach ($admin->wallets as $key => $walt) {
               
                AdminWallet::find($walt->id)->update([
                    'amount'=>$walt->amount - $adminWallet->amount,
                ]);
            }
    
           

        } elseif ($guard == 'user') {
            $wallet           = new UserWallet;
            

            //Balance minus when approved
            $admin = Admin::find(Auth::user()->id);
            $userWallet = UserWallet::find($id);
            foreach ($admin->wallets as $key => $walt) {
                AdminWallet::find($walt->id)->update([
                       'amount'=>$walt->amount - $userWallet->amount,
                ]);
            }

            $data['status']   = 1;
            $data['admin_id'] = $user_id;
        }
        $wallet->query()->findOrFail($id)->update($data);
    

    }
    public function payment($guard, $user_id, $service, $amount) {
        //Check User role to create transaction for  UserWalletTransaction or AdminWalletTransactionor

        if ($guard == 'admin') {
            $wallet             = new AdminWallet;
            $wallet_transaction = new AdminWalletTransaction;
            $column             = 'admin_id';
        } elseif ($guard == 'user') {
            $wallet             = new UserWallet;
            $column             = 'user_id';
            $wallet_transaction = new UserWalletTransaction;
        }
        $result = $wallet->where($column, $user_id)->first();

        // check Sufficient Balance
        if ($result->balance > $amount) {
            // generate random transaction  id
            $transaction_id         = rand(10000000, 99999999);
            $data['wallet_id']      = $result->id;
            $data['transaction_id'] = $transaction_id;
            $data['amount']         = $amount;
            $data['service_name']   = $service;
            $wallet_transaction->create($data);
        } else {
            return 'You Do not Have Sufficient Balance';
        }

    }
}