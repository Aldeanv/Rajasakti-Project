<nav x-data="{ isOpen: false }" class="bg-white shadow-md border-b border-gray-200">
  <div class="mx-auto w-full px-4 sm:px-6 md:px-8">
      <div class="flex items-center justify-between">
          <div class="flex justify-between items-center w-full">
              <span></span>
              <div class="hidden md:block">
                  <div class="ml-10 flex items-baseline space-x-4">
                      <a href="/event" class="rounded-md py-2 px-4 text-sm font-semibold hover:bg-[#BCDC9A] hover:text-white">Event Program</a>
                      <a href="/galeri" class="rounded-md py-2 px-4 text-sm font-semibold hover:bg-[#BCDC9A] hover:text-white">Galeri</a>
                      <a href="/news" class="rounded-md py-2 px-4 text-sm font-semibold hover:bg-[#BCDC9A] hover:text-white">Berita</a>
                      <a href="/about" class="rounded-md py-2 px-4 text-sm font-semibold hover:bg-[#BCDC9A] hover:text-white">Tentang Kami</a>
                  </div>
              </div>
              <span></span>
          </div>
          <div class="-mr-2 flex md:hidden">
              <button @click="isOpen = !isOpen" type="button" class="relative inline-flex items-center justify-center p-2 text-black hover:text-gray-400">
                  <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                  </svg>
                  <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                  </svg>
              </button>
          </div>
      </div>
  </div>

  <div x-show="isOpen" class="md:hidden bg-white shadow-md border-t border-gray-200 mt-2 rounded-lg">
    <div class="border-t border-[#BCDC9A] pt-3 pb-3 px-4">
      @auth
      <div x-data="{ openUser: false }">
          <button @click="openUser = !openUser" class="w-full flex justify-between items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">
              <span>
                  <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9.953 9.953 0 0012 20a9.953 9.953 0 006.879-2.196M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                  {{ Auth::user()->name }}
              </span>
              <svg class="w-5 h-5 text-gray-600 transform transition-transform duration-300" :class="{ 'rotate-180': openUser }" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
              </svg>
          </button>
          <div x-show="openUser" x-transition class="mt-2 bg-gray-50 shadow-md rounded-lg py-2">
              @can('view-dashboard')
              <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">{{ __('Dashboard') }}</a>  
              @endcan
              <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">{{ __('Profile') }}</a>
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md">{{ __('Log Out') }}</button>
              </form>
          </div>
      </div>
      @else
      <div class="space-y-1">
          <a href="/login" class="block text-base font-medium text-gray-600 hover:underline">Login</a>
          <a href="/register" class="block text-base font-medium text-gray-600 hover:underline">Register</a>
      </div>
      @endauth
    </div>

      <div class="p-4 pt-0 space-y-1">
          <a href="/event" class="block rounded-md px-4 py-2 text-base font-semibold hover:bg-[#BCDC9A] hover:text-white">Event Program</a>
          <a href="/galeri" class="block rounded-md px-4 py-2 text-base font-semibold hover:bg-[#BCDC9A] hover:text-white">Galeri</a>
          <a href="/news" class="block rounded-md px-4 py-2 text-base font-semibold hover:bg-[#BCDC9A] hover:text-white">Berita</a>
          {{-- <a href="#" class="block rounded-md px-4 py-2 text-base font-semibold hover:bg-[#BCDC9A] hover:text-white">Klien</a> --}}
          <a href="/about" class="block rounded-md px-4 py-2 text-base font-semibold hover:bg-[#BCDC9A] hover:text-white">Tentang Kami</a>
      </div>
  </div>
</nav>


