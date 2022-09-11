@extends('../layouts/dashboard')

@section('title')
@endsection

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-2 text-gray-800">Kategori Create</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('kategoris.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- title -->
                        <div class="form-group">
                            <label for="input_kategori_name" class="font-weight-bold">
                                Nama 
                            </label>
                            <input id="input_kategori_name" name="name" type="text" class="form-control  @error('name') is-invalid @enderror"
                                placeholder="Masukkan Nama Kategori" value="{{ old('name') }}" required />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                        <!-- slug -->
                        <div class="form-group">
                            <label for="input_kategori_slug" class="font-weight-bold">
                                Slug
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button id="button_kategori_thumbnail" data-input="input_kategori_thumbnail" data-preview="holder"
                                        class="btn btn-primary" type="button">
                                        Browse
                                    </button>
                                </div>
                                <input id="input_kategori_thumbnail" name="thumbnail" value="" type="text"
                                    class="form-control" placeholder="Thumbnail Post" readonly  @error('thumbnail') is-invalid @enderror />
                                    @error('thumbnail')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                        </div>
                        <div id="holder">
                        </div>

                        <div class="float-right">

                            <a class="btn btn-warning px-4" href="/kategoris">Kembali</a>
                            <button type="submit" class="btn btn-primary px-4">Simpan</button>
                            <button type="reset" class="btn btn-danger px-4">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    @push('css-external')
        <link rel="stylesheet" href="{{ asset('../vendor/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('../vendor/select2/css/select2-bootstrap4.min.css') }}">
    @endpush

    @push('javascript-external')
        <script src="{{ asset('../vendor/select2/js/select2.full.min.js') }}"></script>
        {{-- filemanager --}}
        <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    @endpush

    @push('javascript-internal')
        <script>
            $(function() {
                // generateSlug 
                function generateSlug(value) {
                    return value.trim()
                        .toLowerCase()
                        .replace(/[^a-z\d-]/gi, '-')
                        .replace(/-+/g, '-').replace(/^-|-$/g, "");
                }
                // event:input name kategori
                $('#input_kategori_name').change(function() {
                    let name = $(this).val();
                    $('#input_kategori_slug').val(generateSlug(name));
                });  
                //file manager
                $('#button_kategori_thumbnail').filemanager('image');
            });
        </script>
    @endpush
@endsection
