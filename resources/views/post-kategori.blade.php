@extends('layouts.main')

@section('title')
    {{ ['name' => 'kategori->name'] }}
@endsection
@section('container')
    <!-- Title -->
    <h2 class="mt-4 mb-3">
        {{ ['name' =>'kategori->name'] }}
    </h2>
    
    <div class="row">
        <div class="col-lg-8">
            <!-- Post list:start -->
            @forelse ($posts as $dtpost)
            <div class="card mb-4">
               <div class="card-body">
                   <div class="row">
                       <div class="col-lg-6">
                           <!-- tumbnail -->
                           <img class="img-fluid rounded" src="{{ asset('storage/..' . $dtpost->thumbnail) }}" alt="Post">
                       </div>
                       <div class="col-lg-6">
                           <h2 class="card-title">{{ $dtpost->title }}</h2>
                           <p class="card-text">{{ $dtpost->deskripsi }}</p>
                           <a href="" class="btn btn-primary">
                               Selengkapnya
                           </a>
                       </div>
                   </div>
               </div>
           </div>
            @empty
               <!-- empty -->
            <h3 class="text-center">
               Tidak Ada Data
           </h3>
            @endforelse
            
            
            <!-- Post list:end -->
        </div>
        <div class="col-md-4">
            <!-- Categories list:start -->
            <div class="card mb-1">
                <h5 class="card-header">
                    Categories
                </h5>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li>
                            <a href="">
                                Category title
                            </a>
                            <!-- category descendants:start -->

                            <!-- category descendants:end -->
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Categories list:end -->
        </div>
    </div>
@endsection
