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
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="pb-4 bg-white">
                <form method="GET" action="{{ route('adminCheckoutEvent') }}">
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
                        <th scope="col" class="px-6 py-3">Event</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($checkouts as $checkout)
                        <tr
                            class="bg-white border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-6 py-3">{{ $checkout->id }}</td>
                            <td class="px-6 py-3">{{ $checkout->pelanggan->nama }}</td>
                            <td class="px-6 py-3">{{ $checkout->event->nama }}</td>
                            <td class="px-6 py-3">{{ $checkout->status }}</td>
                            <td class="px-6 py-3">{{ $checkout->updated_at->translatedFormat('d F Y H:i') }} WIB</td>
                            <td class="px-6 py-3">Rp{{ number_format($checkout->total, 0, ',', '.') }}</td>
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
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                lengthMenu: [
                    [10, 25, 50, 75, 100],
                    [10, 25, 50, 75, 100]
                ], // Dua array untuk nilai dan tampilan
                dom: 'lBfrtip', // Pastikan 'l' (length menu) ada dalam DOM
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    }
                ],
            });
        });
    </script>
@endsection
