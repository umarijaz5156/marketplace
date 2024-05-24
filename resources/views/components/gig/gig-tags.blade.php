<div class="mt-[103px]">
    <div class="container max-w-[95%]  sm:max-w-[75%] lg:max-w-[95%] xl:max-w-[75%] mx-auto">
      <div class="bg-[#F4F6FC] pt-[55px] pb-[65px] px-[30px] lg:px-[40px] xl:px-[113px] rounded-2xl">
        <div>
          <h2>Related Tags</h2>
        </div>
        <div class="flex justify-start items-center flex-wrap">
         @foreach ($tags as $tag)
         <div>
            <a  class="cursor-default py-[15px] px-[22px] border border-[#d1d1d1] rounded-full bg-white text-[#545454] text-[16px] leading-[66px] text-center">
                {{$tag->name}}
              </a>
         </div>
        
         @endforeach
         
        </div>
      </div>
    </div>
   </div>