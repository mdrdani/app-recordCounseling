
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        {{-- <div class="pull-left">
            <h2> User - {{ $siswa->name }}</h2>
        </div> --}}
        <div class="pull-right">
            <a class="btn btn-primary mb-2" href="{{ route('siswas.index') }}"> Back</a>
        </div>
    </div>
</div>


<div class="row">
    <div class="card border-info mb-3" style="max-width: 25rem;">
        <div class="card-header">Header</div>
        <div class="card-body">
          <h5 class="card-title">Info card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
</div>
@endsection 