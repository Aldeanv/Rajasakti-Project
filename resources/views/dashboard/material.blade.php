<x-app-layout>
    <x-navigation-layout>
        Peserta
    </x-navigation-layout>
    
    <div class="flex-col lg:ml-64 p-6">
        <!-- Form Pencarian dan Download -->
        <div class="flex items-center justify-between mb-4">
            <form method="GET" action="{{ route('material.index') }}" class="flex space-x-2 w-full max-w-md">
                <select name="program" onchange="this.form.submit()" class="border px-4 py-2 rounded-lg w-full shadow-sm focus:ring focus:ring-blue-300">
                    <option value="">Semua Program</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program }}" {{ request('program') == $program ? 'selected' : '' }}>
                            {{ $program }}
                        </option>
                    @endforeach
                </select>
                <input type="text" name="search" placeholder="Cari Nama atau NIP" value="{{ request('search') }}" class="border px-4 py-2 rounded-lg w-full shadow-sm focus:ring focus:ring-blue-300">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Cari
                </button>
            </form>            
        </div>
    </div>
    
    <div class="flex-col bg-white rounded-xl overflow-auto lg:ml-64 h-full shadow-lg p-6 pt-0">
        <!-- Tabel Peserta -->
        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="w-full border-collapse rounded-lg overflow-hidden">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-3 px-6">Nama</th>
                        <th class="py-3 px-6">Program</th>
                        <th class="py-3 px-6">Email</th>
                        <th class="py-3 px-6">Sertifikat</th>
                        <th class="py-3 px-6">Materi</th>
                        <th class="py-3 px-6">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($participants as $participant)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $participant->nama }}</td>
                            <td class="py-3 px-6">{{ $participant->program_title }}</td>
                            <td class="py-3 px-6">{{ $participant->email }}</td>
                            <td class="py-3 px-6 text-center">
                                @if($participant->certificate)
                                    <a href="{{ asset('storage/certificates/'.$participant->certificate) }}" class="text-green-600 hover:underline">Ada</a>
                                @else
                                    Tidak ada
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                @if($participant->material)
                                    <a href="{{ asset('storage/materials/'.$participant->material) }}" class="text-yellow-600 hover:underline">Ada</a>
                                @else
                                    Tidak ada
                                @endif
                            </td>
                            <td class="py-3 px-6">
                                @if(!$participant->certificate || !$participant->material)
                                    <button onclick="openModal({{ $participant->id }}, '{{ $participant->nama }}', '{{ $participant->program_title }}')" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                        Upload
                                    </button>
                                @else
                                    Sudah Lengkap
                                @endif
                            </td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $participants->onEachSide(1)->links() }}
        </div>
    </div>

    <!-- Modal Upload -->
    <div id="uploadModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h3 class="text-lg font-semibold mb-4">📤 Upload Sertifikat & Materi</h3>
            <form action="{{ route('admin.upload.files') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="participant_id" name="participant_id">
                <p id="participantInfo" class="text-gray-600 text-sm"></p>
                <div>
                    <label class="block text-sm font-medium">📜 Sertifikat</label>
                    <input type="file" name="certificate" class="w-full border-gray-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium">📂 Materi</label>
                    <input type="file" name="material" class="w-full border-gray-300 rounded-lg">
                </div>
                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-500 text-white rounded-lg">❌ Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">📤 Upload</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/material.js"></script>
</x-app-layout>
