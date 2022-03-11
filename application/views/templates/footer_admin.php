  

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
     if(tahun.length == 0){
      
      swal({
        title: 'Opppss!',
        text: 'Harap pilih tahun!',
        icon: 'warning',
        buttons: {                  
            confirm: {
                className : 'btn btn-focus'
            }
        },
      });
      
    }
    else{

     if(is == 1){
        // filter_masuk(is,tahun);
        document.location.href = "<?php echo base_url('admin/filter_masuk?')?>";
      }
      else{
        // filter_keluar(is,tahun);
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


function button_cetak(e){
  $('#modal_cetak').modal('show');
  // console.log(e);
  if (e == 1) {
    $('#modal_header').html('Cetak Data Pemasukan');
    get_tahun(e);
  }else{
    $('#modal_header').html('Cetak Data Pengeluaran');
    get_tahun(e);
  }

  document.getElementById("jenis_form_cetak").value = e;
}


function form_cetak(){
  // console.log('a');
  if (document.getElementById("modal_tahun").value == '' || document.getElementById("modal_ketua").value == '' || document.getElementById("modal_sekretaris").value == '') {
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
    document.getElementById("form_modal_cetak").submit();
    $('#modal_cetak').modal('hide');
    document.getElementById("jenis_form_cetak").value = '';
    document.getElementById("modal_ketua").value = '';
    document.getElementById("modal_sekretaris").value = '';

  }
 
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

</script>

<!-- Modal -->
<div class="modal fade" id="modal_cetak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="modal_header"></h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        

        <form method="post" id="form_modal_cetak" target="_blank" action="<?= base_url('admin/cetak'); ?>">
          <input type="hidden" name="jenis_form_cetak" id="jenis_form_cetak">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Tahun</label>
            <select class="form-control" id="modal_tahun" name="modal_tahun" required="">
            </select>
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Kepala Desa</label>
            <input type="text" class="form-control" id="modal_ketua" name="modal_ketua" placeholder="nama kepala desa ..." required="">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Sekretaris</label>
            <input type="text" class="form-control" id="modal_sekretaris" name="modal_sekretaris" placeholder="nama sekretaris ..." required="">
          </div>
        


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="form_cetak()">Cetak</button>
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