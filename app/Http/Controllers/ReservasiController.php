<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\Meja;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    public function storeReservasi(Request $request)
    {
        // Validasi data input
        $request->validate([
            'meja_id' => 'required|exists:mejas,id',
            'aktivitas_id' => 'required|exists:aktivitas,id',
            'jumlah_orang' => 'required',
            'waktu_kedatangan' => 'required',
        ], [
            'meja_id.required' => 'Meja Harus Diisi',
            'meja_id.exist' => 'Meja Tidak ditemukan',
            'aktivitas_id.required' => 'Aktivitas Harus Diisi',
            'aktivitas_id.exist' => 'Aktivitas Tidak ditemukan',
            'jumlah_orang.required' => 'Jumlah orang harus diisi.',
            'jumlah_orang.numeric' => 'Jumlah orang harus berupa angka.',
            'jumlah_orang.min' => 'Jumlah orang minimal 1.',
            'waktu_kedatangan.required' => 'Waktu kedatangan harus diisi.',
            'waktu_kedatangan.date' => 'Format waktu kedatangan tidak valid.'
        ]);
        $meja = Meja::where('id', $request->meja_id)->firstOrFail();
        $aktivitas = Aktivitas::where('id', $request->aktivitas_id)->firstOrFail();
        // Ambil pelanggan yang sedang login
        $pelanggan = Auth::guard('pelanggan')->user();
        if (!$pelanggan) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai pelanggan untuk melakukan checkout.');
        }
        if ($request->jumlah_orang > $meja->kapasitas) {
            return redirect()->back()->withErrors(['jumlah_orang' => 'Jumlah orang tidak boleh melebihi kapasitas Meja yang tersedia.']);
        }
        $waktu_kedatangan = Carbon::parse($request->waktu_kedatangan);
        $waktu_selesai = $waktu_kedatangan->copy()->addMinutes($aktivitas->durasi);
        // **Cek apakah ada reservasi lain yang tumpang tindih dengan waktu ini**
        $cek_bentrok = Reservasi::where('meja_id', $request->meja_id)
            ->where('status', 'booking') // Hanya cek reservasi yang sudah "booking"
            ->where(function ($query) use ($waktu_kedatangan, $waktu_selesai) {
                $query->whereBetween('waktu_kedatangan', [$waktu_kedatangan, $waktu_selesai])
                    ->orWhereBetween('waktu_selesai', [$waktu_kedatangan, $waktu_selesai])
                    ->orWhere(function ($q) use ($waktu_kedatangan, $waktu_selesai) {
                        $q->where('waktu_kedatangan', '<=', $waktu_kedatangan)
                            ->where('waktu_selesai', '>=', $waktu_selesai);
                    });
            })
            ->exists();

        if ($cek_bentrok) {
            return redirect()->back()->withErrors(['waktu_kedatangan' => 'Meja sudah dipesan pada waktu ini. Silakan pilih waktu lain.']);
        }
        // Simpan data checkout
        $reservasi = Reservasi::create([
            'pelanggan_id' => $pelanggan->id,
            'meja_id' => $request->meja_id,
            'aktivitas_id' => $request->aktivitas_id,
            'waktu_kedatangan' => $waktu_kedatangan,
            'waktu_selesai' => $waktu_selesai,
            'total' => $aktivitas->harga,
            'jumlah_orang' => $request->jumlah_orang,
            'dp' => 20000,
            'status' => 'pending', // Default status pending
            'updated_at' => '',
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $reservasi->dp,
            ),
            'customer_details' => array(
                'name' => $pelanggan->nama,
                'email' => $pelanggan->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $reservasi->snap_token = $snapToken;
        $reservasi->save();
        return redirect()->route('reservasi.show', $reservasi->id)
            ->with('success', 'Reservasi berhasil! Silakan lanjutkan pembayaran.');
    }
    public function show($id)
    {
        if (Auth::guard('pelanggan')->check()) {
            $reservasi = Reservasi::where('id', $id)->where('pelanggan_id', Auth::guard('pelanggan')->user()->id)->firstOrFail();
            return view('invoice-reservasi', compact('reservasi'));
        }
    }
    public function booking(Reservasi $reservasi)
    {
        $reservasi->status = 'booking';
        $reservasi->save();
        return redirect()->route('reservasi.show', ['id' => $reservasi->id]);
    }
}
