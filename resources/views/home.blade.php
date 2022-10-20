@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <img src="https://pbs.twimg.com/profile_images/1410453968/SDB_logo_400x400.jpg" alt="" width="30%" class="rounded mx-auto d-block">
                    <p class="h3 mt-2 text-center">Selamat Datang Di Aplikasi Record Counseling <br> Sekolah Darma Bangsa</p>
                    
                    <div class="container">
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Total Laki Laki</div>
                                    <div class="card-body">
                                      <h1 class="card-title text-center">{{ $totallaki }}</h1>
                                      <p class="card-text text-center">Siswa</p>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Total Perempuan</div>
                                    <div class="card-body">
                                      <h1 class="card-title text-center">{{ $totalperempuan }}</h1>
                                      <p class="card-text text-center">Siswi</p>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
                                    <div class="card-header">Total Keseluruhan</div>
                                    <div class="card-body">
                                      <h1 class="card-title text-center">{{ $totalall }}</h1>
                                      <p class="card-text  text-center">Siswa Siswi</p>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
