@extends('layout.master')
@section('content')

<style>
    .fc-button{
        display: inline-block
    }
</style>
<section class="max-w-screen-xl  mx-auto p-4">

    <input type="text" id="datepicker"
        class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Pilih Tanggal" />
    <div id="calendar" class="w-full block lg:h-auto h-screen"></div>
    <a href="{{ route('tambah-reservasi', ['id' => $id]) }}"
        class="fixed z-20 bottom-5 right-8 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Tambah
        Reservasi
        Tempat</a>
</section>


<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales-all.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        // Data event
        var eventsData = [
            @foreach($reservasis as $reservasi)
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
