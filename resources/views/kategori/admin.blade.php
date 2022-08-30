@extends('dashboard.layouts.main')

@section('title')
@endsection
@section('content')
<div class="container-fluid">
    <!-- section:content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-2 text-gray-800">Kategori</h1>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
                </div>
                <br>
                <div class="col-md-3">
                    <a href="/dashboard/kategori/create" class="btn btn-md btn-primary" style="margin-bottom: 10px">
                        Tambah
                        <i class="fas fa-plus-square"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">NO.</th>
                                    <th scope="col">KATEGORI</th>
                                    <th scope="col">SLUG</th>
                                    <th scope="col">THUMBNAIL</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                <!-- list category -->
                                @foreach ($kategoris as $kategori)
                                    <tr class="text-center">
                                        <td><?php echo $no++; ?></td>
                                        <!-- category list -->
                                        <td>
                                            <label class="mt-auto mb-auto">
                                                <!-- todo: show category title -->
                                                {{ $kategori->name }}
                                            </label>
                                        </td>
                                        <td>
                                            <label class="mt-auto mb-auto">
                                                <!-- todo: show category slug -->
                                                {{ $kategori->slug }}
                                            </label>
                                        </td>
                                        <td>
                                            <label class="mt-auto mb-auto">
                                                <!-- todo: show category slug -->
                                                {{ $kategori->thumbnail }}
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <div>
                                                <!-- detail -->
                                                <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-sm btn-primary" role="button">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <!-- edit -->
                                                <a href="{{ route('kategori.edit', $kategori->id) }}"
                                                    class="btn btn-sm btn-info" role="button">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- delete -->
                                                <form class="d-inline"
                                                    action="{{ route('kategori.destroy', $kategori->id) }}" role="alert"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button id="delete" type="submit" class="btn btn-sm btn-danger">
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
    </div>
    @include('sweetalert::alert')
@endsection
