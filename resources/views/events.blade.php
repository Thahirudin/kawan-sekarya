@extends('layout.master')
@section('title', "Events | " . config('app.name'))
@section('url', route('event'))
@section('content')
    <section class="max-w-screen-xl mx-auto px-4 py-20">
        <h2 class="text-2xl font-bold text-[#222222] text-center mb-10">Event Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-4 gap-5 items-center justify-between h-full mb-10">
            @foreach ($events as $event)
                <div
                    class="h-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-md">
                    <div class="h-[150px] lg:h-[250px] bg-contain rounded-t-lg w-full">
                        <img class="rounded-t-lg w-full h-full object-cover" src="{{ asset($event->gambar) }}"
                            alt="{{ $event->nama }}" />
                    </div>
                    <div class="p-5">
                        <a href="{{ route('event.detail', ['slug' => $event->slug]) }}">
                            <h5
                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 hover:text-blue-800 ease-in-out duration-700">
                                {{ $event->nama }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700">
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
        <div class="">
            {{ $events->links('pagination::tailwind') }}
        </div>
    </section>
@endsection

