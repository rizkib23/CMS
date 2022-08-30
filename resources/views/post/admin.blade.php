@extends('dashboard.layouts.main')

@section('title')
@endsection
@section('content')
    <!-- section:content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-2 text-gray-800">Post</h1>
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="GET">
                                <div class="input-group">
                                    <input name="keyword" type="search" class="form-control" placeholder="Cari Kategori">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <div class="col-md-3">
                            <a href="/dashboard/post/create" class="btn btn-md btn-primary" style="margin-bottom: 10px">
                                Tambah
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </div>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">NO.</th>
                                    <th scope="col">JUDUL</th>
                                    <th scope="col">SLUG</th>
                                    <th scope="col">THUMBNAIL</th>
                                    <th scope="col">DESKRIPSI</th>
                                    <th scope="col">CONTENT</th>
                                    <th scope="col">KATEGORI</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                <!-- list category -->
                                @foreach ($posts as $post)
                                    <tr class="text-center">
                                        <td><?php echo $no++; ?></td>
                                        <!-- category list -->
                                        <td>
                                            <label class="mt-auto mb-auto">
                                                <!-- todo: show judul post-->
                                                {{ $post->judul }}
                                            </label>
                                        </td>
                                        <td>
                                            <label class="mt-auto mb-auto">
                                                <!-- todo: show slug post-->
                                                {{ $post->slug }}
                                            </label>
                                        </td>
                                        <td>
                                            <label class="mt-auto mb-auto">
                                                {{ $post->thumbnail }}
                                            </label>
                                        </td>
                                        <td>
                                            <label class="mt-auto mb-auto">
                                                {{ $post->deskripsi }}
                                            </label>
                                        </td>
                                        <td>
                                            <label class="mt-auto mb-auto">
                                                {{ $post->content }}
                                            </label>
                                        </td>
                                        <td>
                                            <label class="mt-auto mb-auto">
                                                {{ $post->kategori_id }}
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <div>
                                                <!-- detail -->
                                                <a href="{{ route('post.show', ['post' => $post]) }}" class="btn btn-sm btn-primary" role="button">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <!-- edit -->
                                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-info"
                                                    role="button">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- delete -->
                                                <form class="d-inline" action="{{ route('post.destroy', $post->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- todo:show subcategory -->
                                    <!-- end  category list -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
@endsection
