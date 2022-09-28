@extends('../layouts.dashboard')

@section('title')
Ocoding | Dashboard - {{ $title }}
@endsection
@section('content')
<div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-info bg-light">
          <div class="card-header text-center bg-primary text-white">
            <h1> Role </h1>
          </div>
          <div class="card-body">
            @can('role_create')
            <a href="{{ route('roles.create') }}" class="btn btn-md btn-success" style="margin-bottom: 10px">
                Tambah
                <i class="fas fa-plus-square"></i>
            </a>
            @endcan
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
                        @foreach ($roles as $role)
                            <!-- category list -->
                            
                           <tr>
                                <td scope="col" class="text-center">
                                    {{ $no++ }}</td>
                                <td>
                                    <label class="mt-auto mb-auto">
                                        {{ $role->name }}
                                    </label>
                                </td>
                                <td class="text-center">
                                    <div>
                                        {{-- detail --}}
                                        @can('role_detail', 'role_delete', 'role_update')
                                        <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-primary" role="button">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <!-- edit -->
                                        <a href="{{ route('roles.edit', ['role'=>$role]) }}" class="btn btn-sm btn-info" role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- delete -->
                                        <form class="d-inline" role="alert" action="{{ route('roles.destroy', ['role'=>$role]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                          <button type="submit"  class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        </form>
                                        @endcan
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