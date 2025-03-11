<x-app-layout>
    <x-navigation-layout>
        Selamat Datang di Dashboard
    </x-navigation-layout>
    <div class="flex-col lg:ml-64 p-6">
        <!-- Stats -->
        <div class="w-full grid grid-cols-2 md:grid-cols-3 gap-6">
            <div class="p-4 bg-white rounded-lg shadow-md border-l-4 border-blue-500">
                <h3 class="text-lg font-semibold">Total Users</h3>
                <div class="flex justify-between">
                    <p class="text-3xl text-blue-600 pt-5">{{ $totalUsers }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>                      
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg shadow-md border-l-4 border-green-500">
                <h3 class="text-lg font-semibold">Total Programs</h3>
                <div class="flex justify-between">
                    <p class="text-3xl text-blue-600 pt-5">{{ $totalPrograms }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>                      
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg shadow-md border-l-4 border-red-500">
                <h3 class="text-lg font-semibold">Total Posts</h3>
                <div class="flex justify-between">
                    <p class="text-3xl text-blue-600 pt-5">{{ $totalPosts }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                    </svg>                                                                 
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg shadow-md border-l-4 border-yellow-500">
                <h3 class="text-lg font-semibold">Total Images</h3>
                <div class="flex justify-between">
                    <p class="text-3xl text-blue-600 pt-5">{{ $totalImages }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>                                                               
                </div>
            </div>
            <div class="p-4 bg-white rounded-lg shadow-md border-l-4 border-purple-500">
                <h3 class="text-lg font-semibold">New Participants</h3>
                <div class="flex justify-between">
                    <p class="text-3xl text-blue-600 pt-5">{{ $totalParticipants }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>                                           
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-4 bg-white rounded-lg shadow-md">
                <div>{!! $participantsChart->container() !!}</div>
            </div>
            <div class="p-4 bg-white rounded-lg shadow-md">
                <div>{!! $usersChart->container() !!}</div>
            </div>
        </div>
        
        <!-- News Users -->
        <div class="mt-6 p-4 bg-white rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-4">News Users</h3>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="p-2">Name</th>
                        <th class="p-2">Username</th>
                        <th class="p-2">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($newUsers as $user)
                        <tr class="border-b">
                            <td class="p-2">{{ $user->name }}</td>
                            <td class="p-2">{{ $user->username }}</td>
                            <td class="py-4 px-6 text-gray-500">{{ \Carbon\Carbon::parse($user->created_at)->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d-m-Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center p-4 text-gray-500">No recent registrations</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Latest Participants -->
        <div class="mt-6 p-4 bg-white rounded-lg shadow-md">
            <h3 class="text-lg font-semibold mb-4">Latest Participants</h3>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="p-2">Name</th>
                        <th class="p-2">Program</th>
                        <th class="p-2">Tanggal Daftar</th>
                        <th class="p-2">Bukti Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestParticipants as $participant)
                        <tr class="border-b">
                            <td class="p-2">{{ $participant->nama }}</td>
                            <td class="p-2">{{ $participant->program_title }}</td>
                            <td class="py-4 px-6 text-gray-500">{{ \Carbon\Carbon::parse($participant->created_at)->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d-m-Y H:i') }}</td>
                            <td class="py-4 px-6">
                                @if ($participant->bukti_pembayaran)
                                    <a href="{{ asset('storage/' . $participant->bukti_pembayaran) }}" target="_blank" class="text-blue-500 underline">Lihat</a>
                                @else
                                    <span class="text-gray-500">Belum Ada</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center p-4 text-gray-500">No recent registrations</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="{{ LarapexChart::cdn() }}"></script>
    {{ $participantsChart->script() }}
    {{ $usersChart->script() }}
</x-app-layout>
