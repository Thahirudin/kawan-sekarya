<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credential = $request->only('email', 'password');

        if (Auth::guard('pelanggan')->attempt($credential)){
            $pelanggan = Auth::guard('pelanggan')->user();

            // Ganti = dengan == atau === untuk perbandingan
            if ($pelanggan) {
                return redirect()->intended('/');
            } 
        }
        return back()->withInput()->withErrors(['error' => 'Email dan Password Salah']);
    }
    public function logout()
    {
        Auth::guard('pelanggan')->logout(); 
        return back();
    }
}
