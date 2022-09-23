@extends('layouts.main')

@section('title')
    Ocoding Bog | {{ $title }}
@endsection

@section('container')
    <div class="bg-info position-relative overlay-bottom py-5" style="margin-bottom: auto">
        <div class="text-center">
            <img src="image/Kategori.png" class="img-fluid" alt="Kategori">
        </div>
        <h1 class="text-white mt-4 mb-4 text-center">Kategori</h1>
    </div>
    <br>

    <!-- List category -->
    <div class="container border py-5">
        <div class="row flex-row">
            @forelse ($kategoris as $dtkategori)
                <!-- true -->
                <div class="col-lg-4 col-md-6 pb-4">
                    <a class="courses-list-item position-relative d-block overflow-hidden mb-2"
                        href="{{ route('post-kategori', ['slug' => $dtkategori->slug]) }}">
                        <img class="img-fluid rounded" src="{{ asset('storage/..' . $dtkategori->thumbnail) }}"
                            alt="kategori">
                        <div class="courses-text">
                            <div class="border-top w-100 mt-3">
                                <div class="d-flex justify-content-between p-4 text-center">
                                    <h4 class="text-center text-white px-3">{{ $dtkategori->name }}</h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

            @empty
                <!-- false -->
                <h3 class="text-center">
                    Belum Ada Data
                </h3>
            @endforelse
        </div>
    </div>
@endsection
