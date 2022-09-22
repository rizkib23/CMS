@extends('layouts.dashboard')

@section('title')
Ocoding | Dashboard - {{ $title }}
@endsection

@section('content')
    
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Post Count -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Post</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <span class="count-numbers">{{ $posts }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                        <img class="img-tag" src="img/file-text.svg" width="30px">
                                {{-- <i class="bi bi-file-text fa-2x text-gray-300"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kategori Count -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Kategori</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <span class="count-numbers">{{ $kategoris }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                        <img class="img-tag" src="image/Kategori.png" width="30px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tag Count -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Tag</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <span class="count-numbers">{{ $tags }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                        <img class="img-tag" src="image/tag.png" width="30px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
