@extends('../layouts/dashboard')
@section('title')
@endsection
@section('content')
<div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h1> User </h1>
          </div>
          <div class="card-body">
                    <a href="{{ route('user.create') }}" class="btn btn-md btn-success" style="margin-bottom: 10px">
                        Tambah
                        <i class="fas fa-plus-square"></i>
                    </a>
                    <table class="table table-bordered"  id="myTable">
                    
                        
                     <thead>
                            <tr class="text-center">
                                <th scope="col">no</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                     </thead>
                     <tbody>
                        <?php $no=1; ?>
                        <!-- list category -->
                        @forelse ($user as $users)
                        <tr>
                            <td scope="col" class="text-center">{{ $no++ }}</td>
                            <td>
                                <label class="mt-auto mb-auto">
                                    {{ $users->name }}
                                </label>
                            </td>
                            <td>
                                <label class="mt-auto mb-auto">
                                    {{ $users->email }}
                                </label>
                            </td>
                            <td>
                                    @if (!empty($users->getRoleNames()))
                                        @foreach ($users->getRoleNames() as $item)
                                        <label class="mt-auto mb-auto">{{ $item }}</label>

                                        @endforeach
                                    @endif        
                            </td>
                            <td>
                                <label for="mt-auto mb-auto">
                                    {{ $users->status }}
                                </label>
                            </td>
                            <td class="text-center">
                                <div>
                                    <a href="{{ route('user.show', $users->id) }}" class="btn btn-sm btn-primary" role="button">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <!-- edit -->
                                    <a href="{{ route('user.edit', $users->id) }}" class="btn btn-sm btn-info" role="button">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- delete -->
                                    <form class="d-inline" role="alert" action="{{ route('user.destroy', $users->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            
                        @endforelse ()
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
                        // todo: process of deleting categories
                        event.target.submit();
                    }
                    });
            });
        }); 
    </script>
@endpush
