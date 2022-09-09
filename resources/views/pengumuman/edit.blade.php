@extends('../layouts/dashboard')

@section('content')

<div class="container mt-4">
    <div class="row">
       <div class="col-12">
          <div class="card">
                <div class="card-header text-center">
                    <h1> Buat Pengumuman </h1> 
                </div>
                <div class="card-body">
                    <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group text-center">
                            <label><h5>Judul</h5></label>
                            <input type="text" name="judul" required class="form-control" value="{{ old('judul', $pengumuman->judul) }}" autofocus >
                        </div>
                        <div class="form-group text-center">
                            <label><h5>Isi</h5></label>
                            <textarea type="text" name="isi" required class="form-control" rows="15" autofocus >{{ old('isi', $pengumuman->isi) }}</textarea>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-success px-3 berhasil">SIMPAN</button>
                            <button type="reset" class="btn btn-danger px-3">RESET</button>
                            <a class="btn btn-warning px-3" href="/pengumuman">KEMBALI</a>
                        </div>
                    </form>
                </div>
          </div>
       </div>
    </div>
</div>


    @endsection