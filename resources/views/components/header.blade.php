<header class="bg-white shadow-md flex justify-between items-center px-6 py-2 lg:px-10">
    <div class="flex items-center space-x-4">
        <a href="/">
            <img class="size-12" src="/img/logo HD.png" alt="PUSAT KAJIAN KEUANGAN PUBLIK" />
        </a>
        <a href="/">
            <p class="lg:text-xl text-xl font-bold text-gray-800 leading-tight">
                PUSAT KAJIAN<br />KEUANGAN PUBLIK
            </p>
        </a>
    </div>
    
    <div class="hidden md:flex items-center space-x-6">
        @auth
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center px-4 py-2 border border-transparent text-lg font-medium rounded-md text-gray-600 bg-white hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition ease-in-out duration-150">
                    <span>{{ Auth::user()->username }}</span>
                    <svg class="ml-2 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a 1 1 0 01-1.414 0l-4-4a 1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>
            
            <x-slot name="content">
                @can('view-dashboard')
                <x-dropdown-link :href="route('dashboard')">Dashboard</x-dropdown-link>
                @endcan
                <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
        @else
        <div>
            <a href="/login" class="text-lg font-medium text-gray-600 hover:text-indigo-600 transition">Log In</a>
            <span class="mx-2 text-gray-400">|</span>
            <a href="/register" class="text-lg font-medium text-indigo-600 hover:text-indigo-800 transition">Register</a>
        </div>
        @endauth
    </div>
</header>
