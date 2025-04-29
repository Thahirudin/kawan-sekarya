@extends('layout.master')
@section('content')
    <section class="max-w-screen-xl  mx-auto p-4 my-5">
        <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h1 class="text-2xl font-extrabold text-[#222222] text-center mb-5">FORM RESERVASI KAWAN SEKARYA</h1>
            <form action="{{ route('store-reservasi') }}" method="POST">
                @csrf
                @method('POST')
                @if ($errors->any())
                    <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                        <svg class="shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
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
                    <label for="meja" class="block mb-2 text-sm font-medium text-gray-900">Pilih
                        Meja</label>
                    <select id="meja" name="meja_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @foreach ($mejas as $meja)
                            <option value="{{ $meja->id }}">{{ $meja->nama }} - Maks {{ $meja->kapasitas }} Orang
                            </option>
                        @endforeach
                    </select>
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
                                Rp{{ number_format($aktivitas->harga, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Kirim</button>
            </form>
        </div>
    </section>
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
