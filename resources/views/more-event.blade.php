@extends('layout.master')
@section('content')
<div class="max-w-screen-xl mx-auto p-4 my-5 flex flex-col lg:flex-row lg:space-x-6">

    <!-- Main Content (Kiri) -->
    <div
        class="mb-6 flex-1 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <h1 class="text-2xl font-extrabold text-[#222222] text-center">KeyChain</h1>
        <p class="text font-bold text-[#222222] text-center mb-5">18/03/2024</p>
        <div class="border-b border-gray-300 mb-6"></div>

        <!-- Gambar di tengah -->
        <div class="flex justify-center">
            <img src="{{asset('img/logoKS.png')}}" alt="Logo" class="w-64 mb-10">
        </div>

        <h1 class="text-2xl font-extrabold text-[#222222]">Deskripsi</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas est tenetur corrupti sed excepturi, velit quia
            porro? Ad accusamus, omnis rerum possimus nesciunt error, cum sed, debitis ullam obcaecati facere?</p><br>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas est tenetur corrupti sed excepturi, velit quia
            porro? Ad accusamus, omnis rerum possimus nesciunt error, cum sed, debitis ullam obcaecati facere?</p><br>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas est tenetur corrupti sed excepturi, velit quia
            porro? Ad accusamus, omnis rerum possimus nesciunt error, cum sed, debitis ullam obcaecati facere?</p>


        <div class="border-b border-gray-300 mb-6 mt-6"></div>
        <h1 class="text-2xl font-extrabold text-[#222222]">Susunan Acara</h1>

        <div class="border-b border-gray-300 mb-6 mt-6"></div>
        <div class="flex space-x-4">
            <button class="bg-blue-700 text-white font-bold py-2 px-6 rounded-md hover:bg-blue-800">
                Daftar
            </button>
            <button class="bg-red-700 text-white font-bold py-2 px-6 rounded-md hover:bg-red-800">
                Batal
            </button>
        </div>
    </div>

    <!-- Sidebar (Kanan) -->
    <div
        class="h-2/3 w-full lg:w-1/4 p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="max-w-md mx-auto p-4">
            <!-- Jadwal Pelaksanaan -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-900">Jadwal Pelaksanaan</h2>
                <div class="grid grid-cols-2 gap-2 mt-2">
                    <p class="text-gray-600">Mulai</p>
                    <p class="font-bold text-gray-900">: 18 Mar 2023 08:00</p>
                    <p class="text-gray-600">Selesai</p>
                    <p class="font-bold text-gray-900">: 18 Mar 2023 17:00</p>
                </div>
            </div>

            <!-- Lokasi -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Lokasi</h2>
                <div class="flex items-start space-x-2 mt-2">
                    <svg class="w-5 h-5 text-gray-700 mt-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path fill="currentColor"
                            d="M168 0C75.2 0 0 75.2 0 168c0 16.9 2.5 33.3 7.2 48.7C40.1 322.6 168 512 168 512s127.9-189.4 160.8-295.3c4.7-15.4 7.2-31.8 7.2-48.7C336 75.2 260.8 0 168 0zm0 256c-48.5 0-88-39.5-88-88s39.5-88 88-88 88 39.5 88 88-39.5 88-88 88z" />
                    </svg>
                    <div>
                        <p class="text-gray-700">LIVE di Youtube :</p>
                        <a href="#" class="text-pink-500 font-semibold hover:underline">kawansekarya.com</a>
                        <p class="text-green-600 font-semibold">Online</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection