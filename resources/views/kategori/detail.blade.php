@extends('../layouts/dashboard')

@section('title')
Ocoding | Dashboard | {{ $title }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
            <div class="card border-info bg-light mr-3 ml-3" >
                <div class="card-header text-center bg-info">
                    <h1 class="h3 mb-0 text-gray-800">Detail Kategori</h1>
                </div>
                <div class="card-body">
                    <!-- Thumbnail -->
                    <img class="img-fluid img-thumbnail" width="200px" src="{{ asset('storage/..' . $kategoris->thumbnail) }}"/>

                    <!-- title -->
                    <h2 class="my-1">
                        {{ $kategoris->name }}
                    </h2>
                    <div class="float-right">
                        <a class="btn btn-outline-warning px-4" href="/kategoris">
                            <i class="bi bi-backspace"></i>Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection