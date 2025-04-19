<div>
    <div class="col-md-12 mt-2 p-2">
        <div class="mb-4 p-2">
            <div class="card-header mb-4 border-b-0 p-0">
                <span class="card-title text-2xl font-semibold"> Categories</span>
            </div>
            <div class="card mb-2 shadow-none">
                <div class="flex justify-between gap-3 p-2">
                    <input type="text" class="form-control" placeholder="Search Here" wire:model.live="search">
                    <div>
                        <button class="btn btn-success px-3 py-1 btn-sm text-xs" data-bs-toggle="modal" data-bs-target="#supplierModal" wire:click.prevent="resetInputFields">Add Supplier</button>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="text-sm">
                            <th style="width: 10px">#</th>
                            <th>Supplier Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Opening Balance</th>
                            <th>Tax Number</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th style="width: 50px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier )

                        <tr class="align-middle text-sm">
                            <td>{{$loop->index+1}}</td>
                            <td>{{$supplier->name}}</td>
                            <td>{{$supplier->phone}}</td>
                            <td>{{$supplier->email}}</td>
                            <td>{{$supplier->opening_balance}}</td>
                            <td>{{$supplier->tax_number}}</td>
                            <td>{{$supplier->address}}</td>
                            <td>
                                @if ($supplier->is_active == 1 )
                                <span class="text-green-500 text-sm rounded-2xl bg-green-200 px-2 py-1 font-semibold">Active</span>
                                @else
                                <span class="text-red-500 text-sm rounded-2xl bg-red-200 px-2 py-1 font-semibold">InActive</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-between gap-2">
                                    <button class="btn btn-dark btn-sm text-xs" data-bs-toggle="modal" data-bs-target="#supplierModal" wire:click="edit({{$supplier->id}})">Edit</button>
                                    <button class="btn btn-danger btn-sm text-xs" wire:click="delete({{$supplier->id}})">Delete</button>
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
                    <button type="button" class="btn btn-primary" wire:click.prevent="save">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>