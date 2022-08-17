
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Class</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('kelas.index') }}"> Back</a>
        </div>
    </div>
</div>


<form action="{{ route('kelas.store') }}" method="POST">
@csrf
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
    <label class="font-weight-bold">Nama Kelas</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Kelas" autocomplete="off">

    <!-- error message untuk title -->
    @error('name')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
          <strong>Wali Kelas:</strong>
          <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
              <option value="">Pilih Wali Kelas</option>
              @foreach ($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
              @endforeach
            </select>
      </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
          <strong>Tahun Ajaran:</strong>
          <select name="tahunajaran_id" id="tahunajaran_id" class="form-control @error('tahunajaran_id') is-invalid @enderror">
              <option value="">Pilih Tahun Ajaran</option>
              @foreach ($tahun_ajarans as $tahun)
                <option value="{{$tahun->id}}">{{$tahun->tahun}}</option>
              @endforeach
            </select>
      </div>
  </div>
  
  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
      <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</div>
</form>
@endsection
