<x-guest-layout>
    <form action="{{ route('register') }}" method="post" class="mx-auto bg-white drop-shadow-2xl pb-8 px-6 sm:px-14 lg:px-32 w-full max-w-4xl rounded-2xl my-10">
        @csrf
        <!-- Header -->
        <div class="pt-6 flex flex-col justify-center items-center border-b border-gray-300 pb-4">
            <div class="px-4 flex flex-col justify-center items-center pt-2 md:px-6 sm:px-8 lg:px-10">
                <a href="/">
                    <img
                        class="lg:w-[80px] lg:h-[80px] w-[70px] h-[70px] pr-2"
                        src="/img/logo HD.png"
                        alt="PUSAT KAJIAN KEUANGAN PUBLIK"
                    />
                </a>
                <a href="/">
                    <p class="lg:text-3xl font-bold text-xl text-center">
                        PUSAT KAJIAN<br />KEUANGAN PUBLIK
                    </p>
                </a>
            </div>
            <h1 class="text-lg font-semibold mt-2">Buat Akun Anda</h1>
        </div>

        <!-- Formulir -->
        <div class="space-y-8">
            <div class="pb-4">
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-full">
                    <!-- Nama -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-900">Nama</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            placeholder="Masukkan nama" 
                            autocomplete="given-name" 
                            value="{{ old('name') }}"
                            required
                            class="mt-2 block w-full rounded-md px-4 py-3 text-base text-gray-900 border border-gray-300 sm:text-sm @error('name') is-invalid @enderror">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="sm:col-span-2">
                        <label for="username" class="block text-sm font-medium text-gray-900">Username</label>
                        <input 
                            type="text" 
                            name="username" 
                            id="username" 
                            placeholder="Masukkan Username" 
                            autocomplete="username" 
                            value="{{ old('username') }}"
                            required
                            class="mt-2 block w-full rounded-md px-4 py-3 text-base text-gray-900 border border-gray-300 sm:text-sm @error('username') is-invalid @enderror">
                        @error('username')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            placeholder="Masukkan email" 
                            autocomplete="email" 
                            value="{{ old('email') }}"
                            required
                            class="mt-2 block w-full rounded-md px-4 py-3 text-base text-gray-900 border border-gray-300 sm:text-sm @error('email') is-invalid @enderror">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kata Sandi -->
                    <div class="sm:col-span-2">
                        <label for="password" class="block text-sm font-medium text-gray-900">Kata Sandi</label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            placeholder="Masukkan kata sandi" 
                            autocomplete="new-password" 
                            required
                            class="mt-2 block w-full rounded-md px-4 py-3 text-base text-gray-900 border border-gray-300 sm:text-sm @error('password') is-invalid @enderror">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Kata Sandi -->
                    <div class="sm:col-span-2">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Konfirmasi Kata Sandi</label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            placeholder="Konfirmasi kata sandi" 
                            autocomplete="new-password" 
                            required
                            class="mt-2 block w-full rounded-md px-4 py-3 text-base text-gray-900 border border-gray-300 sm:text-sm">
                    </div>
                </div>
            </div>
        </div>

        <!-- Link ke Halaman Masuk -->
        <div class="mt-4 text-center">
            <small class="text-sm">Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk di sini</a>
            </small>
        </div>

        <!-- Tombol Submit -->
        <div class="mt-6 flex items-center justify-end">
            <button 
                type="submit" 
                class="w-full sm:w-auto rounded-md bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Daftar
            </button>
        </div>
    </form>
</x-guest-layout>
