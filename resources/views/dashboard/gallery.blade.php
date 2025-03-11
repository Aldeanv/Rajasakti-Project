<x-app-layout>
    <x-navigation-layout>
        Galeri
    </x-navigation-layout>
    <div class="flex-col lg:ml-64 p-6">
        <!-- Form Pencarian dan Tombol Tambah -->
        <div class="flex items-center justify-between">
            <!-- Tombol Tambah Gambar -->
            <a href="{{ route('gallery.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </a>
        </div>
    </div>
    
    <div class="flex-col bg-white rounded-xl overflow-auto lg:ml-64 h-full shadow-lg p-6 pt-0">
        <!-- Isi tabel -->
        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="w-full border-collapse rounded-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                    <tr>
                        <th class="py-4 px-6 text-left">ID</th>
                        <th class="py-4 px-6 text-left">Gambar</th>
                        <th class="py-4 px-6 text-left">Dibuat Pada</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 h-full">
                    @foreach ($galleries as $gallery)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="py-4 px-6 font-medium text-gray-700">{{ $gallery->id }}</td>
                        <td class="py-4 px-6">
                            <img src="{{ asset('storage/images/' . $gallery->image) }}" alt="Gambar" class="w-28 h-16 rounded-lg">
                        </td>
                        <td class="py-4 px-6 text-gray-500">{{ $gallery->created_at->format('d-m-Y H:i') }}</td>
                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" 
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-700 transition flex items-center">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $galleries->onEachSide(1)->links() }}
        </div>
    </div>
</x-app-layout>
