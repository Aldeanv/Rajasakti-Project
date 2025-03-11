<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 px-6 py-8">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-center mb-4">
                <img src="/img/logo HD.png" alt="Logo" class="size-24">
            </div>
            
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">
                {{ __('Verifikasi Alamat Email Anda') }}
            </h2>

            <p class="text-sm text-gray-600 text-center mb-4">
                {{ __('Terima kasih telah mendaftar! Sebelum mulai menggunakan akun, harap verifikasi email Anda dengan mengklik tautan dalam email yang kami kirimkan. Jika Anda belum menerima email, klik tombol di bawah untuk mengirim ulang.') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-green-600 text-center text-sm font-medium">
                    {{ __('Tautan verifikasi baru telah dikirim ke email Anda.') }}
                </div>
            @endif

            <div class="mt-4">
                <form method="POST" action="{{ route('verification.send') }}" class="flex flex-col gap-4">
                    @csrf
                    <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg transition duration-200">
                        {{ __('Kirim Ulang Email Verifikasi') }}
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="mt-4 text-center">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 underline transition duration-200">
                        {{ __('Keluar') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
