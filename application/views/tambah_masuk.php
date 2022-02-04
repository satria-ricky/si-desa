
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Tambah Pemasukan Desa</h1>
      </div>

      <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                
        <form class="mh-100" style="width: 300px;" method="post" action="<?= base_url('auth/login'); ?>">
              
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
              </div>
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
            
                <button style="margin-top: 25px;" class="btn btn-primary" type="submit"><i class="fas fa-plus"></i> Tambah data</button>
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