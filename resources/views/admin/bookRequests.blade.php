<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Book Requests') }}
        </h2>
    </x-slot>

<div class="container mt-5">
    <table class="table table-striped text-center">
      <thead>
        <tr>
          <th>User Id</th>
          <th>Book id</th>
          <th>Due Date</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach($bookrequests as $bookrequest)
          <tr>
          <td>{{$bookrequest->user_id}}</td>
          <td>{{$bookrequest->book_id}}</td>
          <td>{{$bookrequest->due_date}}</td>
          <td>{{$bookrequest->status}}</td>
          <td>
            <div class="btn-group" role="group" aria-label="Book Request Actions">
           <form method="post" action="{{route('admin.acceptRequest', ['bookrequest' => $bookrequest])}}">
             @csrf
             @method('post')
             <button type="submit" class="btn btn-primary">Accept</button>
           </form>
           <form method="post" action="{{route('admin.deleteRequest', ['bookrequest'=> $bookrequest])}}">
             @csrf
             @method('delete')
             <button type="submit" class="btn btn-danger">Decline</button>
           </form>
         </div>
       </td>
      </tr>
          @endforeach 
      </tbody>
    </table>
  </div>

</x-app-layout>