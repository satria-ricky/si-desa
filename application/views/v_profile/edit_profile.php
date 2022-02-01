<div class="main-panel">
      <div class="content">
        <div class="panel-header bg-primary-gradient">
          <div class="page-inner py-5">
              
            <div class="page-header text-white">
              <h4 class="page-title text-white">Profile</h4>
              <ul class="breadcrumbs">
                <li class="nav-home">
                  <a href="#">
                    <i class="flaticon-home text-white"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item ">
                  <a href="<?= base_url()?><?= $data_pengguna['level_nama'];?>/profile" class="text-white">Detail profile</a>
                </li>
                <li class="separator">
                  <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                  <a href="#" class="text-white">Edit profile</a>
                </li>
              </ul>
            </div>
          </div>
        </div>


        <div class="page-inner mt--5">
          <div class="row mt--2">



<!-- ISI KONTEN -->

            <div class="col-md-12">
              <div class="card">
                <div class="card-body">

                      

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?= base_url('assets/foto/user/').$data_pengguna['user_foto']; ?>" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <b><h1><?= $data_pengguna['user_nama'];?></h1></b>
                      <p class="text-secondary mb-1"><?= $data_pengguna['level_nama'];?></p>
                      <p class="text-muted font-size-sm">Terakhir diubah pada : <?php if ($data_pengguna['last_updated'] == "") { ?>
                          -
                      <?php }else{ ?>
                        <?= $data_pengguna['last_updated'];?>
                      <?php } ?>
                        </p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-8">
              <?= form_open_multipart(); ?>
              <div class="card">
            <div class="card-body">
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mt-2 mb-0">Nama lengkap</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" name="nama" value="<?= $data_pengguna['user_nama'];?>">
                  <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mt-2 mb-0">Username</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" name="username" value="<?= $data_pengguna['user_username'];?>">
                  <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mt-2 mb-0">Password</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                
                    <input type="password" id="input_password" name="password" class="form-control" value="<?= $data_pengguna['user_password'];?>">
                  <div class="ml-4">
                  <input class="form-check-input " type="checkbox" onclick="show_password()">
                  <span class="form-check-sign">Show password</span>
                  </div>
                  <?= form_error('password', '<small class="text-danger">', '</small>'); ?> 
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mt-2 mb-0">Kontak</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="number" class="form-control" name="kontak" value="<?= $data_pengguna['user_kontak'];?>">
                  <?= form_error('kontak', '<small class="text-danger">', '</small>'); ?>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mt-2 mb-0">Alamat</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="text" class="form-control" name="alamat" value="<?= $data_pengguna['user_alamat'];?>">
                  <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-3">
                  <h6 class="mt-1 mb-0">Ganti foto?</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <input type="file" class="form-control-file" name="foto" accept="image/*" id="exampleFormControlFile1">
                </div>
              </div>

              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 text-secondary">
                  <button type="button" class="btn btn-primary px-4" id="button_edit_profile"> Simpan Perubahan </button>
                  <?= form_close(); ?>
                </div>
              </div>
            </div>
          </div>

              


            </div>
          </div>

  



                </div>
              </div>
            </div>

<!-- ISI KONTEN -->
            
              </div>
            </div>
          </div>

<script type="text/javascript">
  
  $('#button_edit_profile').click(function(e) {
          swal({
            title: 'Simpan perubahan?',
            icon: 'warning',
            buttons:{
              confirm: {
                text : 'Simpan',
                className : 'btn btn-success'
              },
              cancel: {
                text : 'Tidak',
                visible: true,
                className: 'btn btn-focus'
              }
            }
          }).then((Edit) => {
            if (Edit) {
              $('form').submit();
            } else {
              swal.close();
            }
          });

        });

</script>

<?php if($this->session->flashdata('error')){ ?>
  <script>
    swal("<?php echo $this->session->flashdata('error'); ?>", {
        icon : "error",
        buttons: {                  
            confirm: {
                className : 'btn btn-danger'
            }
        },
    });
  </script>
<?php } ?>