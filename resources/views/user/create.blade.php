<div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="modalHeading">Tambahkan User Baru</h5>
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
          <div class="form-group">
            <button type="submit" id="register" class="btn btn-primary btn-lg btn-block">
              Register
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>