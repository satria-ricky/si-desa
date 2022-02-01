<div class="main-panel">
      <div class="content">
        <div class="panel-header bg-primary-gradient">
          <div class="page-inner py-5">
              
            <div class="page-header text-white">
              <h4 class="page-title text-white">Kerja</h4>
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
                  <a href="#" class="text-white">Tambah kerja</a>
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
                    <?= form_open_multipart('sales/tambah_kerja'); ?>

                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Rute</label>
                        <select class="form-control" id="rute_select" name="rute" onchange="get_toko()">
                          <option value=""> -- Pilih RUTE -- </option>
                        </select>
                        <?= form_error('rute', '<small class="text-danger">', '</small>'); ?>
                      </div>

                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Toko</label>
                        <select class="form-control" id="toko_select" name="toko">
                          <option value=""> -- Pilih TOKO -- </option>
                        </select>
                        <?= form_error('toko', '<small class="text-danger">', '</small>'); ?>
                      </div>
                      <hr>
                      <h3> Stok produk </h3>
                      <div class="form-group">
                        <label>Sepray</label>
                        <input type="number"  class="form-control" name="sepray" value="<?= set_value('sepray'); ?>">
                      </div>

                      <div class="form-group">
                        <label>Roll</label>
                        <input type="number"  class="form-control" name="roll" value="<?= set_value('roll'); ?>">
                      </div>
                      <hr>
                      <h3> Harga Satuan </h3>
                      <div class="form-group">
                        <label>Sepray</label>
                        <input type="number"  class="form-control" name="harga_sepray" value="<?= set_value('harga_sepray'); ?>">
                        <?= form_error('harga_sepray', '<small class="text-danger">', '</small>'); ?>
                      </div>

                      <div class="form-group">
                        <label>Roll</label>
                        <input type="number"  class="form-control" name="harga_roll" value="<?= set_value('harga_roll'); ?>">
                      </div>
                      <?= form_error('harga_roll', '<small class="text-danger">', '</small>'); ?>
                    <hr>
                      <h3> Bonus </h3>
                      <div class="form-group">
                        <label>Sepray</label>
                        <input type="number"  class="form-control" name="bonus_sepray" value="<?= set_value('bonus_sepray'); ?>">
                      </div>

                      <div class="form-group">
                        <label>Roll</label>
                        <input type="number"  class="form-control" name="bonus_roll" value="<?= set_value('bonus_roll'); ?>">
                      </div>

                      <button type="button" class="btn btn-primary float-right mr-2" id="button_tambah">
                        <span class="btn-label">
                          <i class="fa fa-plus"></i>
                        </span>
                        Tambah
                      </button>
                    <?= form_close(); ?>
                </div>
              </div>
            </div>




            
              </div>
            </div>
          </div>



 
<script type="text/javascript">


    $('#button_tambah').click(function(e) {
        swal({
          title: 'Yakin ditambah?',
          icon: 'warning',
          buttons:{
            confirm: {
              text : 'Tambah',
              className : 'btn btn-success'
            },
            cancel: {
              text : 'Tidak',
              visible: true,
              className: 'btn btn-focus'
            }
          }
        }).then((Tambah) => {
          if (Tambah) {
            $('form').submit();
          } else {
            swal.close();
          }
        });

      });


 function rute() {
    $.ajax({
        url: "<?php echo base_url(); ?>auth/get_rute",
        dataType: "json",
        success: function(data) {
            // console.log(data);
            var Body = "";
            for(var key in data){
              Body +=`<option value="${data[key]['rute_id']}">${data[key]['rute_nama']}</option>`;
            }
            $("#rute_select").append(Body);
        }
    });
}
rute();
  

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