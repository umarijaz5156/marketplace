@props(['total', 'sorting' => false])

<!-- top filter -->
<div class="flex justify-between items-center flex-wrap py-4">
  <h1 class="text-[20px] text-[#e76d17]">{{ number_format($total) }} Results</h1>

  @if ($sorting)
    <div class="flex items-center">
      <span>Sort by:</span>
      <select wire:model="sortField" class="ml-[15px] w-[158px] bg-white border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block p-[12px]  drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
        <option value="average_rating">Best Selling</option>
        {{-- <option value="">Recommended</option>
        <option value="">Newest Arrivals</option> --}}
      </select>
    </div>
  @endif
</div>
<!-- top filter -->
