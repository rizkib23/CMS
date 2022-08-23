@extends('layouts.main')

@section('container')
<div class="bg-info position-relative overlay-bottom py-5" style="margin-bottom: auto">
    <div class="text-center">
        <img src="image/Kategori.png" class="img-fluid" alt="Kategori">
   </div>
    <h1 class="text-white mt-4 mb-4 text-center">Postingan</h1>
</div>

@foreach ($posts as $post)
    <article class="px-0 py-5">
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->body }}</p>
    </article>
@endforeach
@endsection