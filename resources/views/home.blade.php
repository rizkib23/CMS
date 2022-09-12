@extends('layouts.main')

@section('title')
    Ocoding Bog | {{ $title }}
@endsection

@section('container')
    {{-- awal --}}
    <div class="bg-info position-relative overlay-bottom py-5" style="margin-bottom: auto">
        <div class="container text-center my-5 py-5">
            <h1 class="text-white mt-4 mb-4">Belajar dimana aja</h1>
            <h1 class="text-white display-1 mb-5">Overload Coding</h1>
            <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">

                <form class="input-group my-1" action="{{ route('search-post') }}" method="GET">
                    <input name="keyword" type="search"
                        class="form-control border-light" style="padding: 30px 25px;" placeholder="Cari">
                    <div class="input-group-append">
                        <button class="btn btn-outline-light px-4 px-lg-5" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- --- --}}

    <!-- Courses Start -->
    <div class="container-fluid px-0 py-5">
        <div class="row mx-0 justify-content-center pt-5">
            <div class="col-lg-6">
                <div class="section-title text-center position-relative mb-4">
                    <h1 class="display-4">Post</h1>
                </div>
            </div>
        </div>
        <br>
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
                                    <img class="img-fluid rounded" src="{{ asset('storage/.' . $dtpost->thumbnail) }}"
                                        alt="Post">
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
        
        <div class="container-fluid px-0 py-5">
            <div class="row mx-0 justify-content-center pt-5">
                <div class="col-lg-6">
                    <div class="section-title text-center position-relative mb-4">
                        <h1 class="display-4">Tag</h1>
                    </div>
                </div>
            </div>

        <div class="card mb-4">
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col">
                             @forelse ($tag as $dttag)
                                 <!-- true -->
                                 <a href="{{ route('post-tag', ['slug'=> $dttag->slug]) }}"     
                                 class="badge badge-info py-3 px-5 my-2">#{{ $dttag->name }}</a>
                             @empty
                                 <!-- false -->
                                 <h3 class="text-center">
                                     No data
                                  </h3>
                             @endforelse
                            </div>
                         </div>
                    </div>
                </div>
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
