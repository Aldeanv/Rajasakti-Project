<x-app-layout>
    <x-navigation-layout>
        Users
    </x-navigation-layout>
    <div class="flex-col lg:ml-64 p-6">
        <!-- Form Pencarian -->
        <div class="flex items-center justify-between">
            <form method="GET" action="{{ route('users.index') }}" class="flex space-x-2 w-full max-w-md">
                <input type="text" name="search" placeholder="Cari Nama, Username, atau ID" 
                    value="{{ request('search') }}"
                    class="border px-4 py-2 rounded-lg w-full shadow-sm focus:ring focus:ring-blue-300">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg> Cari
                </button>
            </form>
        </div>
    </div>
    
    <div class="flex-col bg-white rounded-xl overflow-auto lg:ml-64 h-full shadow-lg p-6 pt-0">
        <!-- Isi tabel -->
        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="w-full border-collapse rounded-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                    <tr>
                        <th class="py-4 px-6 text-left">ID</th>
                        <th class="py-4 px-6 text-left">Nama</th>
                        <th class="py-4 px-6 text-left">Username</th>
                        <th class="py-4 px-6 text-left">Email</th>
                        <th class="py-4 px-6 text-left">Dibuat Pada</th>
                        <th class="py-4 px-6 text-left">Diperbarui Pada</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 h-full">
                    @foreach ($users as $user)
                    <tr class="hover:bg-blue-50 transition">
                        <td class="py-4 px-6 font-medium text-gray-700">{{ $user->id }}</td>
                        <td class="py-4 px-6 font-semibold text-blue-700">{{ $user->name }}</td>
                        <td class="py-4 px-6 text-gray-700">{{ $user->username ?? '-' }}</td>
                        <td class="py-4 px-6 text-gray-700">{{ $user->email }}</td>
                        <td class="py-4 px-6 text-gray-500">{{ $user->created_at->format('d-m-Y H:i') }}</td>
                        <td class="py-4 px-6 text-gray-500">{{ $user->updated_at->format('d-m-Y H:i') }}</td>
                        <td class="py-4 px-6 text-center">
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" 
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
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
            {{ $users->onEachSide(1)->links() }}
        </div>
    </div>
</x-app-layout>