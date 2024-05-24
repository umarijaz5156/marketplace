

<select {{ $attributes->merge(['class' => ' bg-white border border-[#E7EFFF] text-gray-900 text-sm rounded-md focus:ring-[#0096D8] focus:border-[#0096D8]  block w-full p-4 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500']) }}>
    {{ $slot }}
</select>
