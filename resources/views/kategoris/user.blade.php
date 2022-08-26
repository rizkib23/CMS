@extends('../layouts.main')

@section('container')
<div class="bg-info position-relative overlay-bottom py-5" style="margin-bottom: auto">
    <div class="text-center">
        <img src="image/Kategori.png" class="img-fluid" alt="Kategori">
    </div>
    <h1 class="text-white mt-4 mb-4 text-center">Kategori</h1>
</div>
<!-- Courses Start -->

<div class="container-fluid py-5">
<div class="container py-5">
    <div class="row mx-0 justify-content-center">
        <div class="col-lg-8">
                <div class="row">
                    @foreach ($kategoris as $kategori)
                    <div class="col-lg-4 col-md-6 pb-4">
                        <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="detail.html">
                            <img class="img-fluid" src="{{ $kategori->thumbnail }}" alt="{{ $kategori->name }}">
                            <div class="courses-text">
                                <h4 class="text-center text-white px-3">{{ $kategori->name }}</h4>
                                <div class="border-top w-100 mt-3">
                                    <div class="d-flex justify-content-between p-4">
                                        <span class="text-white"><i class="fa fa-user mr-2"></i>Jhon Doe</span>
                                        <span class="text-white"><i class="fa fa-star mr-2"></i>4.5
                                            <small>(250)</small></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
