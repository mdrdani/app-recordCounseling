@if(!$notes->isEmpty())
<div class="col-2">
  <div id="list-example" class="list-group">
    @foreach ($notes as $key => $note)
    <a class="list-group-item list-group-item-action" href="#list-item-{{ $key+1 }}"><i class="bi bi-bookmark-check"></i> Konseling-{{ $key+1 }}</a>
    @endforeach
  </div>
</div>

<div class="col-10">
  <div data-bs-spy="scroll" data-bs-target="#list-example" style="overflow-y: scroll; height:450px" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
    @foreach($notes as $key => $note)  
      <h3 id="list-item-{{ $key+1 }}">Konseling-{{ $key+1 }}</h3>
      <h5><strong>Permasalahan : </strong></h5>
      <h5>{!! $note->masalah !!}</h5> 
      <span>Dibuat Tanggal : {{ Carbon\Carbon::parse($note->created_at)->translatedFormat('l, j F Y ; h:i a') }} WIB<br> Oleh : {{ $note->User->name }} </span>
      <br>
      @can('note-list')
      <a href="{{ route('notes.show', ['id' => $note->siswa_id, 'note' => $note->id]) }}" class="btn btn-info btn-md "><i class="bi bi-journals"></i> Detail Catatan</a>
      @endcan
      <hr>
        @endforeach
    </div>
</div>
@else
<div class="alert alert-danger">
  Data Konseling Masih Kosong
</div>
@endif
