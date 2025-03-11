<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\Checkout;
use App\Models\Event;
use App\Models\Meja;
use App\Models\Pegawai;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        $events = Event::orderBy('tanggal_mulai', 'desc')->take(8)->get();
        return view('index', compact('events'));
    }
    public function eventDetail($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        $jumlahPesertaPaid = Checkout::where('event_id', $event->id)
            ->where('status', 'paid') // Hanya yang sudah dibayar
            ->count();
        return view('more-event', compact('event', 'jumlahPesertaPaid'));
    }
    public function daftarEvent($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        return view('daftar-event', compact('event'));
    }
    public function dataCheckout()
    {
        $checkouts = Checkout::where('pelanggan_id', Auth::guard('pelanggan')->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('order-history', compact('checkouts'));
    }
    public function reservasiHistrory()
    {
        $reservasis = Reservasi::where('pelanggan_id', Auth::guard('pelanggan')->user()->id)->get();
        return view('reservasi-history', compact('reservasis'));
    }
    public function reservasi()
    {
        $mejas = Meja::all();
        return view('reservasi', compact('mejas'));
    }
    public function reservasiJadwal($id)
    {
        $reservasis = Reservasi::where('meja_id', $id)->where('status', 'booking')->get();
        return view('reservasi-jadwal', compact('reservasis', 'id'));
    }
    public function aboutUs()
    {
        return view('about-us');
    }
    public function tambahReservasi($id)
    {
        if (Auth::guard('pelanggan')->check()) {
            $mejas = Meja::all();
            $aktivitass = Aktivitas::all();
            return view('tambah-reservasi', compact('mejas', 'aktivitass', 'id'));
        } else {
            return redirect()->route('login');
        }
    }
    public function administratorDashboard()
    {
        $pegawais = Pegawai::all();
        $totalPegawai = Pegawai::count();
        $reservasis = Reservasi::all();
        $totalReservasi = Reservasi::count();
        $checkouts = Checkout::all();
        $totalCheckout = Checkout::where('status', 'paid')->count();
        $events = Event::all();
        $pemasukanCheckout = Checkout::where('status', 'paid')->sum('total');
        $pemasukanReservasi = Reservasi::where('status', '!=', 'pending')->sum('total');
        $totalPemasukan = $pemasukanCheckout + $pemasukanReservasi;
        return view('admin.dashboard', compact('pegawais', 'reservasis', 'checkouts', 'totalPegawai', 'totalReservasi', 'totalCheckout', 'events', 'totalPemasukan'));
    }
    public function administratorDataPegawai()
    {
        $pegawais = Pegawai::all();
        return view('admin.data-pegawai', compact('pegawais'));
    }
    public function administratorDataEvent()
    {
        $events = Event::all();
        return view('admin.data-event', compact('events'));
    }
    public function administratorCheckoutEvent()
    {
        $checkouts = Checkout::all();
        return view('admin.checkout-event', compact('checkouts'));
    }
}
