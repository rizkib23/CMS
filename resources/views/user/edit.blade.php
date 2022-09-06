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