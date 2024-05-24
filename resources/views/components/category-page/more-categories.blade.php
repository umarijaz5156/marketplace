
    <!-- Explore More Logo Section -->
  <div class="mt-[103px]">
    <div class="container max-w-[95%]  sm:max-w-[75%] lg:max-w-[95%] xl:max-w-[75%] mx-auto">
      <div class="bg-[#F4F6FC] pt-[55px] pb-[65px] px-[30px] lg:px-[40px] xl:px-[113px] rounded-2xl">
        <div>
          <h2>Explore More Services</h2>
        </div>
        <div class="flex justify-start items-center flex-wrap">
         @foreach ($categories as $category)
            <x-category-page.more-categories-link href="{{route('category_details' ,['catId' => $category->id])}}">
                {{$category->name}}
            </x-category-page.more-categories-link>
         @endforeach
         
        </div>
      </div>
    </div>
   </div>
   <!-- Explore More Logo Section -->