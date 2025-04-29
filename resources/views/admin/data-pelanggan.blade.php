@extends('admin.template.master')
@section('title')
    Data Pelanggan | {{ config('app.name') }}
@endsection
@section('pelanggan-active')
    bg-gray-200 text-blue-600 font-semibold
@endsection
@section('addCss')
@endsection
@section('content')
    <section class="p-4 bg-white rounded-xl lg:p-5 mb-5 shadow-lg">
        <div class="mb-5 flex justify-between items-center">
            <p class="text-xl font-bold">Data Pelanggan</p>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="pb-4 bg-white">
                <form method="GET" action="{{ route('adminDataPelanggan') }}">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan order Id"
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
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggans as $pelanggan)
                        <tr
                            class="bg-white border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-6 py-3">{{ $pelanggan->nama }}</td>
                            <td class="px-6 py-3">{{ \Carbon\Carbon::parse($pelanggan->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                            <td class="px-6 py-3">{{ $pelanggan->nohp }}</td>
                            <td class="px-6 py-3">{{ $pelanggan->email }}</td>
                            <td class="px-6 py-3">
                                <div class="inline-flex rounded-md shadow-xs" role="group">
                                    <button type="button" data-modal-target="edit-pelanggan{{ $pelanggan->id }}"
                                        data-modal-toggle="edit-pelanggan{{ $pelanggan->id }}"
                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-700 border border-blue-700 rounded-s-lg hover:bg-blue-900  focus:z-10 focus:ring-2 focus:ring-blue-500 focus:bg-blue-900 focus:text-white ">
                                        Edit
                                    </button>
                                    <button type="button" data-modal-target="delete-pelanggan{{ $pelanggan->id }}"
                                        data-modal-toggle="delete-pelanggan{{ $pelanggan->id }}"
                                        class="px-4 py-2 text-sm font-medium text-white bg-red-700 border border-red-700 rounded-e-lg hover:bg-red-900  focus:z-10 focus:ring-2 focus:ring-red-500 focus:bg-red-900 focus:text-white">
                                        Hapus
                                    </button>
                                    <div>
                                        <!-- Delete confirmation modal -->
                                        <div id="delete-pelanggan{{ $pelanggan->id }}" tabindex="-1" aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden bg-gray-900 bg-opacity-50 fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-screen">
                                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex items-start justify-between p-5 border-b rounded-t">
                                                        <h3
                                                            class="text-xl font-semibold text-gray-900 lg:text-2xl">
                                                            Hapus Data Pelanggan
                                                        </h3>
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                            data-modal-hide="delete-pelanggan{{ $pelanggan->id }}">
                                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-6 space-y-6">
                                                        <p
                                                            class="text-base leading-relaxed text-gray-500">
                                                            Apakah Anda yakin ingin menghapus data pelanggan ini?
                                                        </p>
                                                        <div class="flex items-center justify-end">
                                                            <button type="button"
                                                                class="w-full sm:w-auto bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-gray-500 px-5 py-2.5"
                                                                data-modal-hide="delete-pelanggan{{ $pelanggan->id }}">
                                                                Batal
                                                            </button>
                                                            <form
                                                                action="{{ route('admin.delete-pelanggan', $pelanggan->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="w-full sm:w-auto bg-blue-500 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- edit modal --}}
                                        <div id="edit-pelanggan{{ $pelanggan->id }}" aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed  bg-gray-900 bg-opacity-50 top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-screen">
                                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow-sm">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                                        <h3 class="text-xl font-semibold text-gray-900">
                                                            Edit Data
                                                        </h3>
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                                            data-modal-hide="edit-pelanggan{{ $pelanggan->id }}">
                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <form
                                                        action="{{ route('admin.update-pelanggan', ['id' => $pelanggan->id]) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <!-- Modal body -->
                                                        <div class="p-4 md:p-5 space-y-4">
                                                            <div>
                                                                <label for="nama"
                                                                    class="block mb-2 text-sm font-medium text-gray-900">Nama
                                                                    Lengkap</label>
                                                                <input type="text" id="nama" name="nama"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                    value="{{ $pelanggan->nama }}" required>
                                                            </div>
                                                            <div>
                                                                <label for="email"
                                                                    class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                                                                <input type="email" id="email" name="email"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                    value="{{ $pelanggan->email }}" required>
                                                            </div>
                                                            <div>
                                                                <label for="tanggal_lahir"
                                                                    class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                                                                    Lahir</label>
                                                                <input type="date" id="tanggal_lahir"
                                                                    name="tanggal_lahir"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                    value="{{ \Carbon\Carbon::parse($pelanggan->tanggal_lahir)->format('Y-m-d') }}"
                                                                    required>
                                                            </div>
                                                            <div>
                                                                <label for="nohp"
                                                                    class="block mb-2 text-sm font-medium text-gray-900">No
                                                                    HP</label>
                                                                <input type="text" id="nohp" name="nohp"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                                    value="{{ $pelanggan->nohp }}" required>
                                                            </div>
                                                            <div>
                                                                <label for="password"
                                                                    class="block mb-2 text-sm font-medium text-gray-900">Ganti
                                                                    Password</label>
                                                                <input type="password" id="password" name="password"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                            </div>
                                                            <div>
                                                                <label for="gambar"
                                                                    class="block mb-2 text-sm font-medium text-gray-900">Gambar</label>
                                                                <input type="file" id="gambar" name="gambar"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                            </div>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div
                                                            class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                                                            <button type="submit"
                                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</button>
                                                            <button data-modal-hide="edit-pelanggan{{ $pelanggan->id }}"
                                                                type="button"
                                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="my-5">
            {{ $pelanggans->onEachSide(1)->links('pagination::tailwind') }}
        </div>
    </section>
@endsection
@section('addJs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
