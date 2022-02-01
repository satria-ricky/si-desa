<div class="main-panel">
      <div class="content">
        <div class="panel-header bg-primary-gradient">
          <div class="page-inner py-5">
              
            <div class="page-header text-white">
              <h4 class="page-title text-white">Produk</h4>
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
                  <a href="#" class="text-white">Masuk</a>
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
                  <button class="btn btn-primary" id="filter_button">Filter Data</button>
                   <button class="btn btn-success" id="tambah_button">Tambah Produk</button>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                      <thead>
                        <tr>
                          <th>Tanggal</th>
                          <th>Spray</th>
                          <th>Roll</th>
                          <th>Total</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>TOTAL</th>
                          <th></th>
                          <th></th>
                          <th></th>
                          <th></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-4">
              <div class="card card-dark bg-secondary-gradient">
                <div class="card-body skew-shadow">
                  Sisa Produk Saat Ini
                  <h1 class="py-4 mb-0" style="text-align: center; font-size: 60px;"> <?= $produk_induk['pi_sepray'] + $produk_induk['pi_roll'];?> </h1>
                  <div class="row">
                    <div class="col-6 pr-0 text-center">
                      <h3 class="fw-bold mb-1"><?= $produk_induk['pi_sepray']; ?></h3>
                      <div class="text-small text-uppercase fw-bold op-8">stok spray</div>
                    </div>
                    <div class="col-6 pl-0 text-center">
                      <h3 class="fw-bold mb-1"><?= $produk_induk['pi_roll'] ?></h3>
                      <div class="text-small text-uppercase fw-bold op-8">stok roll</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            
              </div>
            </div>
          </div>


<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Filter Data</h5>
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
                                 
        </div>
        <div class="modal-footer">
          
          <button class="btn btn-primary" type="button" id="button_filter_data">Filter Data</button>
          <button class="btn btn-focus" type="button" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
  </div>

 

 <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form_tambah" action="<?= base_url('admin/produk_masuk'); ?>" method="post">
          <div class="form-group">
            <label for="inputCity">Tanggal</label>
              <input type="date" class="form-control" id="tanggal" name="tanggal" required="">        
          </div>
         <hr>
          <h3> Jumlah produk yang dimasukkan </h3>
          <div class="form-group">
            <label>Sepray</label>
            <input type="number"  class="form-control" name="sepray" value="<?= set_value('sepray'); ?>">
          </div>

          <div class="form-group">
            <label>Roll</label>
            <input type="number"  class="form-control" name="roll" value="<?= set_value('roll'); ?>">
          </div>
                 
        </div>
        <div class="modal-footer">
          </form>
          <button class="btn btn-primary " type="button" id="button_tambah_data">Tambah</button>
          <button class="btn btn-focus" type="button" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
  </div>


<div class="modal fade bd-example-modal-lg" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog">
  
      <div class="modal-content" >
        
        <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">      
              Edit produk masuk
           </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
                        
        <div class="modal-body">
            <?= form_open_multipart('admin/edit_pm'); ?>
                      <div class="form-group">
                        <label for="inputCity">Tanggal</label>
                          <input type="date" class="form-control" id="tanggal_edit" name="tanggal">        
                      </div>
                     <hr>
                      <h3> Jumlah produk yang dimasukkan </h3>
                      <div class="form-group">
                        <label>Sepray</label>
                        <input type="number" id="sepray_edit"  class="form-control" name="sepray">
                      </div>

                      <div class="form-group">
                        <label>Roll</label>
                        <input type="number"class="form-control" id="roll_edit" name="roll">
                      </div>

                    <input type="hidden" id="id_modal" name="id_modal">
                    
                      <div class="modal-footer">
                      <button type="button" id="button_edit" class="btn btn-primary float-right">
                        <span class="btn-label">
                          <i class="fas fa-edit"></i>
                        </span>
                        Simpan perubahan 
                      </button>
                      <button class="btn btn-focus" type="button" data-dismiss="modal">Kembali</button>
                    </div>

                    <?= form_close(); ?>                
                        </div>
                      </div>
                    </div>
                  </div>

