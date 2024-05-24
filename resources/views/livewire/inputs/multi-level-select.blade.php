


<div class="group">
    <input value="{{   $selectedCategory }}" readonly placeholder="Select Category" wire:model="selectedCategory" name="categories[]" id="select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" />

    <ul id="menu" aria-hidden="true" class="bg-white border rounded-sm transform scale-0 group-hover:scale-100 absolute
                                                    transition duration-150 ease-in-out origin-top min-w-32 z-10">

            @foreach ($categories as $category)
                @if (count($category->childCategories) > 0)

                    <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                        <button wire:click="changeSelect('{{ $category->name }}')" type="button" aria-haspopup="true" aria-controls="menu-lang"
                            class="w-full text-left flex items-center outline-none focus:outline-none">
                            <span class="pr-1 flex-1">{{ $category->name }}</span>
                            <span class="mr-auto">
                                <svg class="fill-current h-4 w-4
                                            transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </span>
                        </button>
                        <ul id="menu-lang" aria-hidden="true" class="bg-white border rounded-sm absolute top-0 right-0
                            transition duration-150 ease-in-out origin-top-left
                            min-w-32
                        ">
                        @foreach ($category->childCategories as $child)
                            @if (count($child->childCategories) > 0)
                            <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                                <button type="button"  wire:click="changeSelect('{{ $child->name }}')" aria-haspopup="true" aria-controls="menu-lang-python"
                                    class="w-full text-left flex items-center outline-none focus:outline-none">
                                    <span class="pr-1 flex-1">{{ $child->name }}</span>
                                    <span class="mr-auto">
                                        <svg class="fill-current h-4 w-4
                                            transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </span>
                                </button>
                                <ul id="menu-lang-python" aria-hidden="true" class="bg-white border rounded-sm absolute top-0 right-0
                                transition duration-150 ease-in-out origin-top-left
                                min-w-32
                                ">
                                    @foreach ($child->childCategories as $subChild)
                                        <li  class="px-3 py-1 hover:bg-gray-100">
                                            <button wire:click="changeSelect('{{ $subChild->name  }}')" type="button" aria-haspopup="true" aria-controls="menu-lang"
                                                class="w-full text-left flex items-center outline-none focus:outline-none">
                                                <span class="pr-1 flex-1">{{ $subChild->name }}</span>
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            @else
                                <li class="px-3 py-1   hover:bg-gray-100">
                                    <button wire:click="changeSelect('{{ $child->name  }}')" type="button" aria-haspopup="true" aria-controls="menu-lang"
                                        class="w-full text-left flex items-center outline-none focus:outline-none">
                                        <span class="pr-1 flex-1">{{ $child->name }}</span>
                                    </button>
                               </li>
                            @endif


                        @endforeach
                        </ul>
                    </li>

                @else
                    <li class="rounded-sm px-3 py-1 hover:bg-gray-100">
                        <button wire:click="changeSelect('{{ $category->name   }}')" type="button" aria-haspopup="true" aria-controls="menu-lang"
                            class="w-full text-left flex items-center outline-none focus:outline-none">
                            <span class="pr-1 flex-1">{{ $category->name  }}</span>
                        </button>
                   </li>
                @endif
            @endforeach

    </ul>

</div>

