<div class="overflow-hidden">
    <div class="flex items-center gap-2 px-4 py-4">
        <div class=" rounded-lg px-2 py-1 hover:bg-neutral-300 hover:text-black hover:cursor-pointer  @if($categoryFilter == 'all') bg-blue-500 text-white @else bg-neutral-200 text-black @endif " wire:click="changeCategory('all')">
            <span>All</span>
        </div>
        @foreach ($categories as $category )
        <div class=" rounded-lg  px-2 py-1 hover:bg-neutral-300 hover:text-black hover:cursor-pointer {{ $categoryFilter == $category->id ? 'bg-blue-500 text-white' : 'bg-neutral-200 text-black'}} " wire:click="changeCategory({{$category->id}})">
            <span>{{$category->name}}</span>
        </div>
        @endforeach
    </div>
    <div class="grid grid-cols-4 gap-2">

        <div class="col-span-2 bg-gray-50 px-4 py-2">
            <div class="font-bold text-2xl">Products</div>
            <div class="grid grid-cols-4 gap-2 mt-6">
                @foreach ($products as $product )
                <div class="rounded-lg px-2 py-1 bg-gray-200 flex flex-col hover:bg-gray-300 " wire:click="addItem({{$product}})">
                    <span class="font-semibold text-balance">{{$product->name}}</span>
                    <span class="text-sm">{{$product->purchase_price}}</span>
                </div>
                @endforeach

            </div>

        </div>
        <div class="col-span-2 bg-gray-50 px-4 py-2">
            <div class="font-bold text-2xl">Cart</div>
            <div class="mt-6 flex flex-col px-2 py-1 ">
                <table class="table table-borderd text-center ">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>QTY</th>
                            <th>Price</th>
                            <th>Tax %</th>
                            <th>Discount</th>
                            <th>Total</th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($cart as $key => $item )

                        <tr class="align-middle text-sm ">
                            <td>{{$item['name']}}</td>
                            <td>
                                <input type="number" wire:change="calculateTotal" wire:model.live="cart.{{$key}}.quantity" class="w-14 ring ring-black outline-none rounded-md px-1">
                            </td>
                            <td>
                                <input type="number" wire:change="calculateTotal" wire:model.live="cart.{{$key}}.price" class="w-14 ring ring-black outline-none rounded-md px-1">
                            </td>
                            <td>{{$tax_percentage}}</td>
                            <td>
                                <input type="number" wire:change="calculateTotal" wire:model.live="cart.{{$key}}.discount" class="w-14 ring ring-black outline-none rounded-md px-1">
                            </td>
                            <td>{{$item['total']}}</td>
                            <td>
                                <a href="#" wire:click="removeItem({{$key}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-red-500">
                                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
            <div class="flex flex-col gap-2 mt-6 bg-gray-200 rounded-lg px-2 py-1 text-center">
                <div class="flex justify-between items-center px-4 py-2">
                    <div class="">Sub Total :</div>
                    <div class="">{{$cart_data['sub_total']}}</div>
                </div>
                <div class="flex justify-between items-center px-4 py-1">
                    <div class="">Tax Total :</div>
                    <div class="">{{$cart_data['tax_total']}}</div>
                </div>
                <div class="flex justify-between items-center px-4 py-1">
                    <div class="">Taxable Amount :</div>
                    <div class="">{{$cart_data['taxable_amount']}}</div>
                </div>
                <div class="flex justify-between items-center px-4 py-2">
                    <div class="font-semibold text-lg">Gross Total :</div>
                    <div class="">{{$cart_data['total']}}</div>
                </div>

            </div>
        </div>
    </div>
</div>