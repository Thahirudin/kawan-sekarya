<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Transaction;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);
        $event = Event::where('id', $request->event_id)->firstOrFail();
        // Ambil pelanggan yang sedang login
        $pelanggan = Auth::guard('pelanggan')->user();
        if (!$pelanggan) {
            return redirect()->back()->with('error', 'Anda harus login sebagai pelanggan untuk melakukan checkout.');
        }
        $jumlahPesertaPaid = Checkout::where('event_id', $event->id)
            ->where('status', 'paid') // Hanya yang sudah dibayar
            ->count();

        if ($jumlahPesertaPaid >= $event->kapasitas) {
            return redirect()->back()->with('error', 'Pendaftaran event gagal! Kapasitas event sudah penuh.');
        }

        // Simpan data checkout
        $checkout = Checkout::create([
            'id' => 'EVENT-' . Str::uuid(),
            'pelanggan_id' => $pelanggan->id,
            'event_id' => $request->event_id,
            'total' => $event->harga,
            'status' => 'pending', // Default status pending
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
                'order_id' => $checkout->id,
                'gross_amount' => $event->harga,
            ),
            'customer_details' => array(
                'name' => $pelanggan->nama,
                'email' => $pelanggan->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $checkout->snap_token = $snapToken;
        $checkout->save();
        return redirect()->route('checkout.show', $checkout->id)
            ->with('success', 'Checkout berhasil! Silakan lanjutkan pembayaran.');
    }
    public function show($id)
    {

        if (Auth::guard('pelanggan')->check()) {
            $checkout = Checkout::where('id', $id)->where('pelanggan_id', Auth::guard('pelanggan')->user()->id)->firstOrFail();
            return view('invoice-order', compact('checkout'));
        }
    }
    public function updateStatus(Request $request)
    {
        $order_id = $request->query('order_id');
        $checkout = Checkout::findOrFail($order_id);
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.serverKey');
        // Periksa apakah tidak login
        if (!Auth::guard('pelanggan')->check()) {
            return redirect()->route('login');
        }
        // Verifikasi status pembayaran menggunakan Snap API
        try {
            // Verifikasi status transaksi menggunakan Transaction::status
            $transaction = Transaction::status($checkout->id); // Mengambil status transaksi berdasarkan ID
            // Periksa jika $transaction adalah objek
            if (is_object($transaction)) {
                // Cek status transaksi, jika berhasil 'settlement'
                if ($transaction->transaction_status == 'settlement') {
                    // Update status checkout menjadi 'paid'
                    $checkout->status = 'paid';
                    $checkout->save();

                    // Redirect ke halaman checkout untuk melihat detail pembayaran
                    return redirect()->route('checkout.show', ['id' => $checkout->id]);
                } else if ($transaction->transaction_status == 'expire') {
                    // Update status checkout menjadi 'paid'
                    $checkout->status = 'failed';
                    $checkout->save();
                    // Redirect ke halaman checkout untuk melihat detail pembayaran
                    return redirect()->route('checkout.show', ['id' => $checkout->id])->with('error', 'Pembayaran Kedaluwarsa');;
                } else {
                    // Jika status transaksi bukan 'settlement'
                    return redirect()->route('checkout.show', ['id' => $checkout->id])
                        ->with('error', 'Pembayaran gagal atau belum dikonfirmasi.');
                }
            } else {
                // Jika $transaction bukan objek, tangani kesalahan
                return redirect()->route('checkout.show', ['id' => $checkout->id])
                    ->with('error', 'Data transaksi tidak valid.');
            }
        } catch (\Exception $e) {
            // Tangani error jika terjadi kegagalan
            return redirect()->route('checkout.show', ['id' => $checkout->id])
                ->with('error', 'Terjadi kesalahan dalam verifikasi pembayaran.');
        }
    }
    public function failedStatus(Request $request)
    {

        try {
            $order_id = $request->query('order_id');
            $checkout = Checkout::findOrFail($order_id);
            if (!Auth::guard('pelanggan')->check()) {
                return redirect()->route('login');
            }
            $checkout->status = 'failed';
            $checkout->save();
        } catch (\Exception $e) {
            // Tangani error jika terjadi kegagalan
            return redirect()->route('checkout.show', ['id' => $checkout->id])
                ->with('error', 'Terjadi kesalahan dalam verifikasi pembayaran.');
        }
    }
    public function cancelStatus($id)
    {
        try {
            $checkout = Checkout::findOrFail($id);
            if (!Auth::guard('pelanggan')->check()) {
                return redirect()->route('login');
            }
            $checkout->status = 'cancelled';
            $checkout->save();
            return redirect()->back()->with('success', 'Order berhasil dibatalkan');
        } catch (\Exception $e) {
            return redirect()->route('checkout.show', ['id' => $checkout->id])->with('error', 'Terjadi kesalahan dalam verifikasi pembayaran.');
        }
    }
}