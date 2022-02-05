
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Tambah Pemasukan Desa</h1>
      </div>

      <div class="card" style="margin-top: -50px;">
            <div class="card-body">
              <div class="table-responsive">
                
        <form style="width: 500px;" method="post" action="<?= base_url('admin/tambah_masuk'); ?>">
              
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Jenis Pemasukan</label>
                <input type="text" class="form-control" name="jenis" required="">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Asal Pemasukan</label>
                <input type="text" class="form-control" name="asal" required="">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tahun Pemasukan</label>
                <input type="number" class="form-control" name="tahun" required="">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                <input type="number" class="form-control" name="jumlah" required="">
              </div>
              
            
                <button id="button_tambah" style="margin-top: 25px;" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah data</button>
            </form>
      

              </div>
            </div>
        </div>

      




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

<?php if($this->session->flashdata('logout')){ ?>
  <script>
    swal("<?php echo $this->session->flashdata('logout'); ?>", {
        icon : "success",
        buttons: {                  
            confirm: {
                className : 'btn btn-success'
            }
        },
    });
  </script>
<?php } ?>