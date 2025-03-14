<x-index-layout>
    <div class="max-w-6xl mx-auto mt-12 space-y-8">
        <!-- Kartu Profil User -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-8 relative">
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
                <p class="text-4xl font-bold text-gray-900">{{ $certificateCount }}</p>
                <p class="text-lg text-gray-600 mt-2">Sertifikat</p>
            </div>
            <div class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:shadow-md transition-shadow duration-300">
                <p class="text-4xl font-bold text-gray-900">{{ $materialCount }}</p>
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
                        <li class="bg-gray-100 border border-gray-200 rounded-lg p-6">
                            <div class="flex flex-col space-y-4">
                                <h4 class="text-xl font-semibold text-gray-900">{{ $program->title }}</h4>
                                <p class="text-sm text-gray-600">📅 {{ \Carbon\Carbon::parse($program->date)->translatedFormat('l, d F Y') }} • 📍 {{ $program->location }}</p>
                                <div class="flex flex-wrap gap-4">
                                    @if ($program->pivot->certificate)
                                        <a href="{{ route('user.download', ['type' => 'certificate', 'filename' => $program->pivot->certificate]) }}" class="text-green-600 font-semibold hover:text-green-700" download>
                                            📜 Unduh Sertifikat
                                        </a>
                                    @endif
                                    
                                    @if ($program->pivot->material)
                                        <a href="{{ route('user.download', ['type' => 'material', 'filename' => $program->pivot->material]) }}" class="text-yellow-600 font-semibold hover:text-yellow-700" download>
                                            📂 Unduh Materi
                                        </a>
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

