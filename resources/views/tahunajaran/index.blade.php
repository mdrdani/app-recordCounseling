
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Tahun Arajan Management</h2>
        </div>
        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('tahunajaran.create') }}"> Create New Tahun Ajaran</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Tahun</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($tahunajarans as $key => $tahun)
  <tr>
    <td><center>{{ ++$key }}</center></td>
    <td>{{ $tahun->tahun }}</td>
    <td>
       <a class="btn btn-primary" href="{{ route('tahunajaran.edit',$tahun->id) }}">Edit</a>
       {!! Form::open(['method' => 'DELETE','route' => ['tahunajaran.destroy', $tahun->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>
{{ $tahunajarans->links() }}
@endsection 