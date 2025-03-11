<x-app-layout>
    <x-navigation-layout>
        Post
    </x-navigation-layout>
    <div class="flex-col lg:ml-64 p-6">
        <!-- Form Pencarian dan Tombol Download -->
        <div class="flex items-center justify-between">
            <form method="GET" action="{{ route('posts.index') }}" class="flex space-x-2 w-full max-w-md">
                <input type="text" name="search" placeholder="Cari Nama, postname, atau ID" 
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
                <a href="/post/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>                                     
                </a>
            </div>
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
                        <th class="py-4 px-6 text-left">Judul</th>
                        <th class="py-4 px-6 text-left">Deskripsi</th>
                        <th class="py-4 px-6 text-left">Dibuat Pada</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 h-full">
                    @foreach ($posts as $post)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="py-4 px-6 font-medium text-gray-700">{{ $post->id }}</td>
                        <td class="py-4 px-6"><img src="{{ $post->image }}" alt="" class="w-28 h-16 rounded-lg"></td>
                        <td class="py-4 px-6 font-semibold text-blue-700">{{ $post->title }}</td>
                        <td class="py-4 px-6 text-gray-700">{!! Str::limit(strip_tags($post->body), 40, '...') !!}</td>
                        <td class="py-4 px-6 text-gray-500">{{ \Carbon\Carbon::parse($post->date)->translatedFormat('d-m-Y') }}</td>
                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" 
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus post ini?');">
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
            {{ $posts->onEachSide(1)->links() }}
        </div>
    </div>
</x-app-layout>
