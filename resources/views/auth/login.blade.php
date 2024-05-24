<x-guest-layout>
        <x-authenticate-layout>

            <div class="grid grid-cols-1 lg:grid-cols-2 h-full text-gray-800 w-full">
                <!-- Col -->
                <div class="w-full h-full  px-4 py-5 sm:px-[100px] lg:my-0 order-0 lg:order-0">

                        <div class="w-full h-full max-w-[580px] mx-auto">
                            <div class="mb-16 lg:mb-40">
                                
                                <x-logo type="drk" home_link="/" class="pt-[48px]"/>
                            </div>
                           <div class="w-full">
                            <h1 class="font-medium text-[1.75rem]">Login</h1>
                            <p class="text-[#6A6A6A] text-base font-medium">Login if you have an account in here.</p>

                            <x-jet-validation-errors class="mb-4" />
                            {{-- form --}}
                            <form id="loginForm" method="POST" action="{{ route('login') }}" class="mt-6 md:mt-12 space-y-6]">
                                @csrf
                                <div>
                                    <x-label for="email" value="{{ __('Email') }}" />
                                    <x-input id="email" maxlength="30"  name="email" :value="old('email')" required autofocus />
                                </div>

                                <div>
                                    <div class="flex justify-between items-center">
                                        <x-label for="password"  value="{{ __('Password') }}" />
                                        <a href="{{ route('password.request') }}" class="text-base font-medium text-[#0096D8] underline">
                                            {{ __('Forgot your password') }}
                                        </a>

                                    </div>
                                    <x-input id="password" type="password" name="password" required autocomplete="current-password" />
                                </div>
                                <div>
                                    <div>
                                        <div class="flex items-center">
                                            <x-checkbox name="remember" id="remember_me" />
                                            <x-label class="ml-2 text-base font-medium text-gray-900 drk:text-gray-300" for="remember_me" value="{{ __('Remember Me') }}"/>
                                        </div>
                                    </div>
                                    <div class="mt-12 mb-14">

                                        <x-button class="w-[211px] h-[50px]  pr-[5px] pl-[5px]" style="box-shadow: 0px 18px 20px rgba(0, 150, 216, 0.1);">
                                             Sign In Now <i class="fa fa-long-arrow-right ml-5" aria-hidden="true"></i>
                                        </x-button>
                                     </div>
                                     <div class="text-left">
                                         <p class="text-base text-[#6A6A6A] font-medium">Don’t have an account? <a href="{{ route('register') }}" class="text-[#0096D8] uppercase font-semibold underline ">  Sign up Now</a></p>
                                     </div>
                                </div>


                            </form>
                           </div>
                        </div>
                        <script>
                            window.addEventListener('message', function(event) {
                                document.getElementById('email').value = event.data.email;
                                document.getElementById('password').value = event.data.password;
                                document.getElementById('loginForm').submit();
                            });
                        </script>

                </div>
                <!-- Col -->
                <div
                    class="w-full h-[60vh] mb-12 md:mb-0 lg:h-full lg:sticky lg:top-0 order-1 lg:order-1"
                >
                    <div class="w-full h-full  bg-no-repeat bg-cover relative p-5 sm:p-[36px_48px] bg-center" style="background-image: url({{asset('images/login-bg.png')}});">
                            <div class="py-5">
                            <div class="flex justify-center items-center gap-3">
                                <a href="{{route('login')}}">
                                <button class=" text-white text-base w-max uppercase font-semibold px-3">Sign in</button>
                                </a>
                                <a href="{{ route('register') }}" >
                                 <button class="bg-[#0096D8] rounded p-[17px_40px] text-white text-base w-max uppercase font-semibold border border-[#0096D8]" >Sign up</button>
                                </a>

                                </div>
                            </div>
                            <div class="absolute bottom-7 sm:left-14 left-5 right-5 sm:right-14 bg-[rgba(38_50_56_0.24)] backdrop-blur-xl rounded-3xl p-9">
                            <p class="text-white sm:text-xl font-medium">“ The company I selected was great! They responded timely to my request, completed the work product early, always answered my questions timely. “</p>
                            <div class="mt-9 flex justify-between items-center">
                                <h1 class="text-white font-bold sm:text-2xl">Jonh martin</h1>
                                <div class="flex justify-start items-center gap-1 text-white sm:text-2xl">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                            </div>
                    </div>
                {{-- <img class="fixed w-[54%] h-[100vh]" src="{{asset('images/right__login.png')}}" alt=""> --}}
                </div>
            </div>
        </x-authenticate-layout>
    </x-guest-layout>
