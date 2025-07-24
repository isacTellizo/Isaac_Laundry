<div>
  <div class="flex flex-col px-4 py-2 ">
    <p>Enter Your To Do List</p>
    <div class="flex gap-2 items-center ">
      <label for="">To Do :</label>
      <input type="text" class="form-control !w-36" wire:model="todo">
    </div>
    <button class="btn btn-small btn-secondary" wire:click="addTodo">Add</button>
  </div>
  <div>
    {{$message}}
  </div>
  <div class="mt-14">
    <ul>
      @foreach ($todos as $item )
      <li>{{$item}}</li>
      @endforeach
    </ul>
  </div>
</div>