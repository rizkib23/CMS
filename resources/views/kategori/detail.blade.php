@extends('../layouts/dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <h1 class="h3 mb-0 text-gray-800">Detail Kategori</h1>
                </div>
                <div class="card-body">
                    <!-- Thumbnail -->
                    <img class="img-fluid img-thumbnail" src="{{ asset('storage/' . $kategoris->thumbnail) }}">

                    <!-- title -->
                    <h2 class="my-1">
                        {{ $kategoris->name }}
                    </h2>
                    <!-- slug -->
                    <p class="text-justify">
                        {{ $kategoris->slug }}
                    </p>
                    <div class="text-center">
                    <a class="btn btn-primary text-center" href="/kategoris">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection