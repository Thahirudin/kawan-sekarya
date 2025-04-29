@extends('layout.master')
@section('content')
    <!-- sidebar mobile -->
    <div id="accordion-collapse" data-accordion="collapse" class="lg:hidden bg-white">
        <h2 id="accordion-collapse-heading-1">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 gap-3"
                data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                aria-controls="accordion-collapse-body-1">
                <span>Navigasi Profile</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
            <div class=" bg-white shadow-lg rounded-md p-6">
                <div class="">
                    <a href="{{ route('profile') }}" class="flex py-2 px-4 text-black hover:bg-blue-100">
                        <svg class="w-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path
                                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                        </svg>
                        Profile Saya
                    </a>
                </div>
                <div class="">
                    <a href="{{ route('checkout.history') }}" class="flex py-2 px-4 text-black hover:bg-blue-100">
                        <svg class="w-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path
                                d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z" />
                        </svg>
                        Riwayat Transaksi Event
                    </a>
                </div>
                <div class="">
                    <a href="{{ route('reservasi.history') }}" class="flex py-2 px-4 text-black hover:bg-blue-100">
                        <svg class="w-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path
                                d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z" />
                        </svg>
                        Riwayat Transaksi Reservasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:flex justify-center items-start max-w-screen-xl mx-auto p-4 lg:space-x-4">
        <!-- Sidebar -->
        <div class="lg:h-56 lg:w-1/4 bg-white shadow-lg rounded-md p-6 hidden lg:block">
            <div class="">
                <a href="{{ route('profile') }}" class="lg:flex py-2 px-4 text-black hover:bg-blue-100">
                    <svg class="w-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path
                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                    </svg>
                    Profile Saya
                </a>
            </div>
            <div class="">
                <a href="{{ route('checkout.history') }}" class="flex py-2 px-4 text-black hover:bg-blue-100">
                    <svg class="w-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path
                            d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z" />
                    </svg>
                    Riwayat Transaksi Event
                </a>
            </div>
            <div class="">
                <a href="{{ route('reservasi.history') }}" class="flex py-2 px-4 text-black hover:bg-blue-100">
                    <svg class="w-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path
                            d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z" />
                    </svg>
                    Riwayat Reservasi
                </a>
            </div>
        </div>

        <div class="mr-20"></div>

        <!-- Main Content (Invoice) -->
        <div class="w-full bg-white shadow-lg rounded-md p-6">
            <div class="mb-4">

                <div class="text-3xl font-bold text-blue-500">Invoice</div>
                <div class="text-xs text-gray-500">Order Id: {{ $checkout->id }}</div>
                <div class="text-xs text-gray-500">Status: {{ $checkout->status }}</div>
            </div>
            <div class="border-b border-gray-300 mb-6"></div>

            <div class="mb-3">
                <p class="text-lg font-semibold">Nama Lengkap</p>
                <p>{{ $checkout->pelanggan->nama }}</p>
            </div>
            <div class="mb-3">
                <p class="text-lg font-semibold">Nama Event</p>
                <p>{{ $checkout->event->nama }}</p>
            </div>
            <div class="mb-3">
                <p class="text-lg font-semibold">Tanggal Kegiatan</p>
                <p>{{ \Carbon\Carbon::parse($checkout->event->tanggal_mulai)->isoFormat('D MMMM YYYY HH:mm') }} -
                    {{ \Carbon\Carbon::parse($checkout->event->tanggal_selesai)->isoFormat('D MMMM YYYY HH:mm') }}</p>

            </div>
            <div class="mb-3">
                <p class="text-lg font-semibold">Total Pembayaran</p>
                <p>Rp{{ number_format($checkout->total, 0, ',', '.') }}</p>
            </div>
            <div class="mb-3">
                <p class="text-lg font-semibold">Waktu Pembayaran</p>
                @if ($checkout->status === 'paid')
                    <p>{{ $checkout->updated_at }}</p>
                @else
                    <p>-</p>
                @endif
            </div>
            <div class="mb-3 flex gap-5">
                @if ($checkout->status === 'pending')
                    @if ($jumlahPesertaPaid < $checkout->event->kapasitas)
                        <button id="pay-button"
                            class="bg-blue-700 text-white font-bold py-2 px-6 rounded-md hover:bg-blue-800">
                            Bayar
                        </button>
                        <form action="{{ route('checkout.cancel', ['id' => $checkout->id]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="bg-red-700 text-white font-bold py-2 px-6 rounded-md hover:bg-red-800">
                                Batal
                            </button>
                        </form>
                    @else
                        <p class="text-red-600">Pembayaran Error: Kapasitas Penuh</p>
                    @endif
                @endif

            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            // SnapToken acquired from previous step
            snap.pay('{{ $checkout->snap_token }}', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    window.location.href =
                        '{{ route('checkout.status') . '/?order_id=' . $checkout->id }}';
                },
                // Optional
                onPending: function(result) {},
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    window.location.href =
                        '{{ route('checkout.status') . '/?order_id=' . $checkout->id }}';
                }
            });
        };
    </script>
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
            let errorMessages =
                `@foreach ($errors->all() as $error) {{ $error }}\n @endforeach`;

            // Tampilkan semua error menggunakan SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: errorMessages,
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
