<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Facades\MdlSmsHelper;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $user = Admin::where('email', $request->email)->first();

        // Send otp if email & password exists in db
        if ($user && Hash::check($request->password, $user->password)) {
            $uniqueNumber  = random_int(100000, 999999);

            $message = 'Your OTP code is: ' . $uniqueNumber;
            
            // send otp sms on mobile
            $contact = "88{$user->mobile}";
            MdlSmsHelper::send($contact, $message);

            $mobile = substr($user->mobile, -4);

            $token = uniqid($mobile);
 
            session()->put('userInfo', ['email' => $user->email, 'password' => $request->password, 'token' => $token]);

            Cache::put($user->email, $uniqueNumber, 60);

            return redirect()->to('admin/login/otp?token=' . $token);
        }

        $request->authenticate();
    }

    /**
     * Showing otp page
     * 
     *@param string $token

     * @return void
     */
    public function loginOtp(Request $request)
    {
        $token = $request->query('token');

        $user = session('userInfo');

        if (!$user || $token !== $user['token'] || !cache($user['email'])) {
            session()->forget('userInfo');
            return redirect()->route('admin.login');
        }

        return view('admin.auth.login-otp');
    }

    /**
     * Check OTP for login
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse;
     */
    public function loginOtpCheck(Request $request)
    {
        $this->validate($request, [
            'otp' => 'required'
        ],
        [
            'otp.required' => 'আপনি OPT দেন নাই, OTP দিন।'
        ]);
        
        $user = session('userInfo');
        
        if (!$user || $request->token !== $user['token'] || !cache($user['email'])) {
            session()->forget('userInfo');

            return response()->json(['success'=> true, 'url' => route('admin.login')], 200);
        }

        if ($request->otp === (string) cache($user['email'])) {
            Auth::attempt(['email' => $user['email'], 'password' => $user['password']]);

            $request->session()->regenerate();
            
            return response()->json(['success'=> true, 'url' => route('admin.home')], 200);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
