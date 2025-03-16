<x-app-layout>
    <x-navigation-layout>
        Subscriber
    </x-navigation-layout>
    
    <div class="flex-col bg-white rounded-xl overflow-auto lg:ml-64 h-full shadow-lg p-6 pt-0">
        <!-- Isi tabel -->
        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="w-full border-collapse rounded-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                    <tr>
                        <th class="py-4 px-6 text-center">Email</th>
                        <th class="py-4 px-6 text-center">Tanggal Subscribe</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 h-full">
                    @foreach ($subscriber as $subscribe)
                    <tr class="hover:bg-blue-50 transition duration-300 ease-in-out transform hover:scale-101">
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $subscribe->email }}</td>
                        <td class="py-4 px-6 text-gray-500 text-center">{{ \Carbon\Carbon::parse($subscribe->created_at)->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $subscriber->onEachSide(1)->links() }}
        </div>
    </div>
</x-app-layout>