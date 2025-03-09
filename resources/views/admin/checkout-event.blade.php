@extends('admin.template.master')
@section('title')
    Data Checkout event | {{ config('app.name') }}
@endsection
@section('invoice-active')
    bg-gray-200 text-blue-600 font-semibold
@endsection
@section('addCss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection
@section('content')
    <section class="p-4 bg-white rounded-xl lg:p-5 mb-5 shadow-lg">
        <div class="mb-5 flex justify-between items-center">
            <p class="text-xl font-bold">Data Checkout Event</p>
            <a href="" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Data</a>
        </div>
        <div class="relative overflow-x-auto">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Pelanggan</th>
                        <th>Event</th>
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
                            <td>{{ $checkout->event->nama }}</td>
                            <td>{{ $checkout->status }}</td>
                            <td>Rp{{ number_format($checkout->total, 0, ',', '.') }}</td>
                            <td>
                                <div class="inline-flex rounded-md shadow-xs" role="group">
                                    <a  href=""
                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-700 border border-blue-700 rounded-s-lg hover:bg-blue-900  focus:z-10 focus:ring-2 focus:ring-blue-500 focus:bg-blue-900 focus:text-white ">
                                        Edit
                                    </a>
                                    <a href=""
                                        class="px-4 py-2 text-sm font-medium text-white bg-red-700 border border-red-700 rounded-e-lg hover:bg-red-900  focus:z-10 focus:ring-2 focus:ring-red-500 focus:bg-red-900 focus:text-white">
                                        Hapus
                                    </a>
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
            $('#example').DataTable();
        });
    </script>
@endsection
