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
                   <input id="input_kategori_slug" name="slug" type="text" value="{{ old('slug',$kategoris->slug) }}" class="form-control" readonly/>
                </div>
                <!-- thumbnail -->
                <div class="form-group">
                  <label for="input_kategori_thumbnail" class="font-weight-bold">
                      Thumbnail
                  </label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <button id="button_kategori_thumbnail" data-input="input_kategori_thumbnail"
                              data-preview="holder" class="btn btn-primary" type="file" >
                              Browse
                          </button>
                      </div>
                      <input id="input_kategori_thumbnail" name="thumbnail" type="text" value="{{ old('thumbnail', $kategoris->thumbnail) }}" class="form-control" placeholder="Thumbnail Kategori" readonly />
                  </div>
                  <div id="holder">
                  </div>
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
