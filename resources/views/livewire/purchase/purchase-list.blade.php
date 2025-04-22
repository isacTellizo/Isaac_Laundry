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
                        <a class="btn btn-success px-3 py-1 btn-sm text-xs" href="{{route('purchase.manage')}}">Add Purchase</a>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="text-sm">
                            <th>Purchase Info</th>
                            <th>Supplier</th>
                            <th>Total</th>
                            <th>Created By</th>
                            <th style="width: 50px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purchase )

                        <tr class="align-middle text-sm">
                            <td>
                                <div class=" text-neutral-600 text-sm ">
                                    Purchase No : <span class="font-medium text-sm">{{$purchase->purchase_number}}</span>
                                </div>
                                <div class=" text-neutral-600 text-sm ">
                                    Purchase Date : <span class="font-medium text-sm">{{ $purchase->created_at->format('Y-m-d') }}</span>
                                </div>
                            </td>
                            <td>
                                <p>{{ $purchase->supplier->name }}</p>
                                <p>{{ $purchase->supplier->tax_number ?? 'N/A' }}</p>
                            </td>
                            <td>${{ number_format($purchase->total, 2) }}</td>
                            <td>@if ($purchase->created_by == 1 )
                                <span>Admin</span>
                                @else
                                <span>N/A</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-between gap-2">
                                    <a href="{{route('purchase.manage',$purchase->id)}}" class="btn btn-dark btn-sm text-xs" wire:click="">Edit</a>
                                    <button class="btn btn-danger btn-sm text-xs" wire:click="">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>