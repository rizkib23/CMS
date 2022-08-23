@extends('dashboard.layouts.main')

@section('title')
    
@endsection

@section('breadcrumbs')
    
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-body">
             <form action="{{ route('kategori.store') }}" method="POST">
               @csrf
                <!-- title -->
                <div class="form-group">
                   <label for="input_kategori_name" class="font-weight-bold">
                      Nama
                   </label>
                   <input id="input_kategori_name" name="name" type="text" class="form-control" placeholder="Masukkan Nama Kategori" required/>
                </div>
                <!-- slug -->
                <div class="form-group">
                   <label for="input_kategori_slug" class="font-weight-bold">
                      Slug
                   </label>
                   <input id="input_kategori_slug" name="slug" type="text" class="form-control" placeholder="Slug Kategori" />
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

@endsection
@push('css-external')
   <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
   <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
@endpush
@push('javascript-external')
   <link rel="stylesheet" href="{{ asset('vendor/select2/js/select2.full.min.js') }}">
   
@endpush
