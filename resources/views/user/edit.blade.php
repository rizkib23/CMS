@extends('../layouts.dashboard')
@section('content')

<div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
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

                <div class="form-group">
                    <label for="role">Role</label>

                   
                        <select id="role" class="form-control" name="role" required >
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                </div>
                {{-- <div class="form-group">
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
              </div> --}}
                {{-- permisiion --}}
                <div class="float-right">
                    <button type="submit" class="btn btn-success px-3 berhasil">SIMPAN</button>
                    <button type="reset" class="btn btn-danger px-3">RESET</button>
                    <a class="btn btn-warning px-3" href="/roles">KEMBALI</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection