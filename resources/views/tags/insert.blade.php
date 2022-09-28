<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg border-info bg-light">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="modalHeading"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <form action="" id="tagForm" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nama Tag</label>
                            <input type="hidden" name="id" id="id">
                            <input type="text" style="text-transform: capitalize;" name="name" id="name" placeholder="Masukkan Nama Tag" required  class="form-control" autofocus>
                        </div>
                        <div class="float-right">
                            <button type="reset" class="btn btn-outline-danger px-4">
                                <i class="bi bi-arrow-counterclockwise"></i>Reset
                            </button>
                            <button type="submit" id="tagSave" class="btn btn-outline-primary px-4">
                                <i class="bi bi-save2"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
