@extends('../layouts/dashboard')
@section('title')
@endsection
@section('content')
<div class="container mt-5">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header text-center"><h4>Register</h4></div>

          <div class="card-body">
            <form method="POST" action="{{ route('user.store') }}">
                @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" autofocus value="{{ old('name') }}">
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                 @enderror
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                  Register
                </button>
              </div>
            </form>
          </div>
        </div>
       
      </div>
    </div>
  </div>
  @endsection