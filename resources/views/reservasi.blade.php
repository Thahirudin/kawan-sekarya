@extends('layout.master')
@section('title', "Reservasi | " . config('app.name'))
@section('url', route('reservasi'))
@section('content')
    <section class="max-w-screen-xl grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-between gap-10 mx-auto p-4 my-10">
        @foreach ($mejas as $meja)
            <div class="mb-5 w-full">
                <a href="{{ route('reservasi-jadwal', ['id' => $meja->id]) }}"
                    class="w-full flex flex-col items-center hover:text-blue-400 ease-in-out duration-700 bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row hover:bg-gray-100">
                    <img class="object-cover w-full rounded-t-lg h-48 md:h-36 md:w-48 md:rounded-none md:rounded-s-lg"
                        src="https://flowbite.com/docs/images/blog/image-4.jpg" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal w-full">
                        <h5 class="mb-2 text-2xl font-bold  dark:text-white">Lihat Jadwal Tersedia {{ $meja->nama }}</h5>
                        <p>kapasitas : {{ $meja->kapasitas }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </section>
@endsection
