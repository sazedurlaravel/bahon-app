<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\ValidPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show edit profile form
     */
    public function editProfile()
    {
        return view('admin.auth.edit-profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:admins,email,'.Auth::user()->id,
        ]);

        //save name and email
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
        $request->session()->flash('message', 'Profile saved.');
        $request->session()->flash('alert-type', 'success');
        return back();
    }

    /**
     * Show change password form
     */
    public function changePassword()
    {
        return view('admin.auth.change-password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'min:8', new ValidPassword],
            'new_password' => 'required|confirmed|min:8',
        ]);

        //save password
        $user = Auth::user();
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        $request->session()->flash('message', 'Password Changed.');
        $request->session()->flash('alert-type', 'success');
        return back();
    }
}
