@extends('dashboard.layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0 text-gray-800">Detail Kategori</h1>
                </div>
                <div class="card-body">
                    <!-- Thumbnail -->
                    <img class="img-fluid img-thumbnail" src="{{ asset('storage/' . $kategori->thumbnail) }}">

                    <!-- title -->
                    <h2 class="my-1">
                        {{ $kategori->name }}
                    </h2>
                    {{-- <!-- slug -->
                    <p class="text-justify">
                        {{ $kategori->slug }}
                    </p> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css-internal')
    <!-- style -->
    <style>
        .post-tumbnail {
            width: 100%;
            height: 400px;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
    </style>
@endpush