<x-app-layout>
    <x-category-page.hero-section :tagline="$category?->detail->tagline" :title="$category?->name" />


    <!-- List of Post -->
    <section class="mt-10 md:mt-20">
        <livewire:categories.gigs-detail-section :catid="$category?->id" />
    </section>
    <section class="mt-10 md:mt-20">
        <div class="container xl:max-w-screen-2xl mx-auto px-4">
            <div class="space-y-2">
                <h1 class="text-black font-semibold text-4xl md:text-5xl">
                    Popular Professional  <span class="text-primary">Services</span>
                </h1>
                <p class="text-sm font-light">
                    Most Popular & Top Selling Services will be provided
                </p>
            </div>
            {{-- popluar professional services --}}
            <livewire:home-page.popular-services />
        </div>

    </section>
    <!-- Inspired by work  -->
    <section class="mt-10 md:mt-20">
        <livewire:home-page.inspired-work :freelancers="$freelancers" />
    </section>
    <!-- Grid List Cards -->
    {{-- <div class="mt-14">
        <livewire:categories.gigs-detail-section :catid="$category->id" />
        <x-faqs :title="$category->name" />
        <x-category-page.more-categories :title="$category->name" />
    </div> --}}
</x-app-layout>
