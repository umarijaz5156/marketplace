
@props(['tagline','title'])

<!-- HeroSection -->


<section class="mt-32 relative flex justify-center items-center">
    <div
      class="bg-cover bg-center bg-no-repeat w-full py-20"
      style="background-image: url({{ asset('new-images/shop-her0-bg.png') }})"
    >
      <div class="container xl:max-w-screen-2xl mx-auto px-4 relative mt-24">
        <div class="grid text-center space-y-3">
          <h1 class="text-4xl font-semibold"> {!! $title !!}</h1>
          <p class="font-light text-sm">
            {{ $tagline }}
          </p>
        </div>
      </div>
    </div>
  </section>


