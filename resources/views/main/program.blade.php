<x-index-layout>
    <!-- HERO START -->
    <div
    class="bg-slate-600 w-full h-[540px] bg-cover bg-center bg-blend-multiply flex justify-center items-center"
    style="background-image: url(/img/blog-1.jpg)"
>
    <div class="flex flex-col items-center pt-12 justify-center max-w-6xl">
        <div class="flex divide-x-[1.5px]">
            <h2 class="text-white pr-2">UPCOMING EVENT</h2>
            <p class="text-white pl-2">{{ \Carbon\Carbon::parse($program['date'])->format('d F') }}</p>
        </div>
        <div>
            <h1 class="text-white pb-4 font-semibold md:text-6xl text-center text-4xl uppercase">
              {{ $program['title'] }}
            </h1>
            <div class="prose prose-lg max-w-none text-white text-center">
              {!! Str::limit(strip_tags($program->body), 200, '...') !!}
            </div>
        </div>
        <div id="countdown" style="display: flex; justify-content: center; gap: 20px; font-family: Arial, sans-serif; text-align: center; color: white;">
          <div>
            <div id="days" style="font-size: 48px; font-weight: bold;">00</div>
            <div>Hari</div>
          </div>
          <div>
            <div id="hours" style="font-size: 48px; font-weight: bold;">00</div>
            <div>Jam</div>
          </div>
          <div>
            <div id="minutes" style="font-size: 48px; font-weight: bold;">00</div>
            <div>Menit</div>
          </div>
          <div>
            <div id="seconds" style="font-size: 48px; font-weight: bold;">00</div>
            <div>Detik</div>
          </div>
        </div>
        <div>
          <button class="my-8 rounded-md shadow-md transition-all transform hover:scale-105 hover:bg-yellow-600">
            <a href="/registrasi/{{ $program->slug }}"
              class="px-4 py-2 bg-yellow-500 text-black font-bold text-md">
              Daftar Program
            </a>
          </button>
        </div>
    </div>
</div>
    <!-- HERO END -->

    <!-- MORE EVENT START -->
    <div class="mx-auto max-w-7xl py-20 pt-12 px-6 sm:px-18 lg:px-24">
      <div>
        <div>
          <h1 class="lg:text-4xl text-2xl font-bold text-slate-600">
            {{ $program['title'] }}
          </h1>
          <div class="py-2">
            <a
              class="flex items-center hover:text-sky-700"
              href="https://maps.app.goo.gl/nhxBtjL3gtDJTfRk8"
              ><svg
                xmlns="{{ $program['maps'] }}"
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
        </div>
        <div class="flex pt-5">
          <button class="mb-4 rounded-md shadow-md transition-all transform hover:scale-105 hover:bg-yellow-600">
            <a href="/registrasi/{{ $program->slug }}"
              class="px-4 py-2 bg-yellow-300 text-black font-semibold text-md">
              Daftar Program
            </a>
          </button>
        </div>
        <div class="flex mt-5 justify-between">
          <div>
            <div class="prose prose-lg max-w-none text-justify indent-3">
              {!! htmlspecialchars_decode($program->body) !!}
            </div>          
          </div>
        </div>
      </div>
    </div>
    <!-- MORE EVENT END -->
  <x-email></x-email>
  <x-footer></x-footer>

  <script>
    // Fungsi untuk menambahkan nol di depan angka yang kurang dari 10
    function addLeadingZero(num) {
      return num < 10 ? '0' + num : num;
    }
  
    // Tentukan tanggal yang menjadi target hitung mundur
    var countDownDate = new Date("{{ $program['date'] }}  {{ $program['time'] }}").getTime();
  
    // Perbarui hitungan mundur setiap 1 detik
    var x = setInterval(function () {
      // Dapatkan tanggal dan waktu saat ini
      var now = new Date().getTime();
  
      // Temukan jarak antara sekarang dan tanggal hitung mundur
      var distance = countDownDate - now;
  
      // Perhitungan waktu untuk hari, jam, menit, dan detik
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
      // Tambahkan nol di depan jika angkanya kurang dari 10
      days = addLeadingZero(days);
      hours = addLeadingZero(hours);
      minutes = addLeadingZero(minutes);
      seconds = addLeadingZero(seconds);
  
      // Tampilkan hasil pada elemen-elemen dengan id yang sesuai
      document.getElementById("days").innerHTML = days;
      document.getElementById("hours").innerHTML = hours;
      document.getElementById("minutes").innerHTML = minutes;
      document.getElementById("seconds").innerHTML = seconds;
  
      // Jika hitungan mundur selesai, tulis teks ini
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown").innerHTML = "<div style='font-size: 32px; font-weight: bold;'>EVENT BERLANGSUNG</div>";
      }
    }, 1000);
  </script>

</x-index-layout>