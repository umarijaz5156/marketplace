@props(['href'])

<div>

    <a href="{{$href}}" class="py-[15px] px-[22px] border border-[#d1d1d1] rounded-full bg-white text-[#545454] text-[16px] leading-[66px] text-center hover:bg-[#2646C4] hover:border-[#3858D6] hover:text-white mr-[12px]">
        {{$slot}}
      </a>
</div>
