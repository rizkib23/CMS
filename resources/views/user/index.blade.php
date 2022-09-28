@extends('../layouts/dashboard')
@section('title')
Ocoding | Dashboard - {{ $title }}
@endsection
@section('content')
<div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-info bg-light">
        <div class="card-header text-center bg-primary text-white">
            <h1> User </h1>
        </div>
        <div class="card-body">
                    <a href="javascript:void(0)" id="createUser" class="btn btn-md btn-success" style="margin-bottom: 10px">
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
                                    <a href="javascript:void(0)" id="hapusUser" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $users->id }}" class="delete btn-sm btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
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
@include('user.create')
@endsection

@push('javascript-internal')
<script>
    $('body').on('click','#hapusUser',function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    let id = $(this).data("id");
    Swal.fire({
    title: 'Apakah anda Yakin?',
    text: "Data akan dihapus secara permanen",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Batal',
    confirmButtonText: 'Hapus'
    }).then((result) => {
    if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: `/user/${id}`,
                success:function(data){
                    window.location.reload();
                    Swal.fire(
                            'Berhasil',
                            'Data Berhasil Dihapus',
                            'success'
                            );
                },
                error: function(data){
                    console.log('Error:', data);
                    Swal.fire(
                            'Error',
                            'Data Gagal Dihapus',
                            'error'
                            );
                }
            });
        }
    });   
});
</script>
{{-- tambah user --}}
<script>
$('body').on('click', '#createUser', function () {
    $("#userForm").trigger("reset");
    $('#modalCreate').modal('show');
});
</script>
<script>
    var create = "{{ route('user.store') }}"
    var back = "{{ route('user.index') }}"
    $('body').on('submit', '#userForm', function(e) {
        e.preventDefault();
        var actionType = $('#register').val();
        $('#register').html('Memproses..');
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: create,
            enctype: "multipart/form-data",
            dataType: "json",
            encode: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('#register').html('Terdaftar');
                $('#userForm').trigger("reset");
                $('#modalCreate').modal('hide');
                window.location.reload();
                Swal.fire(
                            'Berhasil',
                            'Data Berhasil Disimpan',
                            'success'
                );
            },
            error: function(data) {
                console.log('Error:', data);
                $('#register').html('Gagal Disimpan');
            }
        });
    });
</script>
@endpush
