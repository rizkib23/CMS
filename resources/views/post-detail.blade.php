@extends('layouts.main')

@section('title')
Ocoding Bog | {{ $title }}
@endsection

@section('container')
       <!-- Title:start -->
   <h2 class="mt-4 mb-3">
    {{ $posts->judul }}
 </h2>
 <!-- Title:end -->

 <div class="row">
    <!-- Post Content Column:start -->
    <div class="col-lg-8">
       <!-- thumbnail:start -->
       <img class="img-thumbnail" style="200x700" src="{{ asset('storage/..' . $posts->thumbnail) }}">
       <!-- thumbnail:end -->
       <hr>
       <!-- Post Content:start -->
       <div>
          {{!! $posts->content !!}}
       </div>
       <!-- Post Content:end -->
       <hr>
    </div>

    <!-- Sidebar Widgets Column:start -->
    <div class="col-md-4">
       <!-- Categories Widget -->
       <div class="card mb-3">
          <h5 class="card-header">
             Categories
          </h5>
          <div class="card-body">
             <!-- category list:start -->
             <a href="" class="badge badge-primary py-2 px-4">
                Title
             </a>
             <!-- category list:end -->
          </div>
       </div>

       <!-- Side Widget tags:start -->
       <div class="card mb-3">
          <h5 class="card-header">
             Tags
          </h5>
          <div class="card-body">
             <!-- tag list:start -->
             <a href="" class="badge badge-info py-2 px-4 my-1">
                #Title
             </a>
             <!-- tag list:end -->
          </div>
       </div>
       <!-- Side Widget tags:start -->
    </div>
    <!-- Sidebar Widgets Column:end -->
 </div>
@endsection