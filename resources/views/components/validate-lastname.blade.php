<li x-cloak x-show="formData.last_name.length > 0" class="flex items-center">
    <div 
      :class="{'bg-green-200 text-green-700': isLastName(formData.last_name),
       'bg-red-200 text-red-700': !isLastName(formData.last_name)}"
        class=" rounded-full p-1 fill-current ">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" 
          stroke="currentColor">
            <path
                x-show="isLastName(formData.last_name)"
                stroke-linecap="round" stroke-linejoin="round" 
                stroke-width="2" d="M5 13l4 4L19 7" />
            <path
                x-show="!isLastName(formData.last_name)"
                stroke-linecap="round" stroke-linejoin="round" 
                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </div>
    <span
        :class="{'text-green-700': isLastName(formData.last_name), 
          'text-red-700': !isLastName(formData.last_name)}"
        class="font-medium text-sm ml-3"
        x-text="isLastName(formData.last_name) ? 
        'Valid' : 'Not valid!' "></span>
</li>
