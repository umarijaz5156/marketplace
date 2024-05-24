@props(['type', 'home_link', 'logo'])
    <a href="{{ $home_link }}"  {{ $attributes->merge(['class' => 'flex items-center']) }}>
@if ($type == 'light')
    @if (!empty($logo))
        <img src="{{ asset('storage/images/logo/'.$logo) }}" class="mr-3 h-10 sm:h-9" alt="Pushi">
    @else
        <img src="{{ asset('/images/basics/pushi_logo.png') }}" class="mr-3 h-10 sm:h-9" alt="Pushi">
    @endif
@else
    <img src="{{ asset('/images/hotbleep.jpeg') }}" class="mr-3 h-10 sm:h-20" alt="Pushi">

@endif
</a>
