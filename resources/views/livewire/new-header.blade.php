<nav
  class="fixed w-full z-20 top-0 start-0 transition-all duration-300 ease-in"
  :class="{ 'bg-white shadow-md': scrolled }">
  <div class="container xl:max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="{{ asset('new-images/LOGO.png') }}" class="" alt="thehotbleep" />
    </a>
    <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
      <div class="flex justify-start items-center gap-3">
        @if(!Auth::check())
        <a href="{{ route('login') }}">
          <button
            class="px-6 py-3 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20"
            type="button" data-ripple-dark="true">
            login
          </button>
        </a>

        <a href="{{ route('register') }}">
          <button
            class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none hidden md:block"
            type="button" data-ripple-light="true">
            For Businesses
          </button>
        </a>
        @else
        @if(!Auth::user()->is_seller)
        <div class="pt-[6px]">
          <livewire:notification />
        </div>


        <div class="inline-flex relative w-fit" x-data="{ showNotif: @entangle('newMessage') }">

          <a href=" {{ route('message-center') }}">
            <div x-show="showNotif" wire:model="newMessage"
              class="absolute inline-block top-1 right-0 bottom-auto left-auto translate-x-2/4 -translate-y-1/2 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 p-1.5 text-xs bg-red-600 rounded-full z-10">
            </div>

            <div>
              <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope"
                class="mx-auto text-gray-500 hover:text-gray-700 w-6" role="img" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 512 512">
                <path fill="currentColor"
                  d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
                </path>
              </svg>

            </div>
          </a>
        </div>
        @else

        @endif

            <div class="flex flex-col   lg:items-center  lg:flex-row lg:space-x-5 w-full">

                @if (!isset(Auth::user()->profile_photo_path))
                    <img  id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                        data-dropdown-placement="bottom-start" class="w-12 h-12 rounded-full cursor-pointer"
                        src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="User dropdown">
                @else
                    <img id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                        data-dropdown-placement="bottom-start" class="w-[48px] h-[48px]  rounded-full cursor-pointer"
                        src="{{ asset('/storage/' . Auth::user()->profile_photo_path) }}" alt="">
                @endif
            </div>

            <div id="userDropdown"
                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow drk:bg-gray-700 drk:divide-gray-600">
                <div class="py-3 px-4 text-sm text-gray-900 drk:text-white">
                    <div>{{ Auth::user()->name }}</div>
                    <div class="font-medium truncate">{{ Auth::user()->email }}</div>
                </div>
                <ul class="py-1 text-sm text-gray-700 drk:text-gray-200" aria-labelledby="avatarButton">
                    @if (Auth::user()->is_seller)
                    <li>
                    <a href="{{ route('seller-dashboard') }}"
                        class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Seller
                        Dashboard</a>
                    </li>
                    @else
                    <li>
                    <a href="{{ route('register-info') }}"
                        class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Become
                        a Seller</a>
                    </li>
                    @endif
                    @if (Auth::user()->is_admin)
                    <li>
                    <a href="{{ route('admin-dashboard') }}"
                        class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Admin
                        Panel</a>
                    </li>
                    @endif
                    <li>
                    <a href="{{ route('orders') }}"
                        class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Orders</a>
                    </li>

                    <li>
                    <a href="{{ route('disputes') }}"
                        class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Disputes</a>
                    </li>
                    <li>
                    <a href="{{ route('profile.show') }}"
                        class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Profile</a>
                    </li>
                    <li>
                    <a href="{{ route('requests.index') }}"
                        class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Requests</a>
                    </li>
                    @if(!empty(auth()->user()->affiliate_link))
                    <li>
                    <a href="{{ route('affiliate.show') }}"
                        class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Affiliate
                        Portal</a>
                    </li>
                    @endif
                </ul>

                <div class="py-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <button type="submit" @click.prevent="$root.submit();"
                    class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 drk:hover:bg-gray-600 drk:text-gray-200 drk:hover:text-white">
                    Sign out
                    </button>
                </form>

                </div>
            </div>
        @endif
      </div>
      <button data-collapse-toggle="navbar-sticky" type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
        aria-controls="navbar-sticky" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>
    </div>
    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
      <ul
        class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-14 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
        <li>
          <a href="{{ route('home') }}"
            class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:p-0 nunito-sans text-lg font-semibold"
            :class="{ 'md:!text-black': scrolled }" aria-current="page">Home</a>
        </li>
        <li>
          <a href="{{ route('home.search_gigs') }}" :class="{ 'md:!text-black': scrolled }"
            class="block py-2 px-3 md:text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0 nunito-sans text-lg font-semibold">Services</a>
        </li>
        <li>
          <a href="{{ route('requests') }}" :class="{ 'md:!text-black': scrolled }"
            class="block py-2 px-3 md:text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0 nunito-sans text-lg font-semibold">Jobs</a>
        </li>

        @if(!Auth::check() || (Auth::check() && !Auth::user()->is_seller))
        <li>
            <a href="{{ route('register-info') }}" :class="{ 'md:!text-black': scrolled }"
              class="block py-2 px-3 md:text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0 nunito-sans text-lg font-semibold">Become Seller</a>
          </li>
        <li class="md:hidden">
          <a href="{{route('seller-register')}}" :class="{ 'md:!text-black': scrolled }"
            class="block py-2 px-3 md:text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:p-0 nunito-sans text-lg font-semibold">For
            Businesses</a>
        </li>
        @endif
      </ul>
    </div>
  </div>
  <script>
    window.addEventListener('playSound', event => {

        // navigator.mediaDevices.getUserMedia({video:false, audio:true});
        var x = new Audio("{{ asset('/mixkit-positive-notification-951.wav') }}");
        var playPromise = x.play();

        if (playPromise !== undefined) {

            playPromise.then(_ => {
                    x.play();
                })
                .catch(error => {});
        }
        Notification.requestPermission( permission => {
          let notification = new Notification(event.detail['subject'], {
            body: event.detail['message'], // content for the alert
            icon: "https://pusher.com/static_logos/320x320.png" // optional image url
          });

    });
});
</script>
</nav>
