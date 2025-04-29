@extends('layout.master')
@section('title', 'Tentang Kami | ' . config('app.name'))
@section('url', route('about-us'))
@section('nav-about-us')
    text-blue-700
@endsection
@section('addCss')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
    <!-- Demo styles -->
    <style>
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

@endsection
@section('content')
    <section style="background-image: url('{{ asset('img/ecllips.png') }}');"
        class="bg-cover bg-center rounded-b-[2rem] w-full">
        <div class="pt-8 max-w-screen-xl mx-auto px-4 md:grid grid-cols-2 gap-5 items-center justify-between">
            <div class="py-20 md:py-0">
                <h1 class="text-[30px] lg:text-[40px] font-extrabold text-[#222222] leading-8 lg:leading-10 mb-5">Asah
                    Kreativitasmu, </br> Berkarya <span class="text-[#3B82F6]">Bersama Kawan Sekarya!</span></h1>
                <p class="font-semibold mb-5">Kawan Sekarya siap menemani kamu belajar, berkreasi, dan menikmati serunya
                    berbagai kegiatan kreatif yang penuh inspirasi</p>
                <div class="flex gap-5">
                    <a href="{{ route('reservasi') }}"
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Mulai
                        Reservasi</a>
                    <a href="{{ route('event') }}"
                        class="block py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-blue-600 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Cari
                        Event Lainnya</a>
                </div>
            </div>
            <div class="md:flex justify-end items-center md:pt-20 lg:p-7 hidden"">
                <img src="{{ asset('img/ayangAku.png') }}" alt="kawansekarya" class="w-[90%] lg:w-[70%] h-auto">
            </div>
        </div>
    </section>


    <section class="max-w-screen-xl mx-auto px-4 py-20 grid grid-cols-1 md:grid-cols-2 gap-10 items-center justify-between">
        <div>
            <img src="{{ asset('img/ks1.png') }}" alt="ks1" class="w-full h-auto">
        </div>
        <div>
            <h1 class="text-[30px] lg:text-[40px] font-extrabold text-[#222222] leading-8 lg:leading-10 mb-5">Tentang
                <span class="text-[#3B82F6]">Kami</span>
            </h1>
            <p class="font-semibold mb-5">Kawan Sekarya adalah sebuah usaha kreativitas yang didirikan pada 7 Oktober 2023
                di Pekanbaru, dengan tujuan menyediakan tempat rekreasi yang minim opsi selain mall dan kafe. Usaha ini
                ingin menjadi wadah bagi orang-orang untuk berkumpul dan berkarya.</p>
            <div class="flex gap-5">
                <a href="{{ route('reservasi') }}"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Mulai
                    Reservasi</a>
            </div>
        </div>
    </section>

    <section class="lg:max-w-screen-xl mx-auto px-4 py-20">
        <h2 class="text-2xl font-bold text-[#222222] text-center mb-10">
            Tim <span class="text-[#3B82F6]">Kami</span>
        </h2>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper w-full gap-5">
                @foreach ($pegawais->sortByDesc(fn($pegawai) => $pegawai->jabatan === 'Founder') as $pegawai)
                    <div class="swiper-slide ">
                        <div class="h-full w-full bg-white border border-gray-200 rounded-lg shadow-md">
                            <div class="h-[300px] md:h-[300px] lg:h-[350px] bg-contain rounded-t-lg w-full">
                                <img class="rounded-t-lg w-full h-full object-cover" src="{{ asset($pegawai->gambar) }}"
                                    alt="{{ $pegawai->nama }}" loading="lazy" />
                            </div>
                            <div class="p-5 text-center">
                                <p class="mb-3 font-normal text-[#3B82F6]"><strong>{{ $pegawai->nama }}</strong></p>
                                <p class="mb-3 font-normal text-gray-700">{{ $pegawai->jabatan }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

    </section>


    <!-- Location Section -->
    <section class="lg:max-w-screen-xl mx-auto px-4 py-10">
        <h2 class="text-2xl font-bold text-[#222222] text-center mb-10">Lokasi <span class="text-[#3B82F6]">Kawan
                Sekarya</span></h2>
        <div class="mt-4">
            <div id='map' class="h-[600px] w-[100%] rounded-lg shadow-lg z-0"></div>
            {{-- <iframe class="w-full h-96 rounded" src="https://www.google.com/maps/embed?pb=!1m18..." allowfullscreen=""></iframe> --}}
        </div>
    </section>


    <script>
        var locations = [
            ["Studio Kawan Sekarya", 0.4757909182102745, 101.40273672805012],
        ];

        var map = L.map('map').setView([0.4757909182102745, 101.40273672805012], 13);
        mapLink =
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; ' + mapLink + ' Contributors',
                maxZoom: 18,
            }).addTo(map);

        for (var i = 0; i < locations.length; i++) {
            var marker = new L.marker([locations[i][1], locations[i][2]])
                .bindPopup(locations[i][0])
                .addTo(map)
                .on('click', function(e) {
                    var lat = e.target.getLatLng().lat;
                    var lng = e.target.getLatLng().lng;
                    window.open(`https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`, '_blank');
                });
        }
    </script>
@endsection
@section('addJs')
    <!-- Swiper JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        const swiper = new Swiper(".mySwiper", {
            autoplay: {
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2
                },
                768: {
                    slidesPerView: 3
                },
                1024: {
                    slidesPerView: 4
                },
            },
        });
    </script>
@endsection
