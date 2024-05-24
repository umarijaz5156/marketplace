<div class="flex justify-between items-center py-7 flex-wrap border-b border-[#E5E6ED]">

    <x-logo type="drk" home_link="/" class=""/>
    <div class=" flex justify-around sm:justify-start items-center  w-full sm:w-max">

        <h3 class="text-2xl font-bold text-gray-600 drk:text-white"><small
            class="ml-2 font-semibold text-gray-500 drk:text-gray-400">Status
        <span class="{{$status ? 'bg-green-200 text-green-600':'bg-red-200 text-red-600'}}
            py-1 px-6 rounded-full ">{{$status ? 'Approved' : 'Pending Approval'}}</span></small></h3>
       {{-- <livewire:seller.header-search-bar/> --}}
       <livewire:seller.seller-notification/>
        <div>
            <div id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start" class="cursor-pointer flex justify-start items-center">
                @if (Auth::user()->profile_photo_path)
                    <img class="w-10 h-10 rounded-full"  src="{{  asset('/storage/'.Auth::user()->profile_photo_path) }}" alt="{{$seller_info->seller_name}}">
                    {{-- <p class="ml-2 hidden md:block">{{ $seller_info->seller_name }}</p> --}}
                @else
                <img class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name={{$seller_info->seller_name}}" alt="{{$seller_info->seller_name}}">
                    {{-- <p class="ml-2 hidden md:block">{{ $seller_info->seller_name }}</p> --}}
                @endif
                {{-- <img class="w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_path }}" alt="">
                <p class="ml-2 hidden md:block">{{ $seller_info->seller_name }}</p> --}}
                <i class="fa-solid fa-caret-down ml-3 hidden md:block"></i>
            </div>
            <!-- Dropdown menu -->
            <div id="userDropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow drk:bg-gray-700 drk:divide-gray-600">
                <div class="py-3 px-4 text-sm text-gray-900 drk:text-white">
                <div>
                    @if ($seller_info->first_name || $seller_info->last_name)
                        {{ $seller_info->first_name }} {{ $seller_info->last_name }}
                    @else
                        {{ $seller_info->seller_name }}
                    @endif
                </div>
                <div class="font-medium truncate">
                    {{Auth::user()->email}}
                </div>
                </div>
                <ul class="py-1 text-sm text-gray-700 drk:text-gray-200" aria-labelledby="avatarButton">
                <li>
                    <a href="{{ route('home') }}" class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Home</a>
                </li>
                {{-- <li>
                    <a href="{{ route('profile.show') }}" class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Profile</a>
                </li> --}}
                <li>
                    <a href="{{ route('seller.edit_profile') }}" class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Seller Profile</a>
                </li>
                <li>
                    <a href="{{ route('seller_messages') }}" class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Messages</a>
                </li>
                </ul>
                <div class="py-1">
                 <!-- Authentication -->
                 <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <a href="{{ route('logout') }}"
                        @click.prevent="$root.submit();" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 drk:hover:bg-gray-600 drk:text-gray-200 drk:hover:text-white">
                        Sign out
                    </a>

                </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        $(window).on('beforeunload' , function(){
            Livewire.emit('logout');
        });
        $(window).on('onload' , function(){
            Livewire.emit('login');
        });
    </script>
    @endpush
</div>
