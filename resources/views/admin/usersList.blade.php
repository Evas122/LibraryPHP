<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users List') }}
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
              <th>Id</th>
              <th>Name</th>
              <th>E-Mail</th>
              <th>Role</th>
              <th>Verified</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @foreach($users as $user)
              <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->role}}</td>
              <td>{{$user->verified}}</td>
              <td>
                 <div class="btn-group" role="group" aria-label="User Actions">
                  @if($user->verified !='Yes')
                <form method="post" action="{{route('admin.verifyUser', ['user' => $user])}}">
                  @csrf
                  @method('put')
                  <button type="submit" class="btn btn-primary">Verify</button>
                </form>
                @endif
                <form method="post" action="{{route('admin.deleteUser', ['user' => $user])}}">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </div>
            </td>
            </tr>
              @endforeach
            </tr> 
          </tbody>
        </table>
      </div>
    
</x-app-layout>
