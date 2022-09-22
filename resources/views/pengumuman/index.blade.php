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
                    <h1> Pengumuman </h1>
                </div>
                <div class="card-body">
                    <a href="{{ route('pengumuman.create') }}" class="btn btn-md btn-success" style="margin-bottom: 10px">
                        Tambah<i class="fas fa-plus-square"></i>
                    </a>
                    <table class="table table-bordered"  id="myTable">                       
                        <thead>
                            <tr class="text-center">
                                <th scope="col">no</th>
                                <th scope="col">judul</th>
                                <th scope="col">Isi</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>                        
                        </thead>
                        <tbody>
                            <?php $no=1; ?>
                            <!-- list category -->
                            @foreach ($pengumuman as $pengumumans)
                                <tr>
                                    <td scope="col">{{ $no++ }}</td>
                                    <td>
                                        <label class="mt-auto mb-auto">
                                            {{ $pengumumans->judul}}
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mt-auto mb-auto">
                                            {!! str_word_count($pengumumans->isi) > 20 ? substr("$pengumumans->isi",0,50)." ..[lihat selenkapnya]" : $pengumumans->isi  !!}
                                        </label>
                                    </td>
                                    <td>
                                        <label class="mt-auto mb-auto">
                                            {{ $pengumumans->tanggal }}
                                        </label>
                                    </td>
                                    <td class="text-center">
                                        <div>
                                            @if ( $pengumumans->user_id !== Auth::user()->id )
                                                <!-- detail -->
                                                <a href="{{ route('pengumuman.show', $pengumumans->id) }}" class="btn btn-sm btn-primary" role="button">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @else
                                                <!-- detail -->
                                                <a href="{{ route('pengumuman.show', $pengumumans->id) }}" class="btn btn-sm btn-primary" role="button">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <!-- edit -->
                                                <a href="{{ route('pengumuman.edit', $pengumumans->id) }}" class="btn btn-sm btn-info" role="button">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <!-- delete -->
                                                <a href="javascript:void(0)" id="hapusPengumuman" data-toggle="tooltip" data-original-title="Delete" data-id="{{ $pengumumans->id }}" class="delete btn-sm btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            @endif
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
    $('body').on('click','#hapusPengumuman',function(){
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
                url: `/pengumuman/${id}`,
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
@endpush
