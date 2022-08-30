
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>

<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama">
                @error('name')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukan Email">
                @error('email')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Username:</strong>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukan username">
                @error('username')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukan Password Minimal 2 Karakter">
                @error('password')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                <input type="password" name="confirm-password" class="form-control @error('confirm-password') is-invalid @enderror" placeholder="Konfirmasi Password">
                @error('confirm-password')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>


@endsection
