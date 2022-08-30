@extends('dashboard.layouts.main')

@section('title')   
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{ route('kategori.update', $kategoris->id) }}" method="POST">
               @method('put')
               @csrf
                <!-- title -->
                <div class="form-group">
                   <label for="input_kategori_name" class="font-weight-bold">
                      Nama
                   </label>
                   <input id="input_kategori_name" name="name" type="text" value="{{ old('name', $kategoris->name) }}" class="form-control" />
                </div>
                <!-- slug -->
                <div class="form-group">
                   <label for="input_kategori_slug" class="font-weight-bold">
                      Slug
                   </label>
                   <input id="input_kategori_slug" name="slug" type="text" value="{{ old('slug', $kategoris->slug) }}" class="form-control" readonly/>
                  </div>
                <!-- thumbnail -->
                <div class="form-group">
                  <label for="thumbnail">Thumbnail</label>
                      <input class="form-control" type="file" id="thumbnail" name="thumbnail" value="{{ old('thumbnail', $kategoris->thumbnail) }}" readonly />
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
       function generateSlug(value){
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

 //  event:input thumbnail
 $('#button_kategori_thumbnail').filemanager('image');
    });
 
 </script>
 @endpush
@endsection