<script type="text/javascript">
  
  getdata();

  function getdata(tanggal1,tanggal2){

    $.ajax({
            url: "<?php echo base_url(); ?>auth/get_masuk",
            type: "post",
            data: {
              tanggal1 : tanggal1,
              tanggal2 : tanggal2
            },
            dataType: "json",
            success: function(data) {
                // console.log(data);
                 $('#basic-datatables').DataTable( {
                    "data": data,
                    "columns": [
                        {
                            "data": "pm_created",
                        },
                        {
                            "data": "pm_sepray",
                        },
                        {
                            "data": "pm_roll",
                        },
                        {
                            "data": "pm_total",
                        },
                        {
                            "data": "pm_id",
                            "render": function(data, type, row, meta) {
                            return `
                              <button class="btn btn-danger btn-xs btn-round" onclick="hapus(${row.pm_id})"> Hapus </button> 
                            `;
                            }
                        }
                      ],

                      "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;
             
                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };
             
                        // Total over all pages
                        var stok_sepray_total = api
                            .column( 1 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        var stok_roll_total = api
                            .column( 2 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        var total = api
                            .column( 3 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        
             
                        // Update footer
                        $( api.column( 1 ).footer()).html(stok_sepray_total);
                        $( api.column( 2 ).footer()).html(stok_roll_total);
                        $( api.column( 3 ).footer()).html(total);
                    }  

                } );
            }
        });


  }


$('#filter_button').click(function(e) {
    $('#filterModal').modal('show');
    
});

$('#tambah_button').click(function(e) {
    $('#tambahModal').modal('show');
    
});



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
  

function get_toko() {
    
    var id = $("#rute_select").val();
    $.ajax({
          url: "<?php echo base_url(); ?>auth/get_toko",
          type: "post",
          data: {id: id},
          dataType: "json",
          success: function(data) {
              // console.log(data);
              $('#toko_select').html(data);
          }
    });
}


  $(document).ready(function(){

        $('#filterModal').on('click','#button_filter_data', function (e) {
           // console.log($('#tanggal1').val());
            var tanggal1 = $('#tanggal1').val();
            var tanggal2 = $('#tanggal2').val();
            if (tanggal1 == "" || tanggal2 == "") {
              swal("Silahkan isi  tanggal", {
                  icon : "error",
                  buttons: {                  
                      confirm: {
                          className : 'btn btn-danger'
                      }
                  },
              });
            }else {
              swal({
                title: 'Data berhasil difilter!',
                icon: 'success',
                buttons:{
                  confirm: {
                    text : 'Ok',
                    className : 'btn btn-success'
                  }
                }
              }).then((Tambah) => {
                if (Tambah) {
                  $('#basic-datatables').DataTable().destroy();
                    getdata(tanggal1,tanggal2);
                    // console.log(sales+" = "+tanggal1+" = "+tanggal2+" = "+id_rute+" = "+id_toko);

                  swal.close();
                  $('#filterModal').modal('hide');
                } 
              });
            }
            

        });

    });




$(document).ready(function(){

        $('#tambahModal').on('click','#button_tambah_data', function (e) {

            var tanggal1 = $('#tanggal').val();

            if (tanggal1 == "") {
              swal("Silahkan isi  tanggal", {
                  icon : "error",
                  buttons: {                  
                      confirm: {
                          className : 'btn btn-danger'
                      }
                  },
              });
            }else {
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

    });



function hapus(id) {
    swal({
            title: 'Yakin dihapus?',
            icon : "warning",
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
          }).then((Delete) => {
            if (Delete) {
              swal({
                title: 'Berhasil!',
                text: 'Data berhasil dihapus!',
                icon : "success",
                buttons : {
                  confirm: {
                    className : 'btn btn-success'
                  }
                }
              }).then((Hapus) => {
                if (Hapus) {
                  $.ajax({
                    method: 'post',
                    url: "<?php echo base_url(); ?>auth/hapus_pm",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(data) {

                      location.reload();
                             
                    }
                  });
                }
              });
            };
          });
  }


 function edit(id){ 
  $('#modal_edit').modal('show');
    // console.log(id);
    $.ajax({
        method: 'get',
        url: "<?php echo base_url(); ?>auth/get_masuk_by_id",
        data: {
            id: id
        },
        dataType: "json",
        success: function(data) {

          // console.log(data);
          
           document.getElementById('id_modal').value = data.pm_id;
           document.getElementById('tanggal_edit').value = data.pm_created;
           document.getElementById('sepray_edit').value = data.pm_sepray;
           document.getElementById('roll_edit').value = data.pm_roll;
         
        }

    });
  }


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
