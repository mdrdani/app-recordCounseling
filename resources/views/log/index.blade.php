
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Activity Log</h2>
        </div>
    </div>
</div>

<table class="table table-bordered table-responsive">
 <thead>
   <tr>
    <th>No</th>
    <th>User</th>
    <th>Aksi</th>
    <th>Waktu</th>
  </tr>
 </thead>
 <tbody>
  @forelse ($logs as $key => $log)
  <tr>
    <td><center>{{ $logs->firstItem() + $key }}</center></td>
    <td><strong>{{ $log->User->name }}</strong></td>
    <td><strong>{{ $log->method }}</strong></td>
    <td>{{ Carbon\Carbon::parse($log->created_at)->translatedFormat('l, j F Y ; h:i a') }} WIB</td>
    
  </tr>
  @empty
  <div class="alert alert-danger">
    Data Log Masih Kosong
  </div>
 @endforelse
 </tbody>
</table>
{{ $logs->onEachSide(1)->links() }}
@endsection 