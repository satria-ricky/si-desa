<div class="main-panel">
      <div class="content">
        <div class="panel-header bg-primary-gradient">
          <div class="page-inner py-5">
              
            <div class="page-header text-white">
              <h4 class="page-title text-white">Toko</h4>
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
                  <a href="<?= base_url()?><?= $data_pengguna['level_nama'];?>/daftar_toko" class="text-white">Daftar toko</a>
                </li>
                <li class="separator">
                  <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                  <?php
                    $text = $data_detail['main_id_toko'];
                    $enc = encrypt_url($text);
                    $link = $data_pengguna['level_nama']."/detail_toko/".$enc;
                   ?>
                  <a href="<?= base_url("$link");?>" class="text-white">Detail toko</a>
                </li>
                <li class="separator">
                  <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                  <a href="#" class="text-white">Edit riwayat toko</a>
                </li>
              </ul>
            </div>

          
          </div>
        </div>


        <div class="page-inner mt--5">
          <div class="row mt--2">





          <div class="col-md-12">
              <div class="card">

                <div class="card-body"> 
                    <?= form_open_multipart(); ?>
                    <input type="hidden" name="id_toko" value="<?= $data_detail['main_id_toko'];?>">
                      <div class="form-group">
                        <label>Nama Sales</label>
                        <input type="text"  class="form-control" readonly="" value="<?= $data_detail['user_nama'];?>">
                      </div>

                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date"  class="form-control" name="tanggal" value="<?= $data_detail['main_waktu_mulai'];?>">
                        <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                      </div>
                      <h3> Stok produk </h3>
                      <div class="form-group">
                        <label>Sepray</label>
                        <input type="number"  class="form-control" name="sepray" value="<?= $data_detail['main_stok_sepray'];?>">
                      </div>

                      <div class="form-group">
                        <label>Roll</label>
                        <input type="number"  class="form-control" name="roll" value="<?= $data_detail['main_stok_roll'];?>">
                      </div>
                       <hr>
                      <h3> Harga Satuan </h3>
                      <div class="form-group">
                        <label>Sepray</label>
                        <input type="number"  class="form-control" name="harga_sepray" value="<?= $data_detail['main_harga_sepray'];?>">
                        <?= form_error('harga_sepray', '<small class="text-danger">', '</small>'); ?>
                      </div>

                      <div class="form-group">
                        <label>Roll</label>
                        <input type="number"  class="form-control" name="harga_roll" value="<?= $data_detail['main_harga_roll'];?>">
                      </div>
                      <?= form_error('harga_roll', '<small class="text-danger">', '</small>'); ?>

                      <hr>

                      <h3> Bonus </h3>
                      <div class="form-group">
                        <label>Sepray</label>
                        <input type="number"  class="form-control" name="bonus_sepray" value="<?= $data_detail['main_bonus_sepray'];?>">
                      </div>

                      <div class="form-group">
                        <label>Roll</label>
                        <input type="number"  class="form-control" name="bonus_roll" value="<?= $data_detail['main_bonus_roll'];?>">
                      </div>

                      <button type="button" class="btn btn-primary float-right mr-2" id="button_edit">
                        <span class="btn-label">
                          <i class="fas fa-edit"></i>
                        </span>
                        Ubah riwayat
                      </button>
                    <?= form_close(); ?>
                </div>
              </div>
            </div>




            
              </div>
            </div>
          </div>



 
<script type="text/javascript">


    $('#button_edit').click(function(e) {
        swal({
          title: 'Yakin diubah?',
          icon: 'warning',
          buttons:{
            confirm: {
              text : 'Ubah',
              className : 'btn btn-success'
            },
            cancel: {
              text : 'Tidak',
              visible: true,
              className: 'btn btn-focus'
            }
          }
        }).then((Ubah) => {
          if (Ubah) {
            $('form').submit();
          } else {
            swal.close();
          }
        });

      });

</script>

<?php if($this->session->flashdata('pesan')){ ?>
  <script>
    swal("<?php echo $this->session->flashdata('pesan'); ?>", {
        icon : "success",
        buttons: {                  
            confirm: {
                className : 'btn btn-success'
            }
        },
    });
  </script>
<?php } ?>