{{-- <div>

<input id="multiLevelDropdownButton" data-dropdown-toggle="dropdown" value="{{ $selectedCategory }}" readonly placeholder="Select Category" wire:model="selectedCategory" name="categories[]" id="select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" />

<div id="dropdown" class="hidden z-10 w-60 bg-white rounded divide-y divide-gray-100 shadow drk:bg-gray-700">

    <ul class="py-1 text-sm text-gray-700 drk:text-gray-200" aria-labelledby="multiLevelDropdownButton">
        @foreach ($categories as $category)
        <li>
            @if (count($category->childCategories) > 0)
                <button wire:click="changeSelect('{{ $category->name }}')" id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown" data-dropdown-placement="right-start" type="button" class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">{{$category->name}}<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
                <div id="doubleDropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow drk:bg-gray-700" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(10px, 2724px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="right-start">
                    <ul class="py-1 text-sm text-gray-700 drk:text-gray-200" aria-labelledby="doubleDropdownButton">
                        @foreach ($category->childCategories as $child)
                           <li>
                            @if (count($child->childCategories) > 0)
                                <button id="tripleDropdownButton" data-dropdown-toggle="tripleDropdown" data-dropdown-placement="right-start" type="button" class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">{{$child->name}}<svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
                                <div id="tripleDropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow drk:bg-gray-700" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(10px, 2724px);" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="right-start">
                                    <ul class="py-1 text-sm text-gray-700 drk:text-gray-200" aria-labelledby="doubleDropdownButton">
                                        @foreach ($child->childCategories as $subChild)
                                            <li>
                                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">{{ $subChild->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            @else
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">{{ $child->name }}</a>
                            @endif
                           </li>
                        @endforeach
                    </ul>
                </div>

            @else
                <a href="#" class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">{{ $category->name }}</a>
            @endif
        </li>
        @endforeach

    </ul>
</div>

</div> --}}






















 {{-- <div>
 <input value="{{   $selectedCategories }}" readonly placeholder="Select Category" wire:model="selectedCategories" name="categories" id="select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-t  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" />
 <div class="flex">
    <button type="button" id="states-button" data-dropdown-toggle="dropdown-states" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-500 bg-gray-100 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 drk:bg-gray-700 drk:hover:bg-gray-600 drk:focus:ring-gray-700 drk:text-white drk:border-gray-600" type="button">
        Main
         <svg aria-hidden="true" class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </button>
    <div id="dropdown-states" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow drk:bg-gray-700">
        <ul class="py-1 text-sm text-gray-700 drk:text-gray-200" aria-labelledby="states-button">
            @foreach ($categories as $category)
                <li>
                    <button type="button" wire:click="add('{{ $category->name }}', {{ $category->id }})" class="inline-flex py-2 px-4 w-full text-sm text-gray-700 hover:bg-gray-100 drk:text-gray-400 drk:hover:bg-gray-600 drk:hover:text-white">
                        <div class="inline-flex items-center">
                          {{ $category->name }}
                        </div>
                    </button>
                </li>
            @endforeach


        </ul>
    </div>
    <label for="states" class="sr-only">Choose a Subcategory</label>
    <select id="states" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg border-l-gray-100 drk:border-l-gray-700 border-l-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500">

        @if ($childCategories)
            @foreach ($childCategories as $childCategory)
                <option  value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
            @endforeach
        @endif

    </select>
</div>
</div> --}}

{{-- <div class="flex">
    <div>
       <label for="main" class="sr-only">Main</label>
        <input id="main" name="main" type="text" placeholder="select main category">
        <datalist id="maindatalist" placeholder="Choose Main Category..."
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg border-l-gray-100 drk:border-l-gray-700 border-l-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500">

            <option value="">Main</option>
            @foreach ($categories as $category)
                <option wire:click="add('{{ $category->name }}', {{ $category->id }})" value="{{ $category->id }}">{{
                    $category->name }}
                </option>
            @endforeach

        </datalist>
    </div>
    <div>

        <label for="sub" class="sr-only">Choose a Subcategory</label>

        <select id="sub" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg border-l-gray-100 drk:border-l-gray-700 border-l-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500">
            <option  value="">Choose Subcategory</option>
            @if ($childCategories)
                @foreach ($childCategories as $childCategory)
                    <option  value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                @endforeach
            @endif

        </select>
    </div>
     <div>
        <label for="sub" class="sr-only">Choose a Subcategory</label>
        <select id="sub" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg border-l-gray-100 drk:border-l-gray-700 border-l-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500">
            <option  value="">Choose Subcategory</option>
                @if ($childCategories)
                    @foreach ($childCategories as $childCategory)
                        <option  value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                    @endforeach
                @endif

        </select>
    </div>
</div> --}}
