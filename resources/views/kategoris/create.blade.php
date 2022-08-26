@extends('../layouts/dashboard')

@section('title')
    
@endsection

@section('content')
<div class="container mt-4">
    <div class="row">
       <div class="col-12">
          <div class="card">
                <div class="card-header text-center">
                    <h1> Tambah Kategori </h1> 
                </div>
                <div class="card-body">
               <form action="{{ route('kategoris.store') }}" method="POST">
                   @csrf
                   <!-- title -->
                   <div class="form-group">
                       <label for="input_kategori_name" class="font-weight-bold">
                           Nama
                       </label>
                       <input id="input_kategori_name" name="name" type="text" class="form-control"
                           placeholder="Masukkan Nama Kategori" required />
                   </div>
                   <!-- slug -->
                   <div class="form-group">
                       <label for="input_kategori_slug" class="font-weight-bold">
                           Slug
                       </label>
                       <input id="input_kategori_slug" name="slug" type="text" class="form-control"
                           placeholder="Slug Kategori" readonly />
                   </div>
                   <!-- thumbnail -->
                   <div class="form-group">
                       <label for="input_kategori_thumbnail" class="font-weight-bold">
                           Thumbnail
                       </label>
                       <div class="input-group">
                           <div class="input-group-prepend">
                               <button id="button_kategori_thumbnail" data-input="input_kategori_thumbnail"
                                   data-preview="holder" class="btn btn-primary" type="file">
                                   Browse
                               </button>
                           </div>
                           <input id="input_kategori_thumbnail" name="thumbnail" type="text"
                               class="form-control" placeholder="Thumbnail Kategori" readonly />
                       </div>
                       <div id="holder">
                       </div>
                   </div>
                   <div class="float-right">
                       <a class="btn btn-warning px-4" href="{{ route('kategoris.index') }}">Kembali</a>
                       <button type="submit" class="btn btn-primary px-4">Simpan</button>
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
           
          //  event:input thumbnail
           $('#button_kategori_thumbnail').filemanager('image');
       });
   </script>
@endpush
 @endsection