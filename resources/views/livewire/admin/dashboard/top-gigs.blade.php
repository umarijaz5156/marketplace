
<div class="w-full max-w-full mb-6 px-3 md:mb-0 md:w-1/2 md:flex-none lg:w-2/3 lg:flex-none">
    <div
        class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
        <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
            <div class="flex flex-wrap mt-0 -mx-3">
                <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                    <h6>Top Selling Services</h6>
                    {{-- <p class="mb-0 leading-normal text-sm">
                        <i class="fa fa-check text-cyan-500" aria-hidden="true"></i>
                        <span class="ml-1 font-semibold">30 done</span>
                        this month
                    </p> --}}
                </div>
                <div class="flex-none w-5/12 max-w-full px-3 my-auto text-right lg:w-1/2 lg:flex-none">
                    <div class="relative pr-6 lg:float-right">
                        <a dropdown-trigger="" class="cursor-pointer" aria-expanded="false">
                            <i class="fa fa-ellipsis-v text-slate-400" aria-hidden="true"></i>
                        </a>
                        <p class="hidden transform-dropdown-show"></p>
                        <ul dropdown-menu=""
                            class="z-100 text-sm transform-dropdown shadow-soft-3xl duration-250 before:duration-350 before:font-awesome before:ease-soft min-w-44 -ml-34 before:text-5.5 pointer-events-none absolute top-0 m-0 mt-2 list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:top-0 before:right-7 before:left-auto before:z-40 before:text-white before:transition-all before:content-['\f0d8']">
                            <li class="relative">
                                <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300"
                                    href="javascript:;">Action</a>
                            </li>
                            <li class="relative">
                                <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300"
                                    href="javascript:;">Another action</a>
                            </li>
                            <li class="relative">
                                <a class="py-1.2 lg:ease-soft clear-both block w-full whitespace-nowrap rounded-lg border-0 bg-transparent px-4 text-left font-normal text-slate-500 lg:transition-colors lg:duration-300"
                                    href="javascript:;">Something else here</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-auto p-6 px-0 pb-2">
            <div class="overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th
                                class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                Services</th>
                            <th
                                class="px-6 py-3 pl-2 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                Revenue</th>
                            <th
                                class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                Completed Orders</th>
                            <th
                                class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                Refunded Orders</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gigs as $gig)
                        <tr>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                <div class="flex px-2 py-1">
                                    <div>
                                        <img src="{{ asset('gigs/images/' . $gig->image_path) }}"
                                            class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                            alt="xd">
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <a href="{{ route('gig_details', ['slug' => $gig->slug]) }}">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $gig->title }}</h6>
                                        </a>
                                        <p class="mb-0 leading-normal text-sm">
                                            {{-- <i class="fa fa-check text-cyan-500" aria-hidden="true"></i> --}}
                                            <span class="ml-1 text-cyan-500 font-semibold">{{ number_format($gig->order_count) }}</span>
                                            orders
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                ${{ $gig->revenue }}
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                <div class="w-3/4 mx-auto">
                                    <div>
                                        <div>
                                            <span class="font-semibold leading-tight text-xs">{{ $gig->percent }}%</span>
                                        </div>
                                    </div>
                                    <div class="text-xs h-0.75 w-30 m-0 flex overflow-visible rounded-lg bg-gray-200">
                                        <div class="duration-600 ease-soft bg-gradient-to-tl from-blue-600 to-cyan-400 -mt-0.38 -ml-px flex h-1.5 w-[{{ $gig->percent }}%] flex-col justify-center overflow-hidden whitespace-nowrap rounded bg-fuchsia-500 text-center text-white transition-all"
                                            role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </td>
                            <td
                            class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap">
                            <span class="font-semibold leading-tight text-xs"> {{ $gig->refund }} </span>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
