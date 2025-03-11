<x-index-layout>
    <div class="max-w-6xl mx-auto mt-10 space-y-6">
        
        <!-- Kartu Profil User -->
        <div class="bg-white border border-gray-200 shadow-md rounded-lg p-6 flex justify-between items-center relative">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                <p class="text-gray-600">{{ $user->email }}</p>
                <p class="text-sm text-gray-500 mt-1 flex items-center">
                    📅 Bergabung sejak: {{ $user->created_at->translatedFormat('d F Y') }}
                </p>
            </div>
            
            <!-- Dropdown Menu -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                    </svg>                      
                </button>
                <div x-show="open" @click.away="open = false" 
                     class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 shadow-lg rounded-md overflow-hidden">
                    <a href="{{ route('profile.edit') }}" 
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        ✏ Edit Profil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                            🚪 Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Daftar Program yang Diikuti -->
        <div class="bg-white border border-gray-200 shadow-md rounded-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                🎓 Program yang Anda Ikuti
            </h3>

            {{-- @if ($programs->isEmpty()) --}}
                <div class="bg-gray-100 text-gray-600 text-center py-6 rounded-md border">
                    <p class="text-lg">Anda belum mengikuti program apapun.</p>
                </div>
            {{-- @else --}}
                <ul class="space-y-4">
                    {{-- @foreach ($programs as $program) --}}
                    <li class="p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-900"></h4>
                        <p class="text-sm text-gray-600 mt-1">
                            📅 
                        </p>
                        <a href="" 
                           class="text-blue-500 font-semibold mt-2 inline-block hover:text-blue-600">
                            ➝ Lihat Detail
                        </a>
                    </li>
                    {{-- @endforeach --}}
                </ul>
            {{-- @endif --}}
        </div>

        <!-- Tambahkan Seksi Lain Jika Diperlukan -->
        <div class="bg-white border border-gray-200 shadow-md rounded-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4">📊 Statistik Program</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg text-center">
                    <p class="text-xl font-bold text-blue-600"></p>
                    <p class="text-gray-700">Total Program</p>
                </div>
                <div class="bg-green-50 border border-green-200 p-4 rounded-lg text-center">
                    <p class="text-xl font-bold text-green-600"></p>
                    <p class="text-gray-700">Selesai</p>
                </div>
            </div>
        </div>

    </div>
</x-index-layout>
