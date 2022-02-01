<div class="main-panel">
      <div class="content">
        <div class="panel-header bg-primary-gradient">
          <div class="page-inner py-5">
              
            <div class="page-header text-white">
              <h4 class="page-title text-white">Rute</h4>
              <ul class="breadcrumbs">
                <li class="nav-home">
                  <a href="#">
                    <i class="flaticon-home text-white"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item ">
                  <a href="#" class="text-white">Daftar rute</a>
                </li>
              </ul>
            </div>

          
          </div>
        </div>


        <div class="page-inner mt--5">
          <div class="row mt--2">





          <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <button class="btn btn-success" id="riwayat_button">Lihat laporan</button>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Dibuat pada</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Nama</th>
                          <th>Dibuat pada</th>
                          <th>Aksi</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            
              </div>
            </div>
          </div>


<div class="modal fade bd-example-modal-lg" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog">
  
<div class="modal-content" >

<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">      
  Edit rute
</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
            
<div class="modal-body">
<?= form_open_multipart('admin/edit_rute'); ?>
          <input type="hidden" class="form-control" id="id" name="id">
          <div class="form-group">
            <label for="email2">Nama rute</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama">
          </div>


        <input type="hidden" id="id_modal">
        <button type="button" id="button_edit" class="btn btn-primary float-right mr-2" id="button_tambah">
            <span class="btn-label">
              <i class="fas fa-edit"></i>
            </span>
            Simpan perubahan 
          </button>
<?= form_close(); ?>
                     
            </div>
          </div>
        </div>
      </div>

 
 <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Lihat riwayat</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-5">
              <label for="inputCity">Tanggal</label>
              <input type="date" class="form-control" id="tanggal1" name="tanggal1" required="">
            </div>
            <div class="form-group col-md-2" style="display: flex;justify-content: center;align-items: center; ">
              sampai dengan
            </div>
            <div class="form-group col-md-5">
              <label for="inputZip">Tanggal</label>
              <input type="date" class="form-control" id="tanggal2" required="">
            </div>
          </div>
          <hr>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Rute</label>
            <select class="form-control" id="rute_select">
              <option value=""> -- Pilih RUTE -- </option>
            </select>           
          </div>
                                 
        </div>
        <div class="modal-footer">
          
          <button class="btn btn-primary" type="button" id="button_filter_data">Lihat laporan</button>
          <button class="btn btn-focus" type="button" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
  </div> 

<script type="text/javascript">
  
  getdatasales();

  function getdatasales(id_status){

    $.ajax({
            url: "<?php echo base_url(); ?>auth/get_rute",
            type: "post",
            data: {
                id_status : id_status
            },
            dataType: "json",
            success: function(data) {
                // console.log(data);
                 $('#basic-datatables').DataTable( {
                    "data": data,
                    "columns": [
                        {
                            "data": "rute_nama"
                        },
                        {
                            "data": "rute_created",
                        },
                        {
                            "data": "rute_id",
                            "render": function(data, type, row, meta) {
                            return `
                              <a href="#" onclick="edit(${row.rute_id})" class="badge badge-success">Edit</a> 
                            `;
                            }
                        }
                      ]
                } );
            }
        });


  }



 function edit(id){ 
  $('#modal_edit').modal('show');
    
    // console.log(id);
    $.ajax({
        method: 'get',
        url: "<?php echo base_url(); ?>auth/detail_rute",
        data: {
            id: id
        },
        dataType: "json",
        success: function(data) {

          // console.log(data);
          
           document.getElementById('id').value = data.rute_id;
           document.getElementById('nama').value = data.rute_nama;
           
         
        }

    });
  }


  function rute() {
    $.ajax({
        url: "<?php echo base_url(); ?>auth/get_rute",
        dataType: "json",
        success: function(data) {
            // console.log(data);
            var Body = "";
            for(var key in data){
              Body +=`<option value="${data[key]['rute_id']}">${data[key]['rute_nama']}</option>`;
            }
            $("#rute_select").append(Body);
        }
    });
}
rute();

$('#riwayat_button').click(function(e) {
    $('#filterModal').modal('show');
    
});


$(document).ready(function(){

        $('#filterModal').on('click','#button_filter_data', function (e) {
            var tanggal1 = $('#tanggal1').val();
            var tanggal2 = $('#tanggal2').val();
            var id_rute = $('#rute_select').val();
            if (tanggal1 == "" || tanggal2 == "") {
              swal("Silahkan isi  tanggal", {
                  icon : "error",
                  buttons: {                  
                      confirm: {
                          className : 'btn btn-danger'
                      }
                  },
              });
            }else if (id_rute == "") {
              swal("Silahkan pilih rute", {
                  icon : "error",
                  buttons: {                  
                      confirm: {
                          className : 'btn btn-danger'
                      }
                  },
              });
            }
            else {
              swal({
                title: 'Laporan berhasil dicetak!',
                icon: 'success',
                buttons:{
                  confirm: {
                    text : 'Ok',
                    className : 'btn btn-success'
                  }
                }
              }).then((Tambah) => {
                if (Tambah) {
                  window.open("<?php echo base_url('auth/pas_pdf?')?>sales=&tanggal1="+tanggal1+ "&tanggal2=" +tanggal2+ "&rute=" +id_rute+ "&toko=","_blank");

                  swal.close();
                  $('#filterModal').modal('hide');
                } 
              });
            }
            

        });

    });


  
$('#button_edit').click(function(e) {
          swal({
            title: 'Yakin diubah?',
            icon: 'warning',
            buttons:{
              confirm: {
                text : 'Simpan perubahan',
                className : 'btn btn-success'
              },
              cancel: {
                text : 'Tidak',
                visible: true,
                className: 'btn btn-focus'
              }
            }
          }).then((Simpan) => {
            if (Simpan) {
              $('form').submit();
            } else {
              swal.close();
            }
          });

        });


</script>

 

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

