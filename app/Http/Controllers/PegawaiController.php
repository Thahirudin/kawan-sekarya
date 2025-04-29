<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
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
            if ($pegawai && $pegawai->jabatan === 'Administrator' || $pegawai->jabatan === 'Founder') {
                return redirect()->intended('/administrator/dashboard');
            } elseif ($pegawai && $pegawai->jabatan === 'Event Staff') {
                return redirect()->intended('/pegawai/dashboard');
            } else{
                return back()->withInput()->withErrors(['error' => 'Email dan Password Salah']);
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pegawais,email',
            'tanggal_lahir' => 'required|date',
            'nomor_hp' => 'required|string|max:15',
            'jabatan' => 'required|string|max:100',
            'password' => 'required|string|min:8',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.string' => 'Nama harus berupa string',
            'nama.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.string' => 'Email harus berupa string',
            'email.email' => 'Email harus berupa alamat email yang valid',
            'email.max' => 'Email maksimal 255 karakter',
            'email.unique' => 'Email sudah digunakan',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid',
            'nomor_hp.required' => 'Nomor HP harus diisi',
            'nomor_hp.string' => 'Nomor HP harus berupa string',
            'nomor_hp.max' => 'Nomor HP maksimal 15 karakter',
            'jabatan.required' => 'Jabatan harus diisi',
            'jabatan.string' => 'Jabatan harus berupa string',
            'jabatan.max' => 'Jabatan maksimal 100 karakter',
            'password.required' => 'Password harus diisi',
            'password.string' => 'Password harus berupa string',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama',
            'gambar.required' => 'Gambar harus diisi',
            'gambar.image' => 'Gambar harus berupa gambar',
            'gambar.mimes' => 'Gambar harus berupa file dengan format jpeg, png, jpg, atau gif',
            'gambar.max' => 'Gambar maksimal 2048KB',
        ]);

        $pegawai = new Pegawai([
            'nama' => $request->nama,
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_hp' => $request->nomor_hp,
            'jabatan' => $request->jabatan,
            'password' => bcrypt($request->password),
            'gambar' => 'uploads/pegawai/default.png',
        ]);

        if ($request->file('gambar')) {
            $request->file('gambar')->move(public_path('uploads/pegawai'), 'uploads/pegawai/' . time() . '_' . $request->file('gambar')->getClientOriginalName());
            $pegawai->gambar = 'uploads/pegawai/' . time() . '_' . $request->file('gambar')->getClientOriginalName();
        }

        if ($pegawai->save()) {
            return redirect()->back()->with('success', 'Pegawai berhasil ditambahkan');
        }

        return back()->withErrors(['error' => 'Gagal menambahkan pegawai'])->withInput();
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
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:pegawais,email,' . $pegawai->id,
            'tanggal_lahir' => 'required|date',
            'nomor_hp' => 'required|string|max:15',
            'jabatan' => 'required|string|max:100',
            'password' => 'nullable|string|min:8',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.string' => 'Nama harus berupa string',
            'nama.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.string' => 'Email harus berupa string',
            'email.email' => 'Email harus berupa alamat email yang valid',
            'email.max' => 'Email maksimal 255 karakter',
            'email.unique' => 'Email sudah digunakan',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid',
            'nomor_hp.required' => 'Nomor HP harus diisi',
            'nomor_hp.string' => 'Nomor HP harus berupa string',
            'nomor_hp.max' => 'Nomor HP maksimal 15 karakter',
            'jabatan.required' => 'Jabatan harus diisi',
            'jabatan.string' => 'Jabatan harus berupa string',
            'jabatan.max' => 'Jabatan maksimal 100 karakter',
            'password.string' => 'Password harus berupa string',
            'password.min' => 'Password minimal 8 karakter',
            'gambar.image' => 'Gambar harus berupa gambar',
            'gambar.mimes' => 'Gambar harus berupa file dengan format jpeg, png, jpg, atau gif',
            'gambar.max' => 'Gambar maksimal 2048KB',
        ]);

        $pegawai->nama = $request->nama;
        $pegawai->email = $request->email;
        $pegawai->tanggal_lahir = $request->tanggal_lahir;
        $pegawai->nomor_hp = $request->nomor_hp;

        // Cek apakah pegawai yang login adalah administrator
        if (Auth::guard('pegawai')->user()->jabatan === 'Administrator') {
            $pegawai->jabatan = $request->jabatan;
        }

        if ($request->filled('password')) {
            $pegawai->password = bcrypt($request->password);
        }

        if ($request->file('gambar')) {
            if ($pegawai->gambar && file_exists(public_path($pegawai->gambar))) {
            unlink(public_path($pegawai->gambar));
            }
            $request->file('gambar')->move(public_path('uploads/pegawai'), 'uploads/pegawai/' . time() . '_' . $request->file('gambar')->getClientOriginalName());
            $pegawai->gambar = 'uploads/pegawai/' . time() . '_' . $request->file('gambar')->getClientOriginalName();
        }

        if ($pegawai->save()) {
            return redirect()->back()->with('success', 'Pegawai berhasil diperbarui');
        }

        return back()->withErrors(['error' => 'Gagal memperbarui pegawai'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        if ($pegawai->gambar && file_exists(public_path($pegawai->gambar))) {
            unlink(public_path($pegawai->gambar));
        }
        if ($pegawai->delete()) {
            return redirect()->back()->with('success', 'Pegawai berhasil dihapus');
        }
        return back()->withErrors(['error' => 'Gagal menghapus pegawai'])->withInput();
    }
}
