@include('layout.header')
@include('layout.navbar')
<section class="min-h-screen">
    @yield ('content')

</section>
@yield('addJs')
@include('layout.footer')
