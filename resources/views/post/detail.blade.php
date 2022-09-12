@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-0 text-gray-800">Detail Post</h1>
                </div>
                <div class="card-body">
                    <!-- thumbnail -->

                    <img class="post-thumbnail img-fluid img-thumbnail" width="200px" src="{{ asset('storage/..' . $post->thumbnail) }}">

                    <!-- title -->
                    <h2 class="my-1">
                        {{ $post->judul }}
                    </h2>

                    <!-- description -->
                    <p class="text-justify">
                        {{ $post->deskripsi }}
                    </p>
                    <!-- categories -->
                   
                        <span class="badge badge-primary">{{ $post->dataKategori->name }}</span>
                    <!-- content -->
                    <div class="py-1">
                        {!! $post->content !!}
                    </div>
                    <!-- tags  -->
                    @foreach ($post->dataTagPost as $tag)
                        <span class="badge badge-info">{{ $tag->dataTags->name }}</span>
                    @endforeach

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('post.index') }}" class="btn btn-primary mx-1" role="button">
                            Back
                        </a>
                    </div>
                </div>
            </div>
            {{-- <form action="{{ route('komen.store') }}" method="post"> 
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <textarea name="isi" id="" rows="2">masukkan komentar</textarea>
                <button type="submit">save</button>
            </form> --}}
        </div>
    </div>
@endsection

@push('css-internal')
    <!-- style -->
    <style>
        .post-thumbnail {
            width: 100%;
            height: 400px;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
    </style>
@endpush
