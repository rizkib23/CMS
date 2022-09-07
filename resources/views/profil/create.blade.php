@extends('layouts.main')

@section('container')
<div class="mt-5">
<form action="{{ route('profil.update',$profil->id) }}" method="post" enctype="multipart/form-data">
    @method('put')
    @csrf
<div class="row mb-3">
    <label for="no hp" class="col-md-4 col-form-label text-md-end">No Hp</label>

    <div class="col-md-6">
        <input type="number" class="form-control" name="no_tlp" required value="{{ old('no_tlp',$profil->no_tlp) }}">
    </div>
</div>

<div class="row mb-3">
    <label for="email" class="col-md-4 col-form-label text-md-end">Jenis Kelamin</label>

    <div class="col-md-6">
        <div class="form-control">
            <input type="radio" name="jenis_kelamin" required value="{{ old('jenis_kelamin',$profil->jenis_kelamin) }}">Laki-laki
            <input type="radio" name="jenis_kelamin"  value="{{ old('jenis_kelamin',$profil->jenis_kelamin) }}"required>Perempuan
        </div>
    </div>
</div>

<div class="row mb-3">
    <label for="email" class="col-md-4 col-form-label text-md-end">Foto</label>

    <div class="col-md-6">
        <input type="file" class="form-control" name="foto" required value="{{ old('foto',$profil->jenis_kelamin) }}" >
    </div>
</div>
 <button type="submit">SIMPAN</button>
</form>
</div>
@endsection
