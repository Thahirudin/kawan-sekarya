<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function administratorEdit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.edit-event', compact('event'));
    }
    public function pegawaiEdit($id)
    {
        $event = Event::findOrFail($id);
        return view('pegawai.edit-event', compact('event'));
    }
    public function administratorUpdate(Request $request, $id)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'kapasitas' => 'required|integer',
            'harga' => 'required|numeric',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'deskripsi_singkat' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama event harus diisi.',
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi.',
            'tanggal_mulai.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'tanggal_selesai.required' => 'Tanggal selesai harus diisi.',
            'tanggal_selesai.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'kapasitas.required' => 'Kapasitas harus diisi.',
            'kapasitas.integer' => 'Kapasitas harus berupa angka bulat.',
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'lokasi.required' => 'Lokasi harus diisi.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
            'deskripsi_singkat.required' => 'Deskripsi harus diisi.',
            'gambar.image' => 'File gambar tidak valid.',
            'gambar.mimes' => 'File gambar harus bertipe jpeg, png, jpg, gif, atau svg.',
        ]);

        // Ambil data event berdasarkan ID
        $event = Event::findOrFail($id);

        // Jika nama diubah, buat slug baru
        if ($request->nama !== $event->nama) {
            $slug = Str::slug($request->nama);
            $existingSlug = Event::where('slug', $slug)->where('id', '!=', $id)->first();

            if ($existingSlug) {
                $i = 1;
                while (Event::where('slug', $slug . '-' . $i)->where('id', '!=', $id)->exists()) {
                    $i++;
                }
                $slug = $slug . '-' . $i;
            }
        } else {
            $slug = $event->slug;
        }

        // Update data event
        $event->update([
            'nama' => $request->nama,
            'slug' => $slug,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kapasitas' => $request->kapasitas,
            'harga' => $request->harga,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'deskripsi_singkat' => $request->deskripsi_singkat,
        ]);

        // Proses update gambar jika ada file baru
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '-' . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/event');

            // Hapus gambar lama jika ada
            if ($event->gambar && file_exists(public_path($event->gambar))) {
                unlink(public_path($event->gambar));
            }

            // Pindahkan file ke folder tujuan
            $file->move($destinationPath, $filename);

            // Simpan path gambar baru ke database
            $event->update([
                'gambar' => 'uploads/event/' . $filename,
            ]);
        }

        return redirect()->back()->with('success', 'Event Berhasil Diperbarui!');
    }

    public function adminStoreEvent(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'kapasitas' => 'required|integer',
            'harga' => 'required|numeric',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'deskripsi_singkat' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama event harus diisi.',
            'tanggal_mulai.required' => 'Tanggal mulai harus diisi.',
            'tanggal_mulai.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'tanggal_selesai.required' => 'Tanggal selesai harus diisi.',
            'tanggal_selesai.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'kapasitas.required' => 'Kapasitas harus diisi.',
            'kapasitas.integer' => 'Kapasitas harus berupa angka bulat.',
            'harga.required' => 'Harga harus diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'lokasi.required' => 'Lokasi harus diisi.',
            'deskripsi.required' => 'Deskripsi harus diisi.',
            'deskripsi_singkat.required' => 'Deskripsi harus diisi.',
            'gambar.image' => 'File gambar tidak valid.',
            'gambar.mimes' => 'File gambar harus bertipe jpeg, png, jpg, gif, atau svg.',
        ]);

        // Membuat slug berdasarkan nama
        $slug = Str::slug($request->nama);

        // Mengecek apakah slug sudah ada di database
        $existingSlug = Event::where('slug', $slug)->first();

        // Jika slug sudah ada, tambahkan angka untuk membuatnya unik
        if ($existingSlug) {
            $i = 1;
            while (Event::where('slug', $slug . '-' . $i)->exists()) {
                $i++;
            }
            $slug = $slug . '-' . $i; // Membuat slug baru dengan angka
        }
        // Simpan data event terlebih dahulu tanpa gambar
        $event = Event::create([
            'nama' => $request->nama,
            'slug' => $slug, // Pastikan slug dimasukkan
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kapasitas' => $request->kapasitas,
            'pegawai_id' => Auth::guard('pegawai')->user()->id,
            'harga' => $request->harga,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'deskripsi_singkat' => $request->deskripsi_singkat,
            'gambar' => null, // Kosongkan terlebih dahulu
        ]);

        // Menyimpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '-' . Str::slug($request->nama) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/event'); // Direktori penyimpanan

            // Pastikan folder ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Pindahkan file ke folder tujuan
            $file->move($destinationPath, $filename);

            // Simpan path gambar ke database
            $event->update([
                'gambar' => 'uploads/event/' . $filename,
            ]);
        }

        return redirect()->back()->with('success', 'Event Berhasil Ditambahkan!');
    }
    public function administratorDestroy($id)
    {
        // Hapus data event berdasarkan ID
        $event = Event::findOrFail($id);
        $event->delete();

        // Hapus juga gambar jika ada
        if ($event->gambar) {
            $path = public_path($event->gambar);
            if (File::exists($path)) {
                unlink($path);
            }
        }

        return redirect()->back()->with('success', 'Event Berhasil Dihapus!');

    }
}
