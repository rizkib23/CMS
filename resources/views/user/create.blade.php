<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg border-info">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title" id="modalHeading">Tambahkan User Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="userForm">
          @csrf
          <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" class="form-control" name="name" autofocus>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email">
          </div>
          <div class="float-right">
            <button type="reset" class="btn btn-outline-danger px-4">
                <i class="bi bi-arrow-counterclockwise"></i>Reset
            </button>
            <button type="submit" id="register" class="btn btn-outline-primary px-4">
                <i class="bi bi-save2"></i> Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>