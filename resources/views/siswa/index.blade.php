
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Siswa Management</h2>
        </div>
        <div class="pull-right mb-2">
            @can('siswa-create')
            <a class="btn btn-success" href="{{ route('siswas.create') }}"> Create New Siswa</a>
            @endcan
        </div>
    </div>
</div>


<table class="table table-bordered">
 <thead>
   <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Kelas</th>
    <th>Wali Kelas</th>
    <th>Tahun Ajaran</th>
    <th width="280px">Action</th>
  </tr>
 </thead>
 <tbody>
  @forelse ($siswas as $key => $siswa)
  <tr>
    <td><center>{{ ++$key }}</center></td>
    <td>{{ $siswa->name }}</td>
    <td>{{ $siswa->Kelas->name}}</td>
    <td>{{ $siswa->Kelas->User->name }}</td>
    <td>{{ $siswa->Kelas->TahunAjaran->tahun }}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic Example">
        <a href="{{ route('siswas.show', $siswa->id) }}" class="btn btn-md btn-warning">Show Record</a>
        @can('siswa-edit')
        <a href="{{ route('siswas.edit', $siswa->id) }}" class="btn btn-md btn-primary">Edit</a>
        @endcan
        @can('siswa-delete')
        <form onsubmit="return confirm('Apakah Anda yakin?');" action="{{ route('siswas.destroy', $siswa->id) }}" method="POST">
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
    Data Siswa Belum Tersedia
  </div>
 @endforelse
 </tbody>
</table>
{{ $siswas->links() }}
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