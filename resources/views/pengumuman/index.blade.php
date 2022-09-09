@extends('../layouts/dashboard')
@section('title')
@endsection
@section('content')
<div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header text-center">
            <h1> Pengumuman </h1>
          </div>
          <div class="card-body">
                    <a href="{{ route('pengumuman.create') }}" class="btn btn-md btn-success" style="margin-bottom: 10px">
                        Tambah
                        <i class="fas fa-plus-square"></i>
                    </a>
                    <table class="table table-bordered"  id="myTable">
                    
                        
                     <thead>
                            <tr class="text-center">
                                <th scope="col">no</th>
                                <th scope="col">Pembuat</th>
                                <th scope="col">Isi</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        
                     </thead>
                     <tbody>
                        <?php $no=1; ?>
                        <!-- list category -->
                        @foreach ($pengumuman as $pengumumans)
                            <!-- category list -->
                           {{-- {{ dd($pengumumans->dataUser) }} --}}
                           <tr>
                                <td scope="col">{{ $no++ }}</td>
                                <td>
                                    <label class="mt-auto mb-auto">
                                        {{ $pengumumans->dataUser->name}}
                                    </label>
                                </td>
                                <td>
                                    <label class="mt-auto mb-auto">
                                        {{ str_word_count($pengumumans->isi) > 60 ? substr("$pengumumans->isi",0,150)." ..[lihat selenkapnya]" : $pengumumans->isi  }}
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
                                        <form class="d-inline" action="{{ route('pengumuman.destroy', $pengumumans->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        </form>
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
@endsection

<!-- Logout Modal-->
<div class="modal fade" id="hapusTags" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

            
        </div>
    </div>
</div>
</div>