@extends('layout.master')
@section('title', $event->nama . " | " . config('app.name'))
@section('desk_singkat', $event->deskripsi_singkat)
@section('keywords', $event->nama)
@section('thumbnail', asset($event->gambar))
@section('url', route('event.detail', $event->id))
@section('content')
    <style>
        
        
        #detail ul {
            list-style-type: disc !important;
            margin-left: 20px !important;
        }

        #detail ol {
            list-style-type: decimal !important;
            margin-left: 20px !important;
        }

        #detail h1 {
            font-size: 2rem !important;
            margin-bottom: 1rem !important;
        }

        #detail h2 {
            font-size: 1.75rem !important;
            margin-bottom: 0.75rem !important;
        }

        #detail h3 {
            font-size: 1.5rem !important;
            margin-bottom: 0.5rem !important;
        }

        #detail table {
            width: 100% !important;
            border-collapse: collapse !important;
            margin-top: 1rem !important;
        }

        #detail table th,
        #detail table td {
            border: 1px solid #ddd !important;
            padding: 8px !important;
        }

        #detail table th {
            background-color: #f4f4f4 !important;
            font-weight: bold !important;
            text-align: left !important;
        }

        #detail table tr:nth-child(even) {
            background-color: #f9f9f9 !important;
        }

        #detail table tr:hover {
            background-color: #f1f1f1 !important;
        }
    </style>
    <div class="max-w-screen-xl mx-auto p-4 my-5 flex flex-col lg:flex-row lg:space-x-6">

        <!-- Main Content (Kiri) -->
        <div
            class="mb-6 flex-1 p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <div class="border-b border-gray-300 mb-6 pb-6">
                <h1 class="text-2xl font-extrabold text-[#222222] text-center">{{ $event->nama }}</h1>
            </div>

            <!-- Gambar di tengah -->
            <div class="flex justify-center">
                <img src="{{ asset($event->gambar) }}" alt="Logo" class="w-full mb-10">
            </div>

            <h1 class="text-2xl font-extrabold text-[#222222]">Deskripsi</h1>
            <div id="detail">
                {!! $event->deskripsi !!}

            </div>

            <div class="border-b border-gray-300 mb-6 mt-6"></div>
            <div class="flex space-x-4">
                <div>
                    @php
                        $currentDate = \Carbon\Carbon::now(); // Mendapatkan tanggal dan waktu saat ini
                    @endphp

                    @if ($jumlahPesertaPaid < $event->kapasitas && $currentDate->lessThanOrEqualTo($event->tanggal_mulai))
                        @if (Auth::guard('pelanggan')->check())
                            <form action="{{ route('daftar-event') }}" method="POST">
                                @csrf
                                @method('POST')
                                <input type="number" value="{{ $event->id }}" name="event_id" required readonly hidden>
                                <button type="submit"
                                    class="bg-blue-700 text-white font-bold py-2 px-6 rounded-md hover:bg-blue-800">
                                    Daftar
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="bg-blue-700 text-white font-bold py-2 px-6 rounded-md hover:bg-blue-800">
                                Login sebelum daftar
                            </a>
                        @endif
                    @else
                        @if ($currentDate->greaterThan($event->tanggal_mulai))
                            <p class="text-red-700">Pendaftaran Ditutup</p>
                        @else
                            <p class="text-red-700">Pendaftaran Sudah Penuh</p>
                        @endif
                    @endif
                </div>

            </div>
        </div>

        <!-- Sidebar (Kanan) -->
        <div
            class="h-2/3 w-full lg:w-1/4 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="max-w-md mx-auto p-4">
                <!-- Jadwal Pelaksanaan -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Jadwal Pelaksanaan</h2>
                    <div class="flex mt-2">
                        <p class="w-[40%] text-gray-600">Mulai</p>
                        <p class="w-[60%] font-bold text-gray-900">:
                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y H:i') }} WIB</p>
                    </div>
                    <div class="flex mt-2">
                        <p class="w-[40%] text-gray-600">Selesai</p>
                        <p class="w-[60%] font-bold text-gray-900">:
                            {{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('d F Y H:i') }} WIB</p>
                    </div>
                    <div class="flex mt-2">
                        <p class="w-[40%] text-gray-600">Harga</p>
                        <p class="w-[60%] font-bold text-gray-900">: Rp{{ number_format($event->harga, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Lokasi -->
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-900">Lokasi</h2>
                    <div class="flex items-start space-x-2 mt-2">
                        <svg class="w-5 h-5 text-gray-700 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path fill="currentColor"
                                d="M168 0C75.2 0 0 75.2 0 168c0 16.9 2.5 33.3 7.2 48.7C40.1 322.6 168 512 168 512s127.9-189.4 160.8-295.3c4.7-15.4 7.2-31.8 7.2-48.7C336 75.2 260.8 0 168 0zm0 256c-48.5 0-88-39.5-88-88s39.5-88 88-88 88 39.5 88 88-39.5 88-88 88z" />
                        </svg>
                        <div>
                            <p class="text-gray-700">{{ $event->lokasi }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    @php
                        $currentDate = \Carbon\Carbon::now(); // Mendapatkan tanggal dan waktu saat ini
                    @endphp

                    @if ($jumlahPesertaPaid < $event->kapasitas && $currentDate->lessThanOrEqualTo($event->tanggal_mulai))
                        @if (Auth::guard('pelanggan')->check())
                            <form action="{{ route('daftar-event') }}" method="POST">
                                @csrf
                                @method('POST')
                                <input type="number" value="{{ $event->id }}" name="event_id" required readonly hidden>
                                <button type="submit"
                                    class="bg-blue-700 text-white font-bold py-2 px-6 rounded-md hover:bg-blue-800">
                                    Daftar
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="bg-blue-700 text-white font-bold py-2 px-6 rounded-md hover:bg-blue-800">
                                Login sebelum daftar
                            </a>
                        @endif
                    @else
                        @if ($currentDate->greaterThan($event->tanggal_mulai))
                            <p class="text-red-700">Pendaftaran Ditutup</p>
                        @else
                            <p class="text-red-700">Pendaftaran Sudah Penuh</p>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
