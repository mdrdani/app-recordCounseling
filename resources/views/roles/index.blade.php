
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Role Management</h2>
        </div>
        <div class="pull-right mb-2">
            @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
            @endcan
        </div>
    </div>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Name</th>
      <th width="280px">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse($roles as $key => $role)
  <tr>
    <td>{{ ++$key }}</td>
    <td>{{ $role->name }}</td>
    <td>
        @can('role-edit')
        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-md btn-primary">Edit</a>
        @endcan

        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-md btn-warning">Show</a>
        
        @can('role-delete')
        <form action="{{ route('roles.destroy', $role->id) }}" onsubmit="return confirm('apakah anda yakin?');" method="POST">
        @csrf
        @method('DELETE')
        @if(Auth::user() == TRUE)
                <button type="submit" class="btn btn-md btn-danger" disabled>Hapus</button>
          @else
        <button type="submit" class="btn btn-md btn-danger">Hapus</button>
        @endif
        @endcan
      
      </form>
    </td>
  </tr>
  @empty
  <div class="alert alert-danger">
    Data Role Belum tersedia
  </div>
 @endforelse
  </tbody>
</table>
{{ $roles->links() }}
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