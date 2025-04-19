<div>
    <div class="col-md-12 mt-2 p-2">
        <div class="mb-4 p-2">
            <div class="card-header mb-4 border-b-0 p-0">
                <span class="card-title text-2xl font-semibold">Purchase</span>
            </div>
            <div class="card mb-2 shadow-none">
                <div class="flex justify-between gap-3 p-2">
                    <input type="text" class="form-control" placeholder="Search Here" wire:model.live="search">
                    <div>
                        <a class="btn btn-success px-3 py-1 btn-sm text-xs" href="{{route('purchase.manage')}}" >Add Purchase</a>
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
                        <tr class="align-middle text-sm">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                
                                <span class="text-green-500 text-sm rounded-2xl bg-green-200 px-2 py-1 font-semibold">Active</span>
                                <span class="text-red-500 text-sm rounded-2xl bg-red-200 px-2 py-1 font-semibold">Inactive</span>
                            </td>
                            <td>
                                <div class="flex justify-between gap-2">
                                    <button class="btn btn-dark btn-sm text-xs" data-bs-toggle="modal" data-bs-target="#supplierModal" wire:click="">Edit</button>
                                    <button class="btn btn-danger btn-sm text-xs" wire:click="">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>