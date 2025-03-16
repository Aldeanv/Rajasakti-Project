<x-index-layout>
    <div class="max-w-7xl mx-auto mt-12 space-y-12 px-6">
        <!-- Profil User -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-md p-12 flex flex-col md:flex-row items-center gap-10 relative">
            <div class="flex-1 text-center md:text-left">
                <h2 class="text-3xl font-semibold text-gray-900">{{ $user->username }}</h2>
                <p class="text-lg text-gray-700 mt-1">{{ $user->email }}</p>
                <p class="text-sm text-gray-500 mt-2">Bergabung sejak {{ $user->created_at->translatedFormat('d F Y') }}</p>
            </div>
            <div class="text-center md:text-right">
                @if ($user->subscriber)
                    <p class="text-sm text-gray-700">Berlangganan sejak 
                        {{ \Carbon\Carbon::parse($user->subscriber->created_at)->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y') }}
                    </p>
                    <form action="{{ route('unsubscribe') }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin berhenti berlangganan?')" 
                            class="px-5 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition">
                            Berhenti Berlangganan
                        </button>
                    </form>
                @else
                    <p class="text-sm text-gray-500">Anda belum berlangganan.</p>
                @endif
            </div>
            <!-- Dropdown Menu -->
            <div class="absolute top-6 right-6" x-data="{ open: false }">
                <button @click="open = !open" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                    </svg>                          
                </button>
                <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-md">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Edit Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            @foreach ([['count' => $programs->count(), 'label' => 'Program'],
                      ['count' => $certificateCount, 'label' => 'Sertifikat'],
                      ['count' => $materialCount, 'label' => 'Materi']] as $stat)
                <div class="border border-blue-300 rounded-lg p-8 text-center shadow-md hover:shadow-lg transition">
                    <p class="text-4xl font-semibold text-blue-900">{{ $stat['count'] }}</p>
                    <p class="text-lg text-blue-600 mt-2">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>

        <!-- Daftar Program -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-md p-12">
            <h3 class="text-2xl font-semibold text-gray-900 mb-8">Program yang Anda Ikuti</h3>
            @if ($programs->isEmpty())
                <div class="text-center py-12 text-gray-500 border border-gray-300 rounded-md">
                    <p class="text-lg">Anda belum mengikuti program apapun.</p>
                </div>
            @else
                <div class="space-y-8">
                    @foreach ($programs as $program)
                        <div class="border border-gray-300 rounded-lg p-8 shadow-sm hover:shadow-md transition">
                            <h4 class="text-xl font-semibold text-gray-900">{{ $program->title }}</h4>
                            <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($program->date)->translatedFormat('l, d F Y') }} • {{ $program->location }}</p>
                            <div class="mt-4 flex flex-wrap gap-4">
                                @if ($program->pivot->certificate)
                                <a href="{{ route('user.download', ['type' => 'certificate', 'filename' => $program->pivot->certificate]) }}" 
                                   class="text-sm font-medium text-white bg-green-600 px-5 py-2 rounded-md hover:bg-green-700 transition shadow-sm">
                                    Unduh Sertifikat
                                </a>
                                @endif
                            
                                @if ($program->pivot->material)
                                    <a href="{{ route('user.download', ['type' => 'material', 'filename' => $program->pivot->material]) }}" 
                                    class="text-sm font-medium text-white bg-yellow-600 px-5 py-2 rounded-md hover:bg-yellow-700 transition shadow-sm">
                                        Unduh Materi
                                    </a>
                                @endif                         
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-index-layout>