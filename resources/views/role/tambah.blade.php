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
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Role</label>
                    <input type="text" name="name" required  class="form-control">
                </div>
                <div class="row">
                @foreach ($authorities as $manageName => $permissions)
                
                    <ul class="list-group mt-2 mb-2 mr-3 ml-3">
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
                <div class="float-right mt-1">
                  <a class="btn btn-outline-warning px-4" href="/roles">
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
{{-- {{ in_array($permission, $rolePermissions) ? "checked" : null }} onclick="return false;" --}}


                @endsection