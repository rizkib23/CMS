@extends('../layouts/dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-2 text-gray-800">Kategori Edit</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('kategoris.update', $kategoris->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <!-- title -->
                        <div class="form-group">
                            <label for="input_kategori_name" class="font-weight-bold">
                                Nama
                            </label>
                            <input id="input_kategori_name" name="name" type="text"
                                value="{{ old('name', $kategoris->name) }}" class="form-control" />
                        </div>
                        <!-- thumbnail -->
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            @if ($kategoris->thumbnail)
                                <img class="img-fluid img-thumbnail mb-2 col-sm-2 d-block"
                                    src="{{ asset('storage/' . $kategoris->thumbnail) }}" />
                            @else
                                <img class="img-preview img-fluid mb-3 col-sm-5 d-block" width="200px">
                            @endif
                            <input class="form-control" type="file" id="thumbnail" name="thumbnail" readonly />
                        </div>

                        <div class="float-right">
                            <a class="btn btn-warning px-4" href="{{ route('kategori.index') }}">Kembali</a>
                            <button type="submit" class="btn btn-primary px-4">Simpan</button>
                        </div>
                    </form>
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
        <script src="{{ asset('../vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
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
            });
        </script>
    @endpush
@endsection
