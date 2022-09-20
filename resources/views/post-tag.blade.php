@extends('layouts.main')

@section('title')
    Ocoding Bog | {{ $title }}
@endsection
@section('container')
    <!-- Title -->
    <div class="bg-info position-relative overlay-bottom py-4" style="margin-bottom: auto">
        <div class="text-center">
            <img src="/image/tag.png" class="img-fluid" alt="Tag">
        </div>
        <h2 class="text-white mt-4 mb-3 text-center">
            {{ $title }}
        </h2>
    </div>
    <br>
    <main class="container border py-5">
        <div class="row">
            <div class="col-lg-12">
                <!-- Post list:start -->
                @forelse ($posts as $dtpost)
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- tumbnail -->
                                    <img class="img-fluid rounded" src="{{ asset('storage/.' . $dtpost->thumbnail) }}"
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
                        Tidak Ada Data
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
@endsection
