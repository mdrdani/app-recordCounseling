<div class="col-2">
  <div id="list-example" class="list-group">
    @foreach ($notes as $key => $note)
    <a class="list-group-item list-group-item-action" href="#list-item-{{ $key+1 }}">Konseling-{{ $key+1 }}</a>
    @endforeach
  </div>
</div>

<div class="col-10">
  <div data-bs-spy="scroll" data-bs-target="#list-example" style="overflow-y: scroll; height:450px" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
    @foreach($notes as $key => $note)  
    <h3 id="list-item-{{ $key+1 }}"><u>Konseling-{{ $key+1 }}</u></h3>
    <h5><strong>Permasalahan : </strong></h5>
    <h5>{!! $note->masalah !!}</h5>
    
    <h5><strong>Penanganan : </strong></h5>
    <h5>{!! $note->penanganan !!}</h5>    
    <a href="#" class="btn btn-primary btn-sm mb-3">Detail Laporan</a>
      @endforeach
    </div>
</div>

