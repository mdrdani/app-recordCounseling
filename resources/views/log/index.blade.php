
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Activity Log</h2>
        </div>
    </div>
</div>

<table class="table table-bordered">
 <thead>
   <tr>
    <th>No</th>
    <th>User</th>
    <th>Siswa</th>
    <th>Aksi</th>
    <th>Waktu</th>
  </tr>
 </thead>
 <tbody>
  @forelse ($logs as $key => $log)
  <tr>
    <td><center>{{ ++$key }}</center></td>
    <td>{{ $log->User->name }}</td>
    @if($log->siswa_id != NULL)
          <td>{{ $log->Siswa->name }}</td>
    @else
          <td>-</td>
    @endif
    <td><strong>{{ $log->method }}</strong></td>
    <td>{{ Carbon\Carbon::parse($log->created_at)->format('d M Y H:i') }} WIB</td>
    
  </tr>
  @empty
  <div class="alert alert-danger">
    Data Log Masih Kosong
  </div>
 @endforelse
 </tbody>
</table>
{{ $logs->links() }}
@endsection 