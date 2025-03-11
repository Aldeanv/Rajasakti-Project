<x-index-layout>
  {{----- HERO START -----}}
  <div class="px-7 pb-8">
      @foreach ($heroPost as $post)
        <div class="lg:flex lg:rounded-3xl overflow-hidden drop-shadow-xl">
            <div
                class="relative w-full h-[520px] bg-cover bg-center bg-blend-multiply p-7 flex justify-end flex-col"
                style="background-image: url({{ $post['image'] }})">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <a href="/news/{{ $post['slug'] }}" class="relative z-10">
                    <h1 class="font-bold text-white text-3xl capitalize hover:underline">
                      {{ $post['title'] }}
                    </h1>
                    <div class="prose prose-lg max-w-none text-white text-justify">
                      {!! Str::limit(strip_tags($post->body), 200, '...') !!}
                    </div>
                </a>
            </div>
            <div class="flex lg:flex-col lg:w-[450px] w-full">
              @foreach ($heroSide as $post)
                <div
                    class="relative w-full h-[260px] bg-cover bg-center bg-blend-multiply p-5 flex"
                    style="background-image: url({{ $post['image'] }})">
                    <div class="absolute inset-0 bg-black/40"></div>
                    <a href="/news/{{ $post['slug'] }}" class="relative z-10 font-bold text-white text-lg self-end capitalize hover:underline">
                      {{ $post['title'] }}
                    </a>
                </div>
              @endforeach
            </div>
        </div>
        @endforeach
    </div>
    {{----- HERO END -----}}
  
    {{----- NEWS START -----}}
    <div id="latest-news" class="mx-auto max-w-7xl px-6 sm:px-18 lg:px-24">
      <div class="flex items-center">
        <h1 class="text-4xl font-semibold w-1/3">Berita Terbaru</h1>
        <div class="bg-black w-full h-[2px]"></div>
      </div>
        <div>
          <form class="max-w-md mx-auto py-4" action="#latest-news">   
            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="search" name="search" class=" bg-transparent block w-full p-4 ps-10 text-sm text-gray-900 border-b border-slate-400" placeholder="Cari Berita" autocomplete="off"/>
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Cari</button>
            </div>
        </form>
        </div>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          @foreach ($posts as $post)
          <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
            <img src="{{ $post['image'] }}" class="w-full h-52 object-cover" alt="">
            <div class="p-5">
              <h5 class="text-sm text-gray-500">{{ $post->created_at->format('d M Y') }} | {{ $post->created_at->diffForHumans() }}</h5>
              <a href="/news/{{ $post['slug'] }}" class="font-bold text-xl text-gray-800 hover:text-blue-600 hover:underline capitalize block mt-2">{{ $post['title'] }}</a>
              <p class="text-gray-600 mt-2">{!! Str::limit(strip_tags($post->body), 150, '...') !!}</p>               
              <a href="/news/{{ $post['slug'] }}" class="inline-block mt-4 text-blue-500 hover:underline">Selengkapnya &rarr;</a>
            </div>
          </article>
          @endforeach
        </div>
        <div class="mt-6">
          {{ $posts->onEachSide(1)->links() }}
        </div>
    </div>
    {{----- NEWS END -----}}

  <x-email></x-email>
  <x-footer></x-footer>
</x-index-layout>