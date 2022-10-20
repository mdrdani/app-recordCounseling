
@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Buat Catatan Konseling</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('siswas.show', $siswa->id) }}"><i class="bi bi-backspace"></i> Kembali</a>
        </div>
    </div>
</div>

<form action="{{ route('notes.store', $siswa->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" value="{{ $siswa->id }}" name="siswa_id">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Tanggal Konseling</strong>
                <input type="text" id="from-datepicker" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" autocomplete="off">

                @error('tanggal')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Permasalahan</strong>
                <textarea name="masalah" id="masalah" cols="30" rows="5" class="form-control @error('masalah') is-invalid @enderror"></textarea>

                @error('masalah')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Penanganan</strong>
                <textarea name="penanganan" id="penanganan" cols="30" rows="5" class="form-control"></textarea>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Lampiran Pendukung</strong>
                <input type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">

                @error('foto')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
            <button type="submit" class="btn btn-md btn-primary"><i class="bi bi-save"></i> Simpan</button>
            <button type="reset" class="btn btn-md btn-warning"><i class="bi bi-x-octagon"></i> Reset</button>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
$( document ).ready(function() {     
$("#from-datepicker").datepicker({          
        format: 'yyyy-mm-dd', //can also use format: 'dd-mm-yyyy' 
        todayHighlight: true,
        autoclose : true
});      
});  
</script>
<script>
    CKEDITOR.replace( 'masalah' );
    CKEDITOR.replace( 'penanganan' );
</script>
<script>
    //message with toastr
    @if(session()->has('success'))
    
        toastr.success('{{ session('success') }}', 'BERHASIL!'); 

    @elseif(session()->has('error'))

        toastr.error('{{ session('error') }}', 'GAGAL!'); 
        
    @endif
</script>
@endsection

