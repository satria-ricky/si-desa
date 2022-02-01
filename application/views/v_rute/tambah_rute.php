<div class="main-panel">
      <div class="content">
        <div class="panel-header bg-primary-gradient">
          <div class="page-inner py-5">
              
            <div class="page-header text-white">
              <h4 class="page-title text-white">Rute</h4>
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
                  <a href="#" class="text-white">Tambah rute</a>
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
                    <?= form_open_multipart('admin/tambah_rute'); ?>
                      <div class="form-group">
                        <label for="email2">Nama Rute</label>
                        <input type="text" class="form-control" name="nama" placeholder="Enter nama" value="<?= set_value('nama'); ?>">
                        <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
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


</script>
