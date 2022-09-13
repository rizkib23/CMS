@extends('layouts.main')

@section('title')
Ocoding Bog | {{ $title }}
@endsection

@section('container')
       <!-- Title:start -->
<div class="mt-4 mb-3">     
   <h2 class="text-center mb-3">
    {{ ucwords($posts->judul)  }}
 </h2>
 <!-- Title:end -->

 <div class="row mr-2 ml-2">
    <!-- Post Content Column:start -->
    <div class="col-lg-8">
       <!-- thumbnail:start -->
<<<<<<< HEAD
       <img class="img-thumbnail" style="200x700" src="{{ asset('storage/' . $posts->thumbnail) }}">
       <img class="img-thumbnail" style="200x700" src="{{ asset('storage/..' . $posts->thumbnail) }}">
=======
       <img class="img-thumbnail" style="200x700" src="{{ asset('storage/.' . $posts->thumbnail) }}">
>>>>>>> bd2d7d707d730b4b184077f56ab07e8048df7935
       <!-- thumbnail:end -->
       <hr>
       <!-- Post Content:start -->
       <div>
          {!! $posts->content !!}
       </div>
       <!-- Post Content:end -->
       <hr>
    </div>

    <!-- Sidebar Widgets Column:start -->
    <div class="col-md-4">
       <!-- Categories Widget -->
       <div class="card mb-3">
          <h5 class="card-header">
             Kategori
          </h5>
          <div class="card-body">
             <!-- category list:start -->

                <a href="{{ route('post-kategori', ['slug' => $posts->dataKategori->slug]) }}" class="badge badge-primary py-2 px-4">
                    {{ $posts->dataKategori->name }}
                </a>
             
             <!-- category list:end -->
          </div>
       </div>

       <!-- Side Widget tags:start -->
       <div class="card mb-3">
          <h5 class="card-header">
             Tags
          </h5>
          <div class="card-body">
             <!-- tag list:start -->
             @foreach ($posts->dataTagPost as $tag)
             <a href="" class="badge badge-info py-2 px-4 my-1">
               @foreach ($posts->dataTagPost as $tag)
               {{ $tag->dataTags->name }}
           @endforeach
             </a>
             <!-- tag list:end -->
          </div>
       </div>
       <!-- Side Widget tags:start -->
    </div>
    <!-- Sidebar Widgets Column:end -->
 </div>
</div>
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
               <small class="float-end">30m ago</small>
               <strong>{{ $komentar->dataUser->name }}</strong> mengomentari postingan dari <strong>{{ $posts->dataUser->name }}</strong><br />
               <small class="text-muted">{{ $komentar->created_at }}</small>

               <div class="border text-sm text-muted p-2 mt-1">
                  {{ $komentar->isi }}
               </div>
               <button class="btn btn-outline" id="balas">balas</button>
               <div class="border text-sm text-muted p-2 mt-1 " id="balasan">
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
                            <button class="btn btn-outline-success" type="submit">save</button>
                            </div>
                    </div>
                  </form>
               </div>
               
                  @foreach($komentar->dataChilds as $balasan)
                  <div class="d-flex align-items-start">
                     <img src="{{ asset('storage/' . $balasan->dataUser->dataProfil->foto) }}" width="36" height="36" class="rounded-circle me-2" alt="{{ $balasan->dataUser->name }}">
                     <div class="flex-grow-1">
                        <small class="float-end">30m ago</small>
                        <strong>{{ $balasan->dataUser->name }}</strong> membalas komentar dari <strong>{{ $komentar->dataUser->name }}</strong><br />
                        <small class="text-muted">{{ $balasan->created_at }}</small>

                        <div class="border text-sm text-muted p-2 mt-1">
                           {{ $balasan->isi }}
                        </div>
                     </div>
                  </div>

                  <hr />
                  @endforeach
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
                      <button class="btn btn-outline-success" type="submit">save</button>
                      </div>
              </div>
            </form>
         </div>      
      </div>
   </div>
</div>

@endsection
@push('javascript-external')
  <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
@endpush
@push('javascript-internal')
<script>
   $(document).ready(function(){
      $('#balas').click(function(){
         $('#balasan').toggel('slide');
      });
   });
</script>
@endpush