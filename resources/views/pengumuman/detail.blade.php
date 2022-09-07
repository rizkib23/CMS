@extends('../layouts/dashboard')

@section('content')

<div class="container mt-4">
    <div class="row">
       <div class="col-12">
          <div class="card">
                <div class="card-header text-center">
                    <h1> Isi Pengumuman </h1> 
                </div>
                <div class="card-body">
                       {{ $pengumuman->isi }}
                </div>
          </div>
       </div>
    </div>
</div>


    @endsection