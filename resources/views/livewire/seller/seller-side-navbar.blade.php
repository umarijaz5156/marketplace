<div class="flex-1">
    <div class="bg-white h-screen fixed w-[190px] top-0 left-[-190px] lg:left-0  z-50 transition-all duration-500 ease-in-out"
        id="side-nav">
        <div class="flex justify-center items-center mt-[40px]">
            {{-- <img class="w-[40px]"
                src="https://blogger.googleusercontent.com/img/a/AVvXsEgjA6FdqLFps5zaTKQjQJaEThc8nqqk-qq8BTrxjoc1a2DWIJ2wb-eTf1R4hYRwC4UDqdR2kOish2vKcemBjYQEh0waLfZ4wcteJvy0TISrdbPWZm8udx730Ow7nj-oU_-7ZJGQSWWU8iAa_FG3BZ02BK1gpXYzmxj-s42fk4D0WrooBR6bypV9ImrSOg=s800"
                alt=""> --}}
            <div class="lg:hidden">
                <i class="bx bx-chevron-right toggle  justify-center items-center absolute right-[-24px] h-6 w-6 bg-[#2747C5] text-white cursor-pointer rounded-full"
                    id="toggle"></i>
            </div>
        </div>
        <div class="overflow-hidden h-[calc(100%_-_55px)] menubar">
            <div x-data="{showNotif: @entangle('newMessage')}">
                <ul class="mt-[130px] relative pl-0 py-8">
                    <img class="hidden absolute left-[-76px] top-0 bottom-0 h-[472px]"
                        src="{{ asset('images/dashboard-saidenav-bg.png') }}" alt="">
                    <li class="hover:text-blue-700 h-[50px] flex items-center mt-[10px] p-[1rem] relative">
                        <a title="home" href="{{ route('seller-dashboard')}}"
                            class="bg-transparent flex justify-start ml-4 gap-x-2  items-center h-full w-full rounded-[6px]">
                            {{-- <i class="bx bx-home-alt text-[24px] font-[300] text-black"></i> --}}
                            <span class=" text-lg font-semibold">Home</span>
                        </a>
                        @if(\Request::route()->getName() == 'seller-dashboard')
                        <div class="active-line"></div>
                        @endif
                    </li>
                    <li class="hover:text-blue-700 h-[50px] flex items-center mt-[10px] p-[1rem] relative">
                        <a title="services" href="{{ route ('gig_index') }}"
                            class="bg-transparent flex justify-start gap-x-2 ml-4 items-center h-full w-full rounded-[6px]">
                            {{-- <i class="bx bx-bar-chart-alt-2 text-[24px] font-[300] text-black"></i> --}}
                            <span class="mr-1 text-lg font-semibold">Services</span>
                        </a>
                        @if(\Request::route()->getName() == 'gig_index')
                        <div class="active-line"></div>
                        @endif
                    </li>
                    <li class="hover:text-blue-700 h-[50px] flex items-center mt-[10px] p-[1rem] relative">
                        <a title="messages" href="{{ route('seller_messages') }}"
                            class="bg-transparent flex justify-start gap-x-2 ml-4 items-center h-full w-full rounded-[6px]">
                            {{-- <i class="bx bx-bell text-[24px] font-[300] text-black"></i> --}}
                            {{-- <i class='bx bx-chat text-[22px] font-[300] text-white'></i> --}}
                            <span class="mr-1 text-lg font-semibold">Messages</span>
                            <div class="flex relative" x-show="showNotif">
                                <div
                                    class="inline-flex relative -top-[0.5rem] left-[0.1rem] w-3 h-3 bg-[#E9711C] rounded-full border-2 border-white drk:border-gray-900">
                                </div>
                            </div>
                        </a>

                        @if(\Request::route()->getName() == 'seller_messages')
                        <div class="active-line"></div>
                        @endif
                    </li>
                    <li class="hover:text-blue-700 h-[50px] flex items-center mt-[10px] p-[1rem] relative">
                        <a title="orders" href="{{ route('seller_orders')}}"
                            class="bg-transparent flex justify-start gap-x-2 ml-4 items-center h-full w-full rounded-[6px]">
                            {{-- <i class="bx bx-pie-chart-alt text-[24px] font-[300] text-black"></i> --}}
                            <span class="mr-1 text-lg font-semibold">Orders</span>
                        </a>
                        @if(\Request::route()->getName() == 'seller_orders')
                        <div class="active-line"></div>
                        @endif
                    </li>
                    <li class="hover:text-blue-700 h-[50px] flex items-center mt-[10px] p-[1rem] relative">
                        <a title="earnings" href="{{route('seller.requests')}}"
                            class="bg-transparent flex justify-start gap-x-2 ml-4 items-center h-full w-full rounded-[6px]">
                            {{-- <i class="bx bx-briefcase text-[22px] font-[300] text-white"></i> --}}
                            <span class="mr-1 text-lg font-semibold">Requests</span>
                        </a>
                        @if(\Request::route()->getName() == 'seller.requests')
                        <div class="active-line"></div>
                        @endif
                    </li>
                    <li class="hover:text-blue-700 h-[50px] flex items-center mt-[10px] p-[1rem] relative">
                        <a title="earnings" href="{{route('seller.earnings')}}"
                            class="bg-transparent flex justify-start gap-x-2 ml-4 items-center h-full w-full rounded-[6px]">
                            {{-- <i class="bx bx-dollar-circle text-[22px] font-[300] text-white"></i> --}}
                            <span class="mr-1 text-lg font-semibold">Earnings</span>
                        </a>
                        @if(\Request::route()->getName() == 'seller.earnings')
                        <div class="active-line"></div>
                        @endif
                    </li>
                    <li class="hover:text-blue-700 h-[50px] flex items-center mt-[10px] p-[1rem] relative">
                        <a title="disputes" href="{{route('seller_disputes')}}"
                            class="bg-transparent flex justify-start gap-x-2 ml-4 items-center h-full w-full rounded-[6px]">
                            {{-- <i class="bx bx-wallet text-[24px] font-[300] text-black"></i> --}}
                            <span class="mr-1 text-lg font-semibold">Disputes</span>
                        </a>
                        @if(\Request::route()->getName() == 'seller_disputes')
                        <div class="active-line"></div>
                        @endif
                    </li>
                </ul>
            </div>
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
</div>
