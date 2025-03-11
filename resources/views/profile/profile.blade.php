<x-index-layout>
    <div class="max-w-3xl mx-auto mt-10 space-y-6">
        
        <!-- Kartu Profil User -->
        <div class="bg-white border border-gray-300 shadow-sm rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>
            <p class="text-gray-600">{{ $user->email }}</p>
            <p class="text-sm text-gray-500 mt-1">📅 Bergabung sejak: {{ $user->created_at->translatedFormat('d F Y') }}</p>
        </div>

        <!-- Daftar Program yang Diikuti -->
        <div class="bg-white border border-gray-300 shadow-sm rounded-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">🎓 Program yang Anda Ikuti</h3>
            
            @if ($programs->isEmpty())
                <div class="bg-gray-50 text-gray-600 text-center py-4 rounded-md border">
                    <p class="text-lg">Anda belum mengikuti program apapun.</p>
                </div>
            @else
                <ul class="divide-y divide-gray-200">
                    @foreach ($programs as $program)
                    <li class="py-4">
                        <h4 class="text-lg font-semibold text-gray-900">{{ $program->title }}</h4>
                        <p class="text-sm text-gray-600">
                            📅 {{ \Carbon\Carbon::parse($program->date)->translatedFormat('l, d F Y') }} • 📍 {{ $program->location }}
                        </p>
                        <a href="{{ route('program.detail', $program->slug) }}" 
                           class="text-blue-600 font-semibold mt-2 inline-block hover:underline">
                            ➝ Lihat Detail
                        </a>
                    </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-index-layout>
