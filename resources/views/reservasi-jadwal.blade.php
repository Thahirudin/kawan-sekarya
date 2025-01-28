@extends('layout.master')
@section('content')
<section class="max-w-screen-xl  mx-auto p-4">

    <input type="text" id="datepicker"
        class="mb-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Pilih Tanggal" />
    <div id="calendar" class="w-full lg:h-auto h-screen"></div>
    <a href="./tambah-reservasi"
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
        var eventsData = [{
                title: 'Booking Pelanggan 2020201 (Thahirudin)',
                start: '2025-01-28T10:00:00',
                end: '2025-01-28T12:00:00',
            },
            {
                title: 'Booking Pelanggan 2020201 (Bambang Pratama)',
                start: '2025-01-28T14:00:00',
                end: '2025-01-28T16:00:00',
            }
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

                if (clickedDateEvents.length > 0) {
                    let message = 'Events on ' + info.dateStr + ':\n';
                    clickedDateEvents.forEach(event => {
                        message += `- ${event.title}\n`;
                    });
                    alert(message);
                } else {
                    alert('No events on ' + info.dateStr);
                }
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
