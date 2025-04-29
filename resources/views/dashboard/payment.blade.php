<x-app-layout>
    <x-navigation-layout>
        Payment
    </x-navigation-layout>
    
    <div class="flex-col bg-white rounded-xl overflow-auto lg:ml-64 h-full shadow-lg p-6 pt-0">
        <!-- Isi tabel -->
        <div class="overflow-x-auto rounded-lg shadow-lg">
            <table class="w-full border-collapse rounded-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-500 text-white">
                    <tr>
                        <th class="py-4 px-6 text-center">Nama</th>                        
                        <th class="py-4 px-6 text-center">Email</th>
                        <th class="py-4 px-6 text-center">Telepon</th>
                        <th class="py-4 px-6 text-center">Program</th>
                        <th class="py-4 px-6 text-center">Tanggal Daftar</th>
                        <th class="py-4 px-6 text-center">Bukti Pembayaran</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center">Action</th> <!-- Column for Actions -->
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 h-full">
                    @foreach ($participants as $participant)
                    <tr class="hover:bg-blue-50 transition duration-300 ease-in-out transform hover:scale-101">
                        <td class="py-4 px-6 font-semibold text-blue-700">{{ $participant->nama }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->email }}</td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->telepon }}</td>
                        <td class="py-4 px-6 text-gray-700">{{ $participant->program_title }}</td>
                        <td class="py-4 px-6 text-gray-500">{{ \Carbon\Carbon::parse($participant->created_at)->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d-m-Y H:i') }}</td>
                        <td class="py-4 px-6">
                            @if ($participant->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $participant->bukti_pembayaran) }}" target="_blank" class="text-blue-500 underline hover:text-blue-700 transition duration-300 ease-in-out">Lihat</a>
                            @else
                                <span class="text-gray-500">Belum Ada</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-gray-700 text-center">{{ $participant->approved ? 'Disetujui' : 'Belum Disetujui' }}</td>
                        <td class="py-4 px-6">
                            @if (!$participant->approved)
                                <form method="POST" action="{{ route('participant.approve', $participant->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300 ease-in-out">
                                        Setujui
                                    </button>
                                </form>
                            @else
                                <span class="text-green-500">Disetujui</span>
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


buat agar halaman payment hanya menampilkan daftar peserta yg membutuhkan persetujuan saja