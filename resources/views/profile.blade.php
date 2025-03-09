@extends('layout.master')
@section('content')
    <!-- sidebar mobile -->
    <div id="accordion-collapse" data-accordion="collapse" class="lg:hidden bg-white">
        <h2 id="accordion-collapse-heading-1">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                aria-controls="accordion-collapse-body-1">
                <span>Navigasi Profile</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
            <div class=" bg-white shadow-lg rounded-md p-6">
                <div class="">
                    <a href="{{ route('profile') }}" class="flex py-2 px-4 text-black hover:bg-blue-100">
                        <svg class="w-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path
                                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                        </svg>
                        Profile Saya
                    </a>
                </div>
                <div class="">
                    <a href="#" class="flex py-2 px-4 text-black hover:bg-blue-100">
                        <svg class="w-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path
                                d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z" />
                        </svg>
                        Riwayat Transaksi Event
                    </a>
                </div>
                <div class="">
                    <a href="#" class="flex py-2 px-4 text-black hover:bg-blue-100">
                        <svg class="w-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path
                                d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z" />
                        </svg>
                        Riwayat Transaksi Reservasi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:flex justify-center items-start max-w-screen-xl mx-auto p-4 lg:space-x-4">
        <!-- Sidebar -->
        <div class="lg:h-56 lg:w-1/4 bg-white shadow-lg rounded-md p-6 hidden lg:block">
            <div class="">
                <a href="{{ route('profile') }}" class="lg:flex py-2 px-4 text-black hover:bg-blue-100">
                    <svg class="w-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path
                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                    </svg>
                    Profile Saya
                </a>
            </div>
            <div class="">
                <a href="{{ route('checkout.history') }}" class="flex py-2 px-4 text-black hover:bg-blue-100">
                    <svg class="w-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path
                            d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z" />
                    </svg>
                    Riwayat Transaksi Event
                </a>
            </div>
            <div class="">
                <a href="{{ route('reservasi.history') }}" class="flex py-2 px-4 text-black hover:bg-blue-100">
                    <svg class="w-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                        <path
                            d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z" />
                    </svg>
                    Riwayat Reservasi
                </a>
            </div>
        </div>
        <div class="mr-20"></div>

        <!-- Main Content -->
        <div class="flex-1 bg-white p-6 rounded-md shadow-md">
            <div>
                <!-- Profile Header -->
                <div class="flex items-center space-x-6 mb-8">
                    <img src="{{ asset(Auth::guard('pelanggan')->user()->gambar) }}"
                        class="w-36 h-36 bg-cover rounded-full bg-" alt="">
                    <input type="file" class="bg-gray-200 px-4 py-2 rounded-md text-gray-700"></input>
                </div>

                <!-- Profile Info -->
                <div class="grid grid-cols-2 gap-2 mt-2">
                    <p>Email</p>
                    <p class="font-medium text-gray-700">: {{ Auth::guard('pelanggan')->user()->email }}</p>
                    <p>Nama</p>
                    <p class="font-medium text-gray-700">: {{ Auth::guard('pelanggan')->user()->nama }}</p>
                    <p>Tanggal Lahir</p>
                    <p class="font-medium text-gray-700">: {{ Auth::guard('pelanggan')->user()->tanggal_lahir }}</p>
                </div>

                <!-- Change Password Section -->
                <div class="mt-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Change Password</label>
                    <input type="password" class="w-full p-2 border border-gray-300 rounded-md" placeholder="**********">
                </div>
            </div>


            <!-- Action Buttons -->
            <div class="mt-6 flex space-x-4">
                <button class=" bg-blue-600 text-white px-6 py-2 rounded-md">Save</button>
            </div>
        </div>
    </div>
@endsection
