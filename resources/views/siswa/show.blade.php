
@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-primary mb-2" href="{{ route('siswas.index') }}"> Back</a>
            @can('note-create')
            <a class="btn btn-success mb-2" href="{{ route('notes.create', $siswa->id) }}"> Buat Laporan Konseling</a>
            @endcan
        </div>
    </div>
</div>


<div class="row">
    <div class="container">
        <div class="main-body">
              <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                        @if( $siswa->jenis_kelamin == "Laki-Laki")
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                        @else
                        <img src="https://www.bootdey.com/img/Content/avatar/avatar3.png" alt="Admin" class="rounded-circle" width="150">
                        @endif
                        <div class="mt-3">
                          <h4>{{ $siswa->name }}</h4>
                          <p>Kelas {{ $siswa->Kelas->name }} - {{ $siswa->Kelas->User->name }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <div class="col-md-8">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <b>{{ $siswa->name }}</b>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Nomor Induk Siswa</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{ $siswa->nis }}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Jenis Kelamin</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{ $siswa->jenis_kelamin }}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Tanggal Lahir</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{ Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') }}
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Umur</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{ Carbon\Carbon::parse($siswa->tanggal_lahir)->age }} Tahun
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Dibuat :</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          {{ Carbon\Carbon::parse($siswa->created_at)->format('d M Y H:i') }} WIB
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @include('notes.index')
</div>
@endsection 