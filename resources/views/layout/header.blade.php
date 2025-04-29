<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', config('app.name'))</title>
    <!-- Meta SEO -->
    <meta name="description" content="@yield('desk_singkat', 'Kawan Sekarya siap menemani kamu belajar, berkreasi, dan menikmati serunya berbagai kegiatan kreatif yang penuh inspirasi')">
    <meta name="keywords" content="Kawan Sekarya, Events, Reservasi, Pekanbaru, @yield('keywords')">
    <meta name="author" content="Ineke Rahmadini, Thahirudin, Bambang Pratama Putra">
    <meta name="robots" content="index, follow">

    <!-- Open Graph (Facebook, LinkedIn) -->
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('desk_singkat', 'Kawan Sekarya siap menemani kamu belajar, berkreasi, dan menikmati serunya berbagai kegiatan kreatif yang penuh inspirasi')">
    <meta property="og:image" content="@yield('thumbnail', asset('img/logoKS.png'))">
    <meta property="og:url" content="@yield('url', route('home'))">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', config('app.name'))">
    <meta name="twitter:description" content="@yield('desk_singkat', 'Kawan Sekarya siap menemani kamu belajar, berkreasi, dan menikmati serunya berbagai kegiatan kreatif yang penuh inspirasi')">
    <meta name="twitter:image" content="@yield('thumbnail', asset('img/logoKS.png'))">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href={{ asset('img/logoKS.png') }}>

    <!-- WhatsApp (Menggunakan Open Graph, tapi pastikan format gambar .jpg, .png) -->
    <meta property="og:image" content="@yield('thumbnail', asset('img/logoKS.png'))">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Pinterest -->
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="@yield('title', config('app.name'))">
    <meta name="pinterest-rich-pin" content="true">

    <!-- Instagram (Menggunakan Open Graph) -->
    <meta property="og:image" content="@yield('thumbnail', asset('img/logoKS.png'))">
    <meta property="og:description" content="@yield('desk_singkat', 'Kawan Sekarya siap menemani kamu belajar, berkreasi, dan menikmati serunya berbagai kegiatan kreatif yang penuh inspirasi')">

    <!-- Telegram (Menggunakan Open Graph) -->
    <meta property="og:image" content="@yield('thumbnail', asset('img/logoKS.png'))">
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('desk_singkat', 'Kawan Sekarya siap menemani kamu belajar, berkreasi, dan menikmati serunya berbagai kegiatan kreatif yang penuh inspirasi')">

    <!-- TikTok (Menggunakan Open Graph) -->
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('desk_singkat', 'Kawan Sekarya siap menemani kamu belajar, berkreasi, dan menikmati serunya berbagai kegiatan kreatif yang penuh inspirasi')">
    <meta property="og:image" content="@yield('thumbnail', asset('img/logoKS.png'))">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ route('home') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('addCss')
</head>
