<div class="ml-6  sm:ml-[38px]">
    <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" class="inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none drk:hover:text-white drk:text-gray-400" type="button">
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>

    <div class="flex relative">
        <div class="{{count(auth()->user()->seller->unreadNotifications) > 0 ? 'bg-[#E9711C]' : 'bg-gray-100'}} inline-flex relative -top-2 right-3 w-3 h-3  rounded-full border-2 border-white drk:border-gray-900"></div>
    </div>

    </button>
    <!-- Dropdown menu -->
    <div wire:ignore.self id="dropdownNotification" class="overflow-y-auto h-[30vh] hidden z-20 w-full max-w-sm bg-white rounded divide-y divide-gray-100 shadow drk:bg-gray-800 drk:divide-gray-700" aria-labelledby="dropdownNotificationButton">
        <div class="block py-2 px-4 font-medium text-center text-gray-700 bg-gray-50 drk:bg-gray-800 drk:text-white">
            Notifications
        </div>
        <div class="divide-y divide-gray-100 drk:divide-gray-700">


            @forelse ($notifications as $notification)
            <a  wire:click="readNotification({{$notification}})" class="{{ isset($notification['read_at']) ? 'bg-gray-100' : 'hover:bg-gray-100 drk:hover:bg-gray-700'}} cursor-pointer flex py-3 px-4  ">
                <div class="pl-3 w-full">

                    <div class="text-gray-500 text-sm mb-1.5 drk:text-gray-400">{{$notification->data['message']}}</div>
                    <div class="text-xs text-blue-600 drk:text-blue-500">{{$notification->created_at->diffForHumans()}}</div>
                </div>
            </a>
            @empty
            <div class="pl-3 mt-4 w-full">

                <div class="text-center text-gray-500 text-sm mb-1.5 drk:text-gray-400">No new notification</div>

            </div>

            @endforelse

        </div>

        </a>
    </div>
</div>

