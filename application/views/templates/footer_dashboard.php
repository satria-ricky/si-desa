  

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
    // if ($('#isi_tabel').val() == "keluar") {
    //   $('#keluar').DataTable();
    // }else if ($('#isi_tabel').val() == "masuk") {
    //   $('#masuk').DataTable();
    // }
      $('#datatable').DataTable();
  } );




  function show_password() {
    var input = document.getElementById("input_password");
    if (input.type === "password") {
      input.type = "text";
    } else {
      input.type = "password";
    }
  } 

</script>