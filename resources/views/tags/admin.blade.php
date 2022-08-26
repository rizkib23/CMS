@extends('../layouts/dashboard')
@section('title')
@endsection
@section('content')
<div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h1> Tags</h1>
          </div>
          <div class="card-body">
                    <a href="{{ route('tags.create') }}" class="btn btn-md btn-success" style="margin-bottom: 10px">
                        Tambah
                        <i class="fas fa-plus-square"></i>
                    </a>
                    <table class="table table-bordered"  id="myTable">
                    
                        
                     <thead>
                            <tr class="text-center">
                                <th scope="col">no</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        
                     </thead>
                     <tbody>
                        <?php $no=1; ?>
                        <!-- list category -->
                        @foreach ($tags as $tag)
                            <!-- category list -->
                            
                           <tr>
                                <td scope="col">{{ $no++ }}</td>
                                <td>
                                    <label class="mt-auto mb-auto">
                                        {{ $tag->nama_tag }}
                                    </label>
                                </td>
                                <td class="text-center">
                                    <div>
                                        <!-- edit -->
                                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-sm btn-info" role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- delete -->
                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#logoutModal">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
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
            @foreach ($tags as $tag)
            <form class="d-inline" action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                @csrf
                @method('DELETE')
                @endforeach
                <button class="btn btn-primary">Hapus</button>
            </form>
            
        </div>
    </div>
</div>
</div>