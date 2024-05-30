<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
  <!-- Alert -->
  @if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x" role="alert">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="container mt-5">
      <div class="row">
          <div class="col-md-8 offset-md-2">
              <form method="post" action="{{route('books.updateBook', ['book' => $book])}}" class="needs-validation" novalidate>
                  @csrf
                  @method('put')
                  <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" class="form-control" id="title" name="title" value="{{$book->title}}" required>
                      <div class="invalid-feedback">Please provide a title.</div>
                  </div>
                  <div class="form-group">
                      <label for="author">Author</label>
                      <input type="text" class="form-control" id="author" name="author" value="{{$book->author}}" required>
                      <div class="invalid-feedback">Please provide an author.</div>
                  </div>
                  <div class="form-group">
                      <label for="genre">Genre</label>
                      <input type="text" class="form-control" id="genre" name="genre" value="{{$book->genre}}" required>
                      <div class="invalid-feedback">Please provide a genre.</div>
                  </div>
                  <!-- Bottom buttons -->
                  <div class="d-flex justify-content-between">
                      <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                      <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
    
</x-app-layout>