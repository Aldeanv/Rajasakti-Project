<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>Form Registrasi Workshop</title>
</head>
<body class="bg-gray-100">
    <!-- Notifikasi Error -->
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Form -->
    <div class="container mx-auto px-6 py-10" x-data="{ registrationType: 'perorangan', showSuccessPopup: @if(session('success')) true @else false @endif, showErrorPopup: @if(session('error')) true @else false @endif }">
        <form action="{{ route('participant.store', ['program' => $program->slug]) }}" method="POST" enctype="multipart/form-data"
            class="bg-white drop-shadow-lg pb-6 px-8 sm:px-12 lg:px-16 max-w-4xl rounded-2xl mx-auto">
            @csrf

            <!-- Header Form -->
            <div class="text-center border-b border-gray-300 p-4">
                <a href="/">
                    <img class="w-16 mx-auto" src="/img/logo HD.png" alt="PUSAT KAJIAN KEUANGAN PUBLIK">
                </a>
                <h1 class="text-xl font-bold uppercase mt-2">{{ $program['title'] }}</h1>
                <p class="text-gray-500">
                    {{ \Carbon\Carbon::parse($program['date'])->format('d M Y') }} |
                    <a href="{{ $program['maps'] }}" class="text-blue-600 hover:underline">{{ $program['location'] }}</a>
                </p>
            </div>

            <!-- Jenis Pendaftaran -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-900">Jenis Pendaftaran</label>
                <div class="flex gap-6 mt-2">
                    <label class="flex items-center">
                        <input type="radio" name="registration_type" value="perorangan" class="h-4 w-4" x-model="registrationType">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 ml-2">
                          <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z" />
                        </svg>                        
                        <span class="ml-1 text-sm">Perorangan</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="registration_type" value="kelompok" class="h-4 w-4" x-model="registrationType">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 ml-2">
                          <path d="M7 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM14.5 9a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5ZM1.615 16.428a1.224 1.224 0 0 1-.569-1.175 6.002 6.002 0 0 1 11.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 0 1 7 18a9.953 9.953 0 0 1-5.385-1.572ZM14.5 16h-.106c.07-.297.088-.611.048-.933a7.47 7.47 0 0 0-1.588-3.755 4.502 4.502 0 0 1 5.874 2.636.818.818 0 0 1-.36.98A7.465 7.465 0 0 1 14.5 16Z" />
                        </svg>                        
                        <span class="ml-1 text-sm">Kelompok</span>
                    </label>
                </div>
            </div>

            <!-- Form Perorangan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6" x-show="registrationType === 'perorangan'">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" name="nama" id="nama" :required="registrationType === 'perorangan'" placeholder="Nama Lengkap"
                        class="mt-2 w-full px-4 py-2 border rounded-md"
                        :disabled="registrationType !== 'perorangan'">
                </div>

                <div>
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-900">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" :required="registrationType === 'perorangan'" class="mt-2 w-full px-4 py-2 border rounded-md">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            
                <div>
                    <label for="nip" class="block text-sm font-medium text-gray-900">NIP</label>
                    <input type="text" name="nip" id="nip" :required="registrationType === 'perorangan'" placeholder="Nomor Induk Pegawai"
                        class="mt-2 w-full px-4 py-2 border rounded-md"
                        :disabled="registrationType !== 'perorangan'">
                </div>
            
                <div>
                    <label for="dinas" class="block text-sm font-medium text-gray-900">Dinas</label>
                    <input type="text" name="dinas" id="dinas" :required="registrationType === 'perorangan'" placeholder="Satuan Kerja Perangkat Daerah"
                        class="mt-2 w-full px-4 py-2 border rounded-md"
                        :disabled="registrationType !== 'perorangan'">
                </div>
            
                <div>
                    <label for="jabatan" class="block text-sm font-medium text-gray-900">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" :required="registrationType === 'perorangan'" placeholder="Jabatan"
                        class="mt-2 w-full px-4 py-2 border rounded-md"
                        :disabled="registrationType !== 'perorangan'">
                </div>
            
                <div>
                    <label for="pemda" class="block text-sm font-medium text-gray-900">Pemerintah Daerah</label>
                    <input type="text" name="pemda" id="pemda" :required="registrationType === 'perorangan'" placeholder="Pemerintah Daerah"
                        class="mt-2 w-full px-4 py-2 border rounded-md"
                        :disabled="registrationType !== 'perorangan'">
                </div>
            
                <div>
                    <label for="telepon" class="block text-sm font-medium text-gray-900">Telepon</label>
                    <input type="text" name="telepon" id="telepon" :required="registrationType === 'perorangan'" placeholder="Telepon"
                        class="mt-2 w-full px-4 py-2 border rounded-md"
                        :disabled="registrationType !== 'perorangan'">
                </div>
            
                <div class="sm:col-span-2">
                    <label for="email" class="block text-sm font-medium text-gray-900">Alamat Email</label>
                    <input type="email" name="email" id="email" :required="registrationType === 'perorangan'" placeholder="Alamat Email"
                        class="mt-2 w-full px-4 py-2 border rounded-md"
                        :disabled="registrationType !== 'perorangan'">
                </div>
            
                <div class="sm:col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-900">Alamat</label>
                    <textarea name="alamat" id="alamat" :required="registrationType === 'perorangan'" placeholder="Alamat"
                        class="mt-2 w-full px-4 py-2 border rounded-md"
                        :disabled="registrationType !== 'perorangan'"></textarea>
                </div>
            
                <div class="sm:col-span-2">
                    <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-900">Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" :required="registrationType === 'perorangan'" accept="image/*,application/pdf"
                        class="mt-2 w-full px-4 py-2 border rounded-md"
                        :disabled="registrationType !== 'perorangan'">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, PDF. Maks. 2MB.</p>
                </div>
            </div>
            
            <!-- Form Kelompok -->
            <div x-show="registrationType === 'kelompok'" class="mt-6">
                <div class="sm:col-span-2">
                    <label for="anggota" class="block text-sm font-medium text-gray-900">Anggota</label>
                    <input type="file" name="anggota" id="anggota" :required="registrationType === 'kelompok'" accept=".xls,.xlsx"
                        class="mt-2 w-full px-4 py-2 border rounded-md"
                        :disabled="registrationType !== 'kelompok'">
                    <p class="text-xs text-gray-500 mt-1">Gunakan format sesuai <a href="" class="text-blue-600 underline">template</a> yang disediakan.</p>
                </div>             
            
                <div class="sm:col-span-2 mt-6">
                    <label for="bukti_pembayaran_kelompok" class="block text-sm font-medium text-gray-900">Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran_kelompok" id="bukti_pembayaran_kelompok" :required="registrationType === 'kelompok'" accept="image/*,application/pdf"
                        class="mt-2 w-full px-4 py-2 border rounded-md"
                        :disabled="registrationType !== 'kelompok'">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, PDF. Maks. 2MB.</p>
                </div>
            </div>            

            <!-- Tombol Submit -->
            <div class="mt-6 text-end">
                <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-500">
                    Submit
                </button>
            </div>
        </form>

        <!-- Pop-up Notifikasi Sukses -->
        <div x-show="showSuccessPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-green-600">Pendaftaran Berhasil!</h2>
                <p class="mt-2 text-gray-700">Terima kasih telah mendaftar. Kami akan mengirimkan konfirmasi ke email Anda.</p>
                <button @click="showSuccessPopup = false" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500">
                    Tutup
                </button>
            </div>
        </div>

        <!-- Pop-up Notifikasi Error -->
        <div x-show="showErrorPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-red-600">Pendaftaran Gagal!</h2>
                <p class="mt-2 text-gray-700">{{ session('error') }}</p>
                <button @click="showErrorPopup = false" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</body>
</html>