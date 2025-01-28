@extends('layout.master')
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
                <div class="flex gap-5">
                    <a href="#"
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Mulai
                        Reservasi</a>
                    <a href="#"
                        class="block py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-blue-600 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cari
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
            <div
                class="h-fullmax-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg w-full h-64" src="https://flowbite.com/docs/images/blog/image-1.jpg"
                        alt="event" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Lorem ipsum dolor
                            sit amet consectetur adipisicing elit.</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">20 Februari 2025</p>
                    <a href="#"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Info Selengkapnya
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>

            </div>
            <div
                class="h-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg w-full h-64" src="https://flowbite.com/docs/images/blog/image-1.jpg"
                        alt="event" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy
                            KeyChain</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">20 Februari 2025</p>
                    <a href="#"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Info Selengkapnya
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>

            </div>
            <div
                class="h-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg w-full h-64" src="https://flowbite.com/docs/images/blog/image-1.jpg"
                        alt="event" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy
                            KeyChain</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">20 Februari 2025</p>
                    <a href="#"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Info Selengkapnya
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>

            </div>
            <div
                class="h-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg w-full h-64" src="https://flowbite.com/docs/images/blog/image-1.jpg"
                        alt="event" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy
                            KeyChain</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">20 Februari 2025</p>
                    <a href="#"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Info Selengkapnya
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>

            </div>
            <div
                class="h-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg w-full h-64" src="https://flowbite.com/docs/images/blog/image-1.jpg"
                        alt="event" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy
                            KeyChain</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">20 Februari 2025</p>
                    <a href="#"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Info Selengkapnya
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>

            </div>

        </div>
        <div class="text-center mx-auto">
            <a href="#"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
            <h1 class="text-[30px] lg:text-[40px] font-extrabold text-[#222222] leading-8 lg:leading-10 mb-5">Yuk, Berkarya di  <span class="text-[#3B82F6]">Kawan Sekarya!</span></h1>
            <p class="font-semibold mb-5">Cari tempat untuk mewujudkan ide kreatifmu? Kawan Sekarya menyediakan ruang khusus untuk kamu yang ingin berkarya dengan tenang dan nyaman. Reservasi sekarang untuk menikmati pengalaman berkarya yang seru!</p>
            <div class="flex gap-5">
                <a href="#"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Mulai
                    Reservasi</a>
            </div>
        </div>
    </section>
@endsection
