<li x-cloak x-show="formData.email.length > 0" class="flex items-center py-1">
    <div 
      :class="{'bg-green-200 text-green-700': isEmail(formData.email),
       'bg-red-200 text-red-700': !isEmail(formData.email)}"
        class=" rounded-full p-1 fill-current ">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" 
          stroke="currentColor">
            <path
                x-show="isEmail(formData.email)"
                stroke-linecap="round" stroke-linejoin="round" 
                stroke-width="2" d="M5 13l4 4L19 7" />
            <path
                x-show="!isEmail(formData.email)"
                stroke-linecap="round" stroke-linejoin="round" 
                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </div>
    <span
        :class="{'text-green-700': isEmail(formData.email), 
          'text-red-700': !isEmail(formData.email)}"
        class="font-medium text-sm ml-3"
        x-text="isEmail(formData.email) ? 
        'Email is valid' : 'Email is not valid!' "></span>
</li>