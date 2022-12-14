
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
      <div class="pull-left">
        <h2>Catatan {{ $siswa->name }}</h2>
    </div>
        <div class="pull-right">
            <a class="btn btn-primary mb-2" href="{{ route('siswas.show', $siswa->id) }}"><i class="bi bi-backspace"></i> Kembali</a>
            @can('note-edit')
            <a class="btn btn-warning mb-2" href="{{ route('notes.edit', ['id' => $siswa->id, 'note' => $note->id]) }}"><i class="bi bi-pencil-square"></i> Edit Catatan</a>
            @endcan
        </div>
    </div>
</div>

<div class="row">
    <div class="container">
        <div class="col-md-12">
            <div class="card mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Tanggal Konsultasi</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <b>{{ Carbon\Carbon::parse($note->tanggal)->translatedFormat('l, j F Y') }}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Masalah</h6>
                  </div>
                  <div class="col-sm-9">
                    {!! $note->masalah !!}
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Penanganan</h6>
                  </div>
                  <div class="col-sm-9">
                    @if($note->penanganan != NULL)
                    {!! $note->penanganan !!}
                    @else
                        Tidak Ada Penanganan
                    @endif
                  </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Lampiran Tambahan</h6>
                    </div>
                    <div class="col-sm-9">
                        @if($note->foto != NULL)
                            <img src="{{ Storage::url('public/lampiranNote/').$note->foto }}" alt="" class="rounded poto-poto" style="width: 50%">
                        @else
                        Tidak Ada Lampiran
                      @endif
                    </div>
                  </div>
                
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Dibuat :</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ Carbon\Carbon::parse($note->created_at)->translatedFormat('l, j F Y ; h:i a') }} WIB.  Oleh {{ $note->User->name }}
                  </div>
                </div>

                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Diupdate :</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ Carbon\Carbon::parse($note->updated_at)->translatedFormat('l, j F Y ; h:i a') }} WIB
                  </div>
                </div>

              </div>
            </div>
          </div>
    </div>
          
</div>
@endsection 

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('js/zoom-master/jquery.zoom.min.js') }}"></script>
    <script>
        $(document).ready(function(){
        $('.poto-poto')
            .wrap('<span style="display:block;"></span>')
            .css('display', 'block')
            .parent()
            .zoom();
        });
    </script>
@endsection