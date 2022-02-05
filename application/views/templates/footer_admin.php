  

      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; Kantor Desa Dordungga Kec. Donggo Kab. Bima</p>
      </footer>

    </div> <!-- /container -->

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?= base_url('assets/dashboard/docs/'); ?>assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
     <script>window.jQuery || document.write('<script src="<?= base_url('assets/dashboard/docs/'); ?>assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?= base_url('assets/dashboard/docs/'); ?>dist/js/bootstrap.min.js"></script>
    
  </body>
</html>


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


<script type="text/javascript">
  
  $(document).ready(function() {
      $('#datatable').DataTable();
  } );



  function button_logout() {
    swal({
            title: 'Yakin logout?',
            icon : "warning",
            buttons:{
              confirm: {
                text : 'Iya',
                className : 'btn btn-focus'
              },
              cancel: {
                text : 'Tidak',
                visible: true,
                className: 'btn btn-primary'
              }
            }
          }).then((keluar) => {
            if (keluar) {
              document.location.href = "<?php echo base_url('auth/logout')?>";
            };
          });
  }


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
  

  function button_kembali() {
    window.history.go(-1)
  }


</script>