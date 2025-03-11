<x-index-layout>
  {{----- HERO START -----}}
  @forelse ($Hero as $hero)
  <div
    class="bg-slate-600 w-full h-[540px] bg-cover bg-center bg-blend-multiply flex justify-center items-center"
    style="background-image: url(img/blog-1.jpg)">
    <div class="flex flex-col items-center pt-12 justify-center max-w-6xl">
        <div class="flex divide-x-[1.5px]">
            <h2 class="text-white pr-2">UPCOMING EVENT</h2>
            <p class="text-white pl-2">{{ \Carbon\Carbon::parse($hero->date)->format('d F') }}</p>
        </div>
        <div>
            <h1 class="text-white pb-4 font-semibold md:text-6xl text-center text-4xl uppercase">
              {{ $hero->title }}
            </h1>
            <div class="prose prose-lg max-w-none text-white text-center">
                {!! Str::limit(strip_tags($hero->body), 200, '...') !!}
            </div>
        </div>
        <div id="countdown" class="flex justify-center gap-5 text-white text-center">
          <div>
            <div id="days" class="text-4xl font-bold">00</div>
            <div>Hari</div>
          </div>
          <div>
            <div id="hours" class="text-4xl font-bold">00</div>
            <div>Jam</div>
          </div>
          <div>
            <div id="minutes" class="text-4xl font-bold">00</div>
            <div>Menit</div>
          </div>
          <div>
            <div id="seconds" class="text-4xl font-bold">00</div>
            <div>Detik</div>
          </div>
        </div>
        <div>
          <button class="my-8 rounded-md shadow-md transition-all transform hover:scale-105 hover:bg-yellow-600">
            <a href="/registrasi/{{ $hero->slug }}"
              class="px-4 py-2 bg-yellow-500 text-black font-semibold text-md">
              Daftar Program
            </a>
          </button>
        </div>
    </div>
  </div>
  @empty
  <div class="bg-slate-600 w-full h-[540px] bg-cover bg-center bg-blend-multiply flex justify-center items-center">
    <div class="flex flex-col items-center pt-12 justify-center max-w-6xl">
      <svg class="w-16 h-16 text-white mb-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 15.75h4.5m-7.5 3h10.5m-12-6h13.5M12 3.75v6m4.5-4.5L12 3l-4.5 2.25"></path>
      </svg>
      <h2 class="text-2xl font-semibold text-white text-center">Tidak Ada Program yang Tersedia</h2>
      <p class="text-white mt-2 text-center max-w-md">
        Saat ini belum ada program yang tersedia. Silakan cek kembali nanti atau hubungi kami untuk informasi lebih lanjut.
      </p>
      <a href="/" class="mt-6 px-5 py-2 bg-yellow-500 text-black font-semibold rounded-md shadow-md transition-all transform hover:scale-105 hover:bg-yellow-600">
        Kembali ke Beranda
      </a>
    </div>
  </div>  
  @endforelse

  {{----- HERO END -----}}

  {{----- EVENT START -----}}
  <div class="mx-auto max-w-7xl py-20 pt-12 px-6 sm:px-18 lg:px-24" id="event">
      <div class="flex items-center">
          <h1 class="text-2xl font-semibold w-[320px]">UPCOMING EVENT</h1>
          <div class="bg-black w-full h-[2px]"></div>
      </div>
      <div class="mt-5">
        <form class="max-w-md mx-auto py-4" action="#event">   
          <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
          <div class="relative">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                  </svg>
              </div>
              <input type="search" id="search" name="search" class=" bg-transparent block w-full p-4 ps-10 text-sm text-gray-900 border-b border-slate-400" placeholder="Search News" autocomplete="off"/>
              <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
          </div>
      </form>
          @foreach ($programs as $program)
          <div class="mycard md:flex py-4 justify-between px-6 border-b-2 border-black">
              <div class="flex flex-col justify-between min-w-36">
                  <span></span>
                  <h2 class="uppercase text-center items-center text-5xl font-semibold text-yellow-400">{{ \Carbon\Carbon::parse($program['date'])->format('d M') }}</h2>
                  <span></span>
              </div>
              <div class="md:pl-2 py-4">
                <div class="pl-1">
                  <a href="/event/{{ $program['slug'] }}" class="font-bold md:text-2xl text-lg hover:underline">
                      {{ $program['title'] }}
                  </a>
                </div>
                  <div class="py-2">
                    <a
                      class="flex items-center hover:text-sky-700"
                      href="{{ $program['maps'] }}"
                      ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1); transform: ; msfilter: "
                      >
                        <path
                          d="M12 14c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.103 0 2 .897 2 2s-.897 2-2 2-2-.897-2-2 .897-2 2-2z"
                        ></path>
                        <path
                          d="M11.42 21.814a.998.998 0 0 0 1.16 0C12.884 21.599 20.029 16.44 20 10c0-4.411-3.589-8-8-8S4 5.589 4 9.995c-.029 6.445 7.116 11.604 7.42 11.819zM12 4c3.309 0 6 2.691 6 6.005.021 4.438-4.388 8.423-6 9.73-1.611-1.308-6.021-5.294-6-9.735 0-3.309 2.691-6 6-6z"
                        ></path></svg
                      >{{ $program['location'] }}</a
                    >
                  </div>
                  <div class="prose prose-lg max-w-none">
                    {!! Str::limit(strip_tags($program->body), 300, '...') !!}
                  </div>
                  <div class="flex items-center w-40 justify-between pt-6">
                      <button class="text-sm font-semibold hover:underline">
                        <a href="/registrasi/{{ $program->slug }}">DAFTAR</a>
                      </button>
                      <a
                          class="hover:text-sky-800 hover:font-semibold"
                          href="/event/{{ $program['slug'] }}"
                      >learn more</a>
                  </div>
              </div>
          </div>
          @endforeach
      </div>
      {{ $programs->onEachSide(1)->links() }}
  </div>
  {{----- EVENT END -----}}

  <x-email></x-email>
  <x-footer></x-footer>
  
  @php
  $eventDate = $hero['date'] ?? '0000-00-00';
  $eventTime = $hero['time'] ?? '00:00:00';
  @endphp

<script>
  var eventDate = "{{ $eventDate }}";
  var eventTime = "{{ $eventTime }}";

  // Jika tidak ada tanggal atau waktu, set ke default 0
  if (eventDate === "0000-00-00" || eventTime === "00:00:00") {
    document.getElementById("countdown").innerHTML = "<div style='font-size: 32px; font-weight: bold;'>EVENT BELUM DIJADWALKAN</div>";
  } else {
    var countDownDate = new Date(eventDate + " " + eventTime).getTime();

    var x = setInterval(function () {
      var now = new Date().getTime();
      var distance = countDownDate - now;

      if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown").innerHTML = "<div style='font-size: 32px; font-weight: bold;'>EVENT BERLANGSUNG</div>";
      } else {
        document.getElementById("days").innerHTML = Math.floor(distance / (1000 * 60 * 60 * 24));
        document.getElementById("hours").innerHTML = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        document.getElementById("minutes").innerHTML = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        document.getElementById("seconds").innerHTML = Math.floor((distance % (1000 * 60)) / 1000);
      }
    }, 1000);
  }
</script>

</x-index-layout>