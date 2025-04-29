@extends('layout.master')
@section('content')
     <!-- sidebar mobile -->
     <div id="accordion-collapse" data-accordion="collapse" class="lg:hidden bg-white">
        <h2 id="accordion-collapse-heading-1">
            <button type="button"
                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 hover:bg-gray-100 gap-3"
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

        <!-- Main Content (Invoice) -->
        <div class="w-full bg-white shadow-lg rounded-md p-6">
            <h1 class="text-2xl font-extrabold text-[#222222] text-center">Riwayat Transaksi</h1>
            <div class="border-b border-gray-300 my-5"></div>
            @foreach ($checkouts as $checkout)
                <div class="flex justify-between items-center gap-10">

                    <div class="mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 mr-3" viewBox="0 0 384 512">
                            <!-- Font Awesome Free 6.7.2 -->
                            <path fill="#83A2FF"
                                d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z" />
                        </svg>

                        <div>
                            <p class="font-bold text-black">{{ $checkout->event->nama }}</p>
                            <p class="text-[0.6rem] font-bold text-[#83A2FF]">Order Id: {{ $checkout->id }}
                            </p>
                            <p class="text-[0.6rem] font-bold text-[#83A2FF]">Status : {{ $checkout->status }}
                            </p>
                            <p class="text-[0.8rem] text-black">{{ $checkout->updated_at }}</p>
                        </div>
                    </div>

                    <!-- Tombol Read More dengan ukuran sesuai -->
                    <a href="{{ route('checkout.show', ['id' => $checkout->id]) }}"
                        class="bg-blue-700 text-white px-6 py-2 rounded-md hover:bg-blue-800 h-fit">
                        read more
                    </a>
                </div>

                <div class="border-b border-gray-300 mb-6"></div>
            @endforeach




        </div>
    </div>
@endsection
