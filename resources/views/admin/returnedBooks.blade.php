<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Returned Books') }}
        </h2>
    </x-slot>
    <div class="container mt-5">
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>User id</th>
              <th>title</th>
              <th>Borrowed At</th>
              <th>Due Time</th>
              <th>Returned At</th>
            </tr>
          </thead>
          <tbody>
              @foreach($booktransactions as $booktransaction)
              <tr>
                <td>{{$booktransaction['user_id']}}</td>
                <td>{{$booktransaction['title']}}</td>
                <td>{{$booktransaction['borrowed_at']}}</td>
                <td>{{$booktransaction['due_date']}}</td>
                <td>{{$booktransaction['returned_at']}}</td>
            </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    
</x-app-layout>
