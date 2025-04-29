<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\Checkout;
use App\Models\Event;
use App\Models\Meja;
use App\Models\Pegawai;
use App\Models\Pelanggan;
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
        $reservasis = Reservasi::where('pelanggan_id', Auth::guard('pelanggan')->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('reservasi-history', compact('reservasis'));
    }
    public function reservasi()
    {
        $mejas = Meja::all();
        return view('reservasi', compact('mejas'));
    }
    public function reservasiJadwal($id)
    {
        if (!Auth::guard('pelanggan')->check()) {
            return redirect()->route('login');
        }
        $aktivitass = Aktivitas::all();
        $reservasis = Reservasi::where('meja_id', $id)
            ->whereIn('status', ['booking', 'pending-paid', 'paid'])
            ->get();
        return view('reservasi-jadwal', compact('reservasis', 'id', 'aktivitass'));
    }
    public function aboutUs()
    {
        $pegawais = Pegawai::all();
        return view('about-us', compact('pegawais'));
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
        $totalReservasi = Reservasi::where('status', 'paid')->count();
        $checkouts = Checkout::all();
        $totalCheckout = Checkout::where('status', 'paid')->count();
        $events = Event::all();
        $pemasukanCheckout = Checkout::where('status', 'paid')->sum('total');
        $pemasukanReservasiBooking = Reservasi::whereIn('status', ['booking', 'pending-paid'])->sum('dp');
        $pemasukanReservasiPaid = Reservasi::where('status', 'paid')->sum('total');
        $totalPemasukan = $pemasukanCheckout + $pemasukanReservasiBooking + $pemasukanReservasiPaid;
        return view('admin.dashboard', compact('pegawais', 'reservasis', 'checkouts', 'totalPegawai', 'totalReservasi', 'totalCheckout', 'events', 'totalPemasukan'));
    }
    public function pegawaiDashboard()
    {
        $pegawais = Pegawai::all();
        $totalPegawai = Pegawai::count();
        $reservasis = Reservasi::all();
        $totalReservasi = Reservasi::where('status', 'paid')->count();
        $checkouts = Checkout::all();
        $totalCheckout = Checkout::where('status', 'paid')->count();
        $events = Event::all();
        $pemasukanCheckout = Checkout::where('status', 'paid')->sum('total');
        $pemasukanReservasiBooking = Reservasi::whereIn('status', ['booking', 'pending-paid'])->sum('dp');
        $pemasukanReservasiPaid = Reservasi::where('status', 'paid')->sum('total');
        $totalPemasukan = $pemasukanCheckout + $pemasukanReservasiBooking + $pemasukanReservasiPaid;
        return view('pegawai.dashboard', compact('pegawais', 'reservasis', 'checkouts', 'totalPegawai', 'totalReservasi', 'totalCheckout', 'events', 'totalPemasukan'));
    }
    public function administratorDataPegawai(Request $request)
    {
        $query = Pegawai::query();

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'LIKE', "%$search%");
        }

        $pegawais = $query->paginate(10);
        return view('admin.data-pegawai', compact('pegawais'));
    }
    public function pegawaiDataPegawai(Request $request)
    {
        $query = Pegawai::query();

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'LIKE', "%$search%");
        }

        $pegawais = $query->paginate(10);

        return view('pegawai.data-pegawai', compact('pegawais'));
    }
    public function administratorDataAktivitas(Request $request)
    {
        $query = Aktivitas::query();

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'LIKE', "%$search%");
        }

        $aktivitass = $query->paginate(10);
        return view('admin.data-aktivitas', compact('aktivitass'));
    }
    public function pegawaiDataAktivitas(Request $request)
    {
        $query = Aktivitas::query();

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'LIKE', "%$search%");
        }

        $aktivitass = $query->paginate(10);
        return view('pegawai.data-aktivitas', compact('aktivitass'));
    }
    public function administratorDataPelanggan(Request $request)
    {
        $query = Pelanggan::query();

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'LIKE', "%$search%");
        }

        $pelanggans = $query->paginate(10);
        return view('admin.data-pelanggan', compact('pelanggans'));
    }
    public function pegawaiDataPelanggan(Request $request)
    {
        $query = Pelanggan::query();

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'LIKE', "%$search%");
        }

        $pelanggans = $query->paginate(10);

        return view('pegawai.data-pelanggan', compact('pelanggans'));
    }
    public function administratorDataEvent(Request $request)
    {
        $query = Event::query();

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'LIKE', "%$search%");
        }

        $events = $query->paginate(10);
        return view('admin.data-event', compact('events'));
    }
    public function pegawaiDataEvent(Request $request)
    {
        $query = Event::query();

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'LIKE', "%$search%");
        }

        $events = $query->paginate(10);

        return view('pegawai.data-event', compact('events'));
    }

    public function administratorCheckoutEvent(Request $request)
    {
        $query = Checkout::query();

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id', 'LIKE', "%$search%");
        }

        $checkouts = $query->paginate(10);
        return view('admin.checkout-event', compact('checkouts'));
    }
    public function pegawaiCheckoutEvent(Request $request)
    {
        $query = Checkout::query();

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id', 'LIKE', "%$search%");
        }

        $checkouts = $query->paginate(10);
        return view('pegawai.checkout-event', compact('checkouts'));
    }
    public function administratorDataReservasi(Request $request)
    {
        $query = Reservasi::query();

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id', 'LIKE', "%$search%");
        }

        $checkouts = $query->paginate(10);
        return view('admin.data-reservasi', compact('checkouts'));
    }
    public function pegawaiDataReservasi(Request $request)
    {
        $query = Reservasi::query();

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('id', 'LIKE', "%$search%");
        }

        $checkouts = $query->paginate(10);
        return view('pegawai.data-reservasi', compact('checkouts'));
    }
    public function administratorDataMeja(Request $request)
    {
        $query = Meja::query();

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'LIKE', "%$search%");
        }

        $mejas = $query->paginate(10);
        return view('admin.data-meja', compact('mejas'));
    }
    public function pegawaiDataMeja(Request $request)
    {
        $query = Meja::query();

        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'LIKE', "%$search%");
        }

        $mejas = $query->paginate(10);
        return view('pegawai.data-meja', compact('mejas'));
    }
    public function event()
    {
        $events = Event::orderBy('tanggal_mulai', 'desc')->paginate(8);
        return view('events', compact('events'));
    }
    public function profile()
    {
        $pegawai = Auth::guard('pegawai')->user();
        return view('admin.profile', compact('pegawai'));
    }
    public function pegawaiProfile()
    {
        $pegawai = Auth::guard('pegawai')->user();
        return view('pegawai.profile', compact('pegawai'));
    }
    public function sitemap()
    {
        $events = Event::all();
        $urls = [
            ['loc' => route('home'), 'lastmod' => now()->toAtomString()],
            ['loc' => route('about-us'), 'lastmod' => now()->toAtomString()],
            ['loc' => route('reservasi'), 'lastmod' => now()->toAtomString()],
            ['loc' => route('event'), 'lastmod' => now()->toAtomString()],
            ['loc' => route('login'), 'lastmod' => now()->toAtomString()],
            ['loc' => route('daftar'), 'lastmod' => now()->toAtomString()],
        ];
        foreach ($events as $event) {
            $urls[] = [
            'loc' => route('event.detail', $event->slug),
            'lastmod' => $event->updated_at->toAtomString(),
            ];
        }

        $xml = view('sitemap', compact('urls'));

        return response($xml)->header('Content-Type', 'application/xml');
    }
}
