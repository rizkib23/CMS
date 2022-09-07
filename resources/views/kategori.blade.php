@extends('layouts.main')

@section('container')
    <div class="bg-info position-relative overlay-bottom py-5" style="margin-bottom: auto">
        <div class="text-center">
            <img src="image/Kategori.png" class="img-fluid" alt="Kategori">
        </div>
        <h1 class="text-white mt-4 mb-4 text-center">Kategori</h1>
    </div>
     
     <!-- List category -->
     <div class="row">
        @forelse ($kategoris as $kategori)
            <!-- true -->
        <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
               <!-- thumbnail:start -->
               <!-- Thumbnail -->
                    <img class="img-fluid img-thumbnail" style="700x400" src="{{ asset('storage/..' . $kategori->thumbnail) }}"/>
               <!-- thumbnail:end -->         
               <div class="card-body">
                  <h4 class="card-title">
                     <a href="">
                        {{ $kategori->name }}
                     </a>
                  </h4>
               </div>
            </div>
         </div>
        @empty
            <!-- false -->
        <h3 class="text-center">
            No data
         </h3>
        @endforelse
     </div>
     <!-- List category -->
     
     <!-- pagination:start -->
     <div class="row">
        <div class="col">
     
        </div>
     </div>
     <!-- pagination:end -->
@endsection
