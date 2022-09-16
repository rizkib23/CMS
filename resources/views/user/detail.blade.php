@extends('../layouts/dashboard')
@section('title')
Ocoding | Dashboard - {{ $title }}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header text-center">
                    <h1> Detail User</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
  
                          @if($user->dataProfil->foto)
                              <img src="{{ asset('storage/' . $user->dataProfil->foto )}}" width="200px" class="img-thumbnail rounded mx-auto d-block">
                          @else
                              <img src="{{ asset('img/profil.jpg') }}" class="img-thumbnail rounded mx-auto d-block">
                          @endif     
                        </div>
                       
                        <div class="col-md-8">
  
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-start">Nama</label>
  
                                    <div class="col-md-6">
                                        <div class="form-control">{{ $user->name }}</div>
                                    </div>
                                </div>
  
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-start">Email</label>
  
                                    <div class="col-md-6">
                                        <div class="form-control">{{ $user->email }}</div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                  <label for="no_tlp" class="col-md-4 col-form-label text-md-start">No Hp</label>
                                  <div class="col-md-6">
                                      <div class="form-control">{{ $user->dataProfil->no_tlp }}</div>
                                  </div>
                              </div>
  
                              <div class="row mb-3">
                                  <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-start">Jenis kelamin</label>
  
                                  <div class="col-md-6">
                                      <div class="form-control">{{ $user->dataProfil->jenis_kelamin }}</div>
                                  </div>
                              </div>
  
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <a href="/user" class="btn btn-primary">
                                            {{ __('Back') }}
                                        </a>
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