
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

@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif

{!! Form::model($kelas, ['method' => 'PATCH','route' => ['kelas.update', $kelas->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Nama Kelas','class' => 'form-control')) !!}
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
{!! Form::close() !!}

@endsection
