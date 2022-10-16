
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        @can('user-create')
        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Buat User Baru</a>
          </div>
        @endcan

        <form action="{{route('users.index')}}">

          <div class="input-group">
              <input 
                type="text" 
                class="form-control mb-2" 
                placeholder="Cari Berdasarkan Nama"
                value="{{Request::get('name')}}"
                name="name" autocomplete="off">
                
              <div class="input-group-append">
                <input 
                  type="submit" 
                  value="Filter" 
                  class="btn btn-primary">
              </div>
          </div>
            
        </form>
    </div>
</div>

<div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Username</th>
        <th>Roles</th>
        <th width="280px">Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $key => $user)
    <tr>
      <td>{{ ++$key }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->username}}</td>
      <td>
        @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $val)
                  <label class="badge rounded-pill bg-primary">{{ $val }}</label>
            @endforeach
        @endif
      </td>
      <td>
        <div class="btn-group" role="group" aria-label="Basic Example">
        @can('user-edit')
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-md btn-primary">Edit</a>
        @endcan
  
        @can('user-list')
        <a href="{{ route('users.show', $user->id) }}" class="btn btn-md btn-warning">Show</a>
        @endcan
  
        @can('user-delete')
        <form action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('apakah anda yakin?');" method="POST">
          @csrf
          @method('DELETE')
            <button type="submit" class="btn btn-md btn-danger">Hapus</button>
        </form>
        @endcan
      </div>
      </td>
    </tr>
    @empty
    <div class="alert alert-danger">
      Data User Tidak Ada
    </div>
   @endforelse
    </tbody>
  </table>
</div>
{{ $users->links() }}
@endsection 

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    //message with toastr
    @if(session()->has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
</script>
@endsection