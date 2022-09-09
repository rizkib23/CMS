@extends('layouts.dashboard')

@section('title')
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
             <div class="row">
                <div class="col-md-6">
                   <form action="" method="GET" class="form-inline form-row">
                      <div class="col">
                         <div class="input-group mx-1">
                            <label class="font-weight-bold mr-2">Status</label>
                            <select name="status" class="custom-select">
                               <option value="publish" selected>Publish</option>
                               <option value="draft">Draft</option>
                            </select>
                            <div class="input-group-append">
                               <button class="btn btn-primary" type="submit">Apply</button>
                            </div>
                         </div>
                      </div>
                      <div class="col">
                         <div class="input-group mx-1">
                            <input name="keyword" type="search" class="form-control" placeholder="Search for posts">
                            <div class="input-group-append">
                               <button class="btn btn-primary" type="submit">
                                  <i class="fas fa-search"></i>
                               </button>
                            </div>
                         </div>
                      </div>
                   </form>
                </div>
                <div class="col-md-6">
                   <a href="{{ route('post.create') }}" class="btn btn-primary float-right" role="button">
                      Tambah Post
                      <i class="fas fa-plus-square"></i>
                   </a>
                </div>
             </div>
          </div>
          <div class="card-body">
            <table class="table" id="myTable">
               <tbody>
             <ul class="list-group list-group-flush">
                <!-- list post -->
                @forelse ($posts as $post)
                <div class="card my-2">
                    <div class="card-body">
                       <h5>{{ $post->judul }}</h5>
                       <p>
                          {{ $post->deskripsi }}
                       </p>
                       <div class="float-right">
                          <!-- detail -->
                          <a href="{{ route('post.show', ['post' => $post]) }}" class="btn btn-sm btn-primary" role="button">
                             <i class="fas fa-eye"></i>
                          </a>
                          <!-- edit -->
                          <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-info" role="button">
                             <i class="fas fa-edit"></i>
                          </a>
                          <!-- delete -->
                          <form class="d-inline" action="{{ route('post.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                             <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                             </button>
                          </form>
                       </div>
                    </div>
                 </div>
                 @empty
                    Data Belum Ada
                @endforelse
             </ul>
               </tbody>
            </table>
          </div>
       </div>
    </div>
  </div>
    @include('sweetalert::alert')
@endsection
