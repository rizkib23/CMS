@extends('../layouts/dashboard')

@section('breadcrumbs')
    <h1>Kategori</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
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
                        <div class="col-md-6">
                            <a href="{{ route('tags.create') }}" class="btn btn-primary float-right" role="button">
                                Tambah
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered" >
                    
                        
                     <thead>
                            <tr class="text-center">
                                <th scope="col">no</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        
                     </thead>
                     <tbody>
                        <!-- list category -->
                        @foreach ($tags as $tag)
                            <!-- category list -->
                            <?php $no=1; ?>
                           <tr>
                                <td scope="col">{{ $no++ }}</td>
                                <td>
                                    <label class="mt-auto mb-auto">
                                   
                                    <!-- todo: show category title -->
                                    {{ $tag->nama_tag }}
                                    </label>
                                </td>
                                <td class="text-center">
                                <div>
                                    <!-- detail -->
                                    <a href="#" class="btn btn-sm btn-primary" role="button">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <!-- edit -->
                                    <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-info" role="button">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- delete -->
                                    <form class="d-inline" action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger berhasil">
                                            <i class="fas fa-trash"></i>
                                            
                                        </button>
                                    </form>
                                </div>
                                </td>
                                <!-- todo:show subcategory -->
                            </tr>
                            <!-- end  category list -->
                        @endforeach
                    </tbody>
                    
                </table>
                </div>
            </div>
        </div>
    </div>
    @endsection