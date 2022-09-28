@extends('../layouts/dashboard')
@section('title')
Ocoding | Dashboard - {{ $title }}
@endsection
@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-12">
            <div class="card bg-light border-info">
                <div class="card-header text-center bg-primary text-white">
                    <h1>{{ $pengumuman->judul }}</h1> 
                </div>
                <div class="card-body">
                    {!! $pengumuman->isi !!}
                     <div class="float-right">
                        <a class="btn btn-outline-warning px-4" href="/pengumuman">
                            <i class="bi bi-backspace"></i>Back
                        </a>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection