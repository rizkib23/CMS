@extends('../layouts/dashboard')

@section('title')
Ocoding | Dashboard - {{ $title }}
@endsection
@section('content')
<div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
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
                                        <td>
                                            <label class="mt-auto mb-auto">
                                                <!-- todo: show category slug -->
                                                {{ $kategori->slug }}
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <div>
                                                <!-- detail -->
                                                <a href="{{ route('kategoris.show', $kategori->id) }}" class="btn btn-sm btn-primary" role="button">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <!-- edit -->
                                                <a href="{{ route('kategoris.edit', $kategori->id) }}"
                                                    class="btn btn-sm btn-info" role="button">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- delete -->
                                                <form class="d-inline" role="alert"
                                                    action="{{ route('kategoris.destroy', $kategori->id) }}" role="alert"
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