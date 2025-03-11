<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mx-auto bg-white drop-shadow-2xl pb-4 px-24 sm:px-18 lg:px-24 max-w-xl rounded-2xl my-8">
        @csrf
        <!-- Header -->
        <div class="pt-6 flex flex-col justify-center items-center border-b border-gray-300 pb-2">
            <div class="px-3 flex flex-col justify-center items-center pt-2 py-1 md:px-4 sm:px-6 lg:px-8">
                <a href="/">
                    <img
                        class="lg:w-[62px] lg:h-[62px] w-[50px] h-[50px] pr-2"
                        src="/img/logo HD.png"
                        alt="PUSAT KAJIAN KEUANGAN PUBLIK"
                    />
                </a>
                <a href="/">
                    <p class="lg:text-2xl font-bold text-lg text-center">
                        PUSAT KAJIAN<br />KEUANGAN PUBLIK
                    </p>
                </a>
            </div>
            <h1 class="text-base">Masuk ke Akun Anda</h1>
        </div>
    
        <!-- Formulir -->
        <div class="space-y-12">
            <div class="pb-12">
                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <!-- Email Address -->
                    <div class="sm:col-span-full">
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email</label>
                        <div class="mt-2 border-b border-gray-600">
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="Masukkan email"
                                class="block w-full rounded-md px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
    
                    <!-- Password -->
                    <div class="col-span-full">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Kata Sandi</label>
                        <div class="mt-2 border-b border-gray-600">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Masukkan kata sandi"
                                class="block w-full rounded-md px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <div class="flex justify-end">
                                @if (Route::has('password.request'))
                                <a
                                    class="underline text-sm text-gray-600 hover:text-gray-900 px-3"
                                    href="{{ route('password.request') }}"
                                >
                                    Lupa Kata Sandi?
                                </a>
                                @endif
                            </div>
                    </div>
                </div>
    
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember"
                        />
                        <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
                    </label>
                </div>
    
                <!-- Lupa Kata Sandi -->
                <div class="flex flex-col mt-4">
                    <div>
                        <small>Belum memiliki akun? 
                            <a href="/register" class="text-blue-600 hover:underline">Daftar Sekarang</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Tombol Submit -->
        <div class="flex items-center justify-end gap-x-6">
            <button
                type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
                Masuk
            </button>
        </div>
    </form> 
</x-guest-layout>
