<x-index-layout>
  {{----- NEWS START -----}}
  <div class="mx-auto max-w-7xl px-6 py-12 sm:px-12 lg:px-16">
      <!-- Hero Section -->
      <div class="relative w-full h-[450px] overflow-hidden rounded-xl shadow-lg">
          <img src="{{ Storage::url($post->image) }}" alt="Gambar"
              class="w-full h-full object-cover scale-110 transition duration-500 group-hover:blur-0 group-hover:scale-100">
          <div class="absolute inset-0 bg-gradient-to-b from-transparent to-gray-900 opacity-80"></div>
          <div class="absolute inset-0 flex items-end p-6">
              <h1 class="text-white text-3xl md:text-4xl font-bold animate-fade-in">{{ $post['title'] }}</h1>
          </div>
      </div>

      <!-- Content Section -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mt-10">
          <div class="lg:col-span-2">
              <h5 class="text-sm text-gray-500 pb-3">🕒 {{ $post->created_at->format('d M Y') }} | {{ $post->created_at->diffForHumans() }}</h5>
              <div class="prose prose-lg max-w-none text-justify text-gray-700 leading-relaxed">
                  {!! htmlspecialchars_decode($post->body) !!}
              </div>
          </div>

          <!-- Related News -->
          <div class="lg:col-span-1">
              <h2 class="text-xl font-semibold text-gray-800 border-b pb-3">Berita Terkait</h2>
              <div class="space-y-5 mt-4">
                  @foreach ($relatedPosts as $related)
                  <a href="/news/{{ $related->slug }}" class="flex items-center gap-4 p-3 rounded-lg hover:bg-gray-100 transition">
                      <div class="relative w-28 h-20 overflow-hidden rounded-lg shadow-md">
                          <img src="{{ Storage::url($related->image) }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" alt="">
                      </div>
                      <div>
                          <h3 class="text-sm font-medium text-gray-800 hover:underline">{{ Str::limit($related->title, 50) }}</h3>
                          <p class="text-xs text-gray-500">{{ $related->created_at->format('d M Y') }}</p>
                      </div>
                  </a>
                  @endforeach
              </div>
          </div>
      </div>
  </div>
  {{----- NEWS END -----}}
  <x-email></x-email>
  <x-footer></x-footer>
</x-index-layout>
