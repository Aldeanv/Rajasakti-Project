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

      <!-- Share Buttons -->
      <div class="mt-10 flex flex-wrap items-center justify-between gap-4">
          <div class="flex space-x-4">
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                  class="flex items-center gap-2 px-5 py-3 bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-700 transition">
                  <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M22 12.07c0-5.52-4.48-10-10-10s-10 4.48-10 10c0 4.99 3.66 9.12 8.43 9.87v-6.99h-2.54v-2.88h2.54v-2.18c0-2.52 1.49-3.91 3.77-3.91 1.09 0 2.24.19 2.24.19v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.44 2.88h-2.34v6.99C18.34 21.19 22 17.06 22 12.07z"/></svg>
                  Facebook
              </a>
              <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank"
                  class="flex items-center gap-2 px-5 py-3 bg-blue-400 text-white rounded-lg shadow-lg hover:bg-blue-500 transition">
                  <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M22.46 6c-.77.35-1.6.59-2.46.7a4.27 4.27 0 0 0 1.88-2.37c-.83.49-1.74.83-2.7 1a4.27 4.27 0 0 0-7.26 3.9 12.13 12.13 0 0 1-8.8-4.46 4.29 4.29 0 0 0 1.32 5.7c-.68-.02-1.3-.21-1.86-.5v.05a4.29 4.29 0 0 0 3.43 4.2 4.26 4.26 0 0 1-1.86.07 4.28 4.28 0 0 0 4 3c-2.7 2.1-6.13 2.9-9.42 2.4A12.1 12.1 0 0 0 7.29 21c7.88 0 12.2-6.53 12.2-12.2v-.56c.85-.6 1.6-1.36 2.2-2.24z"/></svg>
                  Twitter
              </a>
              <a href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}" target="_blank"
                  class="flex items-center gap-2 px-5 py-3 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 transition">
                  <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 1.9A9.93 9.93 0 0 0 2 11.92a9.84 9.84 0 0 0 1.44 5.2l-1.57 5.56 5.7-1.51a10.06 10.06 0 0 0 4.47 1.08 10.05 10.05 0 0 0 10-10A9.94 9.94 0 0 0 12 1.9zM7.5 14.86c-.47.27-1.11.58-1.64.45a8.32 8.32 0 0 1-2.42-1.08 8.08 8.08 0 0 1-2.44-2.3 8.15 8.15 0 0 1 2.25-2.56A8.21 8.21 0 0 1 12 5.94c4.5 0 8.15 3.66 8.15 8.16s-3.65 8.15-8.15 8.15c-1.48 0-2.87-.4-4.1-1.12l-.45-.26-.5.13-3.52.94.94-3.52.13-.5-.26-.45a8.16 8.16 0 0 1-1.12-4.1z"/></svg>
                  WhatsApp
              </a>
          </div>
          <a href="/news" class="text-gray-700 hover:text-gray-900">⬅ Kembali ke Berita</a>
      </div>
  </div>
  {{----- NEWS END -----}}
  <x-email></x-email>
  <x-footer></x-footer>
</x-index-layout>
