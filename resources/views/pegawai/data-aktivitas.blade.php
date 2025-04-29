@extends('pegawai.template.master')
@section('title')
    Data Aktivitas | {{ config('app.name') }}
@endsection
@section('aktivitas-active')
    bg-gray-200 text-blue-600 font-semibold
@endsection
@section('addCss')
@endsection
@section('content')
    <section class="p-4 bg-white rounded-xl lg:p-5 mb-5 shadow-lg">
        <div class="mb-5 flex justify-between items-center">
            <p class="text-xl font-bold">Data Aktivitas</p>
            <button type="button" data-modal-target="tambah-aktivitas"
                data-modal-toggle="tambah-aktivitas"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-700 border border-blue-700 rounded-md hover:bg-blue-900  focus:z-10 focus:ring-2 focus:ring-blue-500 focus:bg-blue-900 focus:text-white ">
                Tambah
            </button>
            <div id="tambah-aktivitas" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed  bg-gray-900 bg-opacity-50 top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-screen">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Tambah Data
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="tambah-aktivitas">
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
                            action="{{ route('pegawai.store-aktivitas') }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">
                                <div>
                                    <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                                    <input type="text" id="nama" name="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nama Aktivitas" required />
                                </div>
                                <div>
                                    <label for="durasi" class="block mb-2 text-sm font-medium text-gray-900">Durasi</label>
                                    <input type="number" id="durasi" name="durasi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Durasi Aktivitas" required />
                                </div>
                                <div>
                                    <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                                    <input type="number" id="harga" name="harga" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Harga Aktivitas" required />
                                </div>
                                <div>
                                    <label for="dp" class="block mb-2 text-sm font-medium text-gray-900">Harga DP</label>
                                    <input type="number" id="dp" name="dp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Harga Aktivitas" required />
                                </div>
                                <div>
                                    <label for="detail" class="block mb-2 text-sm font-medium text-gray-900">Detail</label>
                                    <textarea id="detail" name="detail" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Detail Aktivitas" required></textarea>
                                </div>
                                <div>
                                    <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900">Gambar</label>
                                    <input type="file" id="gambar" name="gambar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div
                                class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah</button>
                                <button data-modal-hide="tambah-aktivitas"
                                    type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="pb-4 bg-white">
                <form method="GET" action="{{ route('pegawaiDataAktivitas') }}">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama"
                        class="border rounded-lg px-3 py-2">
                    <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded-lg">Cari</button>
                </form>
            </div>
            <table id="eventTable" class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">Durasi</th>
                        <th scope="col" class="px-6 py-3">Harga</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aktivitass as $aktivitas)
                        <tr
                            class="bg-white border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-6 py-3">{{ $aktivitas->nama }}</td>
                            <td class="px-6 py-3">{{ $aktivitas->durasi }}</td>
                            <td>Rp{{ $aktivitas->harga }}</td>
                            <td class="px-6 py-3">
                                <div class="inline-flex rounded-md shadow-xs" role="group">
                                    <button type="button" data-modal-target="edit-aktivitas{{ $aktivitas->id }}"
                                        data-modal-toggle="edit-aktivitas{{ $aktivitas->id }}"
                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-700 border border-blue-700 rounded-s-lg hover:bg-blue-900  focus:z-10 focus:ring-2 focus:ring-blue-500 focus:bg-blue-900 focus:text-white ">
                                        Edit
                                    </button>
                                    <button type="button" data-modal-target="delete-aktivitas{{ $aktivitas->id }}"
                                        data-modal-toggle="delete-aktivitas{{ $aktivitas->id }}"
                                        class="px-4 py-2 text-sm font-medium text-white bg-red-700 border border-red-700 rounded-e-lg hover:bg-red-900  focus:z-10 focus:ring-2 focus:ring-red-500 focus:bg-red-900 focus:text-white">
                                        Hapus
                                    </button>
                                    <div>
                                        <!-- Delete confirmation modal -->
                                        <div id="delete-aktivitas{{ $aktivitas->id }}" aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden bg-gray-900 bg-opacity-50 fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-screen">
                                            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="flex items-start justify-between p-5 border-b rounded-t">
                                                        <h3
                                                            class="text-xl font-semibold text-gray-900 lg:text-2xl">
                                                            Hapus Data aktivitas
                                                        </h3>
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                                                            data-modal-hide="delete-aktivitas{{ $aktivitas->id }}">
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
                                                            Apakah Anda yakin ingin menghapus data aktvitas ini?
                                                        </p>
                                                        <div class="flex items-center justify-end">
                                                            <button type="button"
                                                                class="w-full sm:w-auto bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-gray-500 px-5 py-2.5"
                                                                data-modal-hide="delete-aktivitas{{ $aktivitas->id }}">
                                                                Batal
                                                            </button>
                                                            <form
                                                                action="{{ route('pegawai.delete-aktivitas', $aktivitas->id) }}"
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
                                        <div id="edit-aktivitas{{ $aktivitas->id }}" aria-hidden="true"
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
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                                            data-modal-hide="edit-aktivitas{{ $aktivitas->id }}">
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
                                                        action="{{ route('pegawai.update-aktivitas', ['id' => $aktivitas->id]) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <!-- Modal body -->
                                                        <div class="p-4 md:p-5 space-y-4">
                                                            <div>
                                                                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                                                                <input type="text" id="nama" name="nama" required value="{{ $aktivitas->nama }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nama Aktivitas" required />
                                                            </div>
                                                            <div>
                                                                <label for="durasi" class="block mb-2 text-sm font-medium text-gray-900">Durasi</label>
                                                                <input type="number" id="durasi" name="durasi" required value="{{ $aktivitas->durasi }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Durasi Aktivitas" required />
                                                            </div>
                                                            <div>
                                                                <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                                                                <input type="number" id="harga" name="harga" required value="{{ $aktivitas->harga }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Harga Aktivitas" required />
                                                            </div>
                                                            <div>
                                                                <label for="dp" class="block mb-2 text-sm font-medium text-gray-900">Harga Dp</label>
                                                                <input type="number" id="dp" name="dp" required value="{{ $aktivitas->dp }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Harga DP" required />
                                                            </div>
                                                            <div>
                                                                <label for="detail" class="block mb-2 text-sm font-medium text-gray-900">Detail</label>
                                                                <textarea id="detail" name="detail" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Detail Aktivitas" required>{{ $aktivitas->detail }}</textarea>
                                                            </div>
                                                            <div>
                                                                <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900">Gambar</label>
                                                                <input type="file" id="gambar" name="gambar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                                                                @if ($aktivitas->gambar)
                                                                    <img src="{{ asset($aktivitas->gambar) }}" alt="Gambar Aktivitas" class="mt-2 w-24 h-32 object-cover">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div
                                                            class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                                                            <button type="submit"
                                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</button>
                                                            <button data-modal-hide="edit-aktivitas{{ $aktivitas->id }}"
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
            {{ $aktivitass->onEachSide(1)->links('pagination::tailwind') }}
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
