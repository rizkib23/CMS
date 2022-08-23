@extends('../layouts/dashboard')

@section('breadcrumbs')

    <div class="card-body py-5">
        <form action="{{ route('tags.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Tag</label>
                <input type="text" name="nama_tag" required  class="form-control">
            </div>

            <button type="submit" class="btn btn-success berhasil">SIMPAN</button>
            <button type="reset" class="btn btn-warning">RESET</button>

        </form>
    </div>

    @endsection