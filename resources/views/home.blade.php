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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
