<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= base_url('assets/'); ?>foto/logo.png">

    <title>SI Keuangan Desa Doridungga Kec.Donggo Kab.Bima</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/dashboard/docs/'); ?>dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?= base_url('assets/dashboard/docs/'); ?>assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/signin/'); ?>signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?= base_url('assets/dashboard/docs/'); ?>assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>

  <body>

    <div class="container">
      <div class="mb-4"  style="display: flex;flex-direction: column; justify-content: center;align-items: center; text-align: center; margin-bottom: 20px;">
         <img class="mb-4" src="<?= base_url(); ?>assets/foto/logo.PNG" width="150" height="150">
        </div>

        <form class="form-signin" method="post" action="<?= base_url('auth/login'); ?>">
        
        <!-- <h2 class="form-signin-heading">Please sign in</h2> -->

         <div class="form-group">
          <label for="exampleFormControlInput1">Masuk sebagai:</label>
          <select class="form-control" name="level_user">
            <option value="1">Super Admin</option>
            <option value="2">Admin</option>
            <option value="3">Kepala Desa</option>
            <option value="4">Sekretaris</option>
          </select>
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput1">Username</label>
          <input type="text" class="form-control"  name="username" id="exampleFormControlInput1" placeholder="username" required="">
        </div>

        <div class="form-group">
          <label for="exampleFormControlInput12">Password</label>
          <input type="password" class="form-control" name="password" id="exampleFormControlInput12" placeholder="password" required="">
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Masuk </button>
      </form>
        <a href="<?= base_url(); ?>masyarakat" class="btn btn-focus btn-block">Kembali ke Halaman Utama</a>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?= base_url('assets/dashboard/docs/'); ?>assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

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
