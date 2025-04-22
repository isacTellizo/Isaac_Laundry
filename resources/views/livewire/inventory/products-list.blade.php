<div>
    <div class="col-md-12 mt-2 p-2">
        <div class="mb-4 p-2">
            <div class="card-header mb-4 border-b-0 p-0">
                <span class="card-title text-2xl font-semibold"> Products</span>
            </div>
            <div class="card mb-2 shadow-none">
                <div class="flex justify-between gap-3 p-2">
                    <input type="text" class="form-control" placeholder="Search Here" wire:model.live="search">
                    <div>
                        <button class="btn btn-success px-3 py-1 btn-sm text-xs" data-bs-toggle="modal" data-bs-target="#productModal" wire:click.prevent="resetInputFields">Add Product</button>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="text-sm">
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Unit</th>
                            <th>SKU</th>
                            <th>Purchase Price</th>
                            <th>Opening Stock</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th style="width: 50px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product )
                        <tr class="align-middle text-sm">
                            <td>{{$loop->index+1}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->category?->name}}</td>
                            <td>{{$product->unit->short_form}}</td>
                            <td>{{$product->sku}}</td>
                            <td>${{$product->purchase_price}}</td>
                            <td>{{$product->opening_stock}}</td>
                            <td>{{$product->description}}</td>
                            <td>
                                @if ($product->is_active == 1)
                                <span class="text-green-500 text-sm rounded-2xl bg-green-200 px-2 py-1 font-semibold">Active</span>
                                @else
                                <span class="text-red-500 text-sm rounded-2xl bg-red-200 px-2 py-1 font-semibold">InActive</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-between gap-2">
                                    <button class="btn btn-dark btn-sm text-xs" data-bs-toggle="modal" data-bs-target="#productModal" wire:click="edit({{$product->id}})">Edit</button>
                                    <button class="btn btn-danger btn-sm text-xs" wire:click="delete({{$product->id}})">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-24">
                    <div class="row">
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Name <span class="text-red-500">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Product Name" wire:model="name">
                            @error('name')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Category <span class="text-red-500">*</span></label>
                            <select type="text" class="form-control" id="name" wire:model="category_id">
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
                            <label for="name" class="col-form-label">Unit <span class="text-red-500">*</span></label>
                            <select type="text" class="form-control" id="name" wire:model="unit_id">
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
                            <label for="name" class="col-form-label">SKU<span class="text-red-500">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Enter SKU" wire:model="sku">
                            @error('sku')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Purchase Price<span class="text-red-500">*</span></label>
                            <input type="number" class="form-control" id="name" placeholder="Enter Purchase Price" wire:model="purchase_price">
                            @error('purchase_price')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Opening Stock</label>
                            <input type="number" class="form-control" id="name" placeholder="Enter Opening Stock" wire:model="opening_stock">
                        </div>
                        <div class="col-6 mb-6">
                            <label for="name" class="col-form-label">Minimum Stock value</label>
                            <input type="number" class="form-control" id="name" placeholder="Enter Minimum Stock Value" wire:model="minimum_stock_value">
                        </div>

                        <div class="col-12 mb-6">
                            <label for="description" class="col-form-label">Description</label>
                            <textarea class="form-control resize-none" wire:model="description" rows="3" id="description" placeholder="Enter Description"></textarea>
                        </div>
                        <div class="col-12 mt-6">
                            <div class="form-switch switch-primary d-flex align-items-center gap-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="switch1" wire:model="is_active">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="switch1">Is Active ?</label>
                            </div>
                        </div>
                        <div class="col-12 mt-6">
                            <div class="form-switch switch-primary flex items-center gap-3">
                                <input class="form-check-input" type="checkbox" role="switch" id="switch1" wire:model="is_consumable">
                                <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="switch1">Is Consumable ?</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click.prevent="save">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>