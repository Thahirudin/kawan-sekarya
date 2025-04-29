@extends('layout.master')
@section('nav-home')
    text-blue-700
@endsection
@section('content')
    <section style="background-image: url('{{ asset('img/background.png') }}');"
        class="bg-cover bg-center rounded-b-[2rem] w-full">
        <div class="max-w-screen-xl mx-auto px-4 md:grid grid-cols-2 gap-5 items-center justify-between">
            <div class="py-20 md:py-0">
                <h1 class="text-[30px] lg:text-[40px] font-extrabold text-[#222222] leading-8 lg:leading-10 mb-5">Berkumpul
                    dan Berkreasi <span class="text-[#3B82F6]">Bersama Kawan Sekarya!</span></h1>
                <p class="font-semibold mb-5">Kawan Sekarya hadir sebagai ruang kreativitas di Pekanbaru, menjadi alternatif
                    rekreasi yang menyenangkan selain mall dan kafe. Bergabunglah dengan kami untuk berkarya dan terhubung
                    dengan komunitas kreatif!</p>
                <div class="flex gap-2 justify-between md:justify-start">
                    <a href="{{ route('reservasi') }}"
                        class="block text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Mulai
                        Reservasi</a>
                    <a href="{{ route('event') }}"
                        class="block text-center py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-blue-600 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cari
                        Event Lainnya</a>
                </div>
            </div>
            <div class="md:flex justify-end md:pt-20 lg:pt-32 hidden">
                <img src="{{ asset('img/cewek.png') }}" alt="kawansekarya" class="w-[90%] lg:w-[70%] h-auto">
            </div>
        </div>
    </section>
    <section class="max-w-screen-xl mx-auto px-4 py-20">
        <h2 class="text-2xl font-bold text-[#222222] text-center mb-10">Event Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-5 items-center justify-between h-full mb-10">
            @foreach ($events as $event)
                <div
                    class=" h-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-md">
                    <div class="h-[150px] lg:h-[250px] bg-contain rounded-t-lg w-full">
                        <img class="rounded-t-lg w-full h-full object-cover" src="{{ asset($event->gambar) }}"
                            alt="{{ $event->nama }}" />
                    </div>
                    <div class="p-5">
                        <a href="{{ route('event.detail', ['slug' => $event->slug]) }}" class="">
                            <h5
                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900  hover:text-blue-800 ease-in-out duration-700">
                                {{ $event->nama }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 ">
                            {{ \Carbon\Carbon::parse($event->tanggal_mulai)->translatedFormat('d F Y H:i') }} WIB
                        </p>
                        <a href="{{ route('event.detail', ['slug' => $event->slug]) }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                            Info Selengkapnya
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>

                </div>
            @endforeach

        </div>
        <div class="text-center mx-auto">
            <a href="{{ route('event') }}"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                Event Lainnya
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
            </a>
        </div>
    </section>
    <section class="max-w-screen-xl mx-auto px-4 py-20 grid grid-cols-1 md:grid-cols-2 gap-10 items-center justify-between">
        <div>
            <img src="{{ asset('img/ks1.png') }}" alt="ks1" class="w-full h-auto">
        </div>
        <div>
            <h1 class="text-[30px] lg:text-[40px] font-extrabold text-[#222222] leading-8 lg:leading-10 mb-5">Yuk, Berkarya
                di <span class="text-[#3B82F6]">Kawan Sekarya!</span></h1>
            <p class="font-semibold mb-5">Cari tempat untuk mewujudkan ide kreatifmu? Kawan Sekarya menyediakan ruang khusus
                untuk kamu yang ingin berkarya dengan tenang dan nyaman. Reservasi sekarang untuk menikmati pengalaman
                berkarya yang seru!</p>
            <div class="flex gap-5">
                <a href="{{ route('reservasi') }}"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Mulai
                    Reservasi</a>
            </div>
        </div>
    </section>
@endsection
