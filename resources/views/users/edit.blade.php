
@extends('layouts.app')


@section('content')
<div class="row mb-2">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit User {{ $user->name }}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"><i class="bi bi-backspace"></i> Kembali</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif


<form action="{{ route('users.update',$user->id ) }}" method="POST">
    @csrf
    @method('PUT')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            <input type="text" value="{{ old('name', $user->name) }}" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama">
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
            <input type="email" value="{{ old('email' , $user->email) }}" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukan Email">
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
            <input type="text" name="username" value="{{ old('username', $user->username) }}" class="form-control @error('username') is-invalid @enderror" placeholder="Masukan username">
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
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
    </div>
</div>
</form>

@endsection 