<nav class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-4 md:px-8 sticky top-0 z-50">

    <div class="flex items-center gap-3">

        <button @click="sidebarOpen = !sidebarOpen"
            class="text-gray-500 hover:text-indigo-600 focus:outline-none md:hidden p-2 rounded-md">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"></path>
                <path x-show="sidebarOpen" style="display: none;" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <div class="flex flex-col">

            <span class="flex items-center md:hidden font-bold text-lg text-indigo-600">
                <img class="w-8 h-8" src="{{ asset('image/logo_utm.png') }}" alt="">
                <span class="ml-4">SI MAGANG</span>
            </span>

            <span class="flex items-center max-md:hidden font-bold text-lg text-indigo-600">
                <img class="w-8 h-8" src="{{ asset('image/logo_utm.png') }}" alt="">
                <span class="ml-4">SISTEM INFORMASI MAGANG</span>
            </span>

        </div>
    </div>

    <div class="flex items-center gap-4">

        {{-- <button class="text-gray-500 hover:text-indigo-600 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                </path>
            </svg>
        </button> --}}

        <div class="relative" x-data="{ open: false }">

            <button @click="open = !open" @click.outside="open = false"
                class="flex items-center gap-3 focus:outline-none">
                <div class="text-right hidden md:block">
                    <div class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div
                    class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold border border-indigo-200">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <svg :class="{ 'rotate-180': open }" class="w-4 h-4 text-gray-400 transition-transform duration-200"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-100 z-50"
                style="display: none;">

                <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                    Profil Saya
                </a>

                <div class="border-t border-gray-100 my-1"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                        Keluar (Logout)
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>
