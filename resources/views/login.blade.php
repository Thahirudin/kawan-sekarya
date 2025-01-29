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
            class="bg-[url(../../public/img/card-black-login.png)] bg-center h-auto rounded-2xl content-center shadow-lg w-3/4 sm:w-2/3 md:w-1/2 lg:w-2/3 lg:flex overflow-hidden">

            <!-- Bagian Logo -->
            <div class="w-1/2 lg:flex justify-center items-center border-r border-gray hidden ">
                <img src="{{asset('img/logoKS.png')}}" alt="Logo" class="w-64">
            </div>

            <!-- Garis Pembatas dengan Tinggi 2/3 -->
            <div class="w-[1px] bg-white-100"></div> <!-- Tinggi garis 2/3 dari kontainer -->

            <!-- Bagian Form -->
            <div class="lg:w-1/2 p-8 flex flex-col justify-center items-start space-y-4">
                <h3 class="text-xl font-bold text-[#FFFFFF]">Silahkan Masuk Untuk Melanjutkan</h3>

                <input type="email" placeholder="Email"
                    class="w-full p-3 border-b border-gray-300 bg-transparent text-white focus:outline-none" required>
                <input type="password" placeholder="Password"
                    class="w-full p-3 border-b border-gray-300 bg-transparent text-white focus:outline-none" required>

                <button class="w-full py-3 bg-white text-black font-semibold rounded-md hover:bg-gray-100">
                    LOGIN
                </button>

                <button class="w-full py-3 bg-[#0F00E0] text-white font-semibold rounded-md hover:bg-blue-700">
                    DAFTAR
                </button>

                <a href="#" class="text-sm text-[#ffffff] hover:text-[#cbc5c5] ">Kembali Kehalaman Sebelumnya</a>
            </div>
        </div>
    </div>
</body>

</html>