@extends('../layouts.dashboard')
@section('content')
<div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h1> Role {{ $roles->name }}</h1>
          </div>
          <div class="card-body">
            <div class="form-group">
              <div class="row">
              @forelse ($authorities as $manageName =>$permissions)
             
                <ul class="list-group mx-1 mt-1">
                  <li class="list-group-item">
                    {{ $manageName }}
                  </li>
                  @foreach($permissions as $permission)
                  <li class="list-group-item">
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" value="" {{ in_array($permission, $rolePermissions) ? "checked" : null }} onclick="return false;">
                      <label for="form-check-label">{{ $permission }}</label>
                    </div>
                  </li>
                  @endforeach
                </ul>
             
              @empty
                  
              @endforelse

            </div>
              <div class="d-flex justify-content-end">
                <a href="/roles" class="btn btn-primary">kembali</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection