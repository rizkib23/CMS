@extends('../layouts/dashboard')

@section('title')
@endsection
@section('content')

    <!-- section:content -->
    <div class="container mt-4">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header text-center">
                <h1> Kategori </h1>
              </div>
              <div class="card-body">
                        <a href="{{ route('kategoris.create') }}" class="btn btn-md btn-success" style="margin-bottom: 10px">
                            Tambah
                            <i class="fas fa-plus-square"></i>
                        </a>
                        <table class="table table-bordered"  id="myTable">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">NO.</th>
                                <th scope="col">KATEGORI</th>
                                <th scope="col">SLUG</th>
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
                                    <td>  {{ $kategori->slug }} </td>
                                    <td class="text-center">
                                        <div>
                                            <!-- detail -->
                                            <a href="{{ $kategori->thumbnail, $kategori->id }}" class="btn btn-sm btn-primary" role="button">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <!-- edit -->
                                            <a href="{{ route('kategoris.edit', $kategori->id) }}"
                                                class="btn btn-sm btn-info" role="button">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- delete -->
                                            
                                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#logoutModal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            
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
@endsection
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Menghapus?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">klik "Hapus" jika Ya</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            @foreach ($kategoris as $kategori)
            <form class="d-inline" action="{{ route('kategoris.destroy', $kategori->id) }}"
                method="POST">
                @csrf
                @method('DELETE')
                @endforeach
                <button class="btn btn-primary">Hapus</button>
            </form>
            
        </div>
    </div>
</div>
</div>

