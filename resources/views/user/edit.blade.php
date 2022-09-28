@extends('../layouts.dashboard')
@section('title')
Ocoding | Dashboard - {{ $title }}
@endsection
@section('content')
<div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-info bg-light">
          <div class="card-header text-center text-white bg-primary">
            <h1> Tambah Role </h1>
          </div>
          <div class="card-body">
            <form action="{{ route('user.update',$user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama </label>
                    <input type="text" name="name" readonly  class="form-control" value="{{ old('name', $user->name) }}">
                </div>
                <div class="form-group">
                    <label>Email </label>
                    <input type="email" name="email" readonly  class="form-control" value="{{ old('email', $user->email) }}">
                </div>
                @if (Auth::user()->hasRole('Super Admin'))
                <div class="form-group">
                  <label for="role">Role</label>                  
                      <select id="role" class="form-control" name="role" required>
                         @if(old('role',$rolesSelect))
                          <option value="{{ old('role', $rolesSelect->id) }}" selected>
                            {{ old('role', $rolesSelect->name) }}
                          </option>     
                          @else
                          @foreach ($roles as $role)
                          <option value="{{ $role->name }}">{{ $role->name }}</option>
                          @endforeach
                        @endif
                      </select>
                </div>
                @endif             
                <div class="form-group">
                  <label for="status">Status</label>

                  <div class="form-control @error('status') is-invalid @enderror">
                      <input type="radio" value="aktif" {{ $user->status == 'aktif' ? 'checked' : ''  }} name="status">Aktif
                      <input type="radio" value="nonaktif" {{$user->status == 'nonaktif' ? 'checked' : ''  }} name="status">NonAktif
                      @error('status')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  </div>
              </div>
                {{-- permisiion --}}
                <div class="float-right">
                  <a class="btn btn-outline-warning px-4" href="/user">
                      <i class="bi bi-backspace"></i>Back
                  </a>
                  <button type="reset" class="btn btn-outline-danger px-4">
                      <i class="bi bi-arrow-counterclockwise"></i>Reset
                  </button>
                  <button type="submit" class="btn btn-outline-primary px-4">
                      <i class="bi bi-save2"></i> Save
                  </button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection