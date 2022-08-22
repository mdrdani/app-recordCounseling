
@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.min.css">
@endsection


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Siswa</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('siswas.index') }}"> Back</a>
        </div>
    </div>
</div>

<form action="{{ route('siswas.update', $siswa->id) }}" method="POST" >
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Nama Siswa</strong>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $siswa->name) }}">
                            
                                <!-- error message untuk title -->
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Nomor Induk Siswa</strong>
                <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" autocomplete="off" value="{{ old('nis', $siswa->nis) }}">
                            
                                <!-- error message untuk title -->
                                @error('nis')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Jenis Kelamin</strong>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                    <option value="">Pilih Jenis Kelamin</option>
                      <option {{ $siswa->jenis_kelamin == "Laki-Laki" ? "selected" : "" }} value="Laki-Laki">Laki - Laki</option>
                      <option {{ $siswa->jenis_kelamin == "Perempuan" ? "selected" : "" }} value="Perempuan">Perempuan</option>
                  </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Tanggal Lahir</strong>
                <input type="text" id="from-datepicker" name="tanggal_lahir" class="form-control" autocomplete="off" value="{{ $siswa->tanggal_lahir }}">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Kelas</strong>
                <select name="kelas_id" id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror">
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelas as $id => $k)
                            <option value="{{$id}}" {{ $id == $siswa->kelas_id ? 'selected' : '' }}>{{$k}}</option>
                    @endforeach
                  </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
            <button type="submit" class="btn btn-md btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<script>
$( document ).ready(function() {     
$("#from-datepicker").datepicker({          
format: 'yyyy-mm-dd' //can also use format: 'dd-mm-yyyy'     
});      
});  
</script>
@endsection
