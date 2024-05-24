<div>
    <section class=" h-[275px] relative bg-cover bg-no-repeat flex justify-center items-center bg-center" style="background-image: url({{ asset('/images/basics/home-search-page-header-image.png') }});">
        <div>
          <div class="">
            <div class="mx-auto md:w-[700px] text-gray-600">
                <livewire:search-autocomplete />
            </div>
          </div>
        </div>
    </section>
    <div class="container 2xl:max-w-screen-xl relative max-w-[95%] xl:max-w-[90%] mx-auto mt-[25px] mb-[100px] md:mt-[130px] ">
        <div class="grid grid-cols-12 lg:gap-x-10">
            <div class="col-span-12 lg:col-span-12 mb-4">
                <x-top-bar-filter :total="$gigs->total()" :search="true" />
                <!-- cards section -->
                @if (count($gigs) > 0)
                    <div class="grid sm:grid-cols-3 lg:grid-cols-3 2xl:grid-cols-4 gap-x-7 gap-y-4">
                        @foreach ($gigs as $gig)
                            <x-product-card :gig="$gig" />
                        @endforeach
                    </div>
                @else
                    <h1 class="font-extrabold text-center">We didn't find any results for your search.</h1>
                @endif

                <div class="my-5">
                    {{ $gigs->links('vendor.livewire.custom-pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
