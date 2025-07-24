<div class="px-4 py-2">

    <div class="flex gap-2 items-center">
        <input type="number" placeholder="Enter your Age" wire:model="age" class="rounded-lg px-2 py-1 border border-black outline-none">
        <button class="btn btn-primary" wire:click="checkAge">Submit</button>
        <div class="font-semibold text-lg @if ($age < 18) text-red-500  @endif text-blue-500">{{$message}}</div>
    </div>
    <div class="flex gap-2 items-center mt-10">
        <input type="number" placeholder="Enter your Number" wire:model="number" class="rounded-lg px-2 py-1 border border-black outline-none">
        <button class="btn btn-primary" wire:click="checkNumber">Submit</button>
        <div class="font-semibold text-lg  text-blue-500">{{$numberMessage}}</div>
    </div>

    <div class="flex flex-col gap-2  mt-10">

        <h4 class="font-semibold">Multiplication</h4>
        <div class="flex gap-2 items-center">

            <input type="number" class="rounded-lg px-2 py-1 border border-black outline-none" wire:model="multiplying_number" placeholder="Enter Multiplier">
            <div class="flex gap-1">
                <input type="text" class=" w-64 rounded-lg px-2 py-1 border border-black outline-none" name="number_one" placeholder="Enter numbers seperated by ' , '" wire:model="numbers">
            </div>
            <button class="btn btn-primary" wire:click="multiply">Submit</button>
            <div class="flex flex-col gap-1">
                <!-- <div class="flex gap-1">
                <input type="text" class=" w-64 rounded-lg px-2 py-1 border border-black outline-none" name="number_one" placeholder="Enter numbers seperated by ' , '" wire:model="numbers">
            </div> -->
                <!-- <div class="flex gap-1">
                <input type="number" class="rounded-lg px-2 py-1 border border-black outline-none" name="number_two" placeholder="Enter number" wire:model="numbers.0.number_two">
            </div>
            <div class="flex gap-1">
                <input type="number" class="rounded-lg px-2 py-1 border border-black outline-none" name='number_three' placeholder="Enter number" wire:model="numbers.0.number_three">
            </div>
            <div class="flex gap-1">
                <input type="number" class="rounded-lg px-2 py-1 border border-black outline-none" name='number_four' placeholder="Enter number" wire:model="numbers.0.number_four">
            </div> -->
            </div>

            <div class="font-semibold text-lg  text-blue-500">{{$result}}</div>
        </div>


    </div>

    <div class="flex flex-col gap-2  mt-10">

        <div class="font-semibold text-3xl">Sort Even and Odd</div>
        <div class="flex gap-2 items-center">

            <div class="flex gap-1">
                <input type="text" class=" w-64 rounded-lg px-2 py-1 border border-black outline-none" name="number_one" placeholder="Enter numbers seperated by ' , '" wire:model="numbers_entered">
            </div>
            <button class="btn btn-primary" wire:click="sortEvenAndOdd">Submit</button>
            @foreach ($even_numbers as $item )
            <div class="font-semibold text-lg  text-blue-500">{{$item}}</div>
            @endforeach
            @foreach ($odd_numbers as $item )
            <div class="font-semibold text-lg  text-blue-500">{{$item}}</div>
            @endforeach

        </div>
    </div>
    <div class="font-semibold text-3xl mt-10 mb-2">Array Map</div>
    <div class="flex items-center  gap-2">
        <button class="btn btn-primary" wire:click="squareArrays">Square of Items </button>
        <button class="btn btn-primary" wire:click="squareUsingMap">Square Using Map () </button>
        <button class="btn btn-primary" wire:click="addPrefix">Add Prefix </button>
        <button class="btn btn-primary" wire:click="addPrefixUsingMap">Add Prefix Using Map() </button>
        <button class="btn btn-primary" wire:click="celsiusToFahrenheit">Celsius to Fahrenheit </button>
        <button class="btn btn-primary" wire:click="celsiusToFahrenheit">Celsius to Fahrenheit Using Map() </button>
        <button class="btn btn-primary" wire:click="multiplyWithTax">Add tax </button>
        <button class="btn btn-primary" wire:click="addIndex">Add index </button>

    </div>
    <div class="font-semibold text-3xl mt-10 mb-2">Array Filter</div>
    <div class="flex items-center  gap-2">
        <button class="btn btn-primary" wire:click="filterEven">Filter even out</button>


    </div>
    <div class="font-semibold text-3xl mt-10 mb-2">Do While</div>
    <div class="flex items-center  gap-2">
        <button class="btn btn-primary" wire:click="doWhile">Check Numbers</button>
        <button class="btn btn-primary" wire:click="doWhileArray">Multiply Array</button>
    </div>
    <div class="font-semibold text-3xl mt-10 mb-2">Switch Case</div>
    <div class="flex items-center  gap-2">
        <input type="text" placeholder="Enter alphabet eg; 'a'" wire:model="alphabet" class="rounded-lg px-2 py-1 border border-black outline-none">
        <button class="btn btn-primary" wire:click="switchCase">Get Word</button>
        <button class="btn btn-primary" wire:click="switchCaseArray">Check Odd or Even Array</button>
    </div>
    <div class="font-semibold text-3xl mt-10 mb-2">Status Toggle</div>
    <div class="flex items-center  gap-2">
        <button class="btn btn-primary" wire:click="changeStatus">Change Status</button>
        @switch($is_active)
        @case(0)
        <div class="px-2 py-1 bg-red-200 rounded-lg font-semibold text-xs text-red-500">Inactive</div>
        @break
        @case(1)
        <div class="px-2 py-1 bg-green-200 rounded-lg font-semibold text-xs text-green-500">Active</div>
        @break
        @endswitch

    </div>

</div>