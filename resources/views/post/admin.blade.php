@extends('layouts.dashboard')

@section('title')
Ocoding | Dashboard - {{ $title }}
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="GET" class="form-inline form-row">
                               {{-- filter Post:Status --}}
                                <div class="col">
                                    <div class="input-group mx-1">
                                        <label class="font-weight-bold mr-2">Status</label>
                                        <select name="status" class="custom-select">
                                            @foreach ($statuses as $value => $label)
                                                <option value="{{ $value }}" {{ $statusSelected == $value ? "selected" : null }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Apply</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- filter Post:search --}}
                                <div class="col">
                                    <div class="input-group mx-1">
                                        <input name="keyword" value="{{ request()->get('keyword') }}" type="search" class="form-control"
                                            placeholder="Search for posts">
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
                    <ul class="list-group list-group-flush">
                        <!-- list post -->
                        @forelse ($posts as $post)
                            <div class="card my-2">
                                <div class="card-body">
                                    <h5>{{ $post->judul }}</h5>
                                    <p>
                                        {{ str_word_count($post->deskripsi) > 60 ? substr("$post->deskripsi",0,200).".." : $post->deskripsi  }}
                                    </p>                            
                                    <div class="float-left">
                                        dibuat Oleh: {{ucwords($post->dataUser->name) }} <br>
                                        @if($post->status == ('publish'))
                                        dipublikasi Pada: {{ $post->updated_at}}
                                        @else
                                        dibuat Pada: {{ $post->created_at}}
                                        @endif
                                    </div>

                                    <div class="float-right">

                                        
                                        <!-- detail -->
                                         @if($post->status == ('publish'))
                                          <!-- detail -->
                                        <a href="{{ route('post.show', ['post' => $post]) }}" class="btn btn-sm btn-primary"
                                            role="button">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                         @elseif($post->user_id !== Auth::user()->id)
                                        <!-- detail -->
                                        <a href="{{ route('post.show', ['post' => $post]) }}" class="btn btn-sm btn-primary"
                                            role="button">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        @else                                                                               <!-- detail -->
                                        <a href="{{ route('post.show', ['post' => $post]) }}" class="btn btn-sm btn-primary" role="button">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <!-- edit -->
                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-info"
                                            role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- delete -->
                                        <form class="d-inline" role="alert" action="{{ route('post.destroy', $post->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                       @endif 
                                    </div>
                                </div>
                            </div>
                        @empty
                            Data Belum Ada
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
@push('javascript-internal')
    <script>
        $(document).ready(function(){
            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: "Apakah anda Yakin?",
                    text: "Data akan dihapus",
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: "Batalkan",
                    reverseButtons: true,
                    confirmButtonText: "Konfirmasi",
                    }).then((result) => {
                    if (result.isConfirmed) {
                        // todo: process of deleting 
                        event.target.submit();
                    }
                    });
            });
        }); 
    </script>
@endpush
