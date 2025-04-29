@extends('admin.template.master')
@section('title')
    Data Reservasi | {{ config('app.name') }}
@endsection
@section('reservasi-active')
    bg-gray-200 text-blue-600 font-semibold
@endsection
@section('addCss')
@endsection
@section('content')
    <section class="p-4 bg-white rounded-xl lg:p-5 mb-5 shadow-lg">
        <div class="mb-5 flex justify-between items-center">
            <h1 class="text-xl font-bold">Data Reservasi</h1>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="pb-4 bg-white">
                <form method="GET" action="{{ route('admin.data-reservasi') }}">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan order Id"
                        class="border rounded-lg px-3 py-2">
                    <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded-lg">Cari</button>
                </form>
            </div>
            <table id="eventTable" class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Order ID</th>
                        <th scope="col" class="px-6 py-3">Pelanggan</th>
                        <th scope="col" class="px-6 py-3">Aktivitas</th>
                        <th scope="col" class="px-6 py-3">Waktu Kedatangan</th>
                        <th scope="col" class="px-6 py-3">Waktu Selesai</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Total</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($checkouts as $checkout)
                        <tr
                            class="bg-white border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-6 py-3">{{ $checkout->id }}</td>
                            <td class="px-6 py-3">{{ $checkout->pelanggan->nama }}</td>
                            <td class="px-6 py-3">{{ $checkout->aktivitas->nama }}</td>
                            <td class="px-6 py-3">{{ $checkout->waktu_kedatangan->translatedFormat('d F Y H:i') }} WIB</td>
                            <td class="px-6 py-3">{{ $checkout->waktu_selesai->translatedFormat('d F Y H:i') }} WIB</td>
                            <td class="px-6 py-3">
                                <div
                                    class="px-2 py-1 text-center rounded-full text-white {{ $checkout->status == 'failed' || $checkout->status == 'cancelled'
                                        ? 'bg-red-500'
                                        : ($checkout->status == 'pending' || $checkout->status == 'pending-paid'
                                            ? 'bg-yellow-500'
                                            : ($checkout->status == 'paid'
                                                ? 'bg-green-700'
                                                : ($checkout->status == 'booking'
                                                    ? 'bg-green-500'
                                                    : ''))) }}">
                                    {{ $checkout->status }}
                                </div>
                            </td>
                            <td class="px-6 py-3">Rp{{ number_format($checkout->total, 0, ',', '.') }}</td>
                            <td class="px-6 py-3">
                                <div class="inline-flex rounded-md shadow-xs" role="group">
                                    <button type="button" data-modal-target="edit-checkout{{ $checkout->id }}"
                                        data-modal-toggle="edit-checkout{{ $checkout->id }}"
                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-700 border border-blue-700 rounded-s-lg hover:bg-blue-900 focus:z-10 focus:ring-2 focus:ring-blue-500 focus:bg-blue-900 focus:text-white">
                                        View
                                    </button>
                                    @if ($checkout->status == 'booking' || $checkout->status == 'pending-paid')
                                        <form action="{{ route('admin.paid-reservasi', ['id' => $checkout->id]) }}"
                                            method="POST"
                                            class="px-4 py-2 text-sm font-medium text-white bg-green-700 border border-green-700 hover:bg-green-900 focus:z-10 focus:ring-2 focus:ring-green-500 focus:bg-green-900 focus:text-white">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="">Update Pembayaran Digital</button>
                                        </form>
                                        <form action="{{ route('admin.paid-manual-reservasi', ['id' => $checkout->id]) }}"
                                            method="POST"
                                            class="px-4 py-2 rounded-e-md items-center text-sm font-medium text-white bg-yellow-500 border border-yellow-500 hover:bg-yellow-700 focus:z-10 focus:ring-2 focus:ring-yellow-500 focus:bg-yellow-700 focus:text-white">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="block h-full w-full">Bayar Manual</button>
                                        </form>
                                    @endif
                                </div>

                                <!-- edit modal -->
                                <div id="edit-checkout{{ $checkout->id }}" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed  bg-gray-900 bg-opacity-50 top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-screen">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow-sm">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                                <h3 class="text-xl font-semibold text-gray-900">
                                                    View Data
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                    data-modal-hide="edit-checkout{{ $checkout->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                           <form action="{{ route('admin.update-reservasi', ['id' => $checkout->id]) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                             <!-- Modal body -->
                                             <div class="p-4 md:p-5 space-y-4">
                                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                    <div>
                                                        <label for="pelanggan"
                                                            class="block text-sm font-medium text-gray-700">Pelanggan</label>
                                                        <input readonly type="text" name="pelanggan" id="pelanggan"
                                                            value="{{ $checkout->pelanggan->nama }}"
                                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                            readonly>
                                                    </div>
                                                    <div>
                                                        <label for="aktivitas"
                                                            class="block text-sm font-medium text-gray-700">Aktivitas</label>
                                                        <input readonly type="text" name="aktivitas" id="aktivitas"
                                                            value="{{ $checkout->aktivitas->nama }}"
                                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                            readonly>
                                                    </div>
                                                    <div>
                                                        <label for="status"
                                                            class="block text-sm font-medium text-gray-700">Status</label>
                                                        <select id="status" name="status"
                                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                            <option value="pending"
                                                                {{ $checkout->status == 'pending' ? 'selected' : '' }}>
                                                                Pending</option>
                                                            <option value="booking"
                                                                {{ $checkout->status == 'booking' ? 'selected' : '' }}>
                                                                Booking</option>
                                                            <option value="pending-paid"
                                                                {{ $checkout->status == 'pending-paid' ? 'selected' : '' }}>
                                                                Pending Paid</option>
                                                            <option value="paid"
                                                                {{ $checkout->status == 'paid' ? 'selected' : '' }}>Paid
                                                            </option>
                                                            <option value="cancelled"
                                                                {{ $checkout->status == 'cancelled' ? 'selected' : '' }}>
                                                                Cancelled</option>
                                                            <option value="failed"
                                                                {{ $checkout->status == 'failed' ? 'selected' : '' }}>
                                                                Failed</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label for="waktu_kedatangan"
                                                            class="block text-sm font-medium text-gray-700">Waktu
                                                            Kedatangan</label>
                                                        <input type="datetime-local" name="waktu_kedatangan" id="waktu_kedatangan"
                                                            value="{{ $checkout->waktu_kedatangan}}"
                                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                    <div>
                                                        <label for="waktu_selesai"
                                                            class="block text-sm font-medium text-gray-700">Waktu
                                                            Selesai</label>
                                                        <input type="datetime-local" readonly name="waktu_selesai"
                                                            id="waktu_selesai"
                                                            value="{{ $checkout->waktu_selesai}}"
                                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                    <div>
                                                        <label for="total"
                                                            class="block text-sm font-medium text-gray-700">Total
                                                            harga</label>
                                                        <input disabled type="text" name="total" id="total"
                                                            value="Rp{{ number_format($checkout->total, 0, ',', '.') }}"
                                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                    <div>
                                                        <label for="dp"
                                                            class="block text-sm font-medium text-gray-700">DP</label>
                                                        <input disabled type="text" name="dp" id="dp"
                                                            value="Rp{{ number_format($checkout->dp, 0, ',', '.') }}"
                                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                    @if ($checkout->status === 'booking')
                                                        <div>
                                                            <label for="sisa"
                                                                class="block text-sm font-medium text-gray-700">Sisa
                                                                Harga</label>
                                                            <input disabled type="text" name="sisa" id="sisa"
                                                                value="Rp{{ number_format($checkout->total - $checkout->dp, 0, ',', '.') }}"
                                                                class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <label for="updated_at"
                                                            class="block text-sm font-medium text-gray-700">Tanggal
                                                            Pembayaran</label>
                                                        <input disabled type="text" name="updated_at" id="updated_at"
                                                            value="{{ $checkout->updated_at->format('d-m-Y H:i') }} WIB"
                                                            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div
                                                class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                                                <button type="submit"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium focus:outline-none bg-blue-500 text-white rounded-lg border border-blue-700 hover:bg-blue-700 hover:text-white focus:z-10 focus:ring-4 focus:ring-blue-300">Edit</button>
                                                <button data-modal-hide="edit-checkout{{ $checkout->id }}" type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium focus:outline-none bg-blue-500 text-white rounded-lg border border-blue-700 hover:bg-blue-700 hover:text-white focus:z-10 focus:ring-4 focus:ring-blue-300">Tutup</button>
                                            </div>
                                           </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="my-5">
            {{ $checkouts->onEachSide(1)->links('pagination::tailwind') }}
        </div>
    </section>
@endsection
@section('addJs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000 // Auto close setelah 3 detik
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            // Ambil semua error
            let errorMessages = "<ul class='list-disc text-left'>";
            @foreach ($errors->all() as $error)
                errorMessages += "<li>{{ $error }}</li>";
            @endforeach
            errorMessages += "</ul>";

            // Tampilkan semua error menggunakan SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: errorMessages, // Menggunakan `html` untuk tampilan list
                showConfirmButton: true,
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                showConfirmButton: true
            });
        </script>
    @endif
@endsection
