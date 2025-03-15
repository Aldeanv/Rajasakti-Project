<x-app-layout>
    <x-navigation-layout>
        Tambah Program
    </x-navigation-layout>
    <div class="lg:ml-64 shadow-lg p-2 pt-0">
        <div class="flex-col rounded-xl overflow-auto bg-white p-4">
            <h2 class="text-3xl font-bold text-blue-700 mb-6 text-center">Buat Program Baru</h2>

            <!-- Notifikasi -->
            @if(session('error'))
            <div class="bg-red-500 text-white p-3 rounded-lg mb-4 text-center">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('program.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-lg font-medium text-gray-700">Judul Event</label>
                    <input type="text" id="title" name="title" required 
                        class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring focus:ring-blue-300">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="date" class="block text-lg font-medium text-gray-700">Tanggal</label>
                        <input type="date" id="date" name="date" required 
                            class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring focus:ring-blue-300">
                    </div>
                    <div>
                        <label for="time" class="block text-lg font-medium text-gray-700">Waktu</label>
                        <input type="time" id="time" name="time" required 
                            class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring focus:ring-blue-300">
                    </div>
                </div>

                <div>
                    <label for="location" class="block text-lg font-medium text-gray-700">Lokasi</label>
                    <input type="text" id="location" name="location" required 
                        class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="maps" class="block text-lg font-medium text-gray-700">Link Google Maps</label>
                    <input type="text" id="maps" name="maps" required 
                        class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="body" class="block text-lg font-medium text-gray-700">Deskripsi</label>
                    <input id="body" type="hidden" name="body">
                    <trix-editor input="body" class="mt-1 border rounded-lg shadow-sm"></trix-editor>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white py-3 rounded-lg hover:shadow-lg transition-all">
                    Submit Event
                </button>
            </form>
        </div>
    </div>

    <script src="/js/succes.js"></script>
</x-app-layout>
