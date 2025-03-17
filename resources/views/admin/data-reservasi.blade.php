@extends('admin.template.master')
@section('title')
    Data Checkout event | {{ config('app.name') }}
@endsection
@section('reservasi-active')
    bg-gray-200 text-blue-600 font-semibold
@endsection
@section('addCss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection
@section('content')
    <section class="p-4 bg-white rounded-xl lg:p-5 mb-5 shadow-lg">
        <div class="mb-5 flex justify-between items-center">
            <h1 class="text-xl font-bold">Data Reservasi</h1>
            <div>
                <button class="bg-green-500 text-white px-4 py-2 rounded mr-2">Ekspor Excel</button>
                <button class="bg-red-500 text-white px-4 py-2 rounded">Ekspor PDF</button>
            </div>
        </div>
        <div class="relative overflow-x-auto">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Pelanggan</th>
                        <th>Aktivitas</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($checkouts as $checkout)
                        <tr>
                            <td>{{ $checkout->id }}</td>
                            <td>{{ $checkout->pelanggan->nama }}</td>
                            <td>{{ $checkout->aktivitas->nama }}</td>
                            <td>{{ $checkout->status }}</td>
                            <td>Rp{{ number_format($checkout->total, 0, ',', '.') }}</td>
                            <td>
                                @if ($checkout->status == 'booking')
                                    <form action="" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Paid</button>
                                    </form>
                                @endif
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
            $('#example').DataTable();
        });
    </script>
@endsection
