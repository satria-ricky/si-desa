
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= base_url('assets/'); ?>img/icon.ico">

    <title>SI Keuangan Desa Dordungga Kec.Donggo Kab.Bima</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/dashboard/docs/'); ?>dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?= base_url('assets/dashboard/docs/'); ?>assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/dashboard/docs/'); ?>examples/justified-nav/justified-nav.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap4.min.css">
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

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="masthead">
        <h3 class="text-muted">SISTEM INFORMASI KEUANGAN DESA DORDUNGGA KEC.DONGGO KAB.BIMA</h3>
        <nav>
          <ul class="nav nav-justified">
            <!-- <li class="active"><a href="#">Home</a></li> -->
            <li class="<?= ($is_aktif === 'masuk') ? 'active' : '' ?>"><a href="<?= base_url(); ?>dashboard/masuk">Pemasukan Desa</a></li>
            <li class="<?= ($is_aktif === 'keluar') ? 'active' : '' ?>"><a href="<?= base_url(); ?>dashboard/">Pengeluaran Desa</a></li>
            <li class="<?= ($is_aktif === 'login') ? 'active' : '' ?>"><a href="<?= base_url(); ?>dashboard/login">Login</a></li>
          </ul>
        </nav>        
      </div>
