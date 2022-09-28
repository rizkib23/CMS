@extends('layouts.main')

@section('title')
    Ocoding Blog | {{ $title }}
@endsection

@section('meta_description')
    @yield('{!! Meta::tag() !!}')
@endsection

@section('meta_keywords')
    @yield('{!! Meta::tag() !!}')
@endsection

@section('container')
    {{-- awal --}}
    <div class="bg-info position-relative overlay-bottom py-5" style="margin-bottom: auto">
        <div class="container text-center my-1 py-1">
            <h1 class="text-white mb-4">Belajar dimana aja</h1>
            <h1 class="text-white display-1 mb-5">Overload Coding</h1>
            <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
                {{-- filter:search --}}
                <form class="input-group my-1" action="{{ route('search-post') }}" method="GET">
                    <input name="keyword" type="search" class="form-control border-light" style="padding: 30px 25px;"
                        placeholder="Cari">
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
    <div class="container-fluid px-0 py-3">
        <div class="row mx-0 justify-content-center pt-3">
            <div class="col-lg-6">
                <div class="section-title text-center position-relative mb-4">
                    <h1 class="display-4">Post</h1>
                    <h5>Tekan Selengkapnya Untuk Membaca Artikel</h5>
                </div>
            </div>
        </div>
    </div>
    <br>
    <main class="container border py-5">
        <div class="row">
            <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12">
                <div class="row">
                    @forelse ($posts as $dtpost)
                        <div class="col-6">
                            <!-- Post list:start -->
                            <div class="card mb-4 border-info" style="height: 31rem;">
                                <div class="card-body">
                                    <div class="col-lg-6-md-6">
                                        <!-- thumbnail:start -->
                                        <!-- true -->
                                        <img class="img-fluid rounded" src="{{ asset('storage/..' . $dtpost->thumbnail) }}"
                                            alt="Post">
                                    </div>                                  
                                    <div class="card-title mt-1">
                                        <h2>
                                            {{ $dtpost->judul }}
                                        </h2>
                                    </div> 
                                    <a href="{{ route('post-kategori', ['slug' => $dtpost->dataKategori->slug]) }}" class="badge badge-info ">
                                        {{ $dtpost->dataKategori->name }}
                                    </a>
                                    <p class="card-text">
                                        {{ str_word_count($dtpost->deskripsi) > 20 ? substr("$dtpost->deskripsi", 0, 70) . ' ..' : $dtpost->deskripsi }}
                                    </p>
                                    <a href="{{ route('post-detail', ['slug' => $dtpost->slug]) }}" class="btn btn-primary">
                                        Selengkapnya
                                    </a>
                                </div> 
                                    <div class="card-footer position-absolut bg-light">
                                        <img src="{{ asset('storage/' .$dtpost->dataUser->dataProfil->foto) }}" width="30" height="30" class="rounded-circle me-2" alt="">
                                            {{ ucwords($dtpost->dataUser->name) }}
                                            <p>diPublikasikan {{ $dtpost->updated_at }}</p> 
                                    </div>
                            </div>

                            <!-- Post list:end -->
                        </div>
                    @empty
                        <!-- empty -->
                        <h3 class="text-center">
                            Belum Ada Data
                        </h3>
                    @endforelse
                </div>

            </div>


            <!-- Sidebar Widgets Column:start -->
            <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">
                <!-- tag Widget -->
                <div class="card mb-5 border-info">
                    <h5 class="card-header text-dark bg-light">
                        <img class="img-tag rounded-circle" src="image/tag.png" width="25px">
                        Tag
                    </h5>
                    <div class="card-body">
                        <!-- tag list:start -->
                        @forelse ($tag as $dttag)
                            <!-- true -->
                            <a href="{{ route('post-tag', ['slug' => $dttag->slug]) }}"
                                class="badge badge-info py-3 px-3 my-2">#{{ $dttag->name }}</a>
                        @empty
                            <!-- false -->
                            <h3 class="text-center">
                                No data
                            </h3>
                        @endforelse
                        <!-- tag list:end -->
                    </div>
                </div>
            </div>
        </div>

        <!-- pagination:start -->
        @if ($posts->hasPages())
            <div class="col">
                <div class="row">
                    {{ $posts->links('pagination::bootstrap-4') }}
                </div>
            </div>
        @endif
        <!-- pagination:End -->
    </main>
    <div class="container-fluid px-0 py-5">
        <div class="row mx-0 justify-content-center pt-5">
            <div class="col-lg-6">
                <div class="section-title text-center position-relative mb-4">
                    <h3 class="display-4">Pengumuman</h3>
                </div>
            </div>
            <main class="container border py-5">
                <div class="row g-5 ">
                    <div class="row ml-2 mr-2">
                        <div class="col">   
                            @foreach ( $notif as $pengumuman)
                            <div class="card border-primary mt-3 mb-1">
                                <div class="card-header text-bg-info bg-light">
                                    <button class="btn btn-outline btn-block" data-bs-toggle="collapse" data-bs-target="#collapse{{ $pengumuman->id }}" aria-expanded="false" aria-controls="collapseWidthExample">
                                        {{ $pengumuman->judul }}
                                    </button>
                                </div>
                                <div class="collapse collapse-horizontal" id="collapse{{ $pengumuman->id }}">
                                <div class="card-body">
                                    {!! $pengumuman->isi !!}
                                </div>
                                <div class="card-footer mx-auto text-center bg-info text-white" style="width: 90%;">
                                {{ $pengumuman->created_at }}
                                </div> 
                                </div>                   
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

@endsection
