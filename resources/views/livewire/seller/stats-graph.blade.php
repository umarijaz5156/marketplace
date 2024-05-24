<div class="w-full max-w-full px-3 mt-0 lg:w-8/12 lg:flex-none">
  <div class="">
    <div class="border-black/12.5 drk:bg-slate-850 drk:shadow-drk-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
      <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0 flex justify-between items-center">
        <h6 class="capitalize drk:text-white text-[1.25rem]">Statists</h6>
        {{-- <a href="#" class="border border-[#3858D6] px-8 py-[0.6rem] rounded-full" style="box-shadow: rgb(56 88 214 / 20%) 0px 7px 29px 0px;">
          Sales
        </a> --}}
        <select wire:model="year" id="statuses" class="w-[158px] bg-white border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block p-[12px]  drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">

          @foreach ($filters as $filter)
              <option value="{{$filter}}">{{$filter}}</option>
          @endforeach
      </select>
      </div>
      <div class="flex-auto p-4">
        <div>
          <canvas id="chart-line" height="600" width="1736" class="h-[300px] lg:h-[360px]" style="display: block; box-sizing: border-box; width: 868px;"></canvas>

        </div>
      </div>
    </div>
  </div>

  <x-jet-dialog-modal wire:model="stripeModal">
  <x-slot name="title">
      Connect to Stripe
  </x-slot>

  <x-slot name="content">
      <p></p>
              <button wire:click="toggleModal" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white" >
                  <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                  <span class="sr-only">Close modal</span>
              </button>
              <div class="p-6 text-center">
                <form method="Post" action="{{ route('stripe.redirect', ['seller' => auth()->user()->seller]) }}">
                  @csrf

                  <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Kindly connect to stripe in order to receive funds in your account!</h3>
                  <button  type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                      Connect
                  </button>

                  <button wire:click="toggleModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">Cancel</button>

                </form>
                </div>
  </x-slot>


  <x-slot name="footer">
      {{-- <button type="button" wire:click="acceptOrder" class="focus:outline-none text-white bg-red-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Decline</button> --}}

  </x-slot>

</x-jet-dialog-modal>

  @push('scripts')
  @once
   <script>
    if(document.querySelector("#chart-line")){

        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        var chart = new Chart(ctx1, {
            type: "line",
            data: {
            labels: ['Jan' , 'Feb' , 'Mar' , 'Apr' , 'May' , 'June' , 'July' , 'Aug' , 'Sept' , 'Oct' , 'Nov', 'Dec'],
            datasets: [{
                label: "Sale",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#5e72e4",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: {{Js::From($currentYearOrders)}},
                maxBarThickness: 6

            }],
            },
            options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    padding: 10,
                    color: '#fbfbfb',
                    font: {
                    size: 11,
                    family: "Open Sans",
                    style: 'normal',
                    lineHeight: 2
                    },
                }
                },
                x: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    color: '#ccc',
                    padding: 20,
                    font: {
                    size: 11,
                    family: "Open Sans",
                    style: 'normal',
                    lineHeight: 2
                    },
                }
                },
            },
            },
        });
        }
         Livewire.on('updateChart' , data => {
             chart.data = data;
             chart.update();
         });
</script>
@endonce
  @endpush
</div>


