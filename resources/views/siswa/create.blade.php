
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Siswa</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('siswas.index') }}"> Back</a>
        </div>
    </div>
</div>

<form action="{{ route('siswas.store') }}" method="POST" >
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Nama Siswa</strong>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                            
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
                <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis">
                            
                                <!-- error message untuk title -->
                                @error('nis')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kelas</strong>
                <select name="kelas_id" id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror">
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelas as $k)
                      <option value="{{$k->id}}">{{$k->name}}</option>
                    @endforeach
                  </select>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
            <button type="submit" class="btn btn-md btn-primary">Submit</button>
            <button type="reset" class="btn btn-md btn-warning">Reset</button>
        </div>
    </div>
</form>
@endsection
