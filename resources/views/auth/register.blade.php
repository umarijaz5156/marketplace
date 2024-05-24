<x-guest-layout>
        <x-authenticate-layout>

            <div class="grid grid-cols-1 lg:grid-cols-2 h-full text-gray-800 w-full">
                <!-- Col -->
                <div class="w-full h-full  px-4 py-5 sm:px-[100px] lg:my-0 order-0 lg:order-0">

                        <div class="w-full h-full max-w-[580px] mx-auto">
                            <div class="mb-16 lg:mb-40">
                                <x-logo type="drk" home_link="/" class="pt-[48px] "/>
                            </div>
                           <div class="w-full">
                            <h1 class="text-4xl font-bold mb-2">Sign Up</h1>
                            <p class="text-[#6A6A6A] text-base font-medium">Register here for a new account.</p>
                            <x-jet-validation-errors class="mb-4" />

                            <div x-data="getData( {{ json_encode(session()->getOldInput()) }})">



                                <form method="POST" action="{{ route('register') }}" class="mt-6 md:mt-12 space-y-6">

                                    @csrf
                                    <input hidden name="key" value="{{ request('key') }}" />
                                <div>

                                    <x-label for="name" value="{{ __('Username') }}"  />
                                    <x-input x-model="formData.name"  id="name"  type="text" name="name" :value="old('name')" autofocus
                                        required autocomplete="name"  />
                                        <x-validate-username />
                                </div>
                                  <div>
                                     <!-- Validate Email -->
                                     <div class="flex justify-between items-center">

                                        <x-label  for="email" class=" " value="{{ __('Email') }}" />
                                     </div>

                                    <x-input maxlength="30" x-model="formData.email"  id="email"  type="email" name="email" :value="old('email')"
                                        required />
                                        <x-validate-email />
                                  </div>
                                    <!-- Validate Password -->
                                  <div class="grid sm:grid-cols-2 gap-6">
                                    <div>
                                        <div class="flex justify-between items-center">

                                            <x-label for="password" class="" value="{{ __('Password') }}" />
                                        </div>
                                        <x-input maxlength='100' x-model="formData.password" id="password"  type="password" name="password" required
                                        autocomplete="new-password" />
                                        <x-validate-password/>
                                    </div>


                                      <!-- Validate Password Confirm -->
                                    <div>
                                        <div class="flex justify-between items-center">

                                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                                        </div>

                                        <x-input maxlength='100' x-model="formData.password_confirm" id="password_confirmation" class="border-gray-300 w-full" type="password"
                                            name="password_confirmation" required autocomplete="new-password" />
                                            <x-validate-confirm-password />
                                        </div>
                                  </div>
                                    <div>
                                        <div>
                                            <div class="flex items-center">
                                                <x-checkbox required name="terms" id="terms" />
                                                <label for="terms" class=" ml-2 text-base font-medium text-gray-900 drk:text-gray-300">
                                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                        'terms_of_service' => '<a target="_blank" href="'.route('terms').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                        'privacy_policy' => '<a target="_blank" href="'.route('privacy-policy').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                                ]) !!}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mt-12 mb-14">
                                            <x-button class="p-[17px_24px]">
                                                Register
                                            </x-button>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-[#757473]">Already have an account? <a href="{{ route('login') }}"
                                                class="text-[#2A4AC8] underline">Log In Now</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                           </div>
                        </div>


                </div>
                <!-- Col -->
                <div
                    class="w-full h-[60vh] mb-12 md:mb-0 lg:h-full lg:sticky lg:top-0 order-1 lg:order-1"
                >
                    <div class="w-full h-full  bg-no-repeat bg-cover relative p-5 sm:p-[36px_48px] bg-center" style="background-image: url({{asset('images/sign-up.png')}});">
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
        <script>
            function getData(oldValues) {


                return {
                    formData : {
                        name:  oldValues['name'] ? oldValues['name'] : "",
                        email: oldValues['email'] ? oldValues['email'] : "",
                        password: "",
                        password_confirm: ""
                    },
                    // status: false,
                    // laoding: false,
                    // isError: false,
                    isEmail(email) {
                        var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,7})+$/;
                        return re.test(email);
                    },
                    isName(name) {
                        // var re = /^[a-zA-z]+(([a-zA-z ])|[0-9 ]){2,}/;
                        var re=  /^[a-zA-Z]([._-](?![._-])|[a-zA-Z0-9]){1,15}[a-zA-Z0-9]$/;

                        return re.test(name);
                    },
                    isPassword(password) {
                        var re = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
                        return re.test(password);
                    }

                }
            }
        </script>
    </x-guest-layout>

