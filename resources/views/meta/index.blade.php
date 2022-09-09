@extends('dashboard.layouts.main')

@section('content')
<div class="container-fluid">
    <!-- section:content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="h3 mb-2 text-gray-800">Meta</h1>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Meta</h6>
                </div>
                <br>
                <div class="col-md-3">
                    <a href="/dashboard/meta/create" class="btn btn-md btn-primary" style="margin-bottom: 10px">
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
                                    <th scope="col">TITLE</th>
                                    <th scope="col">KEYWORD</th>
                                    <th scope="col">DESKRIPSI</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                ?>
                                <!-- list category -->
                                @foreach ($metas as $meta)
                                    <tr class="text-center">
                                        <td><?php echo $no++; ?></td>
                                        <!-- category list -->
                                        <td>
                                            <label class="mt-auto mb-auto">
                                                <!-- todo: show category title -->
                                                {{ $meta->title }}
                                            </label>
                                        </td>
                                        <td>
                                            <label class="mt-auto mb-auto">
                                                <!-- todo: show category slug -->
                                                {{ $meta->meta_keyword }}
                                            </label>
                                        </td>
                                        <td>
                                            <label class="mt-auto mb-auto">
                                                <!-- todo: show category slug -->
                                                {{ $meta->meta_deskripsi }}
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <div>
                                                <!-- edit -->
                                                <a href="{{ route('meta.edit', $meta->id) }}"
                                                    class="btn btn-sm btn-info" role="button">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- delete -->
                                                <form class="d-inline"
                                                    action="{{ route('meta.destroy', $meta->id) }}" method="POST">
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
