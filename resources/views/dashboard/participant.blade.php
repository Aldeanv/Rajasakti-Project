<x-app-layout>
    <x-navigation-layout>
        Peserta
    </x-navigation-layout>
    <div class="flex-col lg:ml-64 p-6">
        <!-- Form Pencarian dan Download -->
        <div class="flex items-center justify-between">
            <form method="GET" action="{{ route('participant.index') }}" class="flex space-x-2 w-full max-w-md">
                <select name="program" onchange="this.form.submit()" class="border px-4 py-2 rounded-lg w-full shadow-sm focus:ring focus:ring-blue-300 transition duration-300 ease-in-out">
                    <option value="">Semua Program</option>
                    @foreach ($programs as $program)
                    <option value="{{ $program }}" {{ request('program') == $program ? 'selected' : '' }}>
                        {{ $program }}
                    </option>
                    @endforeach
                </select>
                <input type="text" name="search" placeholder="Cari Nama atau NIP" value="{{ request('search') }}" class="border px-4 py-2 rounded-lg w-full shadow-sm focus:ring focus:ring-blue-300 transition duration-300 ease-in-out">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </form>
            <!-- Tombol Download Excel -->
            <a href="{{ route('participant.export', ['program' => request('program')]) }}" class="bg-green-600 text-white px-4 mr-2 py-2 rounded-lg hover:bg-green-700 transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
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
                        <th class="py-4 px-6 text-center">Nama</th>
                        <th class="py-4 px-6 text-center">Jenis Kelamin</th>
                        <th class="py-4 px-6 text-center">Dinas</th>
                        <th class="py-4 px-6 text-center">Jabatan</th>
                        <th class="py-4 px-6 text-center">NIP</th>
                        <th class="py-4 px-6 text-center">Email</th>
                        <th class="py-4 px-6 text-center">Telepon</th>
                        <th class="py-4 px-6 text-center">Program</th>
                        <th class="py-4 px-6 text-center">Tanggal Daftar</th>
                        <th class="py-4 px-6 text-center">Barcode</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center">Bukti Pembayaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 h-full">
                    @foreach ($participants as $participant)
                    <tr class="hover:bg-blue-50 transition duration-300 ease-in-out transform hover:scale-101">
                        <td class="py-4 px-6 font-semibold text-blue-700">{{ $participant->nama }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->jenis_kelamin }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->dinas }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->jabatan }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->nip }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->email }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->telepon }}</td>
                        <td class="py-4 px-6 text-gray-700">{{ $participant->program_title }}</td>
                        <td class="py-4 px-6 text-gray-500">{{ \Carbon\Carbon::parse($participant->created_at)->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d-m-Y H:i') }}</td>
                        <td class="py-4 px-6">
                            @if ($participant->qrcode_path)
                                <img src="{{ asset('storage/' . $participant->qrcode_path) }}" alt="QR Code" class="h-12 w-12 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out">
                            @else
                                <span class="text-gray-500">Belum Ada</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->approved ? 'Disetujui' : 'Belum Disetujui' }}</td>
                        <td class="py-4 px-6">
                            @if ($participant->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $participant->bukti_pembayaran) }}" target="_blank" class="text-blue-500 underline hover:text-blue-700 transition duration-300 ease-in-out">Lihat</a>
                            @else
                                <span class="text-gray-500">Belum Ada</span>
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
</x-app-layout>