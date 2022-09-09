@extends('../layouts/dashboard')
@section('title')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
  
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
  
                          @if(Auth::user()->dataProfil->foto)
                              <img src="{{ asset('storage/' . Auth::user()->dataProfil->foto )}}" width="200px" class="img-thumbnail rounded mx-auto d-block">
                          @else
                              <img src="{{ asset('img/profil.jpg') }}" class="img-thumbnail rounded mx-auto d-block">
                          @endif     
                        </div>
                       
                        <div class="col-md-8">
                            <form method="POST" action="{{ route('profil.update', Auth::user()->dataProfil->id) }}" enctype="multipart/form-data">
                              @csrf
                              @method("PUT")
  
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-start">Nama</label>
  
                                    <div class="col-md-6">
                                        <input id="name" type="text" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror" name="name" required>
  
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
  
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-start">Email</label>
  
                                    <div class="col-md-6">
                                        <input id="email" type="email" value="{{ Auth::user()->email }}" class="form-control @error('email') is-invalid @enderror" name="email" value="" required>
  
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
  
                                <div class="row mb-3">
                                  <label for="no_tlp" class="col-md-4 col-form-label text-md-start">No Hp</label>
                                  <div class="col-md-6">
                                      <input type="number" value="{{ Auth::user()->dataProfil->no_tlp }}" class="form-control @error('no_tlp') is-invalid @enderror"  name="no_tlp">
                                      @error('no_tlp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                  </div>
                              </div>
  
                              <div class="row mb-3">
                                  <label for="jenis_kelamin" class="col-md-4 col-form-label text-md-start">Jenis kelamin</label>
  
                                  <div class="col-md-6 @error('jenis_kelamin') is-invalid @enderror">
                                      <input type="radio" value="Laki-laki" {{ Auth::user()->dataProfil->jenis_kelamin == 'Laki-laki' ? 'checked' : ''  }} name="jenis_kelamin">Laki-Laki
                                      <input type="radio" value="Perempuan" {{ Auth::user()->dataProfil->jenis_kelamin == 'Perempuan' ? 'checked' : ''  }} name="jenis_kelamin">Perempuan
                                      @error('jenis_kelamin')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                  </div>
                              </div>
  
  
                                <div class="row mb-3">
                                    <label for="foto" class="col-md-4 col-form-label text-md-start">Ganti Foto</label>
  
                                    <div class="col-md-6">
                                        <input id="foto" value="" type="file" class="form-control" name="foto">
                                    </div>
                                </div>
  
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update Profile') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  @endsection