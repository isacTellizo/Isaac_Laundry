<div class="w-full h-full p-4 bg-white !rounded-xl shadow-sm">
    <div class="card">
        <div class="flex flex-col justify-between gap-3">
            <div class="">
                <div class="card-body flex flex-col gap-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <input type="text"
                                class="p-2.5 !rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-100 placeholder:text-sm placeholder-gray-500"
                                placeholder="Search products...">
                            <button class="bg-gray-100 hover:bg-gray-300 p-2 !rounded-md text-blue-600 shadow-sm transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                    viewBox="0 0 24 24">
                                    <g fill="none">
                                        <path
                                            d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                        <path fill="currentColor"
                                            d="M16 14a5 5 0 0 1 5 5v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1a5 5 0 0 1 5-5zm4-6a1 1 0 0 1 1 1v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 1 1 0-2h1V9a1 1 0 0 1 1-1m-8-6a5 5 0 1 1 0 10a5 5 0 0 1 0-10" />
                                    </g>
                                </svg>
                            </button>
                        </div>
                        <div class="flex items-center gap-3">
                            <button class="bg-gray-200 hover:bg-gray-300 px-3 py-1.5 !rounded-md text-sm font-medium">Clear</button>
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 !rounded-md text-sm font-semibold focus:ring-2 focus:ring-blue-200">Save</button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <input type="text"
                                class="p-2.5 !rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-100 placeholder:text-sm"
                                placeholder="#Invoice No.">
                            <input type="date"
                                class="p-2.5 !rounded-md border border-gray-300 text-gray-500 focus:outline-none">
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <button class="bg-gray-100  px-3 py-1 !rounded-md">3</button>
                            <button class="bg-gray-100  px-3 py-1 !rounded-md">2025-10-14</button>
                        </div>
                    </div>

                    <div class="mt-1">
                        <input type="text"
                            class="p-2.5 !rounded-md border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-blue-100 placeholder:text-sm"
                            placeholder="Customer Name / Code">
                    </div>
                </div>

                <div class="card-body px-3 pb-2 pt-0">
                    <div class="overflow-y-auto h-48 border !rounded-lg">
                        <table class="w-full table-auto border-collapse text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-2 text-left">#</th>
                                    <th class="p-2 text-left">Name</th>
                                    <th class="p-2">Qty</th>
                                    <th class="p-2">Rate</th>
                                    <th class="p-2 text-center">Discount</th>
                                    <th class="p-2 text-center">Tax</th>
                                    <th class="p-2 text-center">Total</th>
                                    <th class="p-2 text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t">
                                    <td class="p-2"></td>
                                    <td class="p-2"></td>
                                    <td class="p-2"><input type="number"
                                            class="w-full text-center p-1 border !rounded-md border-gray-300 focus:ring focus:ring-blue-100"></td>
                                    <td class="p-2"><input type="number"
                                            class="w-full text-center p-1 border !rounded-md border-gray-300 focus:ring focus:ring-blue-100"></td>
                                    <td class="p-2"><input type="number"
                                            class="w-full text-center p-1 border !rounded-md border-gray-300 focus:ring focus:ring-blue-100"></td>
                                    <td class="text-center"></td>
                                    <td class="p-2"><input type="number"
                                            class="w-full text-center p-1 border !rounded-md border-gray-300 focus:ring focus:ring-blue-100"></td>
                                    <td class="text-center">
                                        <button class="bg-red-100 hover:bg-red-300 p-2 !rounded-full text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M7.616 20q-.672 0-1.144-.472T6 18.385V6H5V5h4v-.77h6V5h4v1h-1v12.385q0 .69-.462 1.153T16.384 20zM17 6H7v12.385q0 .269.173.442t.443.173h8.769q.23 0 .423-.192t.192-.424zM9.808 17h1V8h-1zm3.384 0h1V8h-1zM7 6v13z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="flex justify-between mt-12">
                <div class="flex flex-col gap-4 w-[60%] p-2">
                    <div class="flex items-center gap-4">
                        <div class="flex flex-col gap-1 w-1/2">
                            <label class="text-sm font-semibold">Paid Amount <span class="text-red-500">*</span></label>
                            <input type="text"
                                class="p-2 !rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                placeholder="Amount">
                        </div>
                        <div class="flex flex-col gap-1 w-1/2">
                            <label class="text-sm font-semibold">Payment Method <span class="text-red-500">*</span></label>
                            <select
                                class="p-2 !rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-100">
                                <option value="">Select Method</option>
                                <option value="1">Cash</option>
                                <option value="2">Card</option>
                                <option value="3">UPI</option>
                                <option value="4">Cheque</option>
                                <option value="5">Bank Transfer</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex flex-col gap-1 w-1/2">
                            <label class="text-sm font-semibold">Note/Remark</label>
                            <textarea
                                class="px-3 py-2 !rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-100 resize-none"
                                placeholder="Write a note..."></textarea>
                        </div>
                        <div class="flex flex-col gap-1 w-1/2">
                            <label class="text-sm font-semibold">Payment Remark</label>
                            <textarea
                                class="px-3 py-2 !rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-100 resize-none"
                                placeholder="Add any payment remarks"></textarea>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-2 px-5 w-[35%]">
                    <div class="flex justify-between text-sm">
                        <span>Sub Total</span>
                        <span>$499.99</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Discount</span>
                        <span>$59.99</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Taxable Amount</span>
                        <span>$440.00</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Tax Amount</span>
                        <span>$59.99</span>
                    </div>
                    <div class="flex justify-between text-base font-semibold mt-3">
                        <span>Gross Total</span>
                        <span>$499.99</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
