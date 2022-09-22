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
                    <h1> Tags</h1>
                </div>
                <div class="card-body">
                    <a href="javascript:void(0)" id="createTag" class="btn btn-md btn-success" style="margin-bottom: 10px">
                        Tambah<i class="fas fa-plus-square"></i>
                    </a>
                    <table class="table table-bordered" id="data-table" >
                        <thead>
                            <tr class="text-center">
                                <th scope="col">no</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@include('sweetalert::alert')
@include('tags.insert')
@endsection

@push('javascript-internal')
{{-- modal create --}}
<script>
    $('body').on('click', '#createTag', function () {
    $("#modalHeading").html('Tambah Tag');
    $("#tagForm").trigger("reset");
    $('#modalCreate').modal('show');
});
</script>
{{-- modal edit --}}
<script>
//edit data
$('body').on('click', '#editTag', function() {
    var id = $(this).data('id');
    $.get("{{ route('tags.index') }}" + "/" + id + "/edit", function(data) {
        $("#modalHeading").html('Edit Tag');
        $("#modalCreate").modal('show');
        $("#id").val(data.id);
        $("#name").val(data.name);
    })
});
</script>
<script>
$(function () {     
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('tags.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});
</script>
<script>

//delete data
$('body').on('click','#hapusTag',function(){
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
                url: `/tags/${id}`,
                success:function(data){
                    var oTable = $('#data-table');
                    oTable.DataTable().ajax.reload();
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
{{-- tambah --}}
<script>
    var create = "{{ route('tags.store') }}"
    var back = "{{ route('tags.index') }}"
    $('body').on('submit', '#tagForm', function(e) {
        e.preventDefault();
        var actionType = $('#tagSave').val();
        $('#tagSave').html('Mengirim..');
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
                $('#tagSave').html('Tersimpan');
                $('#tagForm').trigger("reset");
                $('#modalCreate').modal('hide');
                var oTable = $('#data-table');
                    oTable.DataTable().ajax.reload();
                Swal.fire(
                            'Berhasil',
                            'Data Berhasil Disimpan',
                            'success'
                            );
                $('#tagSave').html('SIMPAN');
            },
            error: function(data) {
                console.log('Error:', data);
                $('#tagSave').html('Gagal Disimpan');
            }
        });
    });
</script>
@endpush
