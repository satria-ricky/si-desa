
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Silahkan Login!</h1>

        <div class="card" style="display: flex;flex-direction: column;justify-content: center;align-items: center;text-align: center;">
            <div class="card-body">
              <div class="table-responsive">
	              	<form class="mh-100" style="width: 300px;" method="post" action="<?= base_url('auth/login'); ?>">
					    <div class="form-floating">
					    <label for="floatingInput">Username</label>
					      <input type="text" class="form-control" placeholder="Username" name="username">
					    </div>
					    <div class="form-floating">
					    <label for="floatingPassword">Password</label>
					      <input type="password" class="form-control" placeholder="Password" name="password">
					    </div>
					    
					    	<button style="margin-top: 25px;" class="btn btn-primary btn-sm" type="submit">Masuk</button>
					  	
					  </form>
              </div>
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