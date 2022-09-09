@extends('dashboard.layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('meta.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h1 class="h3 mb-0 text-gray-800">Create Post</h1>
                    </div>
                    <div class="card-body">
                        <div class="row d-flex align-items-stretch">
                            <div class="col-md-12">
                                <!-- title -->
                                <div class="form-group">
                                    <label for="input_meta_title" class="font-weight-bold">
                                        Title
                                    </label>
                                    <input id="input_meta_title" name="title" type="text" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="Masukkan Title Meta" />
                                </div>
                                <!-- meta:keyword -->
                                <div class="form-group">
                                    <label for="input_meta_keyword" class="font-weight-bold">
                                        Keyword
                                    </label>
                                    <input id="input_meta_keyword" name="meta_keyword" type="text" value="{{ old('meta_keyword') }}" class="form-control @error('meta_keyword') is-invalid @enderror" placeholder="Masukkan Meta Keyword" />
                                </div>
                                <!-- meta:deskripsi -->
                                <div class="form-group">
                                    <label for="input_meta_deskripsi" class="font-weight-bold">
                                        Deskripsi
                                    </label>
                                    <input id="input_meta_deskripsi" name="meta_deskripsi" type="text" value="{{ old('meta_deskripsi') }}" class="form-control @error('meta_deskeripsi') is-invalid @enderror" placeholder="Masukkan Meta Deskripsi" />
                                </div>
                                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-right">
                                    <a class="btn btn-warning px-4" href="{{ route('meta.index') }}">Back</a>
                                    <button type="submit" class="btn btn-primary px-4">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
