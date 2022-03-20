  

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
    

  function button_edit($is,$id) {
    // console.log($is+"++++"+$id);
    if ($is == 1) {
        document.location.href = "<?php echo base_url('admin/edit_masuk/')?>"+$id;
    }else {
        document.location.href = "<?php echo base_url('admin/edit_keluar/')?>"+$id;
    }

  }

  function button_hapus($is,$id) {

    swal({
      title: 'Yakin Hapus Data?',
      text: 'Data yang telah terhapus tidak dapat dipulihkan!',
      icon: 'warning',
      buttons:{
        confirm: {
          text : 'Hapus',
          className : 'btn btn-danger'
        },
        cancel: {
          text : 'Tidak',
          visible: true,
          className: 'btn btn-focus'
        }
      }
    }).then((Hapus) => {
      if (Hapus) {
        
        if ($is == 1) {
            document.location.href = "<?php echo base_url('admin/hapus_masuk/')?>"+$id;
        }else {
            document.location.href = "<?php echo base_url('admin/hapus_keluar/')?>"+$id;
        }

      } else {
        swal.close();
      }
    });
  }






function button_hapus_user($id) {

    swal({
      title: 'Yakin Hapus Data?',
      text: 'Data yang telah terhapus tidak dapat dipulihkan!',
      icon: 'warning',
      buttons:{
        confirm: {
          text : 'Hapus',
          className : 'btn btn-danger'
        },
        cancel: {
          text : 'Tidak',
          visible: true,
          className: 'btn btn-focus'
        }
      }
    }).then((Hapus) => {
      if (Hapus) {
        document.location.href = "<?php echo base_url('admin/hapus_pengguna/')?>"+$id;

      } else {
        swal.close();
      }
    });
  }



   $('#button_simpan_edit').click(function(e) {
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
              document.getElementById("form_edit").submit();
            } else {
              swal.close();
            }
          });
        }
    });



  function button_kembali() {

    swal({
        title: 'Buang Perubahan dan Kembali?',
        icon: 'warning',
        buttons:{
          confirm: {
            text : 'Iya',
            className : 'btn btn-info'
          },
          cancel: {
            text : 'Batal',
            visible: true,
            className: 'btn btn-focus'
          }
        }
      }).then((Tambah) => {
        if (Tambah) {
           window.history.go(-1);
        } else {
          swal.close();
        }
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
              document.location.href = "<?php echo base_url('admin/masuk')?>";
           }else{
              document.location.href = "<?php echo base_url('admin/keluar')?>";
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
          document.location.href = "<?php echo base_url('admin/filter_masuk?')?>sumber="+sumber+"&tahun="+tahun;    
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
            document.location.href = "<?php echo base_url('admin/filter_keluar?')?>bidang="+bidang+"&tahun="+tahun;
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

function button_tambah_pengguna(){
  $('#modal_tambah_pengguna').modal('show');
  get_jabatan();
}





function form_tambah_pengguna(){
  // console.log('a');
  if (document.getElementById("modal_jabatan").value == '' || document.getElementById("modal_nama").value == '' || document.getElementById("modal_username").value == '' || document.getElementById("modal_password").value == '' || document.getElementById("modal_gambar_ttd").value == '') {
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
    document.getElementById("form_modal_tambah_pengguna").submit();
    $('#modal_tambah_pengguna').modal('hide');
    document.getElementById("modal_jabatan").value = '';
    document.getElementById("modal_nama").value = '';
    document.getElementById("modal_username").value = '';
    document.getElementById("modal_password").value = '';
    document.getElementById("modal_gambar_ttd").value = '';
  }
 
}


function form_edit_pengguna(){
  // console.log('a');
  if (document.getElementById("modal_edit_jabatan").value == '' || document.getElementById("modal_edit_nama").value == '' || document.getElementById("modal_edit_username").value == '' || document.getElementById("modal_edit_password").value == '') {
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
    document.getElementById("form_modal_edit_pengguna").submit();
    $('#modal_edit_pengguna').modal('hide');
  }
 
}


function button_edit_user($id) {
  $('#modal_edit_pengguna').modal('show');
  var id = $id;
  $.ajax({
    url: "<?php echo base_url(); ?>auth/get_user",
    data: {
      id : id
    },
    type: "POST",
    dataType: "json",
    success: function(data) {
        // console.log(data);
        set_jabatan_edit(data.user_id_level);
        document.getElementById("modal_edit_id_user").value = data.user_id;
        document.getElementById("modal_edit_nama").value =  data.user_nama;
        document.getElementById("modal_edit_username").value =  data.user_username;
        document.getElementById("modal_edit_password").value =  data.user_password;
        document.getElementById("modal_edit_data_ttd").src="<?= base_url('assets/foto/ttd/'); ?>"+data.user_ttd;
        
    }
  });

}

function set_jabatan_edit(id) {
  // console.log(id);
    $.ajax({
        url: "<?php echo base_url(); ?>auth/set_jabatan_edit",
        data: {
          id : id
        },
        type: "POST",
        dataType: "json",
        success: function(data) {
            // console.log(data);
            $("#modal_edit_jabatan").html(data);
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


function button_hapus_laporan($id) {
    swal({
      title: 'Yakin Hapus Data?',
      text: 'Data yang telah terhapus tidak dapat dipulihkan!',
      icon: 'warning',
      buttons:{
        confirm: {
          text : 'Hapus',
          className : 'btn btn-danger'
        },
        cancel: {
          text : 'Tidak',
          visible: true,
          className: 'btn btn-focus'
        }
      }
    }).then((Hapus) => {
      if (Hapus) {
        document.location.href = "<?php echo base_url('admin/hapus_laporan/')?>"+$id;

      } else {
        swal.close();
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
        <h1 class="modal-title"> Tambah Laporan </h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <form method="post" id="form_modal_laporan" action="<?= base_url('admin/tambah_laporan'); ?>">
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
        <button type="button" class="btn btn-primary" onclick="form_tambah_laporan()"><i class="fas fa-plus"></i> Tambah Laporan</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modal_tambah_pengguna" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title">Tambah Data Pengguna</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <form method="post" id="form_modal_tambah_pengguna" action="<?= base_url('admin/tambah_pengguna'); ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Jabatan</label>
            <select class="form-control" id="modal_jabatan" name="jabatan" required="">
            </select>
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect1">Nama Lengkap</label>
            <input class="form-control" id="modal_nama" name="nama" placeholder="nama lengkap..." required="">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Username</label>
            <input type="text" class="form-control" id="modal_username" name="username" placeholder="username ..." required="">
            <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Password</label>
            <input type="text" class="form-control" id="modal_password" name="password" placeholder="password ..." required="">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Upload TTD</label>
            <input type="file" class="form-control" id="modal_gambar_ttd" name="gambar_ttd" required="" accept="image/*">
          </div>
        


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="form_tambah_pengguna()"> <i class="fas fa-plus"></i> Tambah Pengguna</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="modal_edit_pengguna" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title">Edit Data Pengguna</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <form method="post" id="form_modal_edit_pengguna" action="<?= base_url('admin/edit_pengguna'); ?>" enctype="multipart/form-data">
          <input type="hidden" id="modal_edit_id_user" name="user_id">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Jabatan</label>
            <select class="form-control" id="modal_edit_jabatan" name="jabatan" required="">
            </select>
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect1">Nama Lengkap</label>
            <input class="form-control" id="modal_edit_nama" name="nama" placeholder="nama lengkap..." required="">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Username</label>
            <input type="text" class="form-control" id="modal_edit_username" name="username" placeholder="username ..." required="">
            <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Password</label>
            <input type="text" class="form-control" id="modal_edit_password" name="password" placeholder="password ..." required="">
          </div>
          <div class="form-group">
            <img style="width: 200px; height: 130px; margin-top: 15px;" id="modal_edit_data_ttd" src="" alt="..." class="img-thumbnail">
            <br>
            <label for="exampleFormControlInput1">Ubah TTD?</label>
            <input type="file" class="form-control" id="modal_edit_gambar_ttd" name="gambar_ttd" required="" accept="image/*">
          </div>
        


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="form_edit_pengguna()"> <i class="fas fa-edit"></i> Edit Pengguna</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>