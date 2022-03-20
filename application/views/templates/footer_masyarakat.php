  

      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; Kantor Desa Doridungga Kec. Donggo Kab. Bima</p>
      </footer>

    </div> <!-- /container -->

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/dashboard/docs/'); ?>assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>


   
     <script>window.jQuery || document.write('<script src="<?= base_url('assets/dashboard/docs/'); ?>assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?= base_url('assets/dashboard/docs/'); ?>dist/js/bootstrap.min.js"></script>

    <!-- Chart JS -->
  <script src="<?= base_url('assets/charts/'); ?>js/plugin/chart.js/chart.min.js"></script>

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
          className : 'btn btn-danger'
        },
        cancel: {
          text : 'Tidak',
          visible: true,
          className: 'btn btn-success'
        }
      }
    }).then((keluar) => {
      if (keluar) {
        document.location.href = "<?php echo base_url('auth/logout')?>";
      };
    });
  }
  

function button_refresh(is) {

    swal({
        title: 'Refresh Data ?',
        icon: 'warning',
        buttons:{
          confirm: {
            text : 'Iya',
            className : 'btn btn-success'
          },
          cancel: {
            text : 'Batal',
            visible: true,
            className: 'btn btn-focus'
          }
        }
      }).then((Refresh) => {
        if (Refresh) {
           if (is  == 1) {
              document.location.href = "<?php echo base_url('masyarakat/masuk')?>";
           }else{
              document.location.href = "<?php echo base_url('masyarakat/keluar')?>";
           }
        } else {
          swal.close();
        }
      });
   
  }



 function button_filter(is) {

    var tahun = $('#tahun_filter').val();
    var bidang = $('#bidang_filter').val();
    var sumber = $('#sumber_filter').val();

    if(is == 1){
        // filter_masuk(is,tahun);
        if(sumber.length == 0 && tahun.length == 0){
      
          swal({
            title: 'Opppss!',
            text: 'Harap isi form!',
            icon: 'warning',
            buttons: {                  
                confirm: {
                    className : 'btn btn-focus'
                }
            },
          });
          
        }
        else{
          document.location.href = "<?php echo base_url('masyarakat/filter_masuk?')?>sumber="+sumber+"&tahun="+tahun;    
        }

      }
      else{
        // filter_keluar(is,tahun);
        if(bidang.length == 0 || tahun.length == 0){
          
          swal({
            title: 'Opppss!',
            text: 'Harap isi form!',
            icon: 'warning',
            buttons: {                  
                confirm: {
                    className : 'btn btn-focus'
                }
            },
          });
          
        }
        else{
            document.location.href = "<?php echo base_url('masyarakat/filter_keluar?')?>bidang="+bidang+"&tahun="+tahun;
        }
      }   
  }

</script>

 