<div>
    <div class="grid grid-cols-5 gap-2 rounded-md p-4">
        <div class="col-span-3 bg-gray-100 px-4 py-2 rounded-lg">
            <div class="flex flex-col gap-1">
                <div class="flex items-center gap-2 justify-between">
                    <input type="text" class="outline-none ring ring-black px-1 py-1 w-full rounded-lg" wire:model="name" placeholder="Enter Item" name="" id="">
                    <button class="btn btn-primary" @if (isset($edit_key)) wire:click="updateSecondItem" @else wire:click="addItem" @endif>
                        @if (isset($edit_key))
                        Update
                        @else
                        Add
                        @endif
                    </button>

                </div>
                <div class="grid grid-cols-4 gap-2 mt-6">
                    @foreach ($cart as $key => $item )
                    <div class="rounded-lg px-2 py-1 bg-gray-200 flex flex-col hover:bg-gray-300 " wire:click="addSecondItem({{$key}})">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-balance">{{$item['name']}}</span>
                            <a href="#" wire:click.stop="removeItem({{$item['id']}},{{$key}})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-red-500">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-span-2 bg-gray-200 px-4 py-2 rounded-lg">
            <div class="grid grid-cols-3 gap-2 mt-6">
                @foreach ($secondCart as $key => $item )
                <div class="rounded-lg px-2 py-1 bg-neutral-50 flex flex-col hover:bg-neutral-100 ">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-balance">{{$item['name']}}</span>
                        <div class="flex justify-between gap-1 items-center">
                            <a href="#" wire:click="editSecondItem({{$key}})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-yellow-500">
                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                    <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                </svg>
                            </a>
                            <a href="#" wire:click="removeSecondItem({{$key}})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 text-red-500">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>

                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>