<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex items-center justify-center min-h-screen">

    <div class="max-w-5xl w-full px-6 py-4">
        <h1 class="text-3xl font-bold text-center text-gray-900 mb-8">
            Form Registrasi Workshop
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informasi Profil -->
            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200 hover:shadow-xl transition">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Ubah Password -->
            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200 hover:shadow-xl transition">
                @include('profile.partials.update-password-form')
            </div>

            <!-- Hapus Akun (Full Width) -->
            <div class="bg-white shadow-lg rounded-lg p-6 border border-gray-200 hover:shadow-xl transition md:col-span-2">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

</body>
</html>

