
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
            <a class="btn btn-success" href="{{ route('siswas.create') }}"><i class="bi bi-plus-circle"></i> Buat Siswa Baru</a>
            @endcan
        </div>

        <form action="{{route('siswas.index')}}">

            <div class="input-group">
                <input 
                  type="text" 
                  class="form-control mb-2" 
                  placeholder="Cari Berdasarkan Nama Siswa"
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


<table class="table table-bordered table-responsive">
 <thead>
   <tr>
    <th><center>No</center></th>
    <th><center>Nama</center></th>
    <th><center>Jenjang</center></th>
    <th><center>Kelas</center></th>
    <th><center>Wali Kelas</center></th>
    <th><center>Tahun Ajaran</center></th>
    <th width="280px"><center>Action</center></th>
  </tr>
 </thead>
 <tbody>
  @forelse ($siswas as $key => $siswa)
  <tr>
    <td><center>{{ $siswas->firstItem() + $key }}</center></td>
    <td>{{ $siswa->name }}</td>
    <td><center>{{ $siswa->Kelas->jenjang}}</center></td>
    <td><center>{{ $siswa->Kelas->name}}</center></td>
    <td><center>{{ $siswa->Kelas->User->name }}</center></td>
    <td><center>{{ $siswa->Kelas->TahunAjaran->tahun }}</center></td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic Example">
        <a href="{{ route('siswas.show', $siswa->id) }}" class="btn btn-md btn-warning"><i class="bi bi-journals"></i> Lihat Catatan</a>
        @can('siswa-edit')
        <a href="{{ route('siswas.edit', $siswa->id) }}" class="btn btn-md btn-primary"><i class="bi bi-pencil-square"></i></a>
        @endcan
        @can('siswa-delete')
        <form onsubmit="return confirm('Apakah Anda yakin?');" action="{{ route('siswas.destroy', $siswa->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-md btn-danger"><i class="bi bi-x-circle"></i></button>
      </form>
      @endcan
    </div>
    </td>
  </tr>
  @empty
  <div class="alert alert-danger">
    Data Siswa Masih Kosong
  </div>
 @endforelse
 </tbody>
</table>
{{ $siswas->onEachSide(1)->links() }}
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