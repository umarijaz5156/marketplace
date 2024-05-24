 @props(['subcategories'])

 <!-- Select Logo -->
 @if (count($subcategories->childCategories) > 0)
    <div class="mt-[90px]">
        <div class="container max-w-[95%]  sm:max-w-[75%] lg:max-w-[95%] xl:max-w-[75%] mx-auto">
            {{-- <div class="flex justify-between items-center">
            <h1 class="text-[30px]">
                <span class="font-bold"> Select </span> logo Style
            </h1>
            <p class="text-[#2646C4] underline text-[20px]">
                View All
            </p>
            </div> --}}
            <div class="grid grid-cols-2  md:grid-cols-3 xl:grid-cols-6 mt-[40px]">
                @foreach ($subcategories->childCategories as $subCategory)
                    <x-category-page.sub-category-card image_url="{{ asset('/storage/images/categories/'.$subCategory->detail->icon) }}" link="{{ route('category_details', ['catId'=>$subCategory->id]) }}">
                        {{ $subCategory->name }}
                    </x-category-page.sub-category-card>
                @endforeach
            </div>
        </div>
    </div>     
 @endif
 <!-- Select Logo -->