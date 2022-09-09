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
                <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Our Courses</h6>
                <h1 class="display-4">Checkout New Releases Of Our Courses</h1>
            </div>
        </div>
    </div>
    <div class="owl-carousel courses-carousel">
        {{--  --}}
        <div class="courses-item position-relative">
            <img class="img-fluid" src="img/courses-1.jpg" alt="">
            <div class="courses-text">
                <h4 class="text-center text-white px-3">Web design & development courses for beginners</h4>
                <div class="border-top w-100 mt-3">
                    <div class="d-flex justify-content-between p-4">
                        <span class="text-white"><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                        <span class="text-white"><i class="fa fa-star mr-2"></i>4.5 <small>(250)</small></span>
                    </div>
                </div>
                <div class="w-100 bg-white text-center p-4" >
                    <a class="btn btn-primary" href="detail.html">Course Detail</a>
                </div>
            </div>
        </div>
    </div>
<!-- Courses End -->
</div>
<div class="card mt-5 mr-3 ml-3">
    <div class="card-header text-center bg-info">
    <h4>Pengumuman</h4>
    </div>
    @foreach ($pengumuman as $pengumumans)
    <div class="bg-light bg-gradient text-white mr-3 ml-3 mt-3 mb-1">
        <button class="btn btn-block btn-outline" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $pengumumans->id }}" aria-expanded="false" aria-controls="collapseExample">
            <h5>{{ $pengumumans->judul }}</h5>
        </button>
        <div class="collapse" id="collapseExample{{ $pengumumans->id }}">
          <div class="card card-body text-dark">
            {{  $pengumumans->isi }}
          </div>
        </div>
    </div>
    @endforeach
  </div>
@endsection