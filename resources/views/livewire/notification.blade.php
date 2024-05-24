<div class=" ml-6  sm:ml-[38px]">
    <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" class="inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-700 focus:outline-none drk:hover:text-white drk:text-gray-400" type="button">
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>



    @if($user->unreadNotifications)
    <div class="flex relative">
        <div class="inline-flex relative -top-2 right-3 w-3 h-3 bg-[#E9711C] rounded-full border-2 border-white drk:border-gray-900"></div>
    </div>
    @endif
    </button>
    <!-- Dropdown menu -->
    <div wire:ignore.self id="dropdownNotification" class="overflow-y-auto h-[30vh] hidden z-[99] w-full max-w-sm bg-white rounded divide-y divide-gray-100 shadow drk:bg-gray-800 drk:divide-gray-700" aria-labelledby="dropdownNotificationButton">
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
        {{-- <a href="#" class="flex py-3 px-4 hover:bg-gray-100 drk:hover:bg-gray-700">

            <div class="pl-3 w-full">
                <div class="text-gray-500 text-sm mb-1.5 drk:text-gray-400"><span class="font-semibold text-gray-900 drk:text-white">Joseph Mcfall</span> and <span class="font-medium text-gray-900 drk:text-white">5 others</span> started following you.</div>
                <div class="text-xs text-blue-600 drk:text-blue-500">10 minutes ago</div>
            </div>
        </a>
        <a href="#" class="flex py-3 px-4 hover:bg-gray-100 drk:hover:bg-gray-700">

            <div class="pl-3 w-full">
                <div class="text-gray-500 text-sm mb-1.5 drk:text-gray-400"><span class="font-semibold text-gray-900 drk:text-white">Bonnie Green</span> and <span class="font-medium text-gray-900 drk:text-white">141 others</span> love your story. See it and view more stories.</div>
                <div class="text-xs text-blue-600 drk:text-blue-500">44 minutes ago</div>
            </div>
        </a>
        <a href="#" class="flex py-3 px-4 hover:bg-gray-100 drk:hover:bg-gray-700">

            <div class="pl-3 w-full">
                <div class="text-gray-500 text-sm mb-1.5 drk:text-gray-400"><span class="font-semibold text-gray-900 drk:text-white">Leslie Livingston</span> mentioned you in a comment: <span class="font-medium text-blue-500" href="#">@bonnie.green</span> what do you say?</div>
                <div class="text-xs text-blue-600 drk:text-blue-500">1 hour ago</div>
            </div>
        </a>
        <a href="#" class="flex py-3 px-4 hover:bg-gray-100 drk:hover:bg-gray-700">

            <div class="pl-3 w-full">
                <div class="text-gray-500 text-sm mb-1.5 drk:text-gray-400"><span class="font-semibold text-gray-900 drk:text-white">Robert Brown</span> posted a new video: Glassmorphism - learn how to implement the new design trend.</div>
                <div class="text-xs text-blue-600 drk:text-blue-500">3 hours ago</div>
            </div>
        </a> --}}
        </div>
        {{-- <a href="#" class="block py-2 text-sm font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100 drk:bg-gray-800 drk:hover:bg-gray-700 drk:text-white">
        <div class="inline-flex items-center ">
            <svg class="mr-2 w-4 h-4 text-gray-500 drk:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
            View all
        </div> --}}
        </a>
    </div>
</div>
