@extends('layout.master')
@section('content')
<section class="max-w-screen-xl lg:flex justify-between gap-10 mx-auto p-4 my-10">
    <div class="mb-5 w-full">
        <a href="/reservasi-jadwal"
            class="w-full flex flex-col items-center hover:text-blue-400 ease-in-out duration-700 bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <img class="object-cover w-full rounded-t-lg h-48 md:h-36 md:w-48 md:rounded-none md:rounded-s-lg"
                src="https://flowbite.com/docs/images/blog/image-4.jpg" alt="">
            <div class="flex flex-col justify-between p-4 leading-normal w-full">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 hover:text-blue-400 ease-in-out duration-700 dark:text-white">Lihat Jadwal Tersedia Meja 01</h5>
            </div>
        </a>
    </div>
    <div class="mb-5 w-full">
        <a href="/reservasi-jadwal"
            class="w-full flex flex-col items-center hover:text-blue-400 ease-in-out duration-700 bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <img class="object-cover w-full rounded-t-lg h-48 md:h-36 md:w-48 md:rounded-none md:rounded-s-lg"
                src="https://flowbite.com/docs/images/blog/image-4.jpg" alt="">
            <div class="flex flex-col justify-between p-4 leading-normal w-full">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 hover:text-blue-400 ease-in-out duration-700 dark:text-white">Lihat Jadwal Tersedia Meja 02</h5>
            </div>
        </a>
    </div>
</section>

@endsection