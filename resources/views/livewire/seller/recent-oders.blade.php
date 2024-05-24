<div class="mt-12">
    <h4 class="font-[600] text-xl">Recent Orders</h4>
    <div class="">
        <ul class="scroll-custom scroll-smooth  m-[2rem_0_2.5rem] bg-white py-[0.375rem] px-4 rounded-full flex text-sm font-medium text-center overflow-x-scroll" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-2 flex justify-center items-center w-full" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 text-[15px]" id="All-tab" data-tabs-target="#All" type="button" role="tab" aria-controls="All" aria-selected="false">All</button>
            </li>
            <li class="mr-2 flex justify-center items-center w-full" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 text-[15px] border-transparent hover:text-gray-600 hover:border-gray-300 drk:hover:text-gray-300" id="Pending-tab" data-tabs-target="#Pending" type="button" role="tab" aria-controls="Pending" aria-selected="false">Pending</button>
            </li>
            <li class="mr-2 flex justify-center items-center w-full" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 text-[15px] border-transparent hover:text-gray-600 hover:border-gray-300 drk:hover:text-gray-300" id="In-Progress-tab" data-tabs-target="#In-Progress" type="button" role="tab" aria-controls="In-Progress" aria-selected="false">In Progress</button>
            </li>
            <li class="mr-2 flex justify-center items-center w-full" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 text-[15px] border-transparent hover:text-gray-600 hover:border-gray-300 drk:hover:text-gray-300" id="Complete-tab" data-tabs-target="#Complete" type="button" role="tab" aria-controls="Complete" aria-selected="false">Complete</button>
            </li>
            <li class="mr-2 flex justify-center items-center w-full" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 text-[15px] border-transparent hover:text-gray-600 hover:border-gray-300 drk:hover:text-gray-300" id="Open-tab" data-tabs-target="#Open" type="button" role="tab" aria-controls="Open" aria-selected="false">Open</button>
            </li>
            <li class="mr-2 flex justify-center items-center w-full" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 text-[15px] border-transparent hover:text-gray-600 hover:border-gray-300 drk:hover:text-gray-300" id="Failed-tab" data-tabs-target="#Failed" type="button" role="tab" aria-controls="Failed" aria-selected="false">Failed</button>
            </li>
            <li class="mr-2 flex justify-center items-center w-full" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 text-[15px] border-transparent hover:text-gray-600 hover:border-gray-300 drk:hover:text-gray-300" id="Declined-tab" data-tabs-target="#Declined" type="button" role="tab" aria-controls="Declined" aria-selected="false">Declined</button>
            </li>
            <li class="mr-2 flex justify-center items-center w-full" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 text-[15px] border-transparent hover:text-gray-600 hover:border-gray-300 drk:hover:text-gray-300" id="Backordered-tab" data-tabs-target="#Backordered" type="button" role="tab" aria-controls="Backordered" aria-selected="false">Backordered</button>
            </li>
            <li class="mr-2 flex justify-center items-center w-full" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 text-[15px] border-transparent hover:text-gray-600 hover:border-gray-300 drk:hover:text-gray-300" id="Canceled-tab" data-tabs-target="#Canceled" type="button" role="tab" aria-controls="Canceled" aria-selected="false">Canceled</button>
            </li>
            <li class="mr-2 flex justify-center items-center w-full" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 text-[15px] border-transparent hover:text-gray-600 hover:border-gray-300 drk:hover:text-gray-300" id="Awaiting-Call-tab" data-tabs-target="#Awaiting-Call" type="button" role="tab" aria-controls="Awaiting-Call" aria-selected="false">Awaiting Call</button>
            </li>
            <li class="mr-2 flex justify-center items-center w-full" role="presentation">
                <button class="inline-block p-4 rounded-t-lg border-b-2 text-[15px] border-transparent hover:text-gray-600 hover:border-gray-300 drk:hover:text-gray-300" id="Delivered-tab" data-tabs-target="#Delivered" type="button" role="tab" aria-controls="Delivered" aria-selected="false">Delivered</button>
            </li>
        </ul>
    </div>
    <div class="overflow-x-scroll">
        <div id="myTabContent">
            <div class="hidden rounded-lg drk:bg-gray-800 " id="All" role="tabpanel" aria-labelledby="All-tab">
                <table  class="table table-hover dt-responsive order__table dasboard-table" id="attachmentTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="hidden rounded-lg drk:bg-gray-800" id="Pending" role="tabpanel" aria-labelledby="Pending-tab">
                <table  class="table table-hover dt-responsive order__table dasboard-table" id="pendingTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="hidden rounded-lg drk:bg-gray-800" id="In-Progress" role="tabpanel" aria-labelledby="In-Progress-tab">
                <table  class="table table-hover dt-responsive order__table dasboard-table" id="InprogressTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="hidden rounded-lg drk:bg-gray-800" id="Complete" role="tabpanel" aria-labelledby="Complete-tab">
                <table  class="table table-hover dt-responsive order__table dasboard-table" id="CompleteTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="hidden rounded-lg drk:bg-gray-800" id="Open" role="tabpanel" aria-labelledby="Open-tab">
                <table  class="table table-hover dt-responsive order__table dasboard-table" id="openTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="hidden rounded-lg drk:bg-gray-800" id="Failed" role="tabpanel" aria-labelledby="Failed-tab">
                <table  class="table table-hover dt-responsive order__table dasboard-table" id="FailedTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="hidden rounded-lg drk:bg-gray-800" id="Declined" role="tabpanel" aria-labelledby="Declined-tab">
                <table  class="table table-hover dt-responsive order__table dasboard-table" id="declinedTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="hidden rounded-lg drk:bg-gray-800" id="Backordered" role="tabpanel" aria-labelledby="Backordered-tab">
                <table  class="table table-hover dt-responsive order__table dasboard-table" id="BackorderedTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="hidden rounded-lg drk:bg-gray-800" id="Canceled" role="tabpanel" aria-labelledby="Canceled-tab">
                <table  class="table table-hover dt-responsive order__table dasboard-table" id="CanceledTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="hidden rounded-lg drk:bg-gray-800" id="Awaiting-Call" role="tabpanel" aria-labelledby="Awaiting-Call-tab">
                <table  class="table table-hover dt-responsive order__table dasboard-table" id="AwaitingCallTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="hidden rounded-lg drk:bg-gray-800" id="Delivered" role="tabpanel" aria-labelledby="Delivered-tab">
                <table  class="table table-hover dt-responsive order__table dasboard-table" id="DeliveredTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                        <tr class="border-row" >
                          <td><a href="#">#1</a></td>
                          <td class="customers__info">Brooklyn Zoe</td>
                          <td>302 Snider Street,Rutland</td>
                          <td>
                            31 Jul 2022
                          </td>
                          <td>$64.00</td>
                          <td class="pending-table-orders" >
                            <div class="ping">Pending</div>
                          </td>
                          <td class="last-child">
                            <div class="gear-icon">
                              <img src="{{ asset('images/Layer 72.png') }}" alt="">
                            </div>
                          </td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
