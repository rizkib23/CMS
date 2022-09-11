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
                    <form action="{{ route('pengumuman.store') }}" method="POST">
                        @csrf
                        <div class="form-group text-center">
                            <label>Judul</label>
                            <input type="text" name="judul"  class="form-control  @error('judul') is-invalid @enderror" autofocus>
                            @error('judul')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="form-group text-center">
                            <label><h5>Isi</h5></label>
                            <textarea type="text" name="isi"  class="form-control  @error('isi') is-invalid @enderror" rows="15" autofocus></textarea>
                            @error('isi')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
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