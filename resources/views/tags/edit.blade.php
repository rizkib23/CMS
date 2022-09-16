@extends('../layouts/dashboard')

@section('title')
Ocoding | Dashboard - {{ $title }}
@endsection
@section('content')

<div class="container mt-2">
    <div class="row">
       <div class="col-12">
          <div class="card">
                <div class="card-header text-center">
                    <h1> Edit Tag </h1> 
                </div>
                <div class="card-body">
                    <form action="{{ route('tags.update',$tags->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label>Nama Tag</label>
                            <input type="text" name="name" value="{{ $tags->name }}" required class="form-control">
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-success px-3 berhasil">SIMPAN</button>
                            <button type="reset" class="btn btn-danger px-3">RESET</button>
                            <a class="btn btn-warning px-3" href="{{ route('tags.index') }}">KEMBALI</a>
                        </div>
                    </form>
                </div>
            </div>
       </div>
    </div>
</div>
    @endsection