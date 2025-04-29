@extends('pegawai.template.master')
@section('title')
    Dashboard | {{ config('app.name') }}
@endsection
@section('dashboard-active')
    bg-gray-200 text-blue-600 font-semibold
@endsection
@section('addCss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection
@section('content')
    <section class="md:grid md:grid-cols-3 md:gap-5 mb-5">
        <div class="mb-5 p-4 md:mb-0 bg-white rounded-xl lg:p-5 font-bold  shadow-lg">
            <p>Total Pegawai</p>
            <p class="text-[40px] text-center">{{ $totalPegawai }}</p>
        </div>
        <div class="mb-5 p-4 md:mb-0 bg-white rounded-xl lg:p-5 font-bold  shadow-lg">
            <p>Total Reservasi Selesai</p>
            <p class="text-[40px] text-center">{{ $totalReservasi }}</p>
        </div>
        <div class="mb-5 p-4 md:mb-0 bg-white rounded-xl lg:p-5 font-bold  shadow-lg">
            <p>Total Checkout Selesai</p>
            <p class="text-[40px] text-center">{{ $totalCheckout }}</p>
        </div>

    </section>
    <section class="mb-5">
        <div class="mb-5 p-4 md:mb-0 bg-white rounded-xl lg:p-5 font-bold  shadow-lg">
            <p>Total Pemasukan</p>
            <p class="text-[40px] text-center">Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</p>
        </div>
    </section>
    <section class=" mb-5">
        <div class="mb-5 p-4 md:mb-0 bg-white rounded-xl lg:p-5 font-bold  shadow-lg">
            <canvas id="myChart" style="width:100%;" class="h-[300px]"></canvas>
        </div>
    </section>
    <section class="p-4 bg-white rounded-xl lg:p-5 mb-5 shadow-lg">
        <div class="mb-5 flex justify-between items-center">
            <p class="text-xl font-bold">Data Event</p>
        </div>
        <div class="relative overflow-x-auto">
            <table id="example" class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Kapasitas </th>
                        <th>Harga</th>
                        <th>Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y H:i') }} WIB -
                                {{ \Carbon\Carbon::parse($event->tanggal_selesai)->translatedFormat('d F Y H:i') }} WIB
                            </td>

                            <td>{{ $event->kapasitas }}</td>
                            <td>Rp {{ number_format($event->harga, 0, ',', '.') }}</td>
                            <td>{{ $event->lokasi }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <section class="p-4 bg-white rounded-xl lg:p-5 mb-5 shadow-lg">
        <div class="mb-5 flex justify-between items-center">
            <p class="text-xl font-bold">Data Reservasi</p>
        </div>
        <div class="relative overflow-x-auto">
            <table id="example2" class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead>
                    <tr>
                        <th>Nama Pelanggan</th>
                        <th>Meja</th>
                        <th>Aktivitas</th>
                        <th>Kapasitas</th>
                        <th>Waktu Kedatangan</th>
                        <th>Waktu Selesai</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservasis as $reservasi)
                        <tr>
                            <td>{{ $reservasi->pelanggan->nama }}</td>
                            <td>{{ $reservasi->meja->nama }}</td>
                            <td>{{ $reservasi->aktivitas->nama }}</td>
                            <td>{{ $reservasi->meja->kapasitas }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservasi->waktu_kedatangan)->translatedFormat('d F Y H:i') }}
                                WIB</td>
                            <td>{{ \Carbon\Carbon::parse($reservasi->waktu_selesai)->translatedFormat('d F Y H:i') }} WIB
                            </td>
                            <td>
                                <div
                                    class="px-2 py-1 text-center rounded-full text-white {{ $reservasi->status == 'failed' || $reservasi->status == 'cancelled'
                                        ? 'bg-red-500'
                                        : ($reservasi->status == 'pending'|| $reservasi->status == 'pending-paid'
                                            ? 'bg-yellow-500'
                                            : ($reservasi->status == 'paid' 
                                                ? 'bg-green-700'
                                                : ($reservasi->status == 'booking'
                                                    ? 'bg-green-500'
                                                    : ''))) }}">
                                    {{ $reservasi->status }}
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
@section('addJs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                searching: true,
                ordering: true,
                pageLength: 5, // Menampilkan 5 data per halaman secara default,
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "Semua"]
                ]
            });
            $('#example2').DataTable({
                responsive: true,
                searching: true,
                ordering: true,
                pageLength: 5, // Menampilkan 5 data per halaman secara default,
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "Semua"]
                ]
            });
        });
    </script>
    <script>
        const xValues = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
            'November', , 'Desember'
        ];

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    data: [2000000, 110040, 210060, 10000060, 1070, 1110, 1330, 2210, 7830, 2478],
                    borderColor: "#3B82F6",
                    fill: false
                }, ]
            },
            options: {
                responsive: true,
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Pemasukann Kawan Sekarya'
                }
            }
        });
    </script>
@endsection
