<x-guest-layout>
    @push('styles')
    @once
    <style>
        .row {
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
    @vite(['resources/css/select2.css'])
    @endonce
    @endpush


    <div class="mx-auto">
        <div class="flex justify-center relative">
            <!-- Row -->
            <div class="grid sm:grid-cols-1 lg:grid-cols-2 w-full  h-screen">
                <!-- Col -->
                <div class="w-full bg-white rounded-lg lg:rounded-l-none login-container relative scrollbar-hide">
                    {{-- <h1 class="text-[34px] text-[#2646C4] pt-[48px] ml-[48px]">
                        <a href="/">pushiii</a>
                    </h1> --}}
                    <x-logo type="drk" home_link="/" class="pt-[48px] ml-[48px]" />
                    <div class="flex justify-center mt-[80px] ">
                        <div class="mb-3 w-full px-8 sm:px-0 sm:w-11/12 md:w-11/12 lg:w-10/12 xl:w-7/12">

                            <div class="flex items-center mb-4">
                                <h1 class="font-medium text-[1.75rem]">Register</h1>
                                <img class="ml-[5px]" src="{{ asset('images/arrow__login.png') }}" alt="">
                            </div>
                            <p class="text-[#5D5C5B] text-[15px]">Register for a new seller account.</p>

                            <x-jet-validation-errors class="mb-4" />

                            <div x-data="getData( {{ json_encode(session()->getOldInput()) }})">
                                <form method="POST" action="{{ route('create_seller') }}" class="mt-[53px]">
                                    @csrf
                                    {{-- name input --}}
                                    <div class="flex justify-between">
                                        <div class="">
                                            <x-validate-firstname />
                                            <x-label for="first_name" class="text-[#7F7D7C] text-[15px] mb-2"
                                                value="{{ __('First Name') }}" />
                                            <x-input x-model="formData.first_name" id="first_name"
                                                class="border-gray-300 w-full mb-[33px]" type="text" name="first_name"
                                                autofocus />
                                        </div>
                                        <div class="">
                                            <x-validate-lastname />
                                            <x-label for="last_name" class="text-[#7F7D7C]  text-[15px] mb-2"
                                                value="{{ __('Last Name') }}" />
                                            <x-input x-model="formData.last_name" id="last_name"
                                                class="border-gray-300 w-full mb-[33px]" type="text" name="last_name" />
                                        </div>
                                    </div>

                                    <x-validate-username />
                                    <x-label for="seller_name" class="text-[#7F7D7C] text-[15px] mb-2"
                                        value="{{ __('Username') }}" />
                                    <x-input x-model="formData.name" id="seller_name"
                                        class="border-gray-300 w-full mb-[33px]" type="text" name="seller_name"
                                        required />

                                    <x-label for="description" class="text-[#7F7D7C] text-[15px] mb-2"
                                        value="{{ __('Tell Us About Yourself') }}" />
                                    <x-textarea class="mb-[33px]" x-model="formData.description" id="description"
                                        name="description" rows="5" maxlength="1000"></x-textarea>


                                    <div wire:ignore class="mb-[43px] col-span-8 sm:col-span-4">

                                        <x-label for="skills" class="text-[#7F7D7C] text-[15px] mb-2"
                                            value="{{ __('Skills') }}" />
                                        <select id='skills' x-model="formData.skills"  name="skills[]"
                                            multiple
                                            class="bg-white !border-[#E7EFFF] text-gray-900 text-sm rounded-md focus:ring-1 focus:ring-[#0096D8] focus:border-[#0096D8]  block w-full  focus:outline-none"
                                          >

                                            @if($skills)
                                                @foreach ($skills as $skill)
                                                    <option value="{{ $skill->name }}">{{ $skill->name }}</option>
                                                @endforeach
                                            @endif

                                        </select>

                                        <x-jet-input-error for="description" class="mt-2" />
                                    </div>

                                    <x-validate-phone />
                                    <x-label for="phone_number" class="text-[#7F7D7C] text-[15px] mb-2"
                                        value="{{ __('Phone Number') }}" />
                                    <x-input x-model="formData.phone_number" id="phone_number" class="mb-[33px]"
                                        type="tel" name="phone_number" placeholder="+xxxxxxxxxx" required />

                                    <x-label for="country" class="text-[#7F7D7C] text-[15px]  mb-2"
                                        value="{{ __('Country') }}" />
                                    <x-select x-model="formData.country" id="country" name="country" class="mb-[33px]"
                                        required>

                                        @if ($countries)
                                        @foreach ($countries as $item)
                                        <option value="{{ $item->id }}" {{ $country==$item->id ? "selected":""}}>{{
                                            $item->name }}</option>
                                        @endforeach
                                        @endif

                                    </x-select>

                                    <x-label for="address1" class="text-[#7F7D7C] text-[15px]  mb-2"
                                        value="{{ __('Address Line 1') }}" />
                                    <x-textarea x-model="formData.address_line1" id="address1" name="address_line1"
                                        rows="2" maxlength="1000" required></x-textarea>

                                    <x-label for="address2" class="text-[#7F7D7C] text-[15px] "
                                        value="{{ __('Address Line 2') }}" />
                                    <x-textarea x-model="formData.address_line2" id="address2" name="address_line2"
                                        rows="2" maxlength="1000"></x-textarea>
                                    <div x-data="handler()">
                                        <div class="mt-[33px] flex justify-between">
                                            <x-label for="qualifications" class="text-[#7F7D7C] text-[15px]"
                                                value="{{ __('Qualification') }}" />
                                            <button type="button"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                                @click="addNewField()">+ Add More</button>
                                        </div>
                                        <div class="mt-[33px] flex flex-col">
                                            <div class="">
                                                <table class="table-auto w-full">

                                                    <tbody>
                                                        <template x-for="(field, index) in fields" :key="index">
                                                            <tr>
                                                                <td class="">
                                                                    <x-input x-model="field.title" type="text"
                                                                        name="title[]" class="form-input"
                                                                        class="border-gray-300 w-full " placeholder='Title' type="text" />
                                                                <td>
                                                                    <x-input x-model="field.institute" type="text"
                                                                        name="institute[]" class="form-input"
                                                                        class="border-gray-300 w-full" type="text"  placeholder='Institute'/>
                                                                </td>
                                                                <td class="px-4 py-2"><button type="button"
                                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                                                        @click="removeField(index)">&times;</button>
                                                                </td>
                                                            </tr>
                                                        </template>
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-check mt-[1.5rem] mb-[3rem] flex justify-between">

                                        <div class="flex items-center">

                                            <x-label for="terms"
                                                class=" cursor-pointer text-[#888] text-[15px] ml-[5px]">
                                                <x-checkbox required name="terms" id="terms" />

                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms').'"
                                                    class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms
                                                    of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank"
                                                    href="'.route('privacy-policy').'"
                                                    class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy
                                                    Policy').'</a>',
                                                ]) !!}

                                            </x-label>

                                        </div>

                                    </div>

                                    <div class="flex justify-center mt-10">

                                        <x-button class="w-[211px] h-[50px] ">
                                            Register
                                        </x-button>
                                        <div wire:loading>
                                            Registering
                                        </div>
                                    </div>
                                    <div class="text-center mt-[47px]">
                                        <p class="text-[#757473]">Already have an account? <a
                                                href="{{ route('login') }}" class="text-[#2A4AC8] underline">Log In</a>
                                        </p>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <img class="absolute bottom-0" src="{{ asset('images/auth-layer.png') }}" alt="">
                </div>
                <!-- Col -->
                <div class="w-full h-auto hidden lg:block relative">
                    <img class="fixed w-[54%] h-[100vh]" src="{{asset('images/right__login.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>




