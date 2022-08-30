
@extends('layouts.app')


@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Class Management</h2>
        </div>
        <div class="pull-right mb-2">
          @can('kelas-create')
            <a class="btn btn-success" href="{{ route('kelas.create') }}"> Create New Class</a>
            @endcan
        </div>
    </div>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Kelas</th>
      <th>Wali Kelas</th>
      <th>Tahun Ajaran</th>
      <th width="280px">Action</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($kelass as $key => $kelas)
     <tr>
       <td>{{ ++$key }}</td>
       <td>{{ $kelas->name }}</td>
       @if($kelas->user_id != Null)
               <td>{{ $kelas->User->name}}</td>
       @else
               <td><strong>Belum Ada Wali Kelas</strong></td>
       @endif
   
       @if($kelas->tahunajaran_id != Null)
               <td>{{ $kelas->TahunAjaran->tahun}}</td>
       @else
               <td><strong>Belum Ada Tahun Ajaran</strong></td>
       @endif
       <td>
        @can('kelas-edit')
         <a href="{{ route('kelas.edit', $kelas->id) }}" class="btn btn-md btn-primary">Edit</a>
        @endcan

        @can('kelas-delete')
         <form onsubmit="return confirm('Apakah Anda yakin?');" action="{{ route('kelas.destroy', $kelas->id) }}" method="POST">
         @csrf
         @method('DELETE')
         <button type="submit" class="btn btn-md btn-danger">Hapus</button>
       </form>
       @endcan
     </td>
     </tr>
     @empty
     <div class="alert alert-danger">
       Data Kelas Belum Tersedia
     </div>
    @endforelse
  </tbody>
</table>
{{ $kelass->links() }}
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