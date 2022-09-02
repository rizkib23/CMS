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
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Role</label>
                    <input type="text" name="nama_tag" required  class="form-control">
                </div>
                <div class="row">
                @foreach ($authorities as $manageName => $permissions)
                
                    <ul class="list-group mx-1 mt-1">
                        <li class="list-group-item">
                          {{ $manageName }}
                        </li>
                        @foreach($permissions as $permission)
                        <li class="list-group-item">
                          <div class="form-check">
                            <input id="{{ $permission }}" type="checkbox" class="form-check-input" value="{{ $permission }}">
                            <label for="form-check-label">{{ $permission }}</label>
                          </div>
                        </li>
                        @endforeach
                    </ul>
                @endforeach
                </div>
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
{{-- {{ in_array($permission, $rolePermissions) ? "checked" : null }} onclick="return false;" --}}


                @endsection