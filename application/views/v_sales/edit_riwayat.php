<div class="main-panel">
      <div class="content">
        <div class="panel-header bg-primary-gradient">
          <div class="page-inner py-5">
              
            <div class="page-header text-white">
              <h4 class="page-title text-white">Sales</h4>
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
                  <a href="<?= base_url()?><?= $data_pengguna['level_nama'];?>/daftar_sales" class="text-white">Daftar sales</a>
                </li>
                <li class="separator">
                  <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                  <?php
                    $text = $data_detail['main_id_sales'];
                    $enc = encrypt_url($text);
                    $link = $data_pengguna['level_nama']."/detail_sales/".$enc;
                   ?>
                  <a href="<?= base_url("$link");?>" class="text-white">Detail sales</a>
                </li>
                <li class="separator">
                  <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                  <a href="#" class="text-white">Edit riwayat sales</a>
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
                    <input type="hidden" name="id_sales" value="<?= $data_detail['main_id_sales'];?>">
                      <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date"  class="form-control" name="tanggal" value="<?= $data_detail['main_waktu_mulai'];?>">
                        <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                      </div>


                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Rute</label>
                        <select class="form-control" id="rute_select" name="rute" onchange="get_toko()">
                          <option value=""> -- Pilih RUTE -- </option>
                          <?php foreach($list_rute as $s ) : ?>
                            <?php if($s['rute_id'] == $data_detail['main_id_rute']) : ?>
                              <option value="<?= $s['rute_id']; ?>" selected><?= $s['rute_nama']; ?></option>
                            <?php else : ?>
                              <option value="<?= $s['rute_id']; ?>"><?= $s['rute_nama']; ?></option>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </select>
                        <?= form_error('rute', '<small class="text-danger">', '</small>'); ?>
                      </div>

                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Toko</label>
                        <select class="form-control" id="toko_select" name="toko">
                          <option value=""> -- Pilih TOKO -- </option>
                          <?php foreach($list_toko as $s ) : ?>
                            <?php if($s['toko_id'] == $data_detail['main_id_toko']) : ?>
                              <option value="<?= $s['toko_id']; ?>" selected><?= $s['toko_nama']; ?></option>
                            <?php else : ?>
                              <option value="<?= $s['toko_id']; ?>"><?= $s['toko_nama']; ?></option>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        </select>
                        <?= form_error('toko', '<small class="text-danger">', '</small>'); ?>
                      </div>
                      <hr>
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
                        <input type="number"  class="form-control" name="harga_sepray" value="<?= $data_detail['main_harga_sepray']; ?>">
                        <?= form_error('harga_sepray', '<small class="text-danger">', '</small>'); ?>
                      </div>

                      <div class="form-group">
                        <label>Roll</label>
                        <input type="number"  class="form-control" name="harga_roll" value="<?= $data_detail['main_harga_roll']; ?>">
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

  

function get_toko() {
    
    var id = $("#rute_select").val();
    $.ajax({
          url: "<?php echo base_url(); ?>auth/get_toko",
          type: "post",
          data: {id: id},
          dataType: "json",
          success: function(data) {
              // console.log(data);
              $('#toko_select').html(data);
          }
    });

     
}


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