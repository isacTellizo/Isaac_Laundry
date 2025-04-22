<div>
    <div class="col-md-12 mt-2 p-2">
        <div class="mb-4 p-2">
            <div class="card-header mb-4 border-b-0 p-0">
                <span class="card-title text-2xl font-semibold"> Suppliers </span>
            </div> <!-- /.card-header -->
            <div class="card mb-2 shadow-none">
                <div class="flex justify-between gap-3 p-2">
                    <input type="text" class="form-control" wire:model.live="search" placeholder="Search Here">
                    <div>
                        <button class="btn btn-success !px-6 py-1 btn-sm !text-xs" data-bs-toggle="modal" data-bs-target="#supplierModal" wire:click="resetInputFields">Add Supplier</button>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="text-sm">
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Tax Number</th>
                            <th>Opening Balance</th>
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
                            <td>{{$supplier->tax_number}}</td>
                            <td>{{$supplier->opening_balance}}</td>
                            <td>{{$supplier->address}}</td>
                            <td>
                                @if ($supplier->is_active == 1)
                                <span class="text-green-500 text-sm rounded-2xl bg-green-200 px-2 py-1 font-semibold">Active</span>
                                @else
                                <span class="text-red-500 text-sm rounded-2xl bg-red-200 px-2 py-1 font-semibold">InActive</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-between gap-2">
                                    <button class="btn btn-dark btn-sm text-xs" data-bs-toggle="modal" data-bs-target="#supplierModal" wire:click="edit({{$supplier->id}})">Edit</button>
                                    <button class="btn btn-danger btn-sm text-xs" wire:click.prevent="delete({{$supplier->id}})">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col -->

    <!-- Modal -->
    <div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">@if($this->supplier)Edit Supplier @else Add Supplier @endif</h1>
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
                            <label for="phone" class="col-form-label">Phone <span class="text-red-500">*</span></label>
                            <input type="number" class="form-control" id="phone" wire:model='phone' placeholder="Enter Phone">
                            @error('phone')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="email" class="col-form-label">Email </label>
                            <input type="email" class="form-control" id="email" wire:model='email' placeholder="Enter Email">
                            @error('email')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="tax_number" class="col-form-label">Tax Number</label>
                            <input type="text" class="form-control" id="tax_number" wire:model='tax_number' placeholder="Enter Tax Number">
                            @error('tax_number')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6 mb-6">
                            <label for="opening_balance" class="col-form-label">Opening balance</label>
                            <input type="number" class="form-control" id="opening_balance" wire:model='opening_balance' placeholder="Enter Opening Balance">
                            @error('opening_balance')
                            <span class="text-red-500 text-xs">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-12 mb-6">
                            <label for="address" class="col-form-label">Address</label>
                            <textarea class="form-control !resize-none" rows="3" id="address" wire:model="address" placeholder="Enter Address"></textarea>
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
                    <button type="button" class="btn btn-primary" wire:click.prevent="save">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>