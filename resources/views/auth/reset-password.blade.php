<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-xl mt-10">
        <div class="flex flex-col justify-center items-center">
            <img src="/img/logo HD.png" alt="Logo" class="w-16 h-16 mb-3">
            <h2 class="text-2xl font-extrabold text-gray-800 text-center">Atur Ulang Password</h2>
            <p class="text-sm text-gray-600 text-center mt-2">
                Masukkan password baru Anda dan konfirmasi untuk mengatur ulang akun Anda.
            </p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="mt-6">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                <x-text-input 
                    id="email" 
                    class="block w-full mt-2 px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition duration-200" 
                    type="email" 
                    name="email" 
                    :value="old('email', $request->email)" 
                    required 
                    autofocus 
                    autocomplete="username" 
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password Baru')" class="text-gray-700 font-semibold" />
                <x-text-input 
                    id="password" 
                    class="block w-full mt-2 px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition duration-200" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="new-password" 
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700 font-semibold" />
                <x-text-input 
                    id="password_confirmation" 
                    class="block w-full mt-2 px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-300 focus:border-indigo-500 transition duration-200" 
                    type="password" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password" 
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
            </div>

            <div class="mt-6">
                <button 
                    type="submit" 
                    class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-lg shadow-lg transition-transform transform hover:scale-105 duration-200"
                >
                    Atur Ulang Password
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
