<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Issued Books') }}
      </h2>
  </x-slot>
  <div class="container mt-5">
      <table class="table table-striped text-center">
          <thead>
              <tr>
                  <th>User Id</th>
                  <th>Book</th>
                  <th>Borrowed At</th>
                  <th>Due Date</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
              @foreach($booktransactions as $booktransaction)
              @if($booktransaction['returned_at'] == null)
              <tr>
                  <td>{{$booktransaction['user_id']}}</td>
                  <td>{{$booktransaction['title']}}</td>
                  <td>{{$booktransaction['borrowed_at']}}</td>
                  <td>{{$booktransaction['due_date']}}</td>
                  <td>
                    <form method="post" action="{{ route('admin.returnBook', $booktransaction['id']) }}">
                      @csrf
                      @method('post')
                      <button type="submit" class="btn btn-primary">Return Book</button>
                  </form>
                 @endif
                </td>
              </tr>
              @endforeach 
          </tbody>
      </table>
  </div>
</x-app-layout>