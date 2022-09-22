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
                    <h1> Buat Pengumuman </h1> 
                </div>
                <div class="card-body">
                    <form action="{{ route('pengumuman.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label><h4>Judul</h4></label>
                            <input type="text" name="judul"  class="form-control  @error('judul') is-invalid @enderror" autofocus style="text-transform: capitalize;">
                            @error('judul')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label><h4>Isi</h4></label>
                            <textarea type="text" name="isi" id="inputPengumuman" class="form-control  @error('isi') is-invalid @enderror" rows="15" autofocus></textarea>
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
@push('javascript-external')
 {{-- Tinymce5 --}}
 <script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
 <script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
@endpush
@push('javascript-internal')
<script>
  $(function(){
    $("#inputPengumuman").tinymce({
      relative_urls: false,
      language: "en",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern",
      ],
      toolbar1: "fullscreen preview",
      toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    });
  })
</script>
@endpush