</x-guest-layout>
<script>


    function handler() {
    // let title = {!! json_encode(session()->getOldInput('title')) !!};
    // let qual = {!! json_encode(session()->getOldInput('institute')) !!}
    // let oldFields = [];
    // if( title.length > 0){
    //     for(let i=0;i<title.length;i++)
	// {
	// 	oldFields.push({title : title[i], institute : qual[i]});
	// }
    // console.log(oldFields);
    // }

    return {
      fields: [{   title: '',
      institute: ''}],
       addNewField() {
          this.fields.push({
            title: '',
            institute: ''
           });
        },
        removeField(index) {
           this.fields.splice(index, 1);
        }
      }
    }

</script>
<script>
    function getData(oldValues) {
        return {
            formData : {
                name:  oldValues['seller_name'] ? oldValues['seller_name'] : "",
                description: oldValues['description'] ? oldValues['description'] : "",
                first_name: oldValues['first_name']  ? oldValues['first_name'] : "",
                last_name: oldValues['last_name']  ? oldValues['last_name'] : "",
                skills:  oldValues['skills'] ? oldValues['skills'] : [],
                email: oldValues['email'] ? oldValues['email'] : "",
                country: oldValues['country'] ? oldValues['country'] : {{$country}},
                phone_number: oldValues['phone_number'] ? oldValues['phone_number'] : "",
                address_line1: oldValues['address_line1'] ? oldValues['address_line1'] : "",
                address_line2: oldValues['address_line2'] ? oldValues['address_line2'] : "",
                password: "",
                password_confirm: ""
            },

            isEmail(email) {
                var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,5})+$/;
                return re.test(email);
            },
            isName(name) {
                var re = /^[a-zA-Z]([._-](?![._-])|[a-zA-Z0-9]){1,15}[a-zA-Z0-9]$/;
                return re.test(name);
            },
            isPhone(phone) {
                // var re=/^\+(?:[0-9] ?)[0-9]{11}$/;
                var re=/^\+(?:[0-9].?){6,14}[0-9]$/;
                return re.test(phone);
            },
            isPassword(password) {
                var re = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
                return re.test(password);
            },
            isFirstName(first_name) {
                // /^[A-Za-z]+$/
                var re = /^[a-zA-z]{3,10}$/;
                return re.test(first_name);
            },
            isLastName(last_name) {
                var re = /^[a-zA-z]{3,10}$/;
                return re.test(last_name);
            }

        }

    }
</script>

<script>

    var $select = $('#skills').selectize({
      create: true,

    });
</script>
