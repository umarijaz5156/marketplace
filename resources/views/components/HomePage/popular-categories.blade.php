
<div class="container xl:max-w-screen-2xl mx-auto px-4">
    <div class="flex justify-between sm:items-center gap-4 mt-20 flex-col sm:flex-row">
        <h1 class="text-black font-semibold text-5xl">Popular Categories</h1>
    </div>
    <div class="mt-10 bg-[#15A5E6] bg-opacity-20 rounded-[40px] py-9 sm:py-16 md:py-24 px-6 sm:px-16 md:px-20">
        <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-8">
            @foreach ($popularCategories as $category)

                <div class="flex justify-center items-center gap-3 border border-[#0BA1E5] bg-white rounded-lg py-3 px-4 group hover:bg-[#0BA1E5] transition-all duration-300 ease-in-out cursor-pointer"
                    data-ripple-light="true">
                    <img class="w-10" src="storage/images/categories/{{ $category->categoryDetails?->icon }}" />

                    <h1 class="text-lg group-hover:text-white">{{ $category->name }}</h1>
                </div>
            @endforeach

        </div>
    </div>
</div>
