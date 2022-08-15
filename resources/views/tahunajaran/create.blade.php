
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Tahun Ajaran</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('tahunajaran.index') }}"> Back</a>
        </div>
    </div>
</div>

<form action="{{ route('tahunajaran.store') }}" method="POST" >
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
            <div class="form-group">
                <strong>Tahun</strong>
                <input type="text" class="form-control @error('tahun') is-invalid @enderror" name="tahun" placeholder="Example : 2022-2023">
                            
                                <!-- error message untuk title -->
                                @error('tahun')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
            <button type="submit" class="btn btn-md btn-primary">Submit</button>
            <button type="reset" class="btn btn-md btn-warning">Reset</button>
        </div>
    </div>
</form>
@endsection
