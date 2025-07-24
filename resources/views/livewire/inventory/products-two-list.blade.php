<div>
    <div class="col-md-12 mt-2 p-2">
        <div class="mb-4 p-2">
            <div class="card-header mb-4 border-b-0 p-0">
                <span class="card-title text-2xl font-semibold"> Products </span>
            </div> <!-- /.card-header -->
            <div class="card mb-2 shadow-none">
                <div class="flex justify-between gap-3 p-2">
                    <input type="text" class="form-control" wire:model.live="search" placeholder="Search Here">
                    <div>
                        <button class="btn btn-success !px-6 py-1 btn-sm !text-xs" data-bs-toggle="modal" data-bs-target="#productModal" wire:click="resetInputFields">Add Product</button>
                    </div>
                    <div>
                        <button class="btn btn-success !px-6 py-1 btn-sm !text-xs" wire:click="addProducts">Add Selected Products</button>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="text-sm">
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Category</th>
                            <th>SKU</th>
                            <th>Purchase Price</th>
                            <th>Opening Stock</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th style="width: 50px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item )
                        <tr class="align-middle text-sm">
                            <td>
                                <input type="checkbox" class="form_control" wire:model="selectedProducts" value="{{$item->id}}">
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->unit?->short_form}}</td>
                            <td>{{$item->category?->name}}</td>
                            <td>{{$item->sku}}</td>
                            <td>{{$item->purchase_price}}</td>
                            <td>{{$item->opening_stock}}</td>
                            <td>{{$item->description}}</td>
                            <td>
                                @if ($item->is_active == 1)
                                <span class="text-green-500 text-sm rounded-2xl bg-green-200 px-2 py-1 font-semibold">Active</span>
                                @else
                                <span class="text-red-500 text-sm rounded-2xl bg-red-200 px-2 py-1 font-semibold">InActive</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-between gap-2">
                                    <button class="btn btn-dark btn-sm text-xs" data-bs-toggle="modal" data-bs-target="#productModal" wire:click="edit({{$item->id}})">Edit</button>
                                    <button class="btn btn-danger btn-sm text-xs" wire:click.prevent="delete({{$item->id}})">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col gap-2 mt-16">
                <div>
                    <section class="py-24 relative">
                        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">

                            <h2 class="title font-manrope font-bold text-sm leading-6 mb-6 text-center text-black">
                                Shopping Cart
                            </h2>

                            <div class="hidden lg:grid grid-cols-2 py-4">
                                <div class="font-normal text-sm leading-6 text-gray-500">
                                    Product
                                </div>
                                <p class="font-normal text-sm leading-6 text-gray-500 flex items-center justify-between">
                                    <span class="w-full max-w-[200px] text-center">Delivery Charge</span>
                                    <span class="w-full max-w-[260px] text-center">Quantity</span>
                                    <span class="w-full max-w-[200px] text-center">Total</span>
                                </p>
                            </div>

                            <!-- Example Cart Item -->
                            <div class="grid grid-cols-2 py-4 border-t border-b border-gray-200">
                                @foreach ($selectedProducts as $item )
                                    
                                <div class="flex items-center gap-4">
                                    <img src="your-image.jpg" alt="Product Image" class="w-16 h-16 object-cover rounded" />
                                    <div>
                                        <h5 class="font-semibold text-sm leading-6 text-black max-[550px]:text-center">
                                            {{$item['name']}}
                                        </h5>
                                        <p class="font-normal text-xs leading-5 text-gray-500 my-1 min-[550px]:my-2 max-[550px]:text-center">
                                            {{$item['quantity']}}
                                        </p>
                                        <h6 class="font-medium text-xs leading-5 text-indigo-600 max-[550px]:text-center">
                                            {{$item['rate']}}
                                        </h6>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Add more cart items the same way -->

                            <!-- Cart Summary -->
                            <div class="mt-8 border-t border-gray-200 pt-6">
                                <div class="flex justify-between mb-4">
                                    <span class="font-normal text-sm text-gray-500">Subtotal</span>
                                    <span class="font-medium text-sm text-black">$240.00</span>
                                </div>
                                <div class="flex justify-between mb-4">
                                    <span class="font-normal text-sm text-gray-500">Delivery Charge</span>
                                    <span class="font-medium text-sm text-black">Free</span>
                                </div>
                                <div class="flex justify-between mb-4">
                                    <span class="font-normal text-sm text-gray-500">Discount</span>
                                    <span class="font-medium text-sm text-black">-$20.00</span>
                                </div>
                                <div class="flex justify-between border-t border-gray-300 pt-4">
                                    <span class="font-bold text-sm text-black">Total</span>
                                    <span class="font-bold text-sm text-black">$220.00</span>
                                </div>
                            </div>

                            <div class="mt-6">
                                <button class="w-full bg-indigo-600 text-white text-sm py-3 rounded-lg hover:bg-indigo-700 transition">
                                    Proceed to Checkout
                                </button>
                            </div>

                        </div>
                    </section>

                </div>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="productModalLabel">@if($this->product)Edit Product @else Add Product @endif</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-24">
                    <div class="row">
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Name <span class="text-red-500">*</span></label>
                            <input type="text" class="form-control" id="name" wire:model='name' placeholder="Enter Supplier  Name">
                            @error('name')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="unit_id" class="col-form-label">Unit <span class="text-red-500">*</span></label>
                            <select type="text" class="form-control" id="unit_id" wire:model='unit_id' placeholder="Enter Supplier  Name">
                                <option value="">Select Unit</option>
                                @foreach ($units as $unit )
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                            @error('unit_id')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="category_id" class="col-form-label">Category <span class="text-red-500">*</span></label>
                            <select type="text" class="form-control" id="category_id" wire:model='category_id' placeholder="Enter Supplier  Name">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category )
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="sku" class="col-form-label">SKU <span class="text-red-500">*</span></label>
                            <input type="text" class="form-control" id="sku" wire:model='sku' placeholder="Enter SKU">
                            @error('sku')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="purchase_price" class="col-form-label">Purchase Price <span class="text-red-500">*</span></label>
                            <input type="number" class="form-control" id="purchase_price" wire:model='purchase_price' placeholder="Enter Purchase Price">
                            @error('purchase_price')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="opening_stock" class="col-form-label">Opening Stock </label>
                            <input type="number" class="form-control" id="opening_stock" wire:model='opening_stock' placeholder="Enter Purchase Price">
                            @error('opening_stock')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-12 mb-6">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea class="form-control !resize-none" rows="3" id="description" wire:model="description" placeholder="Enter Description"></textarea>
                        </div>
                        <div class="col-12 tw-mt-6">
                            <div class="form-switch switch-primary d-flex align-items-center gap-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" wire:model="is_active">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="is_active">Is Active ?</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click.prevent="save">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>