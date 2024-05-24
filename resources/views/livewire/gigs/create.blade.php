<div class="md:p-10 md:m-10">

    @if (session('message'))
    @if (session('message.type')=="success")
    <div class="bg-green-100 border border-green-400 mb-5 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">Service saved successfully.</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <title>Close</title>
                <path
                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </span>
    </div>
    @else
    <div class="bg-red-100 border border-red-400 mb-5 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Warning!</strong>
        <span class="block sm:inline">{{ session('message.message') }}.</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <title>Close</title>
                <path
                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </span>
    </div>
    @endif
    @endif
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 mb-5 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Errors!</strong>
        <span class="block sm:inline">Check the form for more details.</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <title>Close</title>
                <path
                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </span>
    </div>
    @endif
    <div class="container lg:w-[85%] xl:max-w-[1450px] w-full mx-auto px-4">
        <!-- Progress bar -->
        <div class="max-w-[400px] mx-auto w-[75%] sm:w-[95%]">
            <div class="progressbar">
                <div class="progress" id="progress"></div>
                <div class="progress-step  {{$currentStep > 0 ? 'progress-step-active ' : ''}} w-12 h-12 bg-white border border-[#DFE2EC] rounded-full flex justify-center items-center"
                    data-title="Overview" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;"></div>
                <div class="progress-step {{$currentStep > 1 ? 'progress-step-active ' : ''}} w-12 h-12 bg-white border border-[#DFE2EC] rounded-full flex justify-center items-center"
                    data-title="Pricing" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;"></div>
                <div class="progress-step {{$currentStep >2 ? 'progress-step-active ' : ''}}  w-12 h-12 bg-white border border-[#DFE2EC] rounded-full flex justify-center items-center"
                    data-title="Description" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;"></div>
            </div>
        </div>
        <form wire:submit.prevent="submit()" method="POST">
            @csrf
            <livewire:forms.gig-create :gig="$gig" :access="$access" />
        </form>
    </div>
</div>



