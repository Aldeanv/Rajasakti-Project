<x-index-layout>
    <div class="max-w-6xl mx-auto mt-12 space-y-8">
        <!-- Kartu Profil User -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-8 relative">
            <!-- Tombol Dropdown Menu -->
            <div class="absolute top-6 right-6">
                <div x-data="{ open: false }" class="relative">
                    <!-- Tombol Trigger -->
                    <button @click="open = !open" class="flex items-center text-gray-600 hover:text-gray-900 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-10">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">✏️ Edit Profile</a>
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
            <!-- Informasi User -->
            <div class="text-center md:text-left">
                <h2 class="text-3xl font-bold text-gray-900">{{ $user->username }}</h2>
                <p class="text-lg text-gray-600 mt-2">{{ $user->email }}</p>
                <p class="text-sm text-gray-500 mt-3 flex items-center justify-center md:justify-start">
                    📅 Bergabung sejak: {{ $user->created_at->translatedFormat('d F Y') }}
                </p>
            </div>
        </div>

        <!-- Statistik Program -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:shadow-md transition-shadow duration-300">
                <p class="text-4xl font-bold text-gray-900">{{ $programs->count() }}</p>
                <p class="text-lg text-gray-600 mt-2">Total Program</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:shadow-md transition-shadow duration-300">
                <p class="text-4xl font-bold text-gray-900">0</p>
                <p class="text-lg text-gray-600 mt-2">Sertifikat</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:shadow-md transition-shadow duration-300">
                <p class="text-4xl font-bold text-gray-900">0</p>
                <p class="text-lg text-gray-600 mt-2">Materi</p>
            </div>
        </div>

        <!-- Daftar Program -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">🎓 Program yang Anda Ikuti</h3>
            @if ($programs->isEmpty())
                <div class="text-center py-8 text-gray-500 border-2 border-dashed border-gray-200 rounded-lg">
                    <p class="text-xl">Anda belum mengikuti program apapun.</p>
                </div>
            @else
                <ul class="space-y-6">
                    @foreach ($programs as $program)
                    <li class="bg-gray-100 border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-300">
                        <div class="flex flex-col space-y-4">
                            <h4 class="text-xl font-semibold text-gray-900">{{ $program->title }}</h4>
                            <p class="text-sm text-gray-600">📅 {{ \Carbon\Carbon::parse($program->date)->translatedFormat('l, d F Y') }} • 📍 {{ $program->location }}</p>
                            <div class="flex flex-wrap gap-4">
                                <a href="" class="text-blue-600 font-semibold hover:text-blue-700 transition-colors duration-300">🔍 Detail</a>
                                @if ($program->certificate)
                                    <a href="{{ asset('storage/certificates/'.$program->certificate) }}" class="text-green-600 font-semibold hover:text-green-700 transition-colors duration-300">📜 Unduh Sertifikat</a>
                                @endif
                                @if ($program->material)
                                    <a href="{{ asset('storage/materials/'.$program->material) }}" class="text-yellow-600 font-semibold hover:text-yellow-700 transition-colors duration-300">📂 Unduh Materi</a>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-index-layout>