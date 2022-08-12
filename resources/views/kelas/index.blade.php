
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Class Management</h2>
        </div>
        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New Class</a>
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
   <th>Kelas</th>
   <th>Wali Kelas</th>
   <th>Tahun Ajaran</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($kelass as $key => $kelas)
  <tr>
    <td>{{ ++$key }}</td>
    <td>{{ $kelas->name }}</td>
    @if($kelas->User->name != Null)
            <td>{{ $kelas->User->name}}</td>
    @else
            <td><strong>Belum Ada Wali Kelas</strong></td>
    @endif

    @if($kelas->TahunAjaran->tahun != Null)
            <td>{{ $kelas->TahunAjaran->tahun}}</td>
    @else
            <td><strong>Belum Ada Tahun Ajaran</strong></td>
    @endif
    <td>
       <a class="btn btn-info" href="{{ route('kelas.show',$kelas->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('kelas.edit',$kelas->id) }}">Edit</a>
       {!! Form::open(['method' => 'DELETE','route' => ['kelas.destroy', $kelas->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>
{{ $kelass->links() }}
@endsection 