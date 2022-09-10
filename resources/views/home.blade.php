@extends('layouts.main')

@section('container')
{{-- awal --}}
<div class="bg-info position-relative overlay-bottom py-5" style="margin-bottom: auto">
    <div class="container text-center my-5 py-5">
        <h1 class="text-white mt-4 mb-4">Belajar dimana aja</h1>
        <h1 class="text-white display-1 mb-5">Overload Coding</h1>
        <div class="mx-auto mb-5" style="width: 100%; max-width: 600px;">
            <form class="input-group">
               
                <input type="text" class="form-control border-light" style="padding: 30px 25px;" placeholder="Cari">
                <div class="input-group-append">
                    <button class="btn btn-outline-light px-4 px-lg-5">Search</button>
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
                <h1 class="display-4">Post Populer</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
           <!-- Post list:start -->
           <div class="card mb-4">
              <div class="card-body">
                 <div class="row">
                    @foreach ($posts as $dtpost)
                    <div class="col-lg-4 col-md-6 pb-4">
                        <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="">
                            <img class="img-fluid" src="{{ asset('storage/..' . $dtpost->thumbnail) }}" alt="kategori">
                            <div class="courses-text">
                               <div class="border-top w-100 mt-3">
                                   <div class="d-flex justify-content-between p-4 text-center">
                                <h4 class="text-center text-white px-3">{{ $dtpost->name }}</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                 </div>
              </div>
           </div>
           <!-- empty -->
           <h3 class="text-center">
              No data
           </h3>
           <!-- Post list:end -->
        </div>
     </div>
     
     <!-- pagination:start -->
     <div class="row">
        <div class="col">
     
        </div>
     </div>
<!-- Courses End -->
<!-- Courses Start -->
<div class="container-fluid px-0 py-5">
    <div class="row mx-0 justify-content-center pt-5">
        <div class="col-lg-6">
            <div class="section-title text-center position-relative mb-4">
                <h3 class="display-4">Pengumuman</h3>
            </div>
        </div>
    </div>
    <div class="row ml-2 mr-2">
        <div class="col">
           <!-- Post list:start -->
           <div class="card mb-4">
              <div class="card-body">
                 <div class="row">
                    @foreach ( $notif as $pengumuman)
                    <div class="card border-primary mt-2 mb-1">
                        <div class="card-header text-bg-info">
                            <button class="btn btn-outline btn-block" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $pengumuman->id }}" aria-expanded="false" aria-controls="collapseWidthExample">
                                {{ $pengumuman->judul }}
                              </button>
                        </div>
                        <div class="collapse collapse-horizontal" id="collapse{{ $pengumuman->id }}">
                        <div class="card-body">
                            {{ $pengumuman->isi }}
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
           <!-- empty -->
           {{-- <h3 class="text-center">
              No data
           </h3> --}}
           <!-- Post list:end -->
        </div>
     </div>
     
     <!-- pagination:start -->
     <div class="row">
        <div class="col">
     
        </div>
     </div>
@endsection