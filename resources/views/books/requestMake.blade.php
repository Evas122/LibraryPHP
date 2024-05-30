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
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form method="post" action="{{route('books.requestSend', ['book' => $book])}}" class="needs-validation" novalidate>
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label for="due_date">Due date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" required>
                        <div class="invalid-feedback">Please provide a correct data.</div>
                    </div>
                    <div class="btn-group" role="group" aria-label="Book Actions">
                        <a href="{{route('books.requestSend', ['book' => $book])}}">
                          <button type="submit" class="btn btn-primary">Send Request</button>
                        </a>      
                </form>
            </div>
        </div>
    </div>



</x-app-layout>