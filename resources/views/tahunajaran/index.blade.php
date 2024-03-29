
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
            <a class="btn btn-success" href="{{ route('tahunajaran.create') }}"><i class="bi bi-plus-circle"></i> Buat Tahun Ajaran Baru</a>
            @endcan
        </div>
    </div>
</div>


<table class="table table-bordered table-responsive">
 <thead>
   <tr>
    <th><center>No</center></th>
    <th>Tahun</th>
    <th width="280px">Action</th>
  </tr>
 </thead>
 <tbody>
  @forelse ($tahunajarans as $key => $tahun)
  <tr>
    <td><center>{{ $tahunajarans->firstItem() + $key }}</center></td>
    <td>{{ $tahun->tahun }}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic Example">
        @if($tahun->deleted_at == NULL)
        @can('tahunajaran-edit')
        <a href="{{ route('tahunajaran.edit', $tahun->id) }}" class="btn btn-md btn-primary"><i class="bi bi-pencil-square"></i></a>
        @endcan
        @endif
            

        @if($tahun->deleted_at == NULL)
        @can('tahunajaran-delete')
        <form onsubmit="return confirm('Apakah Anda yakin? Pastikan Siswa Yang Masih Aktif Sudah Di pindahkan Kelasnya !!');" action="{{ route('tahunajaran.destroy', $tahun->id) }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-md btn-danger"><i class="bi bi-x-circle"></i> Non-Aktif</button>
        @method('DELETE')
      </form>
      @endcan
      @else
      <form action="{{ route('tahunajaran.restore', $tahun->id) }}" method="POST" class="d-inline">
        @csrf
          <input type="submit" value="Aktifkan" class="btn btn-md btn-warning">
      </form>
      @endif

    </div>
    </td>
  </tr>
  @empty
  <div class="alert alert-danger">
    Data Tahun Ajaran Masih Kosong
  </div>
 @endforelse
 </tbody>
</table>
{{ $tahunajarans->onEachSide(1)->links() }}
@endsection 

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    //message with toastr
    @if(session()->has('success'))
    
    toastr.success('{{ session('success') }}', 'BERHASIL!', { positionClass: 'toast-bottom-right' });

    @elseif(session()->has('error'))

    toastr.error('{{ session('error') }}', 'GAGAL!', { positionClass: 'toast-bottom-right' });
        
    @endif
</script>
@endsection