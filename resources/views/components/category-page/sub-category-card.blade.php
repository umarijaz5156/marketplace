@props(['image_url','link'])

<div class="mt-[20px] xl:mt-0">
    <div class="relative rounded-3xl h-[156px] shadow-[0px_2px_11px_rgba(43,75,200,0.1)] w-[75%]  xl:w-[85%] 2xl:w-[75%] mx-auto flex justify-center items-center bg-white">
      <img class="" src="{{ $image_url }}" alt="">
    </div>
    <a href="{{$link}}" class="text-[#545454] text-[18px] hover:text-[white]">
      <div class="group mt-[-22px] w-[95%] mx-auto rounded-2xl h-[83px] bg-[#f0f1f6] p-[41px_39px_18px_39px] xl:p-[41px_39px_18px_25px] 2xl:p-[41px_39px_18px_39px] hover:bg-[#2646C4]">
        <div>
          {{$slot}}
        </div>
      </div>
    </a>
  </div>