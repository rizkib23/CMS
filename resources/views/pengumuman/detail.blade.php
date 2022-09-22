@extends('../layouts/dashboard')
@section('title')
Ocoding | Dashboard - {{ $title }}
@endsection
@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1>{{ $pengumuman->judul }}</h1> 
                </div>
                <div class="card-body">
                    {{ $pengumuman->isi }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection