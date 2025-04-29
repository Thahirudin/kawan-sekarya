@extends('layout.master')
@section('title', 'Jadwal Reservasi | ' . config('app.name'))
@section('url', route('reservasi-jadwal', ['id' => $id]))
@section('addCss')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
@endsection
@section('content')
    <style>
        .fc .fc-button {
            display: inline-block
        }

        .fc .fc-daygrid-day-number {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .fc .fc-event-title {
            font-size: 14px;
            color: #333;
        }

        .fc .fc-toolbar-title {
            font-size: 20px;
        }
    </style>
    <section class="max-w-screen-xl  mx-auto p-4">

        <input type="text" id="datepicker"
            class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="Pilih Tanggal" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if ($errors->any())
            <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 " role="alert">
                <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>

                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8"
                    data-dismiss-target="#alert-2" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif
        <div class="mb-5">
            <h1 class="text-xl text-slate-700 font-bold text-center">JADWAL RESERVASI MEJA {{ $id }}</h1>
        </div>
        <div id="calendar" class="w-full block lg:h-auto"></div>
        <button data-modal-target="default-modal" data-modal-toggle="default-modal"
            class="fixed z-20 bottom-5 right-8 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Tambah
            Reservasi
            Tempat</button>
    </section>
    <!-- Main modal -->
    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden bg-gray-900 bg-opacity-50 fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Reservasi
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form action="{{ route('store-reservasi') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-5">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                Lengkap</label>
                            <input type="text" id="nama" name="nama"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="John" value="{{ Auth::guard('pelanggan')->user()->nama }}" required readonly />
                        </div>
                        <div class="mb-5">
                            <label for="waktu_kedatangan" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                                dan Waktu Kedatangan</label>
                            <input type="datetime-local" id="waktu_kedatangan" name="waktu_kedatangan"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                required />
                        </div>
                        <div class="mb-5">
                            <label for="meja_id" class="block mb-2 text-sm font-medium text-gray-900">Pilih
                                Meja</label>
                            <input type="number" id="meja_id" name="meja_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="John" value="{{ $id }}" required readonly />
                        </div>
                        <div class="mb-5">
                            <label for="jumlah_orang" class="block mb-2 text-sm font-medium text-gray-900">Jumlah
                                Orang</label>
                            <input type="number" id="jumlah_orang" name="jumlah_orang"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="4" required />
                        </div>
                        <div class="mb-5">
                            <label for="aktivitas_id" class="block mb-2 text-sm font-medium text-gray-900">Pilih
                                Kegiatan</label>
                            <select id="aktivitas_id" name="aktivitas_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                @foreach ($aktivitass as $aktivitas)
                                    <option value="{{ $aktivitas->id }}">{{ $aktivitas->nama }} -
                                        Rp{{ number_format($aktivitas->harga, 0, ',', '.') }} - {{ $aktivitas->durasi }}
                                        menit</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales-all.min.js"></script>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            // Data event
            var eventsData = [
                @foreach ($reservasis as $reservasi)
                    {
                        title: '{{ $reservasi->aktivitas->nama }} (Pelanggan: {{ $reservasi->pelanggan->nama }})',
                        start: '{{ $reservasi->waktu_kedatangan }}',
                        end: '{{ $reservasi->waktu_selesai }}'
                    },
                @endforeach
            ];

            // Inisialisasi FullCalendar
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridDay', // Tampilan default
                locale: 'id', // Bahasa Indonesia
                timeZone: 'Asia/Jakarta', // Zona waktu WIB
                height: 'auto', // Sesuaikan tinggi dengan layar
                contentHeight: 'auto', // Tambahan untuk memastikan fleksibilitas tinggi

                events: eventsData, // Memasukkan data event ke kalender
                dateClick: function(info) {
                    // Filter event berdasarkan tanggal
                    var clickedDateEvents = eventsData.filter(event => {
                        return event.start.startsWith(info.dateStr);
                    });
                }
            });

            calendar.render();

            // Integrasi Flatpickr untuk memilih tanggal
            var datepicker = document.getElementById('datepicker');
            flatpickr(datepicker, {
                enableTime: false,
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    calendar.gotoDate(dateStr); // Pindah ke tanggal yang dipilih
                }
            });
        });
    </script>
@endsection
