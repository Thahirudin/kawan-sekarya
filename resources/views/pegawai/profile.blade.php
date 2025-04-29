@extends('pegawai.template.master')
@section('title')
    Profile | {{ config('app.name') }}
@endsection
@section('profile-active')
    bg-gray-200 text-blue-600 font-semibold
@endsection
@section('addCss')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection
@section('content')
    <section class="p-4 bg-white rounded-xl lg:p-5 mb-5 shadow-lg">
        <div class="mb-5 flex justify-between items-center">
            <p class="text-xl font-bold">Data Profile</p>
        </div>
        <div class="">
            <form action="{{ route('pegawai.update-pegawai', ['id' => Auth::guard('pegawai')->user()->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <!-- Profile Header -->
                    <div class="lg:flex items-center gap-5 mb-8">
                        <img id="profileImage" src="{{ asset(Auth::guard('pegawai')->user()->gambar) }}"
                            class="w-36 h-36 bg-cover text-center mx-auto rounded-full mb-5" alt="profile">
                            <input onchange="previewImage(event)" name="gambar"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                            id="file_input" type="file">
                    </div>
                    <!-- Profile Info -->
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <p>Email</p>
                        <div class="flex items-center gap-5">
                            <span>:</span>
                            <input type="text"
                                class="px-4 py-2 rounded-md text-gray-700 w-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ Auth::guard('pegawai')->user()->email }}" name="email">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <p>Nama</p>
                        <div class="flex items-center gap-5">
                            <span>:</span>
                            <input type="text"
                                class="px-4 py-2 rounded-md text-gray-700 w-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ Auth::guard('pegawai')->user()->nama }}" name="nama">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <p>Jabatan</p>
                        <div class="flex items-center gap-5">
                            <span>:</span>
                            <input type="text"
                                class="px-4 py-2 rounded-md text-gray-700 w-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ Auth::guard('pegawai')->user()->jabatan }}" name="jabatan" @readonly(true)>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <p>Tanggal Lahir</p>
                        <div class="flex items-center gap-5">
                            <span>:</span>
                            <input type="date"
                                class="px-4 py-2  rounded-md text-gray-700 w-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ date('Y-m-d', strtotime(Auth::guard('pegawai')->user()->tanggal_lahir)) }}"
                                name="tanggal_lahir">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <p>Nomor HP</p>
                        <div class="flex items-center gap-5">
                            <span>:</span>
                            <input type="text"
                                class="px-4 py-2 rounded-md text-gray-700 w-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                value="{{ Auth::guard('pegawai')->user()->nomor_hp }}" name="nomor_hp">
                        </div>
                    </div>
                    <!-- Change Password Section -->
                    <div class="mt-6">
                        <label class="block mb-2 text-sm font-medium text-gray-700">Change Password</label>
                        <input type="password" class="w-full p-2 border border-gray-300 rounded-md" placeholder="**********"
                            name="password">
                    </div>
                </div>
                <div class="mt-6 flex space-x-4">
                    <button type="submit" class=" bg-blue-600 text-white px-6 py-2 rounded-md">Simpan</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('addJs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000 // Auto close setelah 3 detik
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            // Ambil semua error
            let errorMessages = "<ul class='list-disc text-left'>";
            @foreach ($errors->all() as $error)
                errorMessages += "<li>{{ $error }}</li>";
            @endforeach
            errorMessages += "</ul>";

            // Tampilkan semua error menggunakan SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: errorMessages, // Menggunakan `html` untuk tampilan list
                showConfirmButton: true,
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                showConfirmButton: true
            });
        </script>
    @endif
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('profileImage');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
