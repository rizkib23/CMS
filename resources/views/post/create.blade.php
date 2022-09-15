@extends('layouts.dashboard')

@section('title')
Ocoding | Dashboard - {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('post.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h1 class="h3 mb-0 text-gray-800">Create Post</h1>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex align-items-stretch">
                            <div class="col-md-8">
                                <!-- Judul -->
                                <div class="form-group">
                                    <label for="input_post_judul" class="font-weight-bold">
                                        Judul
                                    </label>
                                    <input id="input_post_judul" name="judul" type="text" value="{{ old('title') }}" class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan Judul Post" />
                                </div>
                                <!-- thumbnail -->
                                <div class="form-group">
                                    <label for="input_post_thumbnail" class="font-weight-bold">
                                        Thumbnail
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button id="button_post_thumbnail" data-input="input_post_thumbnail" data-preview="holder" 
                                                class="btn btn-primary" type="button">
                                                Browse
                                            </button>
                                        </div>
                                        <input id="input_post_thumbnail" name="thumbnail" type="text"
                                            class="form-control @error('thumbnail') is-invalid @enderror" placeholder="Thumbnail Post" readonly />
                                    </div>
                                </div>
                                <div id="holder">
                                </div>
                                <!-- description -->
                                <div class="form-group">
                                    <label for="input_post_deskripsi" class="font-weight-bold">
                                        Deskripsi
                                    </label>
                                    <textarea id="input_post_deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Masukkan Deskripsi Post" class="form-control @error('deskripsi') is-invalid @enderror"
                                        rows="5"></textarea>
                                </div>
                                <!-- content -->
                                <div class="form-group">
                                    <label for="input_post_content" class="font-weight-bold">
                                        Content
                                    </label>
                                    <textarea id="input_post_content" name="content" value="{{ old('content') }}" placeholder="Masukkan Content Post" class="form-control @error('content') is-invalid @enderror"
                                        rows="20"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- catgeory -->
                                <div class="form-group">
                                    <label for="input_post_kategori" class="font-weight-bold">
                                        Kategori
                                    </label>
                                    <div class="form-control overflow-auto-responsive" style="height: 310px">
                                        <!-- List Kategori -->
                                        <ul class="pl-1 my-1" style="list-style: none;">
                                            <select class="form-control @error('kategori') is-invalid @enderror" id="kategori-option" name="kategori_id"
                                                data-placeholder="Pilih Kategori">
                                                @foreach ($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                                @endforeach
                                            </select>
                                        </ul>
                                        <!-- List Kategori -->
                                    </div>
                                </div>
                                <!-- tag -->
                                <div class="form-group">
                                    <label for="select_post_tag" class="font-weight-bold">
                                        Tag
                                    </label>
                                    <div class="form-control overflow-auto-responsive" style="height: 490px">
                                        <ul class="pl-1 my-1" style="list-style: none;">
                                            <select class="tag-responsive form-control custom-select w-100 @error('tag') is-invalid @enderror"
                                                id="select_post_tag" name="tag[]" data-placeholder="Pilih Tag"
                                                multiple="multiple">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- status -->
                        <div class="form-group">
                            <label for="select_post_status" class="font-weight-bold">
                                Status
                            </label>
                            <select id="select_post_status" name="status" class="custom-select">
                                @foreach ($statuses as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-right">
                                    <a class="btn btn-warning px-4" href="{{ route('post.index') }}">Back</a>
                                    <button type="submit" class="btn btn-primary px-4">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('css-external')
        <link rel="stylesheet" href="{{ asset('../vendor/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('../vendor/select2/css/select2-bootstrap4.min.css') }}">
        {{-- multiple-select2 --}}
        <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    @endpush

    @push('javascript-external')
        <script src="{{ asset('../vendor/select2/js/select2.full.min.js') }}"></script>
        {{-- filemanager --}}
        <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
        {{-- Tinymce5 --}}
        <script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
        <script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
        {{-- multiple-select2 --}}
        <script src="{{ asset('js/select2.min.js') }}"></script>
        <script>
            //Multiple Select
            $(document).ready(function() {
                $('.tag-responsive').select2({
                    multiple: true,
                });
            });
        </script>
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
                // TextEditor TinyMCE5
                $("#input_post_content").tinymce({
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
                //file manager
                $('#button_post_thumbnail').filemanager('image');
            });
        </script>
    @endpush
@endsection
