
@extends('layouts.app')

@section('content')
<div class="row mb-2">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Tahun Ajaran</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('tahunajaran.index') }}"><i class="bi bi-backspace"></i> Kembali</a>
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

{!! Form::model($tahunajaran, ['method' => 'PATCH','route' => ['tahunajaran.update', $tahunajaran->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tahun:</strong>
            {!! Form::text('tahun', null, array('placeholder' => 'Ex : 2023-2024','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
    </div>
</div>
{!! Form::close() !!}

@endsection
