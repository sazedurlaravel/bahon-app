<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsExpired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth('admin')->check() && ! auth('admin')->user()->hasRole('super_admin')) {
            $pourashavaAdmin = auth('admin')->user()->hasRole('pourashava_admin') ? auth('admin')->user() : auth('admin')->user()->parentAdmin;
            if($pourashavaAdmin->valid_to > now()) {
                return $next($request);
            }
            // logout and redirect admin login page with account renew message
            auth('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // message
            $request->session()->flash('message', ' আপনার অ্যাকাউন্টের মেয়াদ শেষ। দয়াকরে, নবায়ন করুন। ');
            $request->session()->flash('alert-type', 'warning');

            return redirect()->route('admin.login');
        } elseif(auth('service_user')->check()) {
            $serviceUser = auth('service_user')->user();
            if($serviceUser->valid_to > now()) {
                return $next($request);
            }
            // logout and redirect service_user login page with account renew message
            auth('service_user')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // message
            $request->session()->flash('message', ' আপনার অ্যাকাউন্টের মেয়াদ শেষ। দয়াকরে, নবায়ন করুন। ');
            $request->session()->flash('alert-type', 'warning');

            return redirect()->route('pourashava_frontend.user.login', $request->route('pourashava_slug'));
        }
        return $next($request);
    }
}
