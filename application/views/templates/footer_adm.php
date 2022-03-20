  

      <!-- Site footer -->
      <footer class="footer">
        <p>&copy; Kantor Desa Doridungga Kec. Donggo Kab. Bima</p>
      </footer>

    </div> <!-- /container -->

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
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


  $('#button_tambah').click(function(e) {
        if ($('#form1').val() == '' || $('#form2').val() == '' || $('#form3').val() == '' || $('#form4').val() == '') 
        {
           swal({
              title: 'Opppss!',
              text: 'Harap isi semua form!',
              icon: 'warning',
              buttons: {                  
                  confirm: {
                      className : 'btn btn-focus'
                  }
              },
          });
        }
        else {
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
              document.getElementById("form_tambah").submit();
            } else {
              swal.close();
            }
          });
        }
    });
    


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
              document.location.href = "<?php echo base_url('adm/masuk')?>";
           }else{
              document.location.href = "<?php echo base_url('adm/keluar')?>";
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
          document.location.href = "<?php echo base_url('adm/filter_masuk?')?>sumber="+sumber+"&tahun="+tahun;    
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
            document.location.href = "<?php echo base_url('adm/filter_keluar?')?>bidang="+bidang+"&tahun="+tahun;
        }
      }   
  }


//get sub bidang

$(document).ready(function(){
  $('#bidang').change(function(){
    var id = $(this).val();
    $.ajax({
      url: "<?= base_url('auth/get_subbidang'); ?>",
      data: {
        id : id
      },
      type: "POST",
      dataType : "JSON",
      success: function(response){
        $('#sub_bidang').html(response);
      }
    
    });
  });
});


//get jenis pemasukan
$(document).ready(function(){
  $('#sumber').change(function(){
    var id = $(this).val();
    $.ajax({
      type: "POST",
      url: "<?= base_url('auth/get_jenis'); ?>",
      data: {
        id : id
      },
      dataType : "JSON",
      success: function(response){
        $('#jenis').html(response);
      }
    
    });
  });
});


function isNumberKey(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode != 46 && charCode > 31 
    && (charCode < 48 || charCode > 57))
     return false;

  return true;
}



//MODAL



function get_tahun(jenis) {
  var jenis = jenis;
  // console.log(jenis);
    $.ajax({
        url: "<?php echo base_url(); ?>auth/get_tahun_modal",
        type: "post",
        data: {jenis: jenis},
        dataType: "json",
        success: function(data) {
            // console.log(data);
            $("#modal_tahun").html(data);
        }
    });
}


function button_edit_profile (){

  if ($('#form1').val() == '' || $('#form2').val() == '' || $('#form3').val() == '') 
        {
           swal({
              title: 'Opppss!',
              text: 'Harap isi semua form!',
              icon: 'warning',
              buttons: {                  
                  confirm: {
                      className : 'btn btn-focus'
                  }
              },
            });
        }
        else {
          swal({
            title: 'Simpan Perubahan?',
            icon: 'warning',
            buttons:{
              confirm: {
                text : 'Simpan',
                className : 'btn btn-success'
              },
              cancel: {
                text : 'Tidak',
                visible: true,
                className: 'btn btn-focus'
              }
            }
          }).then((Edit) => {
            if (Edit) {
              document.getElementById("form_profile").submit();
            } else {
              swal.close();
            }
          });
        }
}



//LAPORAN
function button_tambah_laporan(){
  $('#modal_tambah_laporan').modal('show');
  get_kepala();
  get_sekretaris();
}


function form_tambah_laporan(){
  if (document.getElementById("modal_jenis_laporan").value == '' || document.getElementById("modal_tahun_laporan").value == '' || document.getElementById("modal_kepala_laporan").value == '' || document.getElementById("modal_sekretaris_laporan").value == '') {
    swal({
      title: 'Opppss!',
      text: 'Harap isi semua form!',
      icon: 'warning',
      buttons: {                  
          confirm: {
              className : 'btn btn-focus'
          }
      },
    });
  }else {
    document.getElementById("form_modal_laporan").submit();
    $('#modal_tambah_laporan').modal('hide');
    document.getElementById("modal_jenis_laporan").value = '';
    document.getElementById("modal_tahun_laporan").value = '';
    document.getElementById("modal_kepala_laporan").value = '';
    document.getElementById("modal_sekretaris_laporan").value = '';

  }
 
}

$(document).ready(function(){
  $('#modal_jenis_laporan').change(function(){
    var id = $(this).val();
    // console.log(id);
    $.ajax({
      type: "POST",
      url: "<?= base_url('auth/get_tahun_modal'); ?>",
      data: {
        id : id
      },
      dataType : "JSON",
      success: function(response){
        $('#modal_tahun_laporan').html(response);
      }
    
    });
  });
});


function get_kepala(){
  $.ajax({
      url: "<?= base_url('auth/get_kepala'); ?>",
      dataType : "JSON",
      success: function(response){
        // console.log(response);
        $('#modal_kepala_laporan').html(response);
      }
    
    });
}

function get_sekretaris(){
  $.ajax({
      url: "<?php echo base_url(); ?>auth/get_sekretaris",
      dataType : "json",
      success: function(response){
        // console.log(response);
        $('#modal_sekretaris_laporan').html(response);
      }
    
    });
}


function get_jabatan() {
    $.ajax({
        url: "<?php echo base_url(); ?>auth/get_jabatan",
        dataType: "json",
        success: function(data) {
            // console.log(data);
            $("#modal_jabatan").html(data);
        }
    });
}



function button_cetak_laporan(id){
  window.open("<?php echo base_url('auth/cetak?')?>id="+id,"_blank");
}


</script>

<!-- Modal -->
<div class="modal fade" id="modal_tambah_laporan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title"> Ajukan Laporan </h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <form method="post" id="form_modal_laporan" action="<?= base_url('adm/tambah_laporan'); ?>">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Jenis Laporan</label>
            <select class="form-control" id="modal_jenis_laporan" name="modal_jenis_laporan" required="">
              <option value=""> -- Pilih Jenis Laporan --</option>
              <option value="1"> Pemasukan</option>
              <option value="2"> Pengeluaran</option>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Tahun</label>
            <select class="form-control" id="modal_tahun_laporan" name="modal_tahun" required="">
              <option value=""> -- Pilih Tahun --</option>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect1">Kepala Desa</label>
            <select class="form-control" id="modal_kepala_laporan" name="modal_kepala" required="">
              <option value=""> -- Pilih Kepala Desa --</option>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect1">Sekretaris</label>
            <select class="form-control" id="modal_sekretaris_laporan" name="modal_sekretaris" required="">
              <option value=""> -- Pilih Sekretaris --</option>
            </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="form_tambah_laporan()"><i class="fas fa-plus"></i> Ajukan Laporan</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


