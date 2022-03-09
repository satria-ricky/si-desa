
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Profile</h1>
      </div>

      <div class="card" style="margin-top: -50px;">
            <div class="card-body">
              <div class="table-responsive">
                
        <form style="width: 500px;" id="form_profile" method="post">
            <input type="hidden" name="user_id">
              <div class="mb-3"  style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" placeholder="nama" name="nama" value="<?= $data['user_nama']; ?>" id="form1">
                 <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
              </div>

              <div class="mb-3"  style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="username" name="username" value="<?= $data['user_username']; ?>" id="form2">
                 <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
              </div>

              <div class="mb-3"  style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Password</label>
                <input type="text" class="form-control" placeholder="password" name="password" value="<?= $data['user_password']; ?>" id="form3">
                 <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
              </div>

                <button type="button" onclick="button_edit_profile()"  style="margin-top: 25px;" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</button>
            </form>
      

              </div>
            </div>
        </div>

    