@extends('layouts.main')

@section('title')
    {{ request()->get('keyword') }}
@endsection
@section('container')
<!-- page title -->
<h2 class="my-3">
    {{ $title }}
 </h2>

<!-- Courses Start -->
<div class="container-fluid px-0 py-5">
    <div class="row mx-0 justify-content-center pt-5">
        <div class="col-lg-6">
            <div class="section-title text-center position-relative mb-4">
                <h1 class="display-4">Post</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
           <!-- Post list:start -->
           @forelse ($posts as $dtpost)
           <div class="card mb-4">
            <div class="card-body">
               <div class="row">
                  <div class="col-lg-6">
                     <!-- thumbnail:start -->
                        <!-- true -->
                        <img class="img-fluid rounded" src="{{ asset('storage/.' . $dtpost->thumbnail) }}" alt="Post">
                  </div>
                  <div class="col-lg-6">
                     <h2 class="card-title">{{ $dtpost->judul }}</h2>
                     <p class="card-text">{{ $dtpost->deskripsi }}</p>
                     <a href="{{ route('post-detail', ['slug' => $dtpost->slug]) }}" class="btn btn-primary">
                        Selengkapnya
                     </a>
                  </div>
               </div>
            </div>
         </div>
           @empty
               <!-- empty -->
           <h3 class="text-center">
            Belum Ada Data
         </h3>
           @endforelse
           
           
           <!-- Post list:end -->
        </div>
     </div>
     
     <!-- pagination:start -->
     @if ($posts->hasPages())
     <div class="row">
        <div class="col">
            {{ $posts->links() }}
        </div>
     </div>
     @endif
<!-- pagination:End -->
@endsection