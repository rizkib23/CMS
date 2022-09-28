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
    <div class="bg-info position-relative overlay-bottom py-4" style="margin-bottom: auto">
        <div class="text-center">
            <img src="/img/grid-fill.svg" width="100px" class="img-fluid" alt="Post">
            <h1 class="text-white mt-4 mb-4">Post</h1>
        </div>
        
    </div>  
    <main class="container border py-5 mt-5">
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
                                    <img class="img-fluid rounded" src="{{ asset('storage/..' . $dtpost->thumbnail) }}"
                                        alt="Post">
                                </div>
                                <div class="col-lg-6 my-2">
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
                    {{ $posts->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
    </main>
    <!-- pagination:End -->
@endsection
