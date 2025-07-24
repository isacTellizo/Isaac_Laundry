<div>
    <div class="col-md-12 mt-2 p-2">
        <div class="mb-4 p-2">
            <div class="card-header mb-4 border-b-0 p-0">
                <span class="card-title text-2xl font-semibold"> Products </span>
            </div> <!-- /.card-header -->
            <div class="card mb-2 shadow-none p-4">
                <div class="flex justify-between items-center gap-2">

                    <div class="col-3 mb-6">
                        <label for="unit_id" class="col-form-label">Unit </label>
                        <select class="form-control" id="unit_id" wire:model.live='selectedUnit'>
                            <option value="">Select Unit</option>
                            @foreach ($units as $unit )
                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                            @endforeach
                        </select>
                        @error('unit_id')
                        <span class="text-red-500 text-xs">{{"Unit Monu is Required"}}</span>
                        @enderror
                    </div>
                    <div class="col-3 mb-6">
                        <label for="category_id" class="col-form-label">Category </label>
                        <select class="form-control" id="category_id" wire:model.live='selectedCategory'>
                            <option value="all">Select Category</option>
                            @foreach ($categories as $category )
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-red-500 text-xs">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-3 mb-6">
                        <label for="category_id" class="col-form-label">From: </label>
                        <input type="date" class="form-control" id="category_id" wire:model.live='from_date'>
                    </div>
                    <div class="col-3 mb-6">
                        <label for="category_id" class="col-form-label">To: </label>
                        <input type="date" class="form-control" id="category_id" wire:model.live='to_date'>

                    </div>
                </div>

                <div class="flex justify-between gap-7 p-2">
                    {{--<div class="flex items-center gap-x-3">
                        <label for="hs-sm-switch" class="relative inline-block w-11 h-6 cursor-pointer">
                            <input type="checkbox" id="hs-sm-switch" class="peer sr-only active" wire:model.live="toggle">
                            <span class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-blue-600 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                            <span class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                        </label>
                        <label for="hs-sm-switch" class="text-sm text-gray-500 dark:text-neutral-400">Status</label>
                    </div>--}}
                    <input type="text" class="form-control" wire:model.live="search" placeholder="Search Here">
                    <div class="col-2">
                        <input type="number" class="form-control" wire:model.live="number_filter" placeholder="Enter Number Of Items">
                    </div>
                    <div class="col-2 ">
                        <select class="form-control p-2" id="category_id" wire:model.live='order_filter'>
                            <option value="all">Select Order</option>
                            <option value="asc">Ascending</option>
                            <option value="desc">Descending</option>
                        </select>
                    </div>
                    <div class="flex gap-2">

                        @if($this->selected_items)
                        <button class="btn btn-danger btn-sm text-xs" wire:click.prevent="deleteSelected">Delete</button>
                        @endif
                        <button class="btn btn-success !px-6 py-1 btn-sm !text-xs" data-bs-toggle="modal" data-bs-target="#productModal" wire:click="resetInputFields">Add Product</button>


                    </div>

                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="text-sm">
                            <th style="width: 10px">#</th>
                            <th style="width: 10px">No.</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Category</th>
                            <th>SKU</th>
                            <th>Purchase Price</th>
                            <th>Opening Stock</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th style="width: 50px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $item )
                        <tr class="align-middle text-sm">
                            <td><input type="checkbox" wire:click="$refresh" wire:model="selected_items" value="{{$item->id}}"></td>
                            @php
                            $newNumber = $loop->index+5;
                            @endphp
                            <td>{{$newNumber}}</td>

                            <td>
                                <div class="flex gap-2 items-center justify-center ">
                                    <span>{{$item->name}}</span>
                                    <img src="{{$item->photo()}}" class="size-12 rounded-md" alt="">
                                </div>
                            </td>
                            <td>{{$item->unit?->short_form}}</td>
                            <td>{{$item->category?->name}}</td>
                            <td>{{$item->sku}}</td>
                            <td>{{$item->purchase_price}}</td>
                            <td>{{$item->opening_stock}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{Carbon\Carbon::parse($dateNow)->format("Y-m-D")}}</td>
                            <td>


                                <div class="flex items-center gap-x-3">
                                    <label class="relative inline-block w-11 h-6 cursor-pointer">
                                        <input type="checkbox" class="peer sr-only active" wire:click="changeStatus({{$item->id}})" @if($item->is_active == 1) checked @endif>
                                        <span class="absolute inset-0 bg-gray-200 rounded-full transition-colors duration-200 ease-in-out peer-checked:bg-blue-600 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                                        <span class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-between gap-2">
                                    <button class="btn btn-dark btn-sm text-xs" data-bs-toggle="modal" data-bs-target="#productModal" wire:click="edit({{$item->id}})">Edit</button>
                                    <button class="btn btn-danger btn-sm text-xs" wire:click.prevent="delete({{$item->id}})" wire:confirm="Are you sure you want to delete?">Delete</button>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class ="mt-4 p-4" >
                    <p>Carbon Now = {{$dateNow}}</p>
                    <p>Carbon Today = {{$today}}</p>
                    <p>Carbon Yesterday = {{$yesterday}}</p>
                    <p>Carbon Added Year = {{$addedYear}}</p>
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
                        <div class="col-12 mb-6">
                            <label for="image" class="col-form-label">Image</label>
                            <input type="file" class="form-control" id="name" wire:model='image'>
                            @error('name')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Name <span class="text-red-500">*</span></label>
                            <input type="text" class="form-control" id="name" wire:model='name' placeholder="Enter Product  Name">
                            @error('name')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="unit_id" class="col-form-label">Unit <span class="text-red-500">*</span></label>
                            <select class="form-control" id="unit_id" wire:model='unit_id'>
                                <option value="">Select Unit</option>
                                @foreach ($units as $unit )
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                            @error('unit_id')
                            <span class="text-red-500 text-xs">{{"Unit Monu is Required"}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="category_id" class="col-form-label">Category <span class="text-red-500">*</span></label>
                            <select class="form-control" id="category_id" wire:model='category_id'>
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
                            <input type="number" class="form-control" id="opening_stock" wire:model='opening_stock' placeholder="Enter Opening Stock">
                            @error('opening_stock')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-6">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea class="form-control !resize-none" rows="3" id="description" wire:model="description" wire:keydown.enter="save" placeholder="Enter Description"></textarea>
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
                    <button type="button" class="btn btn-primary" wire:click.prevent="save" wire:keydown.enter="save">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>