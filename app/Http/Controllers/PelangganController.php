<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PelangganController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credential = $request->only('email', 'password');

        if (Auth::guard('pelanggan')->attempt($credential)) {
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
    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'nohp' => 'required',
            'password' => 'nullable|min:8',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date_format' => 'Tanggal lahir harus berformat YYYY-MM-DD',
            'nohp.required' => 'Nomor HP harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'File harus berupa jpeg, png, jpg, gif, atau svg',
            'gambar.max' => 'Ukuran file maksimal 2048 kilobyte',
        ]);

        $pelanggan = Pelanggan::findOrFail(Auth::guard('pelanggan')->id());

        if ($request->password) {
            $pelanggan->password = bcrypt($request->password);
        } else {
            $pelanggan->password = $pelanggan->password;
        }

        $pelanggan->nama = $request->nama;
        $pelanggan->email = $request->email;
        $pelanggan->tanggal_lahir = $request->tanggal_lahir;
        $pelanggan->nohp = $request->nohp;

        if (!$pelanggan->save()) {
            return back()->withInput()->withErrors(['error' => 'Gagal mengupdate profil']);
        }

        if ($request->hasFile('gambar')) {
            // hapus gambar lama
            if (File::exists(public_path($pelanggan->gambar))) {
                File::delete(public_path($pelanggan->gambar));
            }

            $image = $request->file('gambar');
            $imageName = $pelanggan->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/pelanggan'), $imageName);
            $pelanggan->gambar = 'uploads/pelanggan/' . $imageName;
            $pelanggan->save();
        }

        return back()->with('success', 'Profil berhasil diupdate');
    }
    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'nohp' => 'required',
            'password' => 'nullable|min:8',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date_format' => 'Tanggal lahir harus berformat YYYY-MM-DD',
            'nohp.required' => 'Nomor HP harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'File harus berupa jpeg, png, jpg, gif, atau svg',
            'gambar.max' => 'Ukuran file maksimal 2048 kilobyte',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);

        if ($request->password) {
            $pelanggan->password = bcrypt($request->password);
        } else {
            $pelanggan->password = $pelanggan->password;
        }

        $pelanggan->nama = $request->nama;
        $pelanggan->email = $request->email;
        $pelanggan->tanggal_lahir = $request->tanggal_lahir;
        $pelanggan->nohp = $request->nohp;

        if (!$pelanggan->save()) {
            return back()->withInput()->withErrors(['error' => 'Gagal mengupdate profil']);
        }

        if ($request->hasFile('gambar')) {
            // hapus gambar lama
            if (file_exists(public_path($pelanggan->gambar))) {
                unlink(public_path($pelanggan->gambar));
            }

            $image = $request->file('gambar');
            $imageName = $pelanggan->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/pelanggan'), $imageName);
            $pelanggan->gambar = 'uploads/pelanggan/' . $imageName;
            $pelanggan->save();
        }

        return back()->with('success', 'Profil Pelanggan berhasil diupdate');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pelanggans',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'nohp' => 'required',
            'password' => 'required|min:8',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'tanggal_lahir.date_format' => 'Tanggal lahir harus berformat YYYY-MM-DD',
            'nohp.required' => 'Nomor HP harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'File harus berupa jpeg, png, jpg, gif, atau svg',
            'gambar.max' => 'Ukuran file maksimal 2048 kilobyte',
        ]);

        $pelanggan = new Pelanggan();
        $pelanggan->nama = $request->nama;
        $pelanggan->email = $request->email;
        $pelanggan->tanggal_lahir = $request->tanggal_lahir;
        $pelanggan->nohp = $request->nohp;
        $pelanggan->password = bcrypt($request->password);

        if (!$pelanggan->save()) {
            return back()->withInput()->withErrors(['error' => 'Gagal mendaftar']);
        }

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = $pelanggan->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/pelanggan'), $imageName);
            $pelanggan->gambar = 'uploads/pelanggan/' . $imageName;
            $pelanggan->save();
        }

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login');
    }
    public function adminDestroy($id){
        $pelanggan = Pelanggan::findOrFail($id);
        if (!$pelanggan->delete()) {
            return back()->withErrors(['error' => 'Gagal menghapus pelanggan']);
        }
        return back()->with('success', 'Pelanggan berhasil dihapus');
    }
}
