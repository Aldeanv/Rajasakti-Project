<x-app-layout>
    <x-navigation-layout>
        Tambah Post
    </x-navigation-layout>
    <div class="lg:ml-64 shadow-lg p-2 pt-0">
        <div class="flex-col rounded-xl overflow-auto bg-white p-4">
            <h2 class="text-3xl font-bold text-blue-700 mb-6 text-center">Buat Post Baru</h2>

            <!-- Notifikasi -->
            @if(session('error'))
            <div class="bg-red-500 text-white p-3 rounded-lg mb-4 text-center">
                {{ session('error') }}
            </div>
            @endif

            @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded-lg mb-4 text-center">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Image Upload with Preview -->
                <div>
                    <label for="image" class="block text-lg font-medium text-gray-700">Upload Image</label>
                    <input type="file" id="image" name="image" accept="image/*" required 
                        class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring focus:ring-blue-300" onchange="previewImage(event)">
                    <img id="imagePreview" class="mt-3 w-64 h-auto rounded-lg hidden">
                </div>

                <div>
                    <label for="title" class="block text-lg font-medium text-gray-700">Judul Post</label>
                    <input type="text" id="title" name="title" required 
                        class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring focus:ring-blue-300">
                </div>

                <div>
                    <label for="body" class="block text-lg font-medium text-gray-700">Deskripsi</label>
                    <input id="body" type="hidden" name="body">
                    <trix-editor input="body" class="mt-1 border rounded-lg shadow-sm"></trix-editor>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white py-3 rounded-lg hover:shadow-lg transition-all">
                    Submit Event
                </button>
            </form>
        </div>
    </div>

    <!-- JavaScript for Image Preview -->
    <script>
        function previewImage(event) {
            var image = document.getElementById("imagePreview");
            image.src = URL.createObjectURL(event.target.files[0]);
            image.classList.remove("hidden");
        }
    </script>
</x-app-layout>
