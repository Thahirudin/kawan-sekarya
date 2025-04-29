<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
        ], [
            'nama.required' => 'Nama meja wajib diisi.',
            'nama.max' => 'Nama meja tidak boleh lebih dari 255 karakter.',
            'kapasitas.required' => 'Kapasitas meja wajib diisi.',
            'kapasitas.integer' => 'Kapasitas meja harus berupa angka.',
            'kapasitas.min' => 'Kapasitas meja minimal adalah 1.',
            'deskripsi.string' => 'Deskripsi meja harus berupa teks.',
        ]);

        // Simpan data meja ke database menggunakan model
        Meja::create([
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
            'deskripsi' => $request->deskripsi,
        ]);

        return back()->with('success', 'Meja berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'kapasitas' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
        ], [
            'nama.required' => 'Nama meja wajib diisi.',
            'nama.max' => 'Nama meja tidak boleh lebih dari 255 karakter.',
            'kapasitas.required' => 'Kapasitas meja wajib diisi.',
            'kapasitas.integer' => 'Kapasitas meja harus berupa angka.',
            'kapasitas.min' => 'Kapasitas meja minimal adalah 1.',
            'deskripsi.string' => 'Deskripsi meja harus berupa teks.',
        ]);

        $meja = Meja::findOrFail($id);
        $meja->update([
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
            'deskripsi' => $request->deskripsi,
        ]);

        return back()->with('success', 'Data meja berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $meja = Meja::findOrFail($id);
        $meja->delete();

        return back()->with('success', 'Meja berhasil dihapus.');
    }
}
