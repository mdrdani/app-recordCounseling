
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Tahun Ajaran Management</h2>
        </div>
        <div class="pull-right mb-2">
            @can('tahunajaran-create')
            <a class="btn btn-success" href="{{ route('tahunajaran.create') }}"> Create New Tahun Ajaran</a>
            @endcan
        </div>
    </div>
</div>


<table class="table table-bordered">
 <thead>
   <tr>
    <th>No</th>
    <th>Tahun</th>
    <th width="280px">Action</th>
  </tr>
 </thead>
 <tbody>
  @forelse ($tahunajarans as $key => $tahun)
  <tr>
    <td><center>{{ ++$key }}</center></td>
    <td>{{ $tahun->tahun }}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic Example">
            @can('tahunajaran-edit')
        <a href="{{ route('tahunajaran.edit', $tahun->id) }}" class="btn btn-md btn-primary">Edit</a>
        @endcan

        @can('tahunajaran-delete')
        <form onsubmit="return confirm('Apakah Anda yakin?');" action="{{ route('tahunajaran.destroy', $tahun->id) }}" method="POST">
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
    Data Tahun Ajaran Belum Tersedia
  </div>
 @endforelse
 </tbody>
</table>
{{ $tahunajarans->links() }}
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