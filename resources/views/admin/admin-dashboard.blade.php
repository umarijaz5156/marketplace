<x-admin-layout>
    <!-- cards -->
    <x-AdminPanel.card-wrapper>
        <!-- row 1 -->
        <div class="flex flex-wrap -mx-3">
            <!-- card1 -->
            <x-AdminPanel.card title="Total Revenue" :value="'$' .number_format($totalRevenue->revenue, 2)" class="ni-paper-diploma" />

            <!-- card2 -->
            <x-AdminPanel.card title="Total Revenue This Month" :value="'$' . number_format($totalRevenueThisMonth->revenue, 2)" class="ni-money-coins" />

            <!-- card3 -->
            <x-AdminPanel.card title="Total Cancelled Orders" :value="$cancelledOrders" class="ni-money-coins" />

        </div>
    </x-AdminPanel.card-wrapper>

    <!-- cards row 3 -->
    <x-AdminPanel.card-wrapper >
        <div class="flex flex-wrap -mx-3">
            {{-- User chart --}}
            <livewire:admin.dashboard.user-chart />

            {{-- Sales Over View Chart --}}
            <livewire:admin.dashboard.sales-overview-chart />
        </div>
    </x-AdminPanel.card-wrapper >

    <x-AdminPanel.card-wrapper>
        <div class="flex flex-wrap -mx-3">
            {{-- <div class="w-full max-w-full px-3 xl:w-4/12">
                <div
                    class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <h6 class="mb-0">Platform Settings</h6>
                    </div>
                    <div class="flex-auto p-4">
                        <h6 class="font-bold leading-tight uppercase text-xs text-slate-500">Account</h6>
                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                            <li class="relative block px-0 py-2 bg-white border-0 rounded-t-lg text-inherit">
                                <div class="min-h-6 mb-0.5 block pl-0">
                                    <input id="follow"
                                        class="mt-0.54 rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                                        type="checkbox" checked="">
                                    <label for="follow"
                                        class="w-4/5 mb-0 ml-4 overflow-hidden font-normal cursor-pointer select-none text-sm text-ellipsis whitespace-nowrap text-slate-500">Email
                                        me when someone follows me</label>
                                </div>
                            </li>
                            <li class="relative block px-0 py-2 bg-white border-0 text-inherit">
                                <div class="min-h-6 mb-0.5 block pl-0">
                                    <input id="answer"
                                        class="mt-0.54 rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                                        type="checkbox">
                                    <label for="answer"
                                        class="w-4/5 mb-0 ml-4 overflow-hidden font-normal cursor-pointer select-none text-sm text-ellipsis whitespace-nowrap text-slate-500">Email
                                        me when someone answers on my post</label>
                                </div>
                            </li>
                            <li class="relative block px-0 py-2 bg-white border-0 rounded-b-lg text-inherit">
                                <div class="min-h-6 mb-0.5 block pl-0">
                                    <input id="mention"
                                        class="mt-0.54 rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                                        type="checkbox" checked="">
                                    <label for="mention"
                                        class="w-4/5 mb-0 ml-4 overflow-hidden font-normal cursor-pointer select-none text-sm text-ellipsis whitespace-nowrap text-slate-500">Email
                                        me when someone mentions me</label>
                                </div>
                            </li>
                        </ul>
                        <h6 class="mt-6 font-bold leading-tight uppercase text-xs text-slate-500">Application</h6>
                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                            <li class="relative block px-0 py-2 bg-white border-0 rounded-t-lg text-inherit">
                                <div class="min-h-6 mb-0.5 block pl-0">
                                    <input id="launches projects"
                                        class="mt-0.54 rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                                        type="checkbox">
                                    <label for="launches projects"
                                        class="w-4/5 mb-0 ml-4 overflow-hidden font-normal cursor-pointer select-none text-sm text-ellipsis whitespace-nowrap text-slate-500">New
                                        launches and projects</label>
                                </div>
                            </li>
                            <li class="relative block px-0 py-2 bg-white border-0 text-inherit">
                                <div class="min-h-6 mb-0.5 block pl-0">
                                    <input id="product updates"
                                        class="mt-0.54 rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                                        type="checkbox" checked="">
                                    <label for="product updates"
                                        class="w-4/5 mb-0 ml-4 overflow-hidden font-normal cursor-pointer select-none text-sm text-ellipsis whitespace-nowrap text-slate-500">Monthly
                                        product updates</label>
                                </div>
                            </li>
                            <li class="relative block px-0 py-2 pb-0 bg-white border-0 rounded-b-lg text-inherit">
                                <div class="min-h-6 mb-0.5 block pl-0">
                                    <input id="subscribe"
                                        class="mt-0.54 rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right"
                                        type="checkbox">
                                    <label for="subscribe"
                                        class="w-4/5 mb-0 ml-4 overflow-hidden font-normal cursor-pointer select-none text-sm text-ellipsis whitespace-nowrap text-slate-500">Subscribe
                                        to newsletter</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="w-full max-w-full px-3 lg-max:mt-6 xl:w-4/12">
                <div
                    class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                        <div class="flex flex-wrap -mx-3">
                            <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                                <h6 class="mb-0">Profile Information</h6>
                            </div>
                            <div class="w-full max-w-full px-3 text-right shrink-0 md:w-4/12 md:flex-none">
                                <a href="javascript:;" data-target="tooltip_trigger" data-placement="top">
                                    <i class="leading-normal fas fa-user-edit text-sm text-slate-400"
                                        aria-hidden="true"></i>
                                </a>
                                <div data-target="tooltip"
                                    class="hidden px-2 py-1 text-center text-white bg-black rounded-lg text-sm"
                                    role="tooltip" data-popper-placement="bottom"
                                    style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(1321px, 445px);"
                                    data-popper-reference-hidden="" data-popper-escaped="">
                                    Edit Profile
                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                        data-popper-arrow=""
                                        style="position: absolute; left: 0px; transform: translate(0px, 0px);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto p-4">
                        <p class="leading-normal text-sm">Hi, I’m Alec Thompson, Decisions: If you can’t decide, the
                            answer is no. If two equally difficult paths, choose the one more painful in the short
                            term (pain avoidance is creating an illusion of equality).</p>
                        <hr
                            class="h-px my-6 bg-transparent bg-gradient-to-r from-transparent via-white to-transparent">
                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                            <li
                                class="relative block px-4 py-2 pt-0 pl-0 leading-normal bg-white border-0 rounded-t-lg text-sm text-inherit">
                                <strong class="text-slate-700">Full Name:</strong> &nbsp; Alec M. Thompson</li>
                            <li
                                class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                                <strong class="text-slate-700">Mobile:</strong> &nbsp; (44) 123 1234 123</li>
                            <li
                                class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                                <strong class="text-slate-700">Email:</strong> &nbsp; alecthompson@mail.com</li>
                            <li
                                class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit">
                                <strong class="text-slate-700">Location:</strong> &nbsp; USA</li>
                            <li
                                class="relative block px-4 py-2 pb-0 pl-0 bg-white border-0 border-t-0 rounded-b-lg text-inherit">
                                <strong class="leading-normal text-sm text-slate-700">Social:</strong> &nbsp;
                                <a class="inline-block py-0 pl-1 pr-2 mb-0 font-bold text-center text-blue-800 align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-none"
                                    href="javascript:;">
                                    <i class="fab fa-facebook fa-lg" aria-hidden="true"></i>
                                </a>
                                <a class="inline-block py-0 pl-1 pr-2 mb-0 font-bold text-center align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-none text-sky-600"
                                    href="javascript:;">
                                    <i class="fab fa-twitter fa-lg" aria-hidden="true"></i>
                                </a>
                                <a class="inline-block py-0 pl-1 pr-2 mb-0 font-bold text-center align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-none text-sky-900"
                                    href="javascript:;">
                                    <i class="fab fa-instagram fa-lg" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> --}}

            {{-- Top gigs by most orders --}}
            <livewire:admin.dashboard.top-gigs />

            {{-- Top sellers having most orders --}}
            <livewire:admin.dashboard.top-sellers />

        </div>
    </x-AdminPanel.card-wrapper>

    {{-- <x-AdminPanel.card-wrapper>

        <!-- cards row 2 -->
        <div class="flex flex-wrap mt-6 -mx-3">
            <div class="w-full px-3 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
                <div
                    class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap -mx-3">
                            <div class="max-w-full px-3 lg:w-1/2 lg:flex-none">
                                <div class="flex flex-col h-full">
                                    <p class="pt-2 mb-1 font-semibold">Built by developers</p>
                                    <h5 class="font-bold">Soft UI Dashboard</h5>
                                    <p class="mb-12">From colors, cards, typography to complex elements, you will find
                                        the full documentation.</p>
                                    <a class="mt-auto mb-0 font-semibold leading-normal text-sm group text-slate-500"
                                        href="javascript:;">
                                        Read More
                                        <i
                                            class="fas fa-arrow-right ease-bounce text-sm group-hover:translate-x-1.25 ml-1 leading-normal transition-all duration-200"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="max-w-full px-3 mt-12 ml-auto text-center lg:mt-0 lg:w-5/12 lg:flex-none">
                                <div class="h-full bg-gradient-to-tl from-purple-700 to-pink-500 rounded-xl">
                                    <img src="/soft-ui/assets/img/shapes/waves-white.svg"
                                        class="absolute top-0 hidden w-1/2 h-full lg:block" alt="waves" />
                                    <div class="relative flex items-center justify-center h-full">
                                        <img class="relative z-20 w-full pt-6"
                                            src="/soft-ui/assets/img/illustrations/rocket-white.png" alt="rocket" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
                <div
                    class="border-black/12.5 shadow-soft-xl relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border p-4">
                    <div class="relative h-full overflow-hidden bg-cover rounded-xl"
                        style="background-image: url('/soft-ui/assets/img/ivancik.jpg')">
                        <span
                            class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80"></span>
                        <div class="relative z-10 flex flex-col flex-auto h-full p-4">
                            <h5 class="pt-2 mb-6 font-bold text-white">Work with the rockets</h5>
                            <p class="text-white">Wealth creation is an evolutionarily recent positive-sum game. It is
                                all about who take the opportunity first.</p>
                            <a class="mt-auto mb-0 font-semibold leading-normal text-white group text-sm"
                                href="javascript:;">
                                Read More
                                <i
                                    class="fas fa-arrow-right ease-bounce text-sm group-hover:translate-x-1.25 ml-1 leading-normal transition-all duration-200"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- cards row 4 -->

        <div class="flex flex-wrap my-6 -mx-3">
            <!-- card 1 -->
            <div class="w-full max-w-full px-3 mt-0 mb-6 md:mb-0 md:w-1/2 md:flex-none lg:w-2/3 lg:flex-none">
                <div
                    class="border-black/12.5 shadow-soft-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                        <div class="flex flex-wrap mt-0 -mx-3">
                            <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                                <h6>Projects</h6>
                                <p class="mb-0 leading-normal text-sm">
                                    <i class="fa fa-check text-cyan-500"></i>
                                    <span class="ml-1 font-semibold">30 done</span>
                                    this month
                                </p>
                            </div>
                            <div class="flex-none w-5/12 max-w-full px-3 my-auto text-right lg:w-1/2 lg:flex-none">
                                <div class="relative pr-6 lg:float-right">
                                    <a dropdown-trigger class="cursor-pointer" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-slate-400"></i>
                                    </a>
                                    <p class="hidden transform-dropdown-show"></p>

                                    <ul dropdown-menu
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
                                            Companies</th>
                                        <th
                                            class="px-6 py-3 pl-2 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Members</th>
                                        <th
                                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Budget</th>
                                        <th
                                            class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">
                                            Completion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="flex px-2 py-1">
                                                <div>
                                                    <img src="/soft-ui/assets/img/small-logos/logo-xd.svg"
                                                        class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                                        alt="xd" />
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 leading-normal text-sm">Soft UI XD Version</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="mt-2 avatar-group">
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-1.jpg"
                                                        class="w-full rounded-full" alt="team1" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Ryan Tompson
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-2.jpg"
                                                        class="w-full rounded-full" alt="team2" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Romina Hadid
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-3.jpg"
                                                        class="w-full rounded-full" alt="team3" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Alexander Smith
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-4.jpg"
                                                        class="w-full rounded-full" alt="team4" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Jessica Doe
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap">
                                            <span class="font-semibold leading-tight text-xs"> $14,000 </span>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="w-3/4 mx-auto">
                                                <div>
                                                    <div>
                                                        <span class="font-semibold leading-tight text-xs">60%</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="text-xs h-0.75 w-30 m-0 flex overflow-visible rounded-lg bg-gray-200">
                                                    <div class="duration-600 ease-soft bg-gradient-to-tl from-blue-600 to-cyan-400 -mt-0.38 -ml-px flex h-1.5 w-3/5 flex-col justify-center overflow-hidden whitespace-nowrap rounded bg-fuchsia-500 text-center text-white transition-all"
                                                        role="progressbar" aria-valuenow="60" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="flex px-2 py-1">
                                                <div>
                                                    <img src="/soft-ui/assets/img/small-logos/logo-atlassian.svg"
                                                        class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                                        alt="atlassian" />
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 leading-normal text-sm">Add Progress Track</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="mt-2 avatar-group">
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-2.jpg"
                                                        class="w-full rounded-full" alt="team5" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Romina Hadid
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-4.jpg"
                                                        class="w-full rounded-full" alt="team6" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Jessica Doe
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap">
                                            <span class="font-semibold leading-tight text-xs"> $3,000 </span>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="w-3/4 mx-auto">
                                                <div>
                                                    <div>
                                                        <span class="font-semibold leading-tight text-xs">10%</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="text-xs h-0.75 w-30 m-0 flex overflow-visible rounded-lg bg-gray-200">
                                                    <div class="duration-600 ease-soft bg-gradient-to-tl from-blue-600 to-cyan-400 -mt-0.38 w-1/10 -ml-px flex h-1.5 flex-col justify-center overflow-hidden whitespace-nowrap rounded bg-fuchsia-500 text-center text-white transition-all"
                                                        role="progressbar" aria-valuenow="10" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="flex px-2 py-1">
                                                <div>
                                                    <img src="/soft-ui/assets/img/small-logos/logo-slack.svg"
                                                        class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                                        alt="team7" />
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 leading-normal text-sm">Fix Platform Errors</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="mt-2 avatar-group">
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-3.jpg"
                                                        class="w-full rounded-full" alt="team8" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Romina Hadid
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-1.jpg"
                                                        class="w-full rounded-full" alt="team9" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Jessica Doe
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap">
                                            <span class="font-semibold leading-tight text-xs"> Not set </span>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="w-3/4 mx-auto">
                                                <div>
                                                    <div>
                                                        <span class="font-semibold leading-tight text-xs">100%</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="text-xs h-0.75 w-30 m-0 flex overflow-visible rounded-lg bg-gray-200">
                                                    <div class="duration-600 ease-soft bg-gradient-to-tl from-green-600 to-lime-400 -mt-0.38 -ml-px flex h-1.5 w-full flex-col justify-center overflow-hidden whitespace-nowrap rounded bg-fuchsia-500 text-center text-white transition-all"
                                                        role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="flex px-2 py-1">
                                                <div>
                                                    <img src="/soft-ui/assets/img/small-logos/logo-spotify.svg"
                                                        class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                                        alt="spotify" />
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 leading-normal text-sm">Launch our Mobile App</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="mt-2 avatar-group">
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-4.jpg"
                                                        class="w-full rounded-full" alt="user1" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Ryan Tompson
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-3.jpg"
                                                        class="w-full rounded-full" alt="user2" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Romina Hadid
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-4.jpg"
                                                        class="w-full rounded-full" alt="user3" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Alexander Smith
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-1.jpg"
                                                        class="w-full rounded-full" alt="user4" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Jessica Doe
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap">
                                            <span class="font-semibold leading-tight text-xs"> $20,500 </span>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="w-3/4 mx-auto">
                                                <div>
                                                    <div>
                                                        <span class="font-semibold leading-tight text-xs">100%</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="text-xs h-0.75 w-30 m-0 flex overflow-visible rounded-lg bg-gray-200">
                                                    <div class="duration-600 ease-soft bg-gradient-to-tl from-green-600 to-lime-400 -mt-0.38 -ml-px flex h-1.5 w-full flex-col justify-center overflow-hidden whitespace-nowrap rounded bg-fuchsia-500 text-center text-white transition-all"
                                                        role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="flex px-2 py-1">
                                                <div>
                                                    <img src="/soft-ui/assets/img/small-logos/logo-jira.svg"
                                                        class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                                        alt="jira" />
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 leading-normal text-sm">Add the New Pricing Page
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="mt-2 avatar-group">
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-4.jpg"
                                                        class="w-full rounded-full" alt="user5" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Ryan Tompson
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap">
                                            <span class="font-semibold leading-tight text-xs"> $500 </span>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                            <div class="w-3/4 mx-auto">
                                                <div>
                                                    <div>
                                                        <span class="font-semibold leading-tight text-xs">25%</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="text-xs h-0.75 w-30 m-0 flex overflow-visible rounded-lg bg-gray-200">
                                                    <div class="duration-600 ease-soft bg-gradient-to-tl from-blue-600 to-cyan-400 -mt-0.38 -ml-px flex h-1.5 w-1/4 flex-col justify-center overflow-hidden whitespace-nowrap rounded bg-fuchsia-500 text-center text-white transition-all"
                                                        role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="25"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-0 whitespace-nowrap">
                                            <div class="flex px-2 py-1">
                                                <div>
                                                    <img src="/soft-ui/assets/img/small-logos/logo-invision.svg"
                                                        class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl"
                                                        alt="invision" />
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 leading-normal text-sm">Redesign New Online Shop
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-0 whitespace-nowrap">
                                            <div class="mt-2 avatar-group">
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-1.jpg"
                                                        class="w-full rounded-full" alt="user6" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Ryan Tompson
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                                <a href="javascript:;"
                                                    class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid rounded-full ease-soft-in-out text-xs hover:z-30"
                                                    data-target="tooltip_trigger" data-placement="bottom">
                                                    <img src="/soft-ui/assets/img/team-4.jpg"
                                                        class="w-full rounded-full" alt="user7" />
                                                </a>
                                                <div data-target="tooltip"
                                                    class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm"
                                                    role="tooltip">
                                                    Jessica Doe
                                                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']"
                                                        data-popper-arrow></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent border-0 text-sm whitespace-nowrap">
                                            <span class="font-semibold leading-tight text-xs"> $2,000 </span>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-0 whitespace-nowrap">
                                            <div class="w-3/4 mx-auto">
                                                <div>
                                                    <div>
                                                        <span class="font-semibold leading-tight text-xs">40%</span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="text-xs h-0.75 w-30 m-0 flex overflow-visible rounded-lg bg-gray-200">
                                                    <div class="duration-600 ease-soft bg-gradient-to-tl from-blue-600 to-cyan-400 -mt-0.38 -ml-px flex h-1.5 w-2/5 flex-col justify-center overflow-hidden whitespace-nowrap rounded bg-fuchsia-500 text-center text-white transition-all"
                                                        role="progressbar" aria-valuenow="40" aria-valuemin="0"
                                                        aria-valuemax="40"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- card 2 -->

            <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none lg:w-1/3 lg:flex-none">
                <div
                    class="border-black/12.5 shadow-soft-xl relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                        <h6>Orders overview</h6>
                        <p class="leading-normal text-sm">
                            <i class="fa fa-arrow-up text-lime-500"></i>
                            <span class="font-semibold">24%</span> this month
                        </p>
                    </div>
                    <div class="flex-auto p-4">
                        <div
                            class="before:border-r-solid relative before:absolute before:top-0 before:left-4 before:h-full before:border-r-2 before:border-r-slate-100 before:content-[''] before:lg:-ml-px">
                            <div class="relative mb-4 mt-0 after:clear-both after:table after:content-['']">
                                <span
                                    class="w-6.5 h-6.5 text-base absolute left-4 z-10 inline-flex -translate-x-1/2 items-center justify-center rounded-full bg-white text-center font-semibold">
                                    <i
                                        class="relative z-10 text-transparent ni leading-none ni-bell-55 leading-pro bg-gradient-to-tl from-green-600 to-lime-400 bg-clip-text fill-transparent"></i>
                                </span>
                                <div class="ml-11.252 pt-1.4 lg:max-w-120 relative -top-1.5 w-auto">
                                    <h6 class="mb-0 font-semibold leading-normal text-sm text-slate-700">$2400, Design
                                        changes</h6>
                                    <p class="mt-1 mb-0 font-semibold leading-tight text-xs text-slate-400">22 DEC 7:20
                                        PM</p>
                                </div>
                            </div>
                            <div class="relative mb-4 after:clear-both after:table after:content-['']">
                                <span
                                    class="w-6.5 h-6.5 text-base absolute left-4 z-10 inline-flex -translate-x-1/2 items-center justify-center rounded-full bg-white text-center font-semibold">
                                    <i
                                        class="relative z-10 text-transparent ni leading-none ni-html5 leading-pro bg-gradient-to-tl from-red-600 to-rose-400 bg-clip-text fill-transparent"></i>
                                </span>
                                <div class="ml-11.252 pt-1.4 lg:max-w-120 relative -top-1.5 w-auto">
                                    <h6 class="mb-0 font-semibold leading-normal text-sm text-slate-700">New order
                                        #1832412</h6>
                                    <p class="mt-1 mb-0 font-semibold leading-tight text-xs text-slate-400">21 DEC 11
                                        PM</p>
                                </div>
                            </div>
                            <div class="relative mb-4 after:clear-both after:table after:content-['']">
                                <span
                                    class="w-6.5 h-6.5 text-base absolute left-4 z-10 inline-flex -translate-x-1/2 items-center justify-center rounded-full bg-white text-center font-semibold">
                                    <i
                                        class="relative z-10 text-transparent ni leading-none ni-cart leading-pro bg-gradient-to-tl from-blue-600 to-cyan-400 bg-clip-text fill-transparent"></i>
                                </span>
                                <div class="ml-11.252 pt-1.4 lg:max-w-120 relative -top-1.5 w-auto">
                                    <h6 class="mb-0 font-semibold leading-normal text-sm text-slate-700">Server
                                        payments for April</h6>
                                    <p class="mt-1 mb-0 font-semibold leading-tight text-xs text-slate-400">21 DEC 9:34
                                        PM</p>
                                </div>
                            </div>
                            <div class="relative mb-4 after:clear-both after:table after:content-['']">
                                <span
                                    class="w-6.5 h-6.5 text-base absolute left-4 z-10 inline-flex -translate-x-1/2 items-center justify-center rounded-full bg-white text-center font-semibold">
                                    <i
                                        class="relative z-10 text-transparent ni leading-none ni-credit-card leading-pro bg-gradient-to-tl from-red-500 to-yellow-400 bg-clip-text fill-transparent"></i>
                                </span>
                                <div class="ml-11.252 pt-1.4 lg:max-w-120 relative -top-1.5 w-auto">
                                    <h6 class="mb-0 font-semibold leading-normal text-sm text-slate-700">New card added
                                        for order #4395133</h6>
                                    <p class="mt-1 mb-0 font-semibold leading-tight text-xs text-slate-400">20 DEC 2:20
                                        AM</p>
                                </div>
                            </div>
                            <div class="relative mb-4 after:clear-both after:table after:content-['']">
                                <span
                                    class="w-6.5 h-6.5 text-base absolute left-4 z-10 inline-flex -translate-x-1/2 items-center justify-center rounded-full bg-white text-center font-semibold">
                                    <i
                                        class="relative z-10 text-transparent ni leading-none ni-key-25 leading-pro bg-gradient-to-tl from-purple-700 to-pink-500 bg-clip-text fill-transparent"></i>
                                </span>
                                <div class="ml-11.252 pt-1.4 lg:max-w-120 relative -top-1.5 w-auto">
                                    <h6 class="mb-0 font-semibold leading-normal text-sm text-slate-700">Unlock
                                        packages for development</h6>
                                    <p class="mt-1 mb-0 font-semibold leading-tight text-xs text-slate-400">18 DEC 4:54
                                        AM</p>
                                </div>
                            </div>
                            <div class="relative mb-0 after:clear-both after:table after:content-['']">
                                <span
                                    class="w-6.5 h-6.5 text-base absolute left-4 z-10 inline-flex -translate-x-1/2 items-center justify-center rounded-full bg-white text-center font-semibold">
                                    <i
                                        class="relative z-10 text-transparent ni leading-none ni-money-coins leading-pro bg-gradient-to-tl from-gray-900 to-slate-800 bg-clip-text fill-transparent"></i>
                                </span>
                                <div class="ml-11.252 pt-1.4 lg:max-w-120 relative -top-1.5 w-auto">
                                    <h6 class="mb-0 font-semibold leading-normal text-sm text-slate-700">New order
                                        #9583120</h6>
                                    <p class="mt-1 mb-0 font-semibold leading-tight text-xs text-slate-400">17 DEC</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="pt-4">
            <div class="w-full px-6 mx-auto">
                <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
                    <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                        <div class="leading-normal text-center text-sm text-slate-500 lg:text-left">
                            ©
                            <script>
                                document.write(new Date().getFullYear() + ",");
                            </script>
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://www.creative-tim.com" class="font-semibold text-slate-700"
                                target="_blank">Creative Tim</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="w-full max-w-full px-3 mt-0 shrink-0 lg:w-1/2 lg:flex-none">
                        <ul class="flex flex-wrap justify-center pl-0 mb-0 list-none lg:justify-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com"
                                    class="block px-4 pt-0 pb-1 font-normal transition-colors ease-soft-in-out text-sm text-slate-500"
                                    target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation"
                                    class="block px-4 pt-0 pb-1 font-normal transition-colors ease-soft-in-out text-sm text-slate-500"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://creative-tim.com/blog"
                                    class="block px-4 pt-0 pb-1 font-normal transition-colors ease-soft-in-out text-sm text-slate-500"
                                    target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license"
                                    class="block px-4 pt-0 pb-1 pr-0 font-normal transition-colors ease-soft-in-out text-sm text-slate-500"
                                    target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </x-AdminPanel.card-wrapper> --}}
    <!-- end cards -->

</x-admin-layout>
