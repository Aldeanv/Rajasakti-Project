<x-app-layout>
    <x-navigation-layout>
        Tambah Gambar
    </x-navigation-layout>
    <div class="lg:ml-64 shadow-lg p-2 pt-0">
        <div class="flex-col rounded-xl overflow-auto bg-white p-4">
            <h2 class="text-3xl font-bold text-blue-700 mb-6 text-center">Tambah Gambar</h2>

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

            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <!-- Image Upload with Preview -->
                <div>
                    <label for="images" class="block text-lg font-medium text-gray-700">Upload Images</label>
                    <input type="file" id="images" name="images[]" accept="image/png, image/jpeg" multiple required
                        class="mt-1 p-3 w-full border rounded-lg shadow-sm focus:ring focus:ring-blue-300"
                        onchange="validateFiles(event)">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG | Maks: 2MB per file | Bisa upload lebih dari satu (maskimal 14 gambar)</p>
                    
                    <!-- Error Message -->
                    <p id="file-error" class="text-red-500 text-sm mt-1 hidden"></p>

                    <!-- Image Preview Container -->
                    <div id="imagePreviewContainer" class="mt-3 flex flex-wrap gap-3"></div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white py-3 rounded-lg hover:shadow-lg transition-all">
                    Submit Images
                </button>
            </form>
        </div>
    </div>

    <!-- JavaScript for Multiple Image Validation & Preview -->
    <script>
        function validateFiles(event) {
            const fileInput = event.target;
            const files = fileInput.files;
            const previewContainer = document.getElementById('imagePreviewContainer');
            const errorMsg = document.getElementById('file-error');
            const maxSize = 2 * 1024 * 1024; // 2MB dalam byte
            const allowedExtensions = ['jpg', 'jpeg', 'png']; // Format yang diperbolehkan

            // Reset preview container & error message
            previewContainer.innerHTML = "";
            errorMsg.classList.add('hidden');

            if (files.length > 0) {
                for (let file of files) {
                    const fileSize = file.size;
                    const fileName = file.name.toLowerCase();
                    const fileExtension = fileName.split('.').pop();

                    // Cek ukuran file
                    if (fileSize > maxSize) {
                        errorMsg.textContent = "Salah satu file melebihi ukuran 2MB!";
                        errorMsg.classList.remove('hidden');
                        fileInput.value = ''; // Reset input file
                        return;
                    }

                    // Cek format file
                    if (!allowedExtensions.includes(fileExtension)) {
                        errorMsg.textContent = "Salah satu file memiliki format tidak diperbolehkan! Hanya JPG & PNG.";
                        errorMsg.classList.remove('hidden');
                        fileInput.value = ''; // Reset input file
                        return;
                    }

                    // Jika validasi berhasil, tampilkan preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('w-32', 'h-32', 'object-cover', 'rounded-lg', 'shadow-md');
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>
</x-app-layout>