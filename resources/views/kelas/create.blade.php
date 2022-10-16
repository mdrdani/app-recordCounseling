
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
    <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
        <div class="form-group">
            <strong>Jenjang Kelas:</strong>
            <select name="jenjang" id="jenjang" class="form-control @error('jenjang') is-invalid @enderror">
                <option value="">Pilih Jenjang</option>
                <option value="TNTK">TNTK</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
              </select>
              <!-- error message untuk title -->
              @error('jenjang')
                      <div class="alert alert-danger mt-2">
                          {{ $message }}
                      </div>
              @enderror
        </div>
    </div>

  <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
    <strong>Nama Kelas:</strong>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Kelas" autocomplete="off">

    <!-- error message untuk title -->
    @error('name')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
    @enderror
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
      <div class="form-group">
          <strong>Wali Kelas:</strong>
          <select name="user_id" id="user_id" class="js-example-basic-single form-control @error('user_id') is-invalid @enderror">
            </select>
            @error('user_id')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
      </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-12 mb-2">
      <div class="form-group">
          <strong>Tahun Ajaran:</strong>
          <select name="tahunajaran_id" id="tahunajaran_id" class="form-control @error('tahunajaran_id') is-invalid @enderror">
              <option value="">Pilih Tahun Ajaran</option>
              @foreach ($tahun_ajarans as $tahun)
                <option value="{{$tahun->id}}">{{$tahun->tahun}}</option>
              @endforeach
            </select>
            <!-- error message untuk title -->
            @error('tahunajaran_id')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
            @enderror
      </div>
  </div>
  
  <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
      <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</div>
</form>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('#user_id').select2({
        placeholder: 'Cari Nama Wali Kelas',
        ajax: {
            url : '/ajax/kelas/search',
            processResults: function(data) {
                return {
                    results: data.map(function(item) {return {id: item.id, text:item.name}})
                }
            }
        }
    });
</script>
@endsection
