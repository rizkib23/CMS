@extends('../layouts.dashboard')

@section('title')
Ocoding | Dashboard - {{ $title }}
@endsection
@section('content')
<div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h1> Tambah Role </h1>
          </div>
          <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Role</label>
                    <input type="text" name="name" required  class="form-control">
                </div>
                <div class="row">
                @foreach ($authorities as $manageName => $permissions)
                
                    <ul class="list-group mx-1 mt-1">
                        <li class="list-group-item">
                          {{ucwords(str_replace("_"," ",$manageName)); }}
                        </li>
                        @foreach($permissions as $permission)
                        <li class="list-group-item">
                          <div class="form-check">
                            <input id="{{ $permission }}" type="checkbox" class="form-check-input" value="{{ $permission }}" name="permissions[]">
                            <label for="form-check-label">{{ ucwords(str_replace("_"," ",$permission)); }}</label>
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