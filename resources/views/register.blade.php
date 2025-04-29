<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="bg-[url(../../public/img/bg-login.png)] h-screen flex items-center justify-center">
        <div
            class="bg-[url(../../public/img/card-black-login.png)] bg-center h-auto rounded-2xl content-center shadow-lg w-3/4 sm:w-2/3 md:w-1/2 lg:w-2/3 flex overflow-hidden">
            <!-- Bagian Logo -->
            <div class="lg:w-1/2 lg:flex justify-center items-center border-r border-gray-300 hidden">
                <img src="{{ asset('img/logoKS.png') }}" alt="Logo" class="w-64">
            </div>

            <!-- Garis Pembatas dengan Tinggi 2/3 -->
            <div class="w-0.2 bg-white-100"></div> <!-- Tinggi garis 2/3 dari kontainer -->

            <!-- Bagian Form -->
            <div class="lg:w-1/2 p-8 lg:flex flex-col justify-center items-start space-y-4">
                <h2 class="text-xl font-bold text-[#FFFFFF]">Silahkan Masukan Data Anda</h2>
                <form action="{{ route('store-pelanggan') }}" method="post">
                    @csrf
                    @method('POST')
                    <input type="text" placeholder="Email" name="email"
                        class="w-full p-3 border-b border-gray-300 bg-transparent text-white focus:outline-none"
                        value="{{ old('email') }}" required>
                    <input type="text" placeholder="Nama" name="nama"
                        class="w-full p-3 border-b border-gray-300 bg-transparent text-white focus:outline-none"
                        value="{{ old('nama') }}" required>
                    <label for="tanggal_lahir" class="text-white">Tanggal Lahir</label>
                    <input type="date" placeholder="Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir"
                        class="w-full p-3 border-b border-gray-300 bg-transparent text-white focus:outline-none"
                        value="{{ old('tanggal_lahir') }}" required>
                    <input type="text" placeholder="Nomor HP" name="nohp"
                        class="w-full p-3 border-b border-gray-300 bg-transparent text-white focus:outline-none"
                        value="{{ old('nohp') }}" required>
                    <input type="password" placeholder="Password" name="password"
                        class="w-full p-3 border-b border-gray-300 bg-transparent text-white focus:outline-none"
                        required>
                    <label for="" class="text-sm text-[#ffffff]">
                        <input type="checkbox" name="" placeholder="" checked /> data yang saya masukan sudah
                        benar!
                    </label>
                    <button type="submit"
                        class="w-full py-3 bg-[#0F00E0] text-white font-semibold rounded-md hover:bg-blue-700">
                        DAFTAR
                    </button>

                    <a href="{{ route('login') }}" class="text-sm text-[#ffffff] hover:text-[#cbc5c5] ">Kembali Ke
                        Halaman Login</a>
                </form>
            </div>
        </div>
    </div>
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
            let errorMessages =
                `@foreach ($errors->all() as $error) {{ $error }}\n @endforeach`;

            // Tampilkan semua error menggunakan SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: errorMessages,
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
</body>

</html>

