<div>
        {{-- overview section --}}
         <div class="form-step {{$currentStep==1 ? 'form-step-active' : ''}} ">

                    <h1 class="text-[30px] font-light">Overview</h1>
                    <div class="bg-white rounded-3xl px-[30px] py-[50px] sm:p-[40px_50px] mt-7" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
                        @if($access == 'admin')
                            <div wire:ignore.self class="mb-[35px] sm:mt-9">
                                <label for="seller_select" class="text-lg">Seller<span style="color:#ff0000">*</span></label>
                                <select id="seller_select" wire:model.lazy="seller" name="seller" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none drk:text-gray-400 drk:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option selected value="">Choose a seller</option>
                                    @foreach ($sellers as $seller)
                                        <option value="{{ $seller->id }}">{{ $seller->seller_name }}</option>
                                    @endforeach
                                </select>
                                @error('seller') <span class="flex items-center font-medium tracking-wide text-red-500 text-[14px] mt-1 ml-1">{{ $message }}</span> @enderror
                            </div>
                        @endif



                        {{-- gig-title --}}

                        <div class="">
                            <label for="gigtitle" class="text-lg">Service Title<span style="color:#ff0000">*</span></label>
                            <p class="text-[14px] text-[#707070] mb-4"></p>
                            <input wire:model.debounce.500ms="title" name="title"  type="text"  id="gigtitle" class="w-full border-0 border-b-2 border-[#DFE3EC] focus:outline-none px-1 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)]" placeholder="Service Title Here..." maxlength="150" autofocus/>

                            @error('title') <x-form-error>{{ $message }}</x-form-error>@enderror
                            <div class="text-end mt-2">
                                <p class="text-[#707070] text-[14px]"><span>{{ strlen($title)}}</span>/100 max</p>
                            </div>

                        </div>

                        {{-- gig-title --}}

                        {{-- categories --}}
                        <div class="mt-[35px] sm:mt-9">
                            <label for="Categories" class="text-lg">Categories<span style="color:#ff0000">*</span></label>
                        </div>
                        <div class="grid sm:grid-cols-3 gap-x-10">
                            {{-- main categories --}}
                           <div class="mb-[30px] sm:mb-0">

                                    {{-- @if($isEdit && $currentMainCategory)
                                    <select wire:model.lazy="currentMainCategory" name="categories[]" id="main_select" class="block py-2.5 px-0 w-full text-[16px] text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none drk:text-gray-400 drk:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                        <option value="{{ $currentMainCategory->id}}">
                                            {{ $currentMainCategory->name }}
                                        </option>
                                    </select>
                                    @else --}}
                                    <select  wire:model.lazy="currentMainCategory" name="categories[]" id="main_select" class="block py-2.5 px-0 w-full text-[16px] text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none drk:text-gray-400 drk:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                     <option  value="{{ null }}">Select a Category</option>
                                     @foreach ($mainCategories as $main)
                                         <option {{ $main->id == $currentMainCategory ? 'selected' : '' }} value="{{ $main->id}}">
                                             {{ $main->name }}
                                         </option>
                                     @endforeach
                                       </select>
                                    {{-- @endif --}}



                           </div>

                           <div>
                            {{-- 2nd level categories --}}
                            {{-- @if($isEdit && $currentSubCategory)
                                <select disabled wire:model.lazy="currentSubCategory" name="categories[]" id="main_select" class="block py-2.5 px-0 w-full text-[16px] text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none drk:text-gray-400 drk:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option value="{{ $currentSubCategory->id}}">
                                        {{ $currentSubCategory->name }}
                                    </option>
                                </select>
                            @else --}}
                                <select wire:model.lazy="currentSubCategory" name="categories[]" id="sub_select" class="block py-2.5 px-0 w-full text-[16px] text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none drk:text-gray-400 drk:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option  value="{{ null }}">Select a subcategory</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option value="{{$subCategory->id}}">
                                            {{$subCategory->name}}
                                        </option>
                                    @endforeach
                                </select>
                            {{-- @endif --}}
                            </div>
                            <div>
                                {{-- 3rd level categories --}}
                                    {{-- <select wire:model.lazy="currentSubChildCategory"
                                    name="categories[]" id="subchild_select" class="block py-2.5 px-0 w-full text-[16px] text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none drk:text-gray-400 drk:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                        @if($isEdit && $currentSubChildCategory)
                                        @foreach ($subChildCategories as $subChildCategory)
                                        <option
                                            @if($subChildCategory->id == $currentSubChildCategory)
                                                selected
                                            @endif
                                            value="{{$subChildCategory->id}}">
                                            {{$subChildCategory->name}}
                                        </option>
                                        @endforeach
                                        @else
                                        <option value="{{ null }}">Select a subcategory</option>
                                              @foreach ($subChildCategories as $subChildCategory)
                                                <option

                                                value="{{$subChildCategory->id}}">
                                                    {{$subChildCategory->name}}
                                                </option>
                                            @endforeach

                                        @endif



                                    </select> --}}
                                </div>
                                @error('categories.0')  <x-form-error>{{ $message }}</x-form-error> @enderror
                                @error('currentMainCategory') <x-form-error>{{ $message }}</x-form-error> @enderror
                        </div>
                         {{-- categories --}}

                         {{-- tags --}}
                        <div class="mt-9" x-data="{ show: @entangle('show')}">
                            <div class="mb-8">
                                <h4 class="text-lg">Search Keywords<span style="color:#ff0000">*</span></h4>
                            </div>
                            <div class="mb-5 flex justify-start items-center flex-wrap gap-y-3">
                                @foreach ($userSelectedTags as $tag)
                                    <a  class="text-[16px] cursor-pointer border border-[#D1D1D1] px-7 py-4 rounded-full mr-3">
                                        {{$tag}}<i wire:click="removeTag('{{ $tag }}')" class="fa-solid fa-x text-[12px] ml-2"></i>
                                    </a>
                                @endforeach

                                <a @click="show = !show" x-show="!show" class="cursor-pointer text-[16px] border border-[#3959D6] px-7 py-4 rounded-full mr-3 bg-[#F8FAFF] text-[#2646C4]">

                                    <i class="fa-regular fa-plus text-[16px] mr-2"></i> Create Tag

                                </a>
                                <input maxlength="20" list="suggestions" type="text" wire:keydown.enter='addTag()' wire:model="tag" class="w-44 text-[16px] border border-[#3959D6] px-7 py-4 rounded-full mr-3 bg-[#F8FAFF] text-[#2646C4]"  x-show="show" autofocus/>
                                <i title="add tag" x-show="show" wire:click='addTag()' class="hover:text-[#0c39ec] hover:text-[24px] text-[#2646C4] cursor-pointer fa-regular fa-plus text-[22px] mr-2"></i>
                                <datalist id="suggestions">
                                    @foreach ($tagSuggestions as $tagSuggestion)
                                        <option value="{{$tagSuggestion->name}}">
                                    @endforeach


                                </datalist>

                                @foreach ($userSelectedTags as $userTag)
                                    <input type="hidden" name="tags[]" value="{{$userTag}}" />
                                @endforeach


                            </div>
                            @error('tag')  <x-form-error>{{ $message }}</x-form-error> @enderror
                            @error('userSelectedTags') <x-form-error>{{ $message }}</x-form-error> @enderror
                          {{-- tags --}}
                    </div>
                    <div class="text-center mt-12">
                        <a wire:click="next()" class="cursor-pointer btn btn-next px-8 sm:px-0 sm:w-[165px] h-[60px] m-auto bg-gradient-to-t from-[rgba(38,70,196,1)] to-[rgba(57,89,214,1)] text-white font-normal  leading-tight rounded-full focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex justify-center items-center text-[20px]" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">Next</a>
                    </div>
                </div>
         </div>
        {{-- overview section --}}

        {{-- pricing section --}}
        <div class="form-step {{$currentStep == 2 ? 'form-step-active' : ''}}">

            <livewire:gigs.pricing :gig="$gig"/>
        </div>

        {{-- descritpion section --}}
        <div class="form-step {{$currentStep == 3 ? 'form-step-active' : ''}}">

            <livewire:gigs.description :gig="$gig"/>

        </div>


</div>
