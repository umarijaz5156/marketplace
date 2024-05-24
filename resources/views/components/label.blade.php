@props(['value'])

<label {{ $attributes->merge(['class'=> 'block mb-2 text-base font-medium text-[#263238] drk:text-gray-4']) }}>
    {{ $value ?? $slot }}
</label>
