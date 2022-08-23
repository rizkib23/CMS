@extends('../layouts.main')

@section('container')
<link rel="stylesheet" href="css/style.css">

@if(session()->has('success'))
<div class="alert alert-danger alert-dismissble fade show" role="alert">
  {{ session('LoginError') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">  </button>
</div>
@endif

@if(session()->has('LoginError'))
<div class="form-signin alert alert-danger alert-dismissble fade show " role="alert">
  {{ session('LoginError') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">  </button>
</div>
@endif

<main class="form-signin w-100 m-auto">
    <form action="/login" method="POST">
      @csrf
      <h1 class="h3 mb-3 fw-normal text-center">Please Login</h1>
    <img class="mb-4" src="image/OC_logo.jpeg" alt="" width="300" height="200">

    <div class="form-floating">
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">

      <label for="email">Email address</label>
      @error('email')
      <div class="invalid-feedback">
     {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
      <label for="password">Password</label>
    </div>

    
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
 
  </form>
  <small class="d-block text-center mt-3">Belum Punya Akun ? <a href="/register">Buat Akun Sekarang!!</a></small>
</main>

@endsection
