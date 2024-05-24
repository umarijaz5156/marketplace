<div class="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
    <style>
        /* filepond */

        .filepond--item {

            color: #2545C3;
        }

        /* the text color of the drop label*/
        .filepond--drop-label {
            background-color: white;
        }

        /* error state color */
        [data-filepond-item-state*='error'] .filepond--item-panel,
        [data-filepond-item-state*='invalid'] .filepond--item-panel {
            /* background-color: red; */

            /* background-color: aliceblue; */
            /* padding-right: 50px; */


        }

        trix-editor {
            height: 300px;
            max-height: 250px !important;
            overflow-y: auto;
        }

        .trix-button-group--file-tools {
            display: none;
        }

        .trix-button--icon-code {
            display: none;

        }

        .trix-button--icon-attach {
            display: none;
        }

        .trix-button--icon-link {
            display: none;
        }

        .trix-button--icon-heading-1 {
            display: none;
        }

        .trix-button--icon-quote {
            display: none
        }

        trix-editor ul {
            list-style-type: disc !important;
            margin-left: 1rem !important;
        }

        trix-editor ol {
            list-style-type: decimal !important;
            margin-left: 1rem !important;

        }
    </style>

    <h1 class="text-[30px] font-light">Description<span style="color:#ff0000">*</span></h1>
    <div class="mt-7">
        <div class="bg-white mb-4 w-full p-9 sm:p-[60px] rounded-3xl border border-gray-200 drk:bg-gray-700 drk:border-gray-600"
            style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">

            <div class="py-2 bg-white rounded-b-lg drk:bg-gray-800">
                <label for="description" class="sr-only">Description</label>

                <div wire:ignore>
                    <input type="hidden" id="desc" name="description" required>
                    <trix-editor class="border-0" input="desc" x-data
                        x-on:trix-change="$dispatch('input', event.target.value)" x-ref="description"
                        wire:model.debounce.500ms="description" wire:key="uniqueKey"></trix-editor>
                </div>
            </div>
            @error('descriptionCopy') <x-form-error>{{ $message }}</x-form-error>
            @enderror

        </div>

    </div>
    {{-- faqs --}}
    <div class="mt-12">

        <div>
            <div class=" flex justify-between items-center flex-wrap">
                <h1 class="text-[30px] font-light">Frequently Asked Questions</h1>
                <a wire:click.prevent="add({{$i}})"
                    class="cursor-pointer text-[16px] border border-[#3959D6] px-6 py-3 rounded-full mr-3 bg-white text-[#2646C4]">
                    <i class=" fa-regular fa-plus text-[16px] mr-2"></i> Add FAQ
                </a>
            </div>

            @error('faq') <span class="flex items-center font-medium tracking-wide text-red-500 text-s mt-1 ml-1">{{
                $message
                }}</span> @enderror

            @foreach($inputs as $key => $value)
            <div class="mt-7">


                <div class=" bg-white mb-4 w-full p-9 sm:px-[60px] sm:py-[40px] rounded-3xl border border-gray-200 drk:bg-gray-700 drk:border-gray-600"
                    style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">

                    <div class="flex justify-between items-center pb-4 border-b drk:border-gray-600">
                        <div class="flex flex-wrap items-center divide-gray-200 sm:divide-x drk:divide-gray-600">
                            <p class="text-[18px] font-medium">Add Questions & Answers for Your Buyers.</p>
                        </div>
                        <div>
                            <button wire:click.prevent="remove({{$key}})" type="button"
                                class=" text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Remove</span>
                            </button>
                        </div>
                    </div>
                    <div class="py-2 rounded-b-lg drk:bg-gray-800">
                        <label for="question" class="sr-only">Question</label>
                        <textarea maxlength="150" name="faqs[{{$value}}][question]" wire:model="question.{{ $value }}"
                            rows="1"
                            class="block px-0 w-full text-[18px] text-gray-800 bg-white border-0 drk:bg-gray-800 focus:ring-0 drk:text-white drk:placeholder-gray-400"
                            placeholder="Enter your question here"></textarea>
                    </div>
                    <div class="py-2 mt-4 bg-white rounded-b-lg drk:bg-gray-800">
                        <label for="answer" class="sr-only">Answer</label>
                        <textarea maxlength="250" name="faqs[{{$value}}][answer] " wire:model="answer.{{ $value }}"
                            rows="2"
                            class="block px-0 w-full text-[18px] text-gray-800 bg-white border-0 drk:bg-gray-800 focus:ring-0 drk:text-white drk:placeholder-gray-400"
                            placeholder="Enter your answer here"></textarea>
                    </div>

                </div>

            </div>
            @endforeach

            @foreach ($faqs as $index=>$faq)
            {{-- {{dd($faqs)}} --}}
            <div class="mt-7">
                <div class=" bg-white mb-4 w-full p-9 sm:px-[60px] sm:py-[40px] rounded-3xl border border-gray-200 drk:bg-gray-700 drk:border-gray-600"
                    style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">

                    <div class="flex justify-between items-center pb-4 border-b drk:border-gray-600">
                        <div class="flex flex-wrap items-center divide-gray-200 sm:divide-x drk:divide-gray-600">
                            <p class="text-[18px] font-medium">Add Questions & Answers for Your Buyers.</p>
                        </div>
                        <div>
                            <button wire:click.prevent="remove({{$index}})" type="button"
                                class=" text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Remove</span>
                            </button>
                        </div>
                    </div>
                    <div class="py-2 rounded-b-lg drk:bg-gray-800">
                        <label for="question" class="sr-only">Question</label>
                        <textarea maxlength="150" name="faqs[{{$index}}][question]"
                            wire:model="faqs.{{$index}}.question" rows="1"
                            class="block px-0 w-full text-[18px] text-gray-800 bg-white border-0 drk:bg-gray-800 focus:ring-0 drk:text-white drk:placeholder-gray-400"
                            placeholder="Enter your question here"></textarea>
                    </div>
                    <div class="py-2 mt-4 bg-white rounded-b-lg drk:bg-gray-800">
                        <label for="answer" class="sr-only">Answer</label>
                        <textarea maxlength="250" name="faqs[{{$index}}][answer]" wire:model="faqs.{{$index}}.answer"
                            rows="2"
                            class="block px-0 w-full text-[18px] text-gray-800 bg-white border-0 drk:bg-gray-800 focus:ring-0 drk:text-white drk:placeholder-gray-400"
                            placeholder="Enter your answer here"></textarea>
                    </div>

                </div>

            </div>
            @endforeach

        </div>
    </div>
    {{-- faqs --}}

    {{-- requirements --}}
    <div class="mt-12">
        <div class="flex justify-between items-center flex-wrap">
            <h1 class="text-[30px] font-light">Requirement</h1>
            <a wire:click.prevent="addReq({{$x}})"
                class="cursor-pointer text-[16px] border border-[#3959D6] px-6 py-3 rounded-full mr-3 bg-white text-[#2646C4]">
                <i class=" fa-regular fa-plus text-[16px] mr-2"></i> Add More
            </a>
        </div>
        @error('requirement') <span class="flex items-center font-medium tracking-wide text-red-500 text-s mt-1 ml-1">{{
            $message
            }}</span> @enderror
        @error('requirements.*.requirement') <span
            class="flex items-center font-medium tracking-wide text-red-500 text-s mt-1 ml-1">{{ $message
            }}</span> @enderror
        @foreach ($reqInputs as $key => $value )
        <div class="mt-7">
            <div class="bg-white mb-4 w-full p-9 sm:px-[60px] sm:py-[40px] rounded-3xl border border-gray-200 drk:bg-gray-700 drk:border-gray-600"
                style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">

                <div class="">
                    <div class="flex justify-between">
                        <label for="requirement[{{$value}}]" class="text-[18px] font-medium">Add a question</label>
                        <div>
                            <button wire:click.prevent="removeReq({{$key}})" type="button"
                                class="justify-end text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Remove</span>
                            </button>
                        </div>
                    </div>

                    <input wire:model="requirement.{{$value}}" maxlength="150" type="text"
                        name="requirement[{{$value}}]" id="requirement[{{$value}}]"
                        class="w-full border-0 border-b-2 border-[#DFE3EC] focus:outline-none px-1 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)]"
                        placeholder="Request necessary details." maxlength="150" />
                    <div class="text-end mt-2">
                        {{-- <p class="text-[#707070] text-[14px]"><span>{{ strlen($requirement[$value])}}</span>/150
                            max</p> --}}
                    </div>

                    <div>
                        <div class="flex items-center mb-4">
                            <input wire:model="options.{{$value}}" id="default-radio-{{$value}}" type="radio"
                                value="file" name="default-radio-{{$value}}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 drk:focus:ring-blue-600 drk:ring-offset-gray-800 focus:ring-2 drk:bg-gray-700 drk:border-gray-600">
                            <label for="default-radio-{{$value}}"
                                class="ml-2 text-sm font-medium text-gray-900 drk:text-gray-300">File</label>
                        </div>
                        <div class="flex items-center">
                            <input wire:model="options.{{$value}}" checked checked id="default-radio-{{$value}}"
                                type="radio" value="text" name="default-radio-{{$value}}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 drk:focus:ring-blue-600 drk:ring-offset-gray-800 focus:ring-2 drk:bg-gray-700 drk:border-gray-600">
                            <label for="default-radio-{{$value}}"
                                class="ml-2 text-sm font-medium text-gray-900 drk:text-gray-300">Plain Text</label>
                        </div>
                    </div>



                </div>
            </div>
        </div>
        @endforeach

        @foreach ($requirements as $index=>$req)
        <div class="mt-7">
            <div class="bg-white mb-4 w-full p-9 sm:px-[60px] sm:py-[40px] rounded-3xl border border-gray-200 drk:bg-gray-700 drk:border-gray-600"
                style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
                <div class="">
                    <label for="gigtitle" class="text-[18px] font-medium">Add a question</label>
                    <input wire:model.debounce:500="requirements.{{$index}}.requirement" maxlength="150" type="text"
                        name="requirement" id="requirement"
                        class="w-full border-0 border-b-2 border-[#DFE3EC] focus:outline-none px-1 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)]"
                        placeholder="Request necessary details." maxlength="150" />

                </div>
                <div>

                    <div class="flex items-center mb-4">
                        <input wire:model="requirements.{{$index}}.type" id="file-radio-{{$index}}" type="radio"
                            value="file" name="file-radio-{{$index}}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 drk:focus:ring-blue-600 drk:ring-offset-gray-800 focus:ring-2 drk:bg-gray-700 drk:border-gray-600">
                        <label for="file-radio-{{$index}}"
                            class="ml-2 text-sm font-medium text-gray-900 drk:text-gray-300">File</label>
                    </div>
                    <div class="flex items-center">
                        <input wire:model="requirements.{{$index}}.type" id="text-radio-{{$index}}" type="radio"
                            value="text" name="text-radio-{{$index}}"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 drk:focus:ring-blue-600 drk:ring-offset-gray-800 focus:ring-2 drk:bg-gray-700 drk:border-gray-600">
                        <label for="text-radio-{{$index}}"
                            class="ml-2 text-sm font-medium text-gray-900 drk:text-gray-300">Plain Text</label>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    {{-- images --}}
    <div class="mt-12">
        <div class="flex justify-between items-center flex-wrap">
            <h1 class="text-[30px] font-light">Showcase Your Services In A Gallery</h1>
        </div>
        <div class="mt-7">
            <div class="showcase bg-white mb-4 w-full p-9 sm:px-[60px] sm:py-[50px] rounded-3xl border border-gray-200 drk:bg-gray-700 drk:border-gray-600"
                style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
                <p class="text-[18px] font-medium">Images/ Videos (up to 5)</p>
                <p class="font-small text-gray-400">Minimum Dimension for an image are 550*370</p>
                <div class="img-container grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 mt-7 gap-x-4">
                    <div class="mb-5 md:mb-0 border-dashed border-[1px] border-[#2646C4] rounded-2xl pt-2">
                        <p class="font-small text-center text-gray-400">Feature Image<span
                                style="color:#ff0000">*</span></p>

                        @if($isEdit)

                        <x-inputs.gig-images-upload wire:model="featureImage" fileName="featureImage"
                            previous="{{'/gigs/images/'.$featureImage}}" />

                        @else
                        <x-inputs.gig-images-upload wire:model="featureImage" fileName="featureImage" />
                        @endif

                    </div>


                    <div class="mb-5  md:mb-0 border-dashed border-[1px] border-[#2646C4] rounded-2xl pt-2">
                        <p class="font-small text-center text-gray-400">Additional Image</p>
                        @if($isEdit && isset($additionalImages[0]))

                        <x-inputs.gig-images-upload wire:model="additionalImages.0" fileName="additionalImages[]"
                            previous="{{'/gigs/images/'.$additionalImages[0]}}" />
                        @else
                        <x-inputs.gig-images-upload wire:model="additionalImages" fileName="additionalImages[]" />
                        @endif
                    </div>
                    <div class="mb-5  md:mb-0 border-dashed border-[1px] border-[#2646C4] rounded-2xl pt-2">
                        <p class="font-small text-center text-gray-400">Additional Image</p>
                        @if($isEdit && isset($additionalImages[1]))
                        <x-inputs.gig-images-upload wire:model="additionalImages.1" fileName="additionalImages[]"
                            previous="{{'/gigs/images/'.$additionalImages[1]}}" />
                        @else
                        <x-inputs.gig-images-upload wire:model="additionalImages" fileName="additionalImages[]" />
                        @endif
                    </div>
                    <div class="hidden lg:block border-dashed border-[1px] border-[#2646C4] rounded-2xl pt-2">
                        <p class="font-small text-center text-gray-400">Additional Image</p>
                        @if($isEdit && isset($additionalImages[2]))
                        <x-inputs.gig-images-upload wire:model="additionalImages.2" fileName="additionalImages[]"
                            previous="{{'/gigs/images/'.$additionalImages[2]}}" />
                        @else
                        <x-inputs.gig-images-upload wire:model="additionalImages" fileName="additionalImages[]" />
                        @endif
                    </div>
                    <div class="hidden xl:block border-dashed border-[1px] border-[#2646C4] rounded-2xl pt-2">
                        <p class="font-small text-center text-gray-400">Additional Image</p>
                        @if($isEdit && isset($additionalImages[3]))
                        <x-inputs.gig-images-upload wire:model="additionalImages.3" fileName="additionalImages[]"
                            previous="{{'/gigs/images/'.$additionalImages[3]}}" />
                        @else
                        <x-inputs.gig-images-upload wire:model="additionalImages" fileName="additionalImages[]" />
                        @endif
                    </div>
                </div>
                @if(!$errors->has('featureImage'))
                    @error('imageMain')<x-form-error>{{ $message }}</x-form-error>@enderror
                    @error('imageSub')<x-form-error>{{ $message }}</x-form-error>@enderror
                @else
                    @error('featureImage')<x-form-error>{{ $message }}</x-form-error> @enderror
                    @error('additionalImages.*')<x-form-error>{{ $message }}</x-form-error> @enderror
                @endif


            </div>
        </div>
    </div>

    <div class="mt-12">
        <div class="flex justify-between items-center flex-wrap">
            <h1 class="text-[30px] font-light">Showcase Your Portfpolio In A Gallery</h1>
        </div>
        <div class="mt-7">
            <div class="showcase bg-white mb-4 w-full p-9 sm:px-[60px] sm:py-[50px] rounded-3xl border border-gray-200 drk:bg-gray-700 drk:border-gray-600"
                style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
                <p class="text-[18px] font-medium">Images/ Videos (up to 5)</p>
                <p class="font-small text-gray-400">Minimum Dimensions for an image are 550*370, You can upload videos that are less than 200Mb.</p>

                <div class="img-container grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 mt-7 gap-x-4">


                    <div class="mb-5  md:mb-0 border-dashed border-[1px] border-[#2646C4] rounded-2xl pt-2">
                        <p class="font-small text-center text-gray-400"></p>
                        @if($isEdit && isset($portfolioImages[0]))

                        <x-inputs.gig-images-upload wire:model="portfolioImages.0" type='portfolio' fileName="portfolioImages[]"
                            previous="{{ '/portfolio/mobile_images/'.$portfolioImages[0] }}" />
                        @else
                        <x-inputs.gig-images-upload wire:model="portfolioImages" type='portfolio' fileName="portfolioImages[]" />
                        @endif
                    </div>
                    <div class="mb-5  md:mb-0 border-dashed border-[1px] border-[#2646C4] rounded-2xl pt-2">
                        <p class="font-small text-center text-gray-400"></p>
                        @if($isEdit && isset($portfolioImages[1]))
                        <x-inputs.gig-images-upload wire:model="portfolioImages.1" type='portfolio' fileName="portfolioImages[]"
                        previous="{{ '/portfolio/mobile_images/'.$portfolioImages[1] }}" />
                        @else
                        <x-inputs.gig-images-upload wire:model="portfolioImages" type='portfolio' fileName="portfolioImages[]" />
                        @endif
                    </div>

                    <div class="hidden lg:block border-dashed border-[1px] border-[#2646C4] rounded-2xl pt-2">
                        <p class="font-small text-center text-gray-400"></p>
                        @if($isEdit && isset($portfolioImages[2]))
                        <x-inputs.gig-images-upload wire:model="portfolioImages.2" type='portfolio' fileName="portfolioImages[]"
                        previous="{{ '/portfolio/mobile_images/'.$portfolioImages[2] }}" />
                        @else
                        <x-inputs.gig-images-upload wire:model="portfolioImages" type='portfolio' fileName="portfolioImages[]" />
                        @endif
                    </div>
                    <div class="hidden xl:block border-dashed border-[1px] border-[#2646C4] rounded-2xl pt-2">
                        <p class="font-small text-center text-gray-400"></p>
                        @if($isEdit && isset($portfolioImages[3]))
                        <x-inputs.gig-images-upload wire:model="portfolioImages.3" type='portfolio' fileName="portfolioImages[]"
                        previous="{{ '/portfolio/mobile_images/'.$portfolioImages[3] }}" />
                        @else
                        <x-inputs.gig-images-upload wire:model="portfolioImages" type='portfolio' fileName="portfolioImages[]" />
                        @endif
                    </div>
                    <div class="hidden xl:block border-dashed border-[1px] border-[#2646C4] rounded-2xl pt-2">
                        <p class="font-small text-center text-gray-400"></p>
                        @if($isEdit && isset($portfolioImages[4]))
                        <x-inputs.gig-images-upload wire:model="portfolioImages.4" type='portfolio' fileName="portfolioImages[]"
                        previous="{{  '/portfolio/mobile_images/'.$portfolioImages[4] }}" />
                        @else
                        <x-inputs.gig-images-upload wire:model="portfolioImages" type='portfolio' fileName="portfolioImages[]" />
                        @endif
                    </div>
                </div>
                @if(!$errors->has('portfolioImages'))
                @error('imageMainPortfolio')<x-form-error>{{ $message }}</x-form-error>@enderror
                @error('imageSubPortfolio')<x-form-error>{{ $message }}</x-form-error>@enderror
                @else

                @error('portfolioImages.*')<x-form-error>{{ $message }}</x-form-error> @enderror
                @endif


            </div>
        </div>
        <div class="flex justify-center items-center gap-x-5 mt-12">
            <a wire:click="previous()"
                class="cursor-pointer btn btn-prev px-8 sm:px-0 sm:w-[165px] h-[60px] bg-gradient-to-t from-[rgba(38,70,196,1)] to-[rgba(57,89,214,1)] text-white font-normal  leading-tight rounded-full focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex justify-center items-center text-[20px]"
                style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">Previous</a>

            <button type="button" {{ $disabled ? 'disabled' : '' }} {{-- formnovalidat''e --}} wire:click="publish()"
                class="cursor-pointer btn btn-next px-8 sm:px-0 sm:w-[165px] h-[60px] bg-gradient-to-t from-[rgba(38,70,196,1)] to-[rgba(57,89,214,1)] text-white font-normal  leading-tight rounded-full focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex justify-center items-center text-[20px]"
                style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
                <svg wire:loading class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                {{$isEdit ? 'Update' : 'Publish'}}
            </button>

        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>

</div>
