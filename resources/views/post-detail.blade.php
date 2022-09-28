@extends('layouts.main')

@section('title')
Ocoding Blog | {{ $title }}
@endsection

@section('container')
    <br>
    <!-- Title:start -->
    <main class="container border py-2">
        <div class="col-md-8">
            <h2 class="mt-4 mb-3 text-center">
                {{ ucwords($posts->judul) }}
            </h2>
        </div>
        <!-- Title:end -->

        <div class="row">
            <!-- Post Content Column:start -->
            <div class="col-lg-8">
                <div class="col-md-12">
                    <!-- thumbnail:start -->
                    <img class="img-thumbnail" style="200x700" src="{{ asset('storage/..' . $posts->thumbnail) }}">
                    <!-- thumbnail:end -->
                    <hr>
                    <!-- Post Content:start -->
                    <div class="col-md-12">
                        {!! $posts->content !!}
                    </div>
                    <!-- Post Content:end -->
                    <hr>
                </div>
            </div>

            <!-- Sidebar Widgets Column:start -->
            <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">
                <!-- Categories Widget -->
                <div class="card mb-4 border-info">
                    <div class="col-md-12">
                        <h5 class="card-header bg-light fw-bold">
                            <img class="img-kategori rounded-circle" src="/image/kategori.png" width="25px">
                            Kategori
                        </h5>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('storage/..' . $posts->dataKategori->thumbnail) }}" width="36" height="36" class="rounded-circle me-2" alt="{{ $posts->dataKategori->name }}">
                        <!-- category list:start -->
                        <a href="{{ route('post-kategori', ['slug' => $posts->dataKategori->slug]) }}"
                            class="badge badge-primary py-2 px-4">
                            {{ $posts->dataKategori->name }}
                        </a>
                        <!-- category list:end -->
                        <hr>
                    </div>
                </div>

                <!-- Side Widget tags:start -->
                <div class="card border-info mb-4">
                    <div class="col-md-12">
                    <h5 class="card-header bg-light fw-bold">
                        <img class="img-tag rounded-circle" src="/image/tag.png" width="25px">
                        Tags
                    </h5>
                    </div>
                    <div class="card-body">
                        <!-- tag list:start -->
                        @foreach ($posts->dataTagPost as $tag)
                            <a href="{{ route('post-tag', ['slug' => $tag->dataTags->slug]) }}"
                                class="badge badge-info py-2 px-4 my-1">
                                #{{ $tag->dataTags->name }}
                            </a>
                        @endforeach
                        <!-- tag list:end -->
                    </div>
                </div>
                <!-- Side Widget tags:start -->
                <div class="card border-info mb-4">
                    <div class="col-md-12">
                    <h5 class="card-header bg-light fw-bold">
                        <img class="img-deskripsi rounded-circle" src="/img/card-text.svg" width="25px">
                        Deskripsi
                    </h5>
                </div>
                    <div class="card-body">
                        <!-- tag list:start -->
                        <p>
                            {{ $posts->deskripsi }}
                        </p>
                        <!-- tag list:end -->
                    </div>
                </div>
            </div>
            <!-- Sidebar Widgets Column:end -->
        
        <div class="card-header border-info bg-light">
            
            <button class="btn btn-outline-info float-start " type="button" data-bs-toggle="collapse" data-bs-target="#formKomentar" aria-expanded="false" aria-controls="collapseWidthExample" id="edit">
                <i class="bi bi-chat"></i><span class="">Komentar</span>
            </button>
        </div>
        <div class="card-body collapse collapse-horizontal" id="formKomentar">
                @foreach($posts->dataKomen->where('parent', 0) as $komentar)
            <div class="d-flex align-items-start">
                    @if($komentar->dataUser->dataProfil->foto)
                        <img src="{{ asset('storage/' . $komentar->dataUser->dataProfil->foto) }}" width="36" height="36" class="rounded-circle me-2" alt="{{ $komentar->dataUser->name }}">
                    @else
                        <img src="{{ asset('img/profil.jpg') }}" class="rounded-circle me-2" width="36" height="36">
                    @endif     
                <div class="flex-grow-1">
                    <small class="float-end">
                        {{ $komentar->updated_at }}
                    </small>
                    <strong>
                        {{ ucwords($komentar->dataUser->name)  }}
                    </strong> mengomentari postingan dari <strong>{{ ucwords($posts->dataUser->name) }}</strong><br/>
                    <small class="text-muted">
                        {{ $komentar->created_at }}
                    </small>  
                    <div class="border text-sm text-muted p-2 mt-1">
                        {{ $komentar->isi }}
                    </div>                
                    @if(Auth::check() == true)
                        @if(Auth::user()->id == $komentar->user_id)
                            {{-- hapus --}}
                            <form class="d-inline" role="alert" alert-title="Apakah Kamu Yakin?" alert-text="Data akan dihapus" action="{{ route('komen.destroy',['koman'=>$komentar->id] ) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                @can('komentar_delet')
                                    <button type="submit" class="btn btn-outline">
                                        <i class="fas fa-trash"></i>Hapus
                                    </button>
                                @endcan
                            </form>
                            {{-- edit button --}}
                            <button class="btn btn-outline" type="button" data-bs-toggle="collapse" data-bs-target="#edit{{ $komentar->id }}" aria-expanded="false" aria-controls="collapseWidthExample" id="edit">
                                <i class="fa fa-edit"></i>Edit
                            </button>
                        @else
                        @endif
                    @endif 
                {{-- balas --}}
                <button class="btn btn-outline inline" type="button" data-bs-toggle="collapse" data-bs-target="#balas{{ $komentar->id }}" aria-expanded="false" aria-controls="collapseWidthExample" id="balas">
                    <i class="bi bi-reply"></i> Balas
                </button>
                {{-- edit --}}
                <div class="collapse collapse-horizontal mt-4" id="edit{{ $komentar->id }}">
                    <form action="{{ route('komen.update', ['koman'=>$komentar->id]) }}" method="POST">
                        @method('put')
                        @csrf
                            <div class="form-group">
                                <input type="hidden" name="post_id" value="{{ $posts->id }}">
                                <input type="hidden" name="parent" value="0">
                                <textarea id="input_post_deskripsi" name="isi" placeholder="Masukkan komentar" class=" form-control" required
                                rows="1"></textarea>
                                <div class="mt-2">
                                    <button class="btn btn-sm btn-outline-info" type="submit"><i class="bi bi-send-fill"></i>Kirim</button>
                                </div>
                            </div>
                    </form>
                </div>
                {{-- balas komen --}}
                <div class="collapse collapse-horizontal mt-4" id="balas{{ $komentar->id }}">
                    <form action="{{ route('komen.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="post_id" value="{{ $posts->id }}">
                            <input type="hidden" name="parent" value="{{ $komentar->id }}">
                            <textarea id="input_post_deskripsi" name="isi" placeholder="Masukkan komentar" class=" form-control" required
                                rows="1"></textarea>
                                <div class="mt-2">
                                    <button class="btn btn-sm btn-outline-info" type="submit"><i class="bi bi-send-fill"></i>Kirim</button>
                                </div>
                        </div>
                    </form>
                </div>
                {{-- balasan komentar --}}
                    @foreach($komentar->dataChilds as $balasan)
                        <div class="d-flex align-items-start">
                            @if($balasan->dataUser->dataProfil->foto)
                                <img src="{{ asset('storage/' .$balasan->dataUser->dataProfil->foto ) }}" width="36" height="36" class="rounded-circle me-2" alt="{{ $balasan->dataUser->name }}">
                            @else
                                <img src="{{ asset('img/profil.jpg') }}" class="rounded-circle me-2" width="36" height="36">
                            @endif
                            <div class="flex-grow-1">
                                <small class="float-end">{{ $balasan->updated_at }}</small>
                                <strong>{{ ucwords($balasan->dataUser->name)  }}</strong> membalas komentar dari <strong>{{ ucwords($komentar->dataUser->name) }}</strong><br />
                                <small class="text-muted">{{ $balasan->created_at }}</small>
                                <div class="border text-sm text-muted p-2 mt-1">
                                    {{ $balasan->isi }}
                                </div>
                                    {{-- hapus --}}
                                    <form class="d-inline" role="alert" alert-title="Apakah Kamu Yakin?" alert-text="Data akan dihapus" action="{{ route('komen.destroy',['koman'=>$balasan->id] ) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        @can('komentar_delet')
                                            <button type="submit" class="btn btn-outline">
                                                <i class="fas fa-trash"></i>Hapus
                                            </button>
                                        @endcan
                                    </form>
                                    {{-- edit button --}}
                                @if(Auth::check() == true)
                                    @if ($balasan->user_id == Auth::user()->id)
                                        <button class="btn btn-outline" type="button" data-bs-toggle="collapse" data-bs-target="#editBalasan{{ $balasan->id }}" aria-expanded="false" aria-controls="collapseWidthExample" id="edit">
                                            <i class="fa fa-edit"></i>Edit
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="collapse collapse-horizontal mt-4" id="editBalasan{{ $balasan->id }}">
                            <form action="{{ route('komen.update', ['koman'=>$balasan->id]) }}" method="POST">
                                @method('put')
                                @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="post_id" value="{{ $balasan->id }}">
                                        <input type="hidden" name="parent" value="{{ $balasan->parent }}">
                                        <textarea id="input_post_deskripsi" name="isi" placeholder="Masukkan komentar" class=" form-control" required
                                        rows="1"></textarea>
                                        <div class="mt-2">
                                            <button class="btn btn-sm btn-outline-info" type="submit"><i class="bi bi-send-fill"></i>Kirim</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                        <hr/>
                    @endforeach
                    {{-- end --}}
                </div>
            </div>
            @endforeach
                <form action="{{ route('komen.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="post_id" value="{{ $posts->id }}">
                        <input type="hidden" name="parent" value="0">
                        <textarea id="input_post_deskripsi" name="isi" autofocus placeholder="Masukkan komentar" class=" form-control"
                            rows="3"></textarea>
                            <div class="mt-2">
                                <button class="btn btn-outline-success" type="submit"><i class="bi bi-send-fill"></i> Kirim</button>
                            </div>
                    </div>
                </form>
            </div>          
</div>
</main>
@include('sweetalert::alert')
@endsection
