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
                  <a href="#" class="text-white">Tambah Toko</a>
                </li>
<!--                 <li class="separator">
                  <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                  <a href="#" class="text-white">Avatars</a>
                </li> -->
              </ul>
            </div>

          
          </div>
        </div>


        <div class="page-inner mt--5">
          <div class="row mt--2">





          <div class="col-md-12">
              <div class="card">

                <div class="card-body"> 
                    <?= form_open_multipart('admin/tambah_toko'); ?>
                      <div class="form-group">
                        <label for="exampleFormControlSelect">Rute</label>
                        <select class="form-control" id="rute_select" name="rute">
                          <option value=""> -- Pilih rute -- </option>
                        </select>
                        <?= form_error('rute', '<small class="text-danger">', '</small>'); ?>
                      </div>

                      <div class="form-group">
                        <label for="email2">Nama toko</label>
                        <input type="text" class="form-control" name="nama" placeholder="Enter nama" value="<?= set_value('nama'); ?>">
                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                      </div>

                      <div class="form-group">
                        <label for="comment">Alamat</label>
                         <input type="text" class="form-control" placeholder="Alamat" name="alamat" value="<?= set_value('alamat'); ?>">
                        <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                      </div>


                      <div class="form-group">
                        <label>Kontak</label>
                        <input type="number"  class="form-control" placeholder="Enter kontak" name="kontak" value="<?= set_value('kontak'); ?>">
                        <?= form_error('kontak', '<small class="text-danger">', '</small>'); ?>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleFormControlFile1">Pilih foto</label>
                        <input type="file" class="form-control-file" accept="image/*" id="exampleFormControlFile1" name="foto">
                      </div>

                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Status</label>
                        <select class="form-control" id="status" name="status">
                          <option value=""> -- Pilih status -- </option>
                        </select>
                        <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
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
  
  function status() {
        $.ajax({
            url: "<?php echo base_url(); ?>admin/get_status",
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var Body = "";
                for(var key in data){
                  Body +=`<option value="${data[key]['status_id']}">${data[key]['status_nama']}</option>`;
                }
                $("#status").append(Body);
            }
        });
    }
    status();

    function rute() {
        $.ajax({
            url: "<?php echo base_url(); ?>admin/get_rute",
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