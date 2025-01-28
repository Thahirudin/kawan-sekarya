@extends('layout.master')
@section('content')

<div class="flex max-w-screen-xl  mx-auto p-4 space-x-4">
    <!-- Sidebar -->
    <div class="w-1/4 bg-white shadow-lg rounded-md">
        
        <div class="">
            <a href="#" class="block py-2 px-4 text-blue-500 hover:bg-blue-100">Profile Saya</a>
        </div>
        <div class="">
            <a href="#" class="block py-2 px-4 text-blue-500 hover:bg-blue-100">Riwayat Transaksi</a>
        </div>
    </div>

    <div class="mr-20"></div>

    <!-- Main Content (Invoice) -->
    <div class="w-3/4 bg-white shadow-lg rounded-md p-6 ml-6">
        <div class="mb-4">
            <div class="text-3xl font-bold text-blue-500">Invoice</div>
            <div class="text-xs text-gray-500">Order Id: 0123104121420528209</div>
        </div>
        <div class="border-b border-gray-300 mb-6"></div>
        <div class>
            <p class="text-lg font-semibold">Nama</p>
            <p >Bambang Pratama Putra Hadi</p>
        </div>

        <div class="text-lg font-semibold mb-2">Jenis Kelas</div>
        <div class="mb-4">KeyChain</div>

        <div class="text-lg font-semibold mb-2">Tanggal Kegiatan</div>
        <div class="mb-4">Kamis, 18 Maret 2025</div>

        <div class="text-lg font-semibold mb-2">Total Pembayaran</div>
        <div class="mb-4">Rp65.000</div>

        <div class="text-lg font-semibold mb-2">Kode Unik</div>
        <div class="mb-4">xx1230xx</div>

        <div class="text-lg font-semibold mb-2">ID Produk</div>
        <div class="mb-4">xxx-089-xx</div>

        <div class="text-lg font-semibold mb-2">Waktu Pembayaran</div>
        <div class="mb-4">Kamis, 18 Maret 2025 Pukul 18:00 WIB</div>
    </div>
</div>
@endsection