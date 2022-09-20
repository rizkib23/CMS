@extends('layouts.main')

@section('title')
    Ocoding Bog | {{ $title }}
@endsection

@section('container')
    <br>
    <!-- Title:start -->
    <main class="container border py-2">
        <div class="col-md-8">
            <h2 class="mt-4 mb-3">
                {{ $posts->judul }}
            </h2>
        </div>
        <!-- Title:end -->

        <div class="row">
            <!-- Post Content Column:start -->
            <div class="col-lg-8">
                <div class="col-md-12">
                    <!-- thumbnail:start -->
                    <img class="img-thumbnail" style="200x700" src="{{ asset('storage/.' . $posts->thumbnail) }}">
                    <!-- thumbnail:end -->
                    <hr>
                    <!-- Post Content:start -->
                    <div class="col-md-12">
                        {!! $posts->content !!}
                    </div>
                    <!-- Post Content:end -->
                    <hr>
                </div>
            </div>

            <!-- Sidebar Widgets Column:start -->
            <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">
                <!-- Categories Widget -->
                <div class="card mb-4">
                    <div class="col-md-12">
                        <h5 class="card-header">
                            <img class="img-kategori rounded-circle" src="/image/kategori.png" width="25px">
                            Kategori
                        </h5>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('storage/..' . $posts->dataKategori->thumbnail) }}" width="36" height="36" class="rounded-circle me-2" alt="{{ $posts->dataKategori->name }}">
                        <!-- category list:start -->
                        <a href="{{ route('post-kategori', ['slug' => $posts->dataKategori->slug]) }}"
                            class="badge badge-primary py-2 px-4">
                            {{ $posts->dataKategori->name }}
                        </a>
                        <!-- category list:end -->
                        <hr>
                    </div>
                </div>

                <!-- Side Widget tags:start -->
                <div class="card mb-4">
                    <div class="col-md-12">
                    <h5 class="card-header">
                        <img class="img-tag rounded-circle" src="/image/tag.png" width="25px">
                        Tags
                    </h5>
                    </div>
                    <div class="card-body">
                        <!-- tag list:start -->
                        @foreach ($posts->dataTagPost as $tag)
                            <a href="{{ route('post-tag', ['slug' => $tag->dataTags->slug]) }}"
                                class="badge badge-info py-2 px-4 my-1">
                                #{{ $tag->dataTags->name }}
                            </a>
                        @endforeach
                        <!-- tag list:end -->
                    </div>
                </div>
                <!-- Side Widget tags:start -->
                <div class="card mb-4">
                    <div class="col-md-12">
                    <h5 class="card-header">
                        <img class="img-deskripsi rounded-circle" src="/img/card-text.svg" width="25px">
                        Deskripsi
                    </h5>
                </div>
                    <div class="card-body">
                        <!-- tag list:start -->
                        <p>
                            {{ $posts->deskripsi }}
                        </p>
                        <!-- tag list:end -->
                    </div>
                </div>
            </div>
            <!-- Sidebar Widgets Column:end -->
        </div>
    </main>
@endsection
