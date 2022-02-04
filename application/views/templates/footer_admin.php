  

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

  </body>
</html>



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



</script>