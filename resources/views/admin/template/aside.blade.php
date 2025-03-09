    {{-- Nav mobile --}}
    <aside id="default-sidebar" aria-label="Sidebar"
        class="fixed  h-screen z-[99] left-0 transition-transform -translate-x-full lg:hidden  top-0 lg:w-[30%] lg:py-6 lg:items-center">
        <div class="bg-white border lg:rounded-xl p-4 h-[100%] w-full shadow-lg">
            <ul>
                <li class="">
                    <a href="#" class="p-3 block text-xl font-bold rounded-xl text-blue-600">MANUNGGAL
                        MOBILINDO</a>
                </li>
                <li class="">
                    <a href="#"
                        class="@yield('dashboard-active') p-3 block hover:font-semibold rounded-xl  hover:bg-gray-200 duration-300 ease-in-out hover:text-blue-600">Dashboard</a>
                </li>
                <li class="">
                    <a href="#"
                        class="@yield('data-mobil-active') p-3 block hover:font-semibold rounded-xl hover:bg-gray-200 duration-300 ease-in-out hover:text-blue-600">Data
                        Mobil</a>
                </li>
                <li class="">
                    <a href="#"
                        class="@yield('banner-active') p-3 block hover:font-semibold rounded-xl hover:bg-gray-200 duration-300 ease-in-out hover:text-[#CE0000]">Banner</a>
                </li>
            </ul>
        </div>
    </aside>
    {{-- Nav desktop --}}
    <aside class="hidden sticky  h-screen z-[99] top-0 lg:w-[30%] lg:flex lg:py-6 lg:items-center">
        <div class="bg-white border lg:rounded-xl p-4 h-[100%] w-full shadow-lg">
            <ul>
                <li class="">
                    <a href="#" class="p-3 block text-xl font-bold rounded-xl text-blue-600">MANUNGGAL
                        MOBILINDO</a>
                </li>
                <li class="">
                    <a href="/administrator/dashboard"
                        class="@yield('dashboard-active') p-3 block hover:font-semibold rounded-xl  hover:bg-gray-200 duration-300 ease-in-out hover:text-blue-600">Dashboard</a>
                </li>
                <li class="">
                    <a href="/administrator/data-pegawai"
                        class="@yield('pegawai-active') p-3 block hover:font-semibold rounded-xl  hover:bg-gray-200 duration-300 ease-in-out hover:text-blue-600">Data Pegawai</a>
                </li>
                <li class="">
                    <a href="/administrator/data-event"
                        class="@yield('event-active') p-3 block hover:font-semibold rounded-xl  hover:bg-gray-200 duration-300 ease-in-out hover:text-blue-600">Data Event</a>
                </li>
                <li class="">
                    <a href="/administrator/checkout-event"
                        class="@yield('invoice-active') p-3 block hover:font-semibold rounded-xl  hover:bg-gray-200 duration-300 ease-in-out hover:text-blue-600">Checkout Event</a>
                </li>
                <li class="">
                    <a href="#"
                        class="@yield('reservasi-active') p-3 block hover:font-semibold rounded-xl  hover:bg-gray-200 duration-300 ease-in-out hover:text-blue-600">Reservasi</a>
                </li>
                <li class="">
                    <a href="#"
                        class="@yield('event-active') p-3 block hover:font-semibold rounded-xl  hover:bg-gray-200 duration-300 ease-in-out hover:text-blue-600">Data Pelanggan</a>
                </li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit"
                        class=" p-3 block w-full text-left hover:font-semibold rounded-xl hover:bg-gray-200 duration-300 ease-in-out hover:text-[#CE0000]">Logout</button>
                </form>
            </ul>
        </div>
    </aside>
