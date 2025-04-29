@extends('pegawai.template.master')
@section('title')
    Data Pegawai | {{ config('app.name') }}
@endsection
@section('pegawai-active')
    bg-gray-200 text-blue-600 font-semibold
@endsection
@section('addCss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection
@section('content')
    <section class="p-4 bg-white rounded-xl lg:p-5 mb-5 shadow-lg">
        <div class="mb-5 flex justify-between items-center">
            <p class="text-xl font-bold">Data Pegawai</p>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="pb-4 bg-white">
                <form method="GET" action="{{ route('pegawaiDataPegawai') }}">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama"
                        class="border rounded-lg px-3 py-2">
                    <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded-lg">Cari</button>
                </form>
            </div>
            <table id="eventTable" class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
                        <th scope="col" class="px-6 py-3">No. HP</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Jabatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pegawais as $pegawai)
                        <tr
                            class="bg-white border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-6 py-3">{{ $pegawai->nama }}</td>
                            <td class="px-6 py-3">
                                {{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                            <td class="px-6 py-3">{{ $pegawai->nomor_hp }}</td>
                            <td class="px-6 py-3">{{ $pegawai->email }}</td>
                            <td class="px-6 py-3">{{ $pegawai->jabatan }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="my-5">
            {{ $pegawais->onEachSide(1)->links('pagination::tailwind') }}
        </div>
    </section>
@endsection
@section('addJs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
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
