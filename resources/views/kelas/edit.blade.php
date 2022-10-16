
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Update Class</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('kelas.index') }}"> Back</a>
        </div>
    </div>
</div>


<form action="{{ route('kelas.update', $kelas->id) }}" method="POST">
@csrf
@method('PUT')
<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
        <div class="form-group">
            <strong>Jenjang Kelas:</strong>
            <select name="jenjang" id="jenjang" class="form-control @error('jenjang') is-invalid @enderror">
                <option value="">Pilih Jenjang</option>
                <option {{ $kelas->jenjang == "TNTK" ? "selected" : "" }} value="TNTK">TNTK</option>
                <option {{ $kelas->jenjang == "SD" ? "selected" : "" }} value="SD">SD</option>
                <option {{ $kelas->jenjang == "SMP" ? "selected" : "" }} value="SMP">SMP</option>
                <option {{ $kelas->jenjang == "SMA" ? "selected" : "" }} value="SMA">SMA</option>
              </select>
              <!-- error message untuk title -->
              @error('jenjang')
                      <div class="alert alert-danger mt-2">
                          {{ $message }}
                      </div>
              @enderror
        </div>
    </div>

  <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
          <strong>Name:</strong>
          <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $kelas->name) }}" placeholder="Masukkan Judul Post">
                            
                                <!-- error message untuk title -->
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
      </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
          <strong>Wali Kelas:</strong>
          <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
              <option value="">Pilih Wali Kelas</option>
              @foreach ($wali_kelas as $id => $wali)
                <option value="{{$id}}" {{ $id == $kelas->user_id ? 'selected' : '' }}>{{$wali}}</option>
              @endforeach
            </select>
      </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="form-group">
          <strong>Tahun Ajaran:</strong>
          <select name="tahunajaran_id" id="tahunajaran_id" class="form-control @error('tahunajaran_id') is-invalid @enderror">
              <option value="">Pilih Tahun Ajaran</option>
              @foreach ($tahun_ajaran as $id => $tahun)
                <option value="{{$id}}" {{ $id == $kelas->tahunajaran_id ? 'selected' : '' }}>{{$tahun}}</option>
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
