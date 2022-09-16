@extends('layouts.main')

@section('title')
Ocoding Bog | {{ $title }}
@endsection
@section('container')
    <!-- Title -->
    <h2 class="mt-4 mb-3 text-center">
        {{ $title }}
    </h2>
    
    <div class="row">
        <div class="col-lg-12">
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
                           <h2 class="card-title">{{ $dtpost->judul }}</h2>
                           <p class="card-text">{{ $dtpost->deskripsi }}</p>
                           <a href="{{ route('post-detail', ['slug' => $dtpost->slug]) }}" class="btn btn-primary">
                            Selengkapnya
                        </a>
                        <div class="mt-4">
                            di buat Oleh :{{ucwords($dtpost->dataUser->name) }} <br> {{ $dtpost->created_at }}
                        </div>
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
@endsection
