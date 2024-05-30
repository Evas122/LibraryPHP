<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <div>
        @if(session()->has('success'))
        <div>
          {{session('success')}}
        </div>
        @endif
      </div>
    
      <div class="container mt-5">
        <table class="table table-striped text-center">
          <thead>
            <tr>
              <th>Title</th>
              <th>Author</th>
              <th>Genre</th>
              <th>Availability</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach($books as $book)
              <tr>
                <td>{{$book->title}}</td>
                <td>{{$book->author}}</td>
                <td>{{$book->genre}}</td>
                <td>{{$book->availability}}</td>
                <td>
                  <div class="btn-group" role="group" aria-label="Book Actions">
                    <a href="{{route('books.requestMake', ['book' => $book])}}">
                      <button type="button" class="btn btn-primary">Borrow a Book</button>
                    </a>     
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    
</x-app-layout>