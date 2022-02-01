<!DOCTYPE html>
<html lang="en">
<head>
    <title>Batu Bulan - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?= base_url('assets_login/'); ?>images/icons/favicon.ico"/>
        <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/atlantis.min.css">

    <link rel="stylesheet"  href="<?= base_url('assets_login/'); ?>css/util.css">
    <link rel="stylesheet"  href="<?= base_url('assets_login/'); ?>css/main.css">

   

</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-50 p-r-50 p-t-50 p-b-30">
                <form class="login100-form validate-form" method="post" action="<?= base_url('auth/login'); ?>">
                    <span class="login100-form-title p-b-55">
                        Login Page !
                    </span>

                    <div class="wrap-input100 validate-input m-b-16" >
                        <input class="input100" type="text" name="username" placeholder="Username" required="">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="fas fa-home"></span>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" >
                        <input class="input100" type="password" id="input_password" name="password" placeholder="Password" required="">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <span class="lnr lnr-lock"></span>
                        </span>
                    </div>

                    <div class="contact100-form-checkbox m-l-4">
                        <input class="input-checkbox100" id="ckb1" type="checkbox">
                        <label class="label-checkbox100" for="ckb1" onclick="show_password()">
                            Show password
                        </label>
                    </div>
                    
                    <div class="container-login100-form-btn p-t-25">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    
    

    <script src="<?= base_url('assets_login/'); ?>vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url('assets_login/'); ?>vendor/bootstrap/js/popper.js"></script>
    <script src="<?= base_url('assets_login/'); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="<?= base_url('assets_login/'); ?>vendor/select2/select2.min.js"></script> -->
    <script src="<?= base_url('assets_login/'); ?>js/main.js"></script>

    <script src="<?= base_url('assets/'); ?>js/plugin/sweetalert/sweetalert.min.js"></script>


<?php if($this->session->flashdata('nonaktif')){ ?>
  <script>
    swal("<?php echo $this->session->flashdata('nonaktif'); ?>", {
        icon : "warning",
        buttons: {                  
            confirm: {
                className : 'btn btn-warning'
            }
        },
    });
  </script>
<?php } ?>

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

<script type="text/javascript">
    function show_password() {
    var input = document.getElementById("input_password");
    if (input.type === "password") {
      input.type = "text";
    } else {
      input.type = "password";
    }
  } 
</script>
</body>
</html>