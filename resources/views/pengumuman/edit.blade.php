@extends('../layouts/dashboard')
@section('title')
Ocoding | Dashboard - {{ $title }}
@endsection
@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-12">
          <div class="card border-info bg-light">
                <div class="card-header text-center bg-primary text-white">
                    <h1> Buat Pengumuman </h1> 
                </div>
                <div class="card-body">
                    <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <label><h4>Judul :</h4></label>
                            <input type="text" autocomplete="off"  name="judul" required class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $pengumuman->judul) }}" style="text-transform: capitalize;" autofocus >
                            @error('judul')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="form-group">
                            <label><h4>Isi :</h4></label>
                            <textarea type="text" name="isi" id="inputPengumuman" required class="form-control @error('isi') is-invalid @enderror" rows="15" autofocus >{!! old('isi', $pengumuman->isi) !!}</textarea>
                            @error('isi')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                        <div class="float-right">
                          <a class="btn btn-outline-warning px-4" href="/pengumuman">
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