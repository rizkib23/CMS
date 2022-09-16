@extends('layouts.main')

@section('title')
Ocoding Blog | {{ $title }}
@endsection

@section('container')
       <!-- Title:start -->
<div class="mt-4">     
   <h2 class="text-center mb-3">
    {{ ucwords($posts->judul)  }}
 </h2>
            </div>
 <!-- Title:end -->

 <div class="row mr-2 ml-2">
    <!-- Post Content Column:start -->
    <div class="col-lg-8">
       <div class="col-md-12">
       <!-- thumbnail:start -->
       <img  src="{{ asset('storage/..' . $posts->thumbnail) }}">
       <!-- thumbnail:end -->
       <hr>
       <!-- Post Content:start -->
       <div class="col-md-12">
          {!! $posts->content !!}
       </div>
       <!-- Post Content:end -->
       <hr>
      </div>
    </div>

    <!-- Sidebar Widgets Column:start -->
    <div class="col-md-4">
       <!-- Categories Widget -->
       <div class="card mb-5">
          <h5 class="card-header">
             Kategori
          </h5>
          <div class="card-body">
             <!-- category list:start -->

                <a href="{{ route('post-kategori', ['slug' => $posts->dataKategori->slug]) }}" class="badge badge-primary py-2 px-2">
                    {{ $posts->dataKategori->name }}
                </a>
             
             <!-- category list:end -->
          </div>
       </div>

       <!-- Side Widget tags:start -->
       <div class="card mb-4">
          <h5 class="card-header">
             Tags
          </h5>
          <div class="card-body">
             <!-- tag list:start -->
             @foreach ($posts->dataTagPost as $tag)
             <a href="{{ route('post-tag', ['slug'=> $tag->dataTags->slug]) }}" class="badge badge-info py-2 px-4 my-1">
               #{{ $tag->dataTags->name }}
            </a>
           @endforeach
             <!-- tag list:end -->
          </div>
       </div>
       <!-- Side Widget tags:start -->
       <div class="card mb-4">
         <h5 class="card-header">
            Deskripsi
         </h5>
         <div class="card-body">
            <!-- tag list:start -->
            <p>
              {{ $posts->deskripsi }}
           </p>
            <!-- tag list:end -->
         </div>
      </div>
    </div>
    <!-- Sidebar Widgets Column:end -->
 </div>
</div>
{{-- komen --}}
<div class="col-12 d-flex">
   <div class="card flex-fill w-100">
      <div class="card-header">
         <span class="badge bg-info float-end">Komentar</span>
      </div>
      <div class="card-body">
         @foreach($posts->dataKomen->where('parent', 0) as $komentar)
         <div class="d-flex align-items-start">
            <img src="{{ asset('storage/' . $komentar->dataUser->dataProfil->foto) }}" width="36" height="36" class="rounded-circle me-2" alt="{{ $komentar->dataUser->name }}">
            <div class="flex-grow-1">
               <small class="float-end">{{ $komentar->updated_at }}</small>
               <strong>{{ $komentar->dataUser->name }}</strong> mengomentari postingan dari <strong>{{ $posts->dataUser->name }}</strong><br />
               <small class="text-muted">{{ $komentar->created_at }}</small>

               <div class="border text-sm text-muted p-2 mt-1">
                  {{ $komentar->isi }}
               </div>
               {{-- hapus --}}
               @if(Auth::check() == true)
               @if(Auth::user()->id == $komentar->user_id)
               <form class="d-inline" role="alert" alert-title="Apakah Kamu Yakin?" alert-text="Data akan dihapus" action="{{ route('komen.destroy',['koman'=>$komentar->id] ) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-outline">
                       <i class="fas fa-trash"></i>Hapus
                  </button>
              </form>
              @else
              @endif
              @endif
               {{--  --}}
               <button class="btn btn-outline" type="button" data-bs-toggle="collapse" data-bs-target="#balas{{ $komentar->id }}" aria-expanded="false" aria-controls="collapseWidthExample" id="balas">
                  <i class="bi bi-reply"></i> Balas
               </button>
               {{-- balas komen --}}
               <div class="collapse collapse-horizontal mt-4" id="balas{{ $komentar->id }}">
                  <form action="{{ route('komen.store') }}" method="POST">
                     @csrf
                     <div class="form-group">
                        <input type="hidden" name="post_id" value="{{ $posts->id }}">
                        <input type="hidden" name="parent" value="{{ $komentar->id }}">
                        <textarea id="input_post_deskripsi" name="isi" value="{{ old('isi') }}" placeholder="Masukkan komentar" class=" form-control @error('isi') is-invalid @enderror"
                            rows="1"></textarea>
                            @error('isi')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="mt-2">
                            <button class="btn btn-sm btn-outline-info" type="submit"><i class="bi bi-send-fill"></i>Kirim</button>
                            </div>
                    </div>
                  </form>
               </div>
               {{-- balasan komentar --}}
                  @foreach($komentar->dataChilds as $balasan)
                  <div class="d-flex align-items-start">
                     <img src="{{ asset('storage/' . $balasan->dataUser->dataProfil->foto) }}" width="36" height="36" class="rounded-circle me-2" alt="{{ $balasan->dataUser->name }}">
                     <div class="flex-grow-1">
                        <small class="float-end">{{ $balasan->updated_at }}</small>
                        <strong>{{ $balasan->dataUser->name }}</strong> membalas komentar dari <strong>{{ $komentar->dataUser->name }}</strong><br />
                        <small class="text-muted">{{ $balasan->created_at }}</small>

                        <div class="border text-sm text-muted p-2 mt-1">
                           {{ $balasan->isi }}
                        </div>
                     </div>
                  </div>

                  <hr />
                  @endforeach
                  {{-- end --}}
               </div>
            </div>
            @endforeach
            <form action="{{ route('komen.store') }}" method="POST">
               @csrf
               <div class="form-group">
                  <input type="hidden" name="post_id" value="{{ $posts->id }}">
                  <input type="hidden" name="parent" value="0">
                  <textarea id="input_post_deskripsi" name="isi" value="{{ old('isi') }}" placeholder="Masukkan komentar" class=" form-control @error('isi') is-invalid @enderror"
                      rows="3"></textarea>
                      @error('isi')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                      <div class="mt-2">
                      <button class="btn btn-outline-success" type="submit"><i class="bi bi-send-fill"></i> Kirim</button>
                      </div>
              </div>
            </form>
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