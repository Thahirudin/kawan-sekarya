<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credential = $request->only('email', 'password');

        if (Auth::guard('pegawai')->attempt($credential)) {
            $pegawai = Auth::guard('pegawai')->user();

            // Ganti = dengan == atau === untuk perbandingan
            if ($pegawai && $pegawai->jabatan === 'Administrator') {
                return redirect()->intended('/administrator/dashboard');
            } elseif ($pegawai && $pegawai->jabatan === 'Pegawai') {
                return redirect()->intended('/pegawai/dashboard');
            }
        } else if (Auth::guard('pelanggan')->attempt($credential)) {
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
        $guard = Auth::guard('pelanggan')->check() ? 'pelanggan' : (Auth::guard('pegawai')->check() ? 'pegawai' : null);

        // Jika ada guard yang aktif, lakukan logout
        if ($guard) {
            Auth::guard($guard)->logout();
        }

        // Redirect ke halaman utama setelah logout
        return redirect('/');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
