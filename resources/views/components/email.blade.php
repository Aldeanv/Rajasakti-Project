{{--=-- EMAIL START -------}}
<div
  id="subscribe-section"
  class="bg-center bg-cover mx-auto py-24 px-6 sm:px-18 lg:px-24 relative"
  style="background-image: url(/img/bg-newsletter.jpg)"
  x-data="{ showSuccessPopup: false }"
  @if(session('success'))
    x-init="showSuccessPopup = true; setTimeout(() => showSuccessPopup = false, 8000)"
  @endif
>

  <!-- Pop-up Notifikasi Sukses -->
  <div 
    x-show="showSuccessPopup" 
    x-transition 
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
  >
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
      <h2 class="text-xl font-bold text-green-600">Pendaftaran Berhasil!</h2>
      <p class="mt-2 text-gray-700">Terima kasih telah berlangganan. Kami akan mengirimkan kabar terbaru ke email Anda.</p>
      <button 
        @click="showSuccessPopup = false" 
        class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-500"
      >
        Tutup
      </button>
    </div>
  </div>

  <div class="flex flex-col">
    <div>
      <h1 class="font-semibold lg:text-3xl text-xl text-center text-white">
        Tetap Terhubung dengan Kabar Terbaru Kami
      </h1>
      <p class="lg:text-base text-xs text-center text-white">
        Daftarkan email anda untuk menerima kabar berkala dari kami
      </p>
    </div>
    <form 
      action="{{ route('subscribers.store') }}#subscribe-section" 
      method="POST" 
      class="flex flex-col items-center"
    >
      @csrf
      <div class="flex justify-center mt-16">
        <input
          type="email"
          name="email"
          required
          placeholder="Alamat Email"
          class="text-center bg-transparent text-white p-2 border-b w-[700px] focus:outline-none"
        />
      </div>
      <div class="flex justify-center mt-11">
        <button
          type="submit"
          class="bg-yellow-400 py-1 px-6 text-slate-800 text-lg font-medium min-w-[250px] max-w-[300px] rounded-lg my-5 hover:text-white hover:font-bold active:scale-95"
        >
          BERLANGGANAN
        </button>
      </div>
    </form>
  </div>
</div>
{{----- EMAIL END -----}}
