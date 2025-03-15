<x-app-layout>
    <x-navigation-layout>
        Programs
    </x-navigation-layout>
    <div class="flex-col lg:ml-64 p-6">
        <!-- Form Pencarian dan Tombol Download -->
        <div class="flex items-center justify-between">
            <form method="GET" action="{{ route('programs.index') }}" class="flex space-x-2 w-full max-w-md">
                <input type="text" name="search" placeholder="Cari Nama, programname, atau ID" 
                    value="{{ request('search') }}"
                    class="border px-4 py-2 rounded-lg w-full shadow-sm focus:ring focus:ring-blue-300">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg> Cari
                </button>
            </form>

            <div class="flex mx-6 justify-between">
                <!-- Tombol Download Excel -->
                <a href="" class="bg-green-600 text-white px-4 mr-2 py-2 rounded-lg hover:bg-green-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>                
                </a>

                <!-- Tombol Tambah Program -->
                <a href="{{ route('program.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>                                     
                </a>
            </div>
        </div>
    </div>
    
    @if(session('success'))
    <div class="bg-green-500 lg:ml-64 p-6 text-white rounded-lg mb-4 text-center">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="flex-col bg-white rounded-xl overflow-auto lg:ml-64 p-6 pt-0">
        <!-- Isi tabel -->
        <div x-data="{ showDeletePopup: false, programToDelete: { id: null, name: '' } }">
            <table class="w-full border-collapse rounded-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                    <tr>
                        <th class="py-4 px-6 text-left">ID</th>
                        <th class="py-4 px-6 text-left">Judul</th>
                        <th class="py-4 px-6 text-left">Deskripsi</th>
                        <th class="py-4 px-6 text-left">Tanggal</th>
                        <th class="py-4 px-6 text-left">Lokasi</th>
                        <th class="py-4 px-6 text-left">Dibuat Pada</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($programs as $program)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="py-4 px-6 font-medium text-gray-700">{{ $program->id }}</td>
                        <td class="py-4 px-6 font-semibold text-blue-700">{{ $program->title }}</td>
                        <td class="py-4 px-6 text-gray-700">{!! Str::limit(strip_tags($program->body), 40, '...') !!}</td>
                        <td class="py-4 px-6 text-gray-600">{{ \Carbon\Carbon::parse($program->date)->translatedFormat('d-m-Y') }}</td>
                        <td class="py-4 px-6 text-gray-600">{{ $program->location }}</td>
                        <td class="py-4 px-6 text-gray-500">{{ \Carbon\Carbon::parse($program->created_at)->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d-m-Y H:i') }}</td>
                        <td class="py-4 px-6 text-center">
                            <button 
                                @click="showDeletePopup = true; programToDelete = { id: {{ $program->id }}, name: '{{ $program->title }}' }" 
                                class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-700 transition flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
            <!-- Pop-up Konfirmasi Hapus -->
            <div x-show="showDeletePopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold text-red-600">Konfirmasi Hapus</h2>
                    <p class="mt-2 text-gray-700">Apakah Anda yakin ingin menghapus program <span class="font-semibold text-red-500" x-text="programToDelete.name"></span>?</p>
                    <div class="mt-4 flex justify-end space-x-3">
                        <button @click="showDeletePopup = false" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                            Batal
                        </button>
                        <form :action="'/programs/' + programToDelete.id" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $programs->onEachSide(1)->links() }}
        </div>
    </div>

    <script src="/js/succes.js"></script>
</x-app-layout>