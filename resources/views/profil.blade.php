@extends('layouts.main')

@section('container')

<div class="container-fluid mt-5">
    <div class="row">
      <div class="col-mb-8">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img src="" alt="profil" class="profile-user-img img-responsive img-circle">
            </div>
            <h3 class="profile-username text-center"> {{ Auth::user()->name }}</h3>
            <p class="text-muted text-center">Member sejak : {{ Auth::user()->created_at }}</p>
            <hr>
            <strong>
              <i class="fa-solid fa-phone"></i>
              No HP
            </strong>
            <p class="text-muted">
                {{ Auth::user()->dataProfil->no_tlp }}
            </p>
            <hr>
            <strong>
              <i class="fas fa-envelope mr-2"></i>
              Email
            </strong>
            <p class="text-muted">
                {{ Auth::user()->email }}
            </p>
            <hr>
            <strong>
              <i class="fa fa-venus-mars"></i>
              Jenis Kelamin
            </strong>
            <p class="text-muted">
                {{ Auth::user()->dataProfil->jenis_kelamin }}
            </p>
            <a href="{{ route('profil.edit', $profil->id) }}" class="btn btn-primary btn-block">Setting</a>
          </div>
        </div>      
      </div>
@endsection
