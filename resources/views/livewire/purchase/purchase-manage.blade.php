<div class="w-full h-full p-4 bg-white !rounded-xl shadow-sm">
    <div class="card">
        <div class="flex flex-col justify-between gap-3">
            <div class="">
                <div class="card-body flex flex-col gap-4">
                    @error('selected_products')
                    <span class="text-red-500 text-sm">{{"At least one product selection is required."}}</span>
                    @enderror
                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-3">
                            <div class="flex flex-col gap-2 relative  ">
                                <input type="text" wire:model.live="supplier_query"
                                    class="p-2.5 !rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-100 placeholder:text-sm placeholder-gray-500"
                                    placeholder="@if (!$selected_supplier) Select Supplier @else {{ $selected_supplier->name }} @endif">
                                @if ($suppliers && count($suppliers) > 0)
                                <div
                                    class="absolute top-[100%] left-0 w-full z-20 shadow-md bg-white rounded-lg">
                                    @foreach ($suppliers as $row)
                                    <li class="w-full dropdown-item !bg-gray-100  cursor-pointer px-2  py-2 !rounded-md text-secondary-light bg-hover-neutral-200 text-hover-neutral-900"
                                        wire:click="selectSupplier({{ $row->id }})">{{ $row->name }}

                                    </li>
                                    @endforeach
                                </div>
                                @endif
                            </div>

                            <button class="bg-gray-100 hover:bg-gray-300 p-2 !rounded-md text-[#157347] shadow-sm transition-all" data-bs-toggle="modal" data-bs-target="#supplierModal" wire:click.prevent="resetFields">
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
                            <button wire:click.prevent="save" class="bg-[#157347] hover:bg-[#274738] text-white px-4 py-1.5 !rounded-md text-sm font-semibold focus:ring-2 focus:ring-blue-200">Save</button>
                        </div>
                    </div>
                    @error('supplier_query')
                    <div class=" tw-px-3">
                        <span class="tw-text-red-500 tw-text-xs">{{ $message }}</span>
                    </div>
                    @enderror

                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="flex flex-col">
                                <input type="text" wire:model="invoice_number"
                                    class="p-2.5 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-100 placeholder:text-sm"
                                    placeholder="#Invoice No.">
                                @error('invoice_number')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col">
                                <input type="date" wire:model="invoice_date"
                                    class="p-2.5 rounded-md border border-gray-300 text-gray-500 focus:outline-none">
                                @error('invoice_date')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center gap-2 text-sm">
                            <input class="bg-gray-100   px-3 py-1 w-10 outline-none  !rounded-md" value="{{$purchase_number}}" readonly />
                            <input class="bg-gray-100  px-3 py-1 w-28 outline-none  !rounded-md" wire:model="purchase_date" readonly />
                        </div>
                    </div>

                    <div class="mt-1 relative">
                        <input type="text" wire:model.live="product_query"
                            class="p-2.5 !rounded-md border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-blue-100 placeholder:text-sm"
                            placeholder="Search Products">
                        @if ($products && count($products) > 0)
                        <div
                            class="absolute top-[100%] left-0 w-full z-20 shadow-md bg-white rounded-lg">
                            @foreach ($products as $row)
                            <li class="w-full dropdown-item !bg-gray-100  cursor-pointer px-2  py-2 !rounded-md text-secondary-light bg-hover-neutral-200 text-hover-neutral-900"
                                wire:click="selectProduct({{ $row->id }})">{{ $row->name }}
                            </li>
                            @endforeach
                        </div>
                        @endif
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
                                @if ($selected_products && count($selected_products)>0)

                                @foreach ($selected_products as $index => $product )
                                <tr class="border-t">
                                    <td class="p-2">{{$loop->index+1}}</td>
                                    <td class="p-2">{{$product['name']}}</td>
                                    <td class="p-2"><input type="number" wire:model.lazy="selected_products.{{ $index }}.quantity"
                                            class="w-full text-center p-1 border !rounded-md border-gray-300 focus:ring focus:ring-blue-100"></td>
                                    <td class="p-2"><input type="number" wire:model.lazy="selected_products.{{ $index }}.rate"
                                            class="w-full text-center p-1 border !rounded-md border-gray-300 focus:ring focus:ring-blue-100"></td>
                                    <td class="p-2"><input type="number" wire:model.lazy="selected_products.{{ $index }}.discount"
                                            class="w-full text-center p-1 border !rounded-md border-gray-300 focus:ring focus:ring-blue-100"></td>
                                    <td class="text-center">{{$product['tax']}}</td>
                                    <td class="p-2">{{$product['total']}}</td>
                                    <td class="text-center">
                                        <button wire:click.prevent="removeProduct({{$index}})" class="bg-red-100 hover:bg-red-300 p-2 !rounded-full text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M7.616 20q-.672 0-1.144-.472T6 18.385V6H5V5h4v-.77h6V5h4v1h-1v12.385q0 .69-.462 1.153T16.384 20zM17 6H7v12.385q0 .269.173.442t.443.173h8.769q.23 0 .423-.192t.192-.424zM9.808 17h1V8h-1zm3.384 0h1V8h-1zM7 6v13z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
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
                            <input type="text" wire:model="paid_amount"
                                class="p-2 !rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                placeholder="Amount">
                        </div>
                        <div class="flex flex-col gap-1 w-1/2">
                            <label class="text-sm font-semibold">Payment Method <span class="text-red-500">*</span></label>
                            <select wire:model="payment_method"
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
                            <textarea wire:model="notes"
                                class="px-3 py-2 !rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-100 resize-none"
                                placeholder="Write a note..."></textarea>
                        </div>
                        <div class="flex flex-col gap-1 w-1/2">
                            <label class="text-sm font-semibold">Payment Remark</label>
                            <textarea wire:model="remarks"
                                class="px-3 py-2 !rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-100 resize-none"
                                placeholder="Add any payment remarks"></textarea>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-2 px-5 w-[35%]">
                    <div class="flex justify-between text-sm">
                        <span>Sub Total</span>
                        <span>${{number_format($product_data['sub_total'],2)}}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Discount</span>
                        <span>${{number_format($product_data['discount'],2)}}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Taxable Amount</span>
                        <span>$ {{number_format($product_data['sub_total'],2)}}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>Tax Amount</span>
                        <span>$ {{number_format(0,2)}}</span>
                    </div>
                    <div class="flex justify-between text-base font-semibold mt-3">
                        <span>Gross Total</span>
                        <span>${{number_format($product_data['total'],2)}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Supplier</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-24">
                    <div class="row">
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Name <span class="text-red-500">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Supplier Name" wire:model="name">
                            @error('name')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="phone" class="col-form-label">Phone <span class="text-red-500">*</span></label>
                            <input type="number" class="form-control" id="phone" placeholder="Enter Phone Number" wire:model="phone">
                            @error('phone')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="email" class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Email Address" wire:model="email">
                            @error('email')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="tax_number" class="col-form-label">Tax number</label>
                            <input type="number" class="form-control" id="tax_number" placeholder="Enter Tax Number" wire:model="tax_number">
                            @error('tax_number')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="opening_balance" class="col-form-label">Opening Balance</label>
                            <input type="number" class="form-control" id="opening_balance" placeholder="Enter Opening Balance" wire:model="opening_balance">
                            @error('opening_balance')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-6">
                            <label for="address" class="col-form-label">Address</label>
                            <textarea class="form-control resize-none" wire:model="address" rows="3" id="address" placeholder="Enter Address"></textarea>
                            @error('address')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12 mt-6">
                            <div class="form-switch switch-primary d-flex align-items-center gap-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="switch1" wire:model="is_active">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="switch1">Is Active?</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click.prevent="addSupplier">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>