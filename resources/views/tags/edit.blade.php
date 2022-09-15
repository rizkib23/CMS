@extends('../layouts/dashboard')

@section('title')
Ocoding | Dashboard - {{ $title }}
@endsection
@section('breadcrumbs')

    <div class="card-body py-5">
        <form action="{{ route('tags.update',$tags->id) }}" method="POST">
            @method('put')
            @csrf
            <div class="form-group">
                <label>Nama Tag</label>
                <input type="text" name="nama_tag" value="{{ $tags->nama_tag }}" required class="form-control">
            </div>

            <button type="submit" class="btn btn-success berhasil">SIMPAN</button>
            <button type="reset" class="btn btn-warning">RESET</button>

        </form>
    </div>

    @endsection