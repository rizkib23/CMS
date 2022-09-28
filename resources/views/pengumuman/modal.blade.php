{{-- <div class="card-header text-center">
    <h1>{{ $pengumuman->judul }}</h1> 
</div>
<div class="card-body">
    {!! $pengumuman->isi !!}
</div> --}}
<div class="modal " tabindex="-1" id="detailPengumuman">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="modal-body"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>