<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\TwoFactorCodeNotification;
use App\Http\Requests\CheckTwoFactorRequest;
use App\Http\Controllers\Controller;

class TwoFactorController extends Controller
{
    public function show()
    {
        if (auth()->user()->two_factor_code === null) {
            return redirect()->route('panel.dashboard');
        }

        return view('auth.twoFactor');
    }

    public function check(CheckTwoFactorRequest $request)
    {
        $user = auth()->user();

        if ($request->input('two_factor_code') == $user->two_factor_code) {

            $user->resetTwoFactorCode();
            return redirect()->route('panel.dashboard');
        }

        return redirect()->back()->withErrors(['two_factor_code' => 'Código de dois fatores inválido.']);
    }

    public function resend()
    {
        if (auth()->user()->two_factor_code === null) {
            return redirect()->route('panel.dashboard');
        }

        try {
            auth()->user()->notify(new TwoFactorCodeNotification());
            return redirect()->back()->with('message', 'O código de dois fatores foi enviado novamente.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Erro ao enviar código de dois fatores! Contate o administrador.');
        }
        
    }
}
