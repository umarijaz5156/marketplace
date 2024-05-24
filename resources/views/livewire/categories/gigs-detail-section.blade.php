<div>
    <div class="container xl:max-w-screen-2xl mx-auto px-4">
        <div class="grid lg:grid-cols-12 gap-5">

            <div class=" lg:col-span-3 border-b lg:border-b-0 lg:border-r border-gray-200 lg:pr-5">
                <x-side-bar-filter :countries="$countries" :selectedCountry="$sellerCountry" />
            </div>

            <div class="lg:col-span-8 xl:col-span-9">
                <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-5">

                @foreach ($gigs as $gig)
                    <x-product-card :gig="$gig" />
                @endforeach

                </div>
                <div class="my-5">
                    {{ $gigs->links('vendor.livewire.custom-pagination') }}
                </div>
            </div>

        </div>

    </div>

</div>
