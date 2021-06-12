<?php

namespace App\Http\Controllers\PourashavaFrontend;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Facades\MdlSmsHelper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show login form for porosova user
     *
     * @param string $pourashava_slug
     * 
     * @return void
     */
    public function login($pourashava_slug)
    {
        if (Admin::role('pourashava_admin')->where('pourashava_url', $pourashava_slug)->exists()) {
            return view('user.auth.login', compact('pourashava_slug'));
        }

        return back();
    }

    /**
     * login the user
     *
     * @param Request $request
     * @param string $pourashava_slug
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $pourashava_slug)
    {
        $request->validate([
            'card_no' => 'required|string',
            'pin_no' => 'required|string'
        ],
        [
            'card_no.required' => 'কার্ড নাম্বার দিন',
            'pin_no.required' => 'পিন নাম্বার দিন'
        ]);

        $user = User::where('card_no', $request->card_no)->where('pin_no', $request->pin_no)->first();

        if ($user && $user->pourashavaAdmin->pourashava_url === $pourashava_slug) {

            $uniqueNumber  = random_int(100000, 999999);

            $message = 'Your OTP code is: ' . $uniqueNumber;
            
            // send otp sms on mobile
            $contact = "88{$user->mobile}";
            MdlSmsHelper::send($contact, $message);

            $mobile = substr($user->mobile, -4);

            $token = uniqid($mobile);

            session()->put('userInfo', ['userId' => $user->id , 'email' => $user->email, 'token' => $token]);

            Cache::put($user->email, $uniqueNumber, 60);

            return redirect()->to('/' . $pourashava_slug .'/user/login/otp?token=' . $token);
        }

        // wrong card no or pin no
        throw ValidationException::withMessages([
            'card_no' => "আপনি ভুল কার্ড নাম্বার বা পিন নাম্বার দিয়েছেন।",
        ]);

        return back();
    }

    public function loginOtp(Request $request, $pourashava_slug)
    {
        if (Admin::role('pourashava_admin')->where('pourashava_url', $pourashava_slug)->exists()) {
            $token = $request->query('token');

            $user = session('userInfo');

            if (!$user || $token !== $user['token'] || !cache($user['email'])) {
                session()->forget('userInfo');
                return redirect()->route('pourashava_frontend.user.login', $pourashava_slug);
            }

            return view('user.auth.login-otp', compact('pourashava_slug'));
        }

        return back();
    }

    /**
     * Check otp for login
     *
     * @param Request $request
     * @param string $pourashava_slug
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function otpCheck(Request $request, $pourashava_slug)
    {
        if (Admin::role('pourashava_admin')->where('pourashava_url', $pourashava_slug)->exists()) {
            $this->validate(
                $request,
                [
            'otp' => 'required'
        ],
                [
            'otp.required' => 'আপনি OPT দেন নাই, OTP দিন।'
        ]
            );
        
            $user = session('userInfo');
        
            if (!$user || $request->token !== $user['token'] || !cache($user['email'])) {
                session()->forget('userInfo');

                return response()->json(['success'=> true, 'url' => route('pourashava_frontend.user.login', $pourashava_slug)], 200);
            }

            if ($request->otp === (string) cache($user['email'])) {
                Auth::guard('service_user')->loginUsingId($user['userId']);

                $request->session()->regenerate();
            
                return response()->json(['success'=> true, 'url' => route('pourashava_frontend.user.home', $pourashava_slug)], 200);
            }
        }

        return back();
        
    }

    /**
     * Logout the user
     *
     * @param string $pourashava_slug
     * 
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy($pourashava_slug)
    {
        if (Admin::role('pourashava_admin')->where('pourashava_url', $pourashava_slug)->exists()) {
            Auth::guard('service_user')->logout();

            request()->session()->invalidate();

            request()->session()->regenerateToken();

            return redirect()->route('pourashava_frontend.user.login', $pourashava_slug);
        }

        return back();
    }
}
