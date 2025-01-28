@extends('layout.master')
@section('content')
<!-- Navigation -->
<div class="bg-blue-600 text-white p-4 flex justify-between items-center">
    <div class="text-xl">Logo</div>
    <div>
        <button class="bg-blue-800 px-4 py-2 rounded-md text-white">Register/Login</button>
    </div>
</div>

<div class="flex max-w-7xl mx-auto p-6 space-x-8">

    <!-- Sidebar -->
    <div class="w-1/4 bg-white p-4 rounded-md shadow-md">
        <ul class="space-y-4">
            <li><a href="#" class="text-blue-600 hover:text-blue-800">Profile Saya</a></li>
            <li><a href="#" class="text-blue-600 hover:text-blue-800">Riwayat Transaksi</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 bg-white p-6 rounded-md shadow-md">

        <!-- Profile Header -->
        <div class="flex items-center space-x-6 mb-8">
            <div class="w-24 h-24 bg-gray-300 rounded-full"></div>
            <button class="bg-gray-200 px-4 py-2 rounded-md text-gray-700">Upload new picture</button>
        </div>

        <!-- Profile Info -->
        <div class="space-y-4">
            <div class="flex justify-between">
                <span class="font-medium text-gray-700">Nama</span>
                <span class="text-gray-600">Jackson William Anderson</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium text-gray-700">Email</span>
                <span class="text-gray-600">123456@djsac.ac.id</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium text-gray-700">Nomor HP</span>
                <span class="text-gray-600">081234567890</span>
            </div>
            <div class="flex justify-between">
                <span class="font-medium text-gray-700">Jenis Kelamin</span>
                <span class="text-gray-600">Laki-Laki</span>
            </div>
        </div>

        <!-- Change Password Section -->
        <div class="mt-6">
            <label class="block mb-2 text-sm font-medium text-gray-700">Change Password</label>
            <input type="password" class="w-full p-2 border border-gray-300 rounded-md" placeholder="**********">
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex justify-between space-x-4">
            <button class="flex-1 bg-blue-600 text-white px-6 py-2 rounded-md">Save</button>
            <button class="flex-1 bg-red-600 text-white px-6 py-2 rounded-md">Sign Out</button>
        </div>
    </div>
</div>
@endsection