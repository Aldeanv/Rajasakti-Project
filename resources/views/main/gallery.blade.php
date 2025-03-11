<x-index-layout>
    <div class="lg:px-[130px] px-8 pb-6 lg:pt-[50px] bg-gray-50 min-h-screen" x-data="{ showModal: false, modalImage: '' }">
        <div class="flex">
            <h1 class="title border-b-4 mx-auto text-center text-3xl font-bold border-indigo-600 pb-2 text-indigo-700 uppercase">
                Galeri Kegiatan Kami
            </h1>
        </div>
        <div class="my-2 text-gray-700 text-center text-lg">
            <p>
                Menelusuri setiap momen berharga yang telah kami jalani dalam berbagai kegiatan sosial, edukasi, dan aksi komunitas.
            </p>
        </div>
  
        <!-- Masonry Grid Gallery -->
        <div class="columns-2 md:columns-3 lg:columns-4 gap-2 space-y-4 mt-6">
            @foreach ($images as $image)
                <div class="relative overflow-hidden rounded-lg shadow-lg bg-white p-1">
                    <img src="{{ asset('storage/images/' . $image->image) }}" alt="Galeri" 
                         class="w-full rounded-lg cursor-pointer transition-transform duration-300 hover:scale-105 hover:shadow-xl"
                         @click="modalImage = '{{ asset('storage/images/' . $image->image) }}'; showModal = true">
                </div>
            @endforeach
        </div>
      
        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            {{ $images->onEachSide(1)->links() }}
        </div>
  
        <!-- Modal Preview -->
        <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50"
             x-cloak>
            <div class="relative max-w-3xl mx-auto p-4">
                <button @click="showModal = false" 
                        class="absolute top-2 right-2 bg-white p-2 rounded-full shadow-md hover:bg-gray-200 transition">
                    ✕
                </button>
                <img :src="modalImage" alt="Preview" class="max-h-[90vh] w-auto rounded-lg shadow-lg border-4 border-white">
            </div>
        </div>
    </div>
  
    <x-email></x-email>
    <x-footer></x-footer>
  </x-index-layout>
  
