<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TwoFactorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user && $user->two_factor_code) {
            if (Carbon::createFromFormat('d-m-Y H:i:s', $user->two_factor_expires_at)->lt(now())) {
                $user->resetTwoFactorCode();
                auth()->logout();

                return redirect()->route('login')->with('message','O código de dois fatores expirou. Por favor faça login novamente.');
            }

            if (!$request->is('two-factor*')) {
                return redirect()->route('twoFactor.show');
            }
        }

        return $next($request);
    }
}