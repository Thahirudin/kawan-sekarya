@extends('layout.master')
@section('content')
    <section class="max-w-screen-xl  mx-auto p-4 my-5">
        <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <h1 class="text-2xl font-extrabold text-[#222222] text-center mb-5">FORM PENDAFTARAN EVENT</h1>
            <form action="">
                <div class="mb-5">
                    <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900">Nama
                        Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="John" value="{{ Auth::guard('pelanggan')->user()->nama }}" required readonly />
                </div>
                <div class="mb-5">
                    <label for="nama_event" class="block mb-2 text-sm font-medium text-gray-900">Nama Event</label>
                    <input type="text" id="nama_event" name="nama_event"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="John" value="{{ $event->nama }}" required readonly/>
                </div>
                <div class="mb-5">
                    <label for="mulai" class="block mb-2 text-sm font-medium text-gray-900 ">Mulai</label>
                    <input type="datetime-local" id="mulai" name="mulai"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required value="{{ $event->tanggal_mulai }}" readonly/>
                </div>
                <div class="mb-5">
                    <label for="harga" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                    <input type="number" id="harga" name="harga"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required value="{{ $event->harga }}" readonly/>
                </div>
                <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Daftar</button>
            </form>
        </div>

    </section>
@endsection
