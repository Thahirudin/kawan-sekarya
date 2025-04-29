<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    public function updateAktivitas(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'durasi' => 'required|integer',
            'harga' => 'required|numeric',
            'dp' => 'required|numeric',
            'detail' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'durasi.required' => 'Durasi wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'dp.required' => 'Harga DP wajib diisi.',
            'detail.required' => 'Detail wajib diisi.',
            'gambar.image' => 'Gambar harus berupa file gambar.',
            'gambar.mimes' => 'Gambar harus memiliki format: jpeg, png, jpg, gif, svg.',
            'gambar.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $aktivitas = Aktivitas::findOrFail($id);
        $aktivitas->nama = $request->input('nama');
        $aktivitas->durasi = $request->input('durasi');
        $aktivitas->harga = $request->input('harga');
        $aktivitas->dp = $request->input('dp');
        $aktivitas->detail = $request->input('detail');

        $aktivitas->save();

        if ($request->hasFile('gambar')) {
            // Upload gambar baru
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/aktivitas'), $filename);

            // Hapus gambar lama setelah data berhasil disimpan
            if ($aktivitas->gambar && file_exists(public_path('uploads/aktivitas/' . $aktivitas->gambar))) {
                unlink(public_path('uploads/aktivitas/' . $aktivitas->gambar));
            }

            // Simpan nama file gambar baru
            $aktivitas->gambar = 'uploads/aktivitas/' . $filename;
            $aktivitas->save();
        }
        return back()->with('success', 'Aktivitas berhasil diperbarui.');
    }
    public function destroyAktivitas($id)
    {
        $aktivitas = Aktivitas::findOrFail($id);
        if ($aktivitas->gambar && file_exists(public_path($aktivitas->gambar))) {
            unlink(public_path($aktivitas->gambar));
        }
        $aktivitas->delete();
        return back()->with('success', 'Aktivitas berhasil dihapus.');
    }
    public function storeAktivitas(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'durasi' => 'required|integer',
            'harga' => 'required|numeric',
            'dp' => 'required|numeric',
            'detail' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'durasi.required' => 'Durasi wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'dp.required' => 'Harga DP wajib diisi.',
            'detail.required' => 'Detail wajib diisi.',
            'gambar.image' => 'Gambar harus berupa file gambar.',
            'gambar.required' => 'Gambar wajib diisi.',
            'gambar.mimes' => 'Gambar harus memiliki format: jpeg, png, jpg, gif, svg.',
            'gambar.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $aktivitas = new Aktivitas();
        $aktivitas->nama = $request->input('nama');
        $aktivitas->durasi = $request->input('durasi');
        $aktivitas->harga = $request->input('harga');
        $aktivitas->dp = $request->input('dp');
        $aktivitas->detail = $request->input('detail');

        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $aktivitas->gambar = 'uploads/aktivitas/' . $filename;
        $aktivitas->save();
        $file->move(public_path('uploads/aktivitas'), $filename);
        return back()->with('success', 'Aktivitas berhasil ditambahkan.');
    }
}
