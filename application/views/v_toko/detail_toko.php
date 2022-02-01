<div class="main-panel">
      <div class="content">
        <div class="panel-header bg-primary-gradient">
          <div class="page-inner py-5">
              
            <div class="page-header text-white">
              <h4 class="page-title text-white">Toko</h4>
              <input type="hidden" id="id_toko" value="<?= $data_detail['toko_id'];?>">
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
                  <a href="<?= base_url()?><?= $data_pengguna['level_nama'];?>/daftar_toko " class="text-white">Daftar toko</a>
                </li>
                 <li class="separator">
                  <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                  <a href="#" class="text-white">Detail toko</a>
                </li>
              </ul>
            </div>

          
          </div>
        </div>


        <div class="page-inner mt--5">
          <div class="row mt--2">


          <div class="col-md-12">
              <div class="card">
                <div class="card-body">

                      

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?= base_url('assets/foto/toko/').$data_detail['toko_foto']; ?>" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <b><h1><?= $data_detail['toko_nama'];?></h1></b>
                      <p class="text-secondary mb-1">Rute : <?= $data_detail['rute_nama'];?></p>
                      <p class="text-muted font-size-sm">Akun dibuat pada : <?= $data_detail['toko_created'];?></p>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="col-md-8">
              <div class="card ">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <b><h6 class="mb-0">Rute</h6></b>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $data_detail['rute_nama'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nama toko</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $data_detail['toko_nama'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Kontak</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $data_detail['toko_kontak'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Alamat</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $data_detail['toko_alamat'];?>
                    </div>
                  </div>
                  <hr>
                   <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Status akun</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php if ($data_detail['toko_id_status'] == '1'){ ?>
                          <h5><span class="badge badge-success"><?= $data_detail['status_nama'];?></span></h5>
                      <?php }else{ ?>
                        <h5><span class="badge badge-danger"><?= $data_detail['status_nama'];?></span></h5>
                      <?php } ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <?php
                        $text = $data_detail['toko_id'];
                        $enc = encrypt_url($text);
                        $link = $data_pengguna['level_nama']."/edit_toko/".$enc;
                       ?>
                      <a class="btn btn-info " target="" href="<?= base_url("$link");?>">Edit toko</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

  



                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"><b>Riwayat toko : <?= $data_detail['toko_nama'];?></b></h4>
                </div>
                <div class="card-header">

                   <button class="btn btn-primary" id="filter_button">Filter Data</button>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                      <thead style="text-align: center;">
                        <tr>
                          <th rowspan="2">Tanggal</th>
                          <th rowspan="2">Sales</th>
                          <th colspan="2">Banyaknya</th>
                          <th colspan="2">Harga Satuan</th>
                          <th colspan="2">Jumlah</th>
                          <th colspan="2">Bonus</th>
                          <th rowspan="2">Aksi</th>

                        </tr>
                        <tr>
                          <th>Spray</th>
                          <th>Roll</th> 
                          <th>Spray</th>
                          <th>Roll</th>
                          <th>Spray</th>
                          <th>Roll</th>
                          <th>Spray</th>
                          <th>Roll</th>
                        </tr>
                      </thead>
                        <tfoot>
                        <tr>
                          <th colspan="2" style="text-align: center;">TOTAL</th>
                          <th></th><th></th>
                          <th></th><th></th>
                          <th></th><th></th>
                          <th></th><th></th>
                          <th></th>
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
          <hr>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Sales</label>
            <select class="form-control" id="sales_select">
              <option value=""> -- Pilih SALES -- </option>
            </select>           
          </div>
                                 
        </div>
        <div class="modal-footer">
          
          <button class="btn btn-primary" type="button" id="button_filter_data">Filter Data</button>
          <button class="btn btn-focus" type="button" data-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
  </div>



<div class="modal fade bd-example-modal-lg" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog">
  
      <div class="modal-content" >
        
        <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">      
              Detail nota
           </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
                        
        <div class="modal-body">
            
          <div class="table-responsive">
          <table class="table table-bordered table-head-bg-info table-bordered-bd-info" style="text-align: center;">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Banyaknya</th>
                        <th scope="col">Harga Satuan (Rp)</th>
                        <th scope="col">Jumlah (Rp)</th>
                        <th scope="col">Bonus</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Spray</td>
                        <td><div id="qty_sepray_detail"></div></td>
                        <td><div id="harga_sepray_detail"></div></td>
                        <td><div id="jumlah_sepray_detail"></div></td>
                        <td><div id="bonus_sepray_detail"></div></td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Roll</td>
                        <td><div id="qty_roll_detail"></div></td>
                        <td><div id="harga_roll_detail"></div></td>
                        <td><div id="jumlah_roll_detail"></div></td>
                        <td><div id="bonus_roll_detail"></div></td>

                      </tr>
                      <tr>
                        <td colspan="2">Total</td>
                        <td><div id="total_qty_detail"></div></td>
                        <td>-</td>
                        <td>Rp. <div id="total_jumlah_detail"></div></td>
                        <td><div id="total_bonus_detail"></div></td>
                      </tr>
                    </tbody>
                  </table>
                 </div>
                  
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="mr-2 fas fa-calendar-check"></i> Tanggal</h6>
                    <span class="text-secondary"><div id="tanggal_detail"></div></span>
                  </li>

                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="mr-2 fas fa-map-marked-alt"></i> Rute</h6>
                    <span class="text-secondary"><div id="rute_detail"></div></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="mr-2 fas fa-store"></i> Nama toko</h6>
                    <span class="text-secondary"><div id="toko_detail"></div></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="mr-2 fab fa-whatsapp"></i> Kontak toko</h6>
                    <span class="text-secondary"><div id="kontak_detail"></div></span>
                  </li>
                </ul>
         
                                 
        </div>

    </div>
  </div>
</div>
<script type="text/javascript">
  
var toko = document.getElementById('id_toko').value;
  
  getmain(toko);

  function getmain(toko,tanggal1,tanggal2,sales,rute){
    // console.log(sales+" = "+tanggal1+" = "+tanggal2+" = "+toko);
    
    $.ajax({
            url: "<?php echo base_url(); ?>auth/get_main",
            type: "post",
            data: {
                id_toko : toko,
                tanggal1 : tanggal1,
                tanggal2 : tanggal2,
                id_sales : sales,
                id_rute  : rute
            },
            dataType: "json",
            success: function(data) {

                 $('#basic-datatables').DataTable( {
                    "data": data,
                    "columns": [
                        {
                            "data": "main_waktu_mulai"
                        },
                        {
                            "data": "user_nama"
                        },
                        {
                            "data": "main_stok_sepray",
                            "render": function(data, type, row, meta) {
                              if(row.main_stok_sepray == 0 || row.main_stok_sepray == null){
                                return `-`;
                                }
                              else{
                                return row.main_stok_sepray;
                              }
                            }
                        },
                        {
                            "data": "main_stok_roll",
                            "render": function(data, type, row, meta) {
                              if(row.main_stok_roll == 0 || row.main_stok_roll == null){
                                return `-`;
                                }
                              else{
                                return row.main_stok_roll;
                              }
                            }
                        },
                        {
                            "data": "main_harga_sepray",
                            "render": function(data, type, row, meta) {
                              if(row.main_harga_sepray == 0 || row.main_harga_sepray == null){
                                return `-`;
                                }
                              else{
                                return Number(row.main_harga_sepray).toLocaleString();
                              }
                            }
                        },
                        {
                            "data": "main_harga_roll",
                            "render": function(data, type, row, meta) {
                              if(row.main_harga_roll == 0 || row.main_harga_roll == null){
                                return `-`;
                                }
                              else{
                                return Number(row.main_harga_roll).toLocaleString();
                              }
                            }
                        },
                        {
                            "data": "main_jumlah_sepray",
                            "render": function(data, type, row, meta) {
                              if(row.main_jumlah_sepray == 0 || row.main_jumlah_sepray == null){
                                return `-`;
                                }
                              else{
                                return Number(row.main_jumlah_sepray).toLocaleString();
                              }
                            }
                        },
                        {
                            "data": "main_jumlah_roll",
                            "render": function(data, type, row, meta) {
                              if(row.main_jumlah_roll == 0 || row.main_jumlah_roll == null){
                                return `-`;
                                }
                              else{
                                return Number(row.main_jumlah_roll).toLocaleString();
                              }
                            }
                        },
                        {
                            "data": "main_bonus_sepray",
                            "render": function(data, type, row, meta) {
                              if(row.main_bonus_sepray == 0 || row.main_bonus_sepray == null){
                                return `-`;
                                }
                              else{
                                return row.main_bonus_sepray;
                              }
                            }
                        },
                        {
                            "data": "main_bonus_roll",
                            "render": function(data, type, row, meta) {
                              if(row.main_bonus_roll == 0 || row.main_bonus_roll == null){
                                return `-`;
                                }
                              else{
                                return row.main_bonus_roll;
                              }
                            }
                        },
                        {
                            "data": "main_id",
                            "render": function(data, type, row, meta) {
                            return `
                              <button class="btn btn-primary btn-xs btn-round" onclick="detail(${row.main_id})">Detail</button>
                              <button class="btn btn-warning btn-xs btn-round" onclick="cetak(${row.main_id})">Cetak nota</button>
                              <button class="btn btn-success btn-xs btn-round" onclick="edit(${row.main_id})">Edit</button>
                              <button class="btn btn-danger btn-xs btn-round" onclick="hapus(${row.main_id})"> Hapus </button> 
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
                            .column( 2 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        var stok_roll_total = api
                            .column( 3 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        var sepray_total = api
                            .column( 6 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        var roll_total = api
                            .column( 7 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        var bonus_sepray_total = api
                            .column( 8 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        var bonus_roll_total = api
                            .column( 9 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
                        
             
                        // Update footer
                        $( api.column( 2 ).footer()).html(stok_sepray_total);
                        $( api.column( 3 ).footer()).html(stok_roll_total);
                        $( api.column( 6 ).footer()).html('Rp. '+sepray_total.toLocaleString());
                        $( api.column( 7 ).footer()).html('Rp. '+roll_total.toLocaleString());
                        $( api.column( 8 ).footer()).html(bonus_sepray_total);
                        $( api.column( 9 ).footer()).html(bonus_roll_total);
                    }  

                } );
                
            }
        });

  }



function detail(id){
  $('#modal_detail').modal('show');
   $.ajax({
        method: 'get',
        url: "<?php echo base_url(); ?>auth/detail_riwayat",
        data: {
            id: id
        },
        dataType: "json",
        success: function(data) {
          // console.log(data);
          var qty_sepray = parseInt( data.main_stok_sepray );
          var qty_roll = parseInt( data.main_stok_roll );
          var tot_qty = qty_sepray + qty_roll;

          var harga_sepray = parseInt( data.main_harga_sepray );
          var harga_roll = parseInt( data.main_harga_roll );
          var tot_harga = harga_sepray + harga_roll;

          var bonus_sepray = parseInt( data.main_bonus_sepray );
          var bonus_roll = parseInt( data.main_bonus_roll );
          var tot_bonus = bonus_sepray + bonus_roll;

          
          $('#jumlah_sepray_detail').html((qty_sepray * harga_sepray).toLocaleString());
          $('#jumlah_roll_detail').html((qty_roll * harga_roll).toLocaleString());
          $('#total_jumlah_detail').html(((qty_sepray * harga_sepray) + (qty_roll * harga_roll)).toLocaleString());

          $('#qty_sepray_detail').html(qty_sepray);
          $('#harga_sepray_detail').html(harga_sepray.toLocaleString());
          $('#bonus_sepray_detail').html(bonus_sepray.toLocaleString());

          $('#qty_roll_detail').html(qty_roll);
          $('#harga_roll_detail').html(harga_roll.toLocaleString());
          $('#bonus_roll_detail').html(bonus_roll.toLocaleString());


          $('#total_qty_detail').html(tot_qty);
          $('#total_harga_detail').html(tot_harga.toLocaleString());
          $('#total_bonus_detail').html(tot_bonus);

          $('#tanggal_detail').html(data.main_waktu_mulai);
          $('#kontak_detail').html(data.toko_kontak);
          $('#rute_detail').html(data.rute_nama);
          $('#toko_detail').html(data.toko_nama);

         
        }

    });

}



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
                    url: "<?php echo base_url(); ?>auth/pindahkan_ke_sampah",
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
    document.location.href = "<?php echo base_url('admin/editpas_riwayat_toko/')?>"+id;
  }




$('#filter_button').click(function(e) {
    $('#filterModal').modal('show');
    $('#sales_select')
        .find('option')
        .remove()
        .end()
        .append('<option value=""> -- Pilih SALES -- </option>')
    ;
    $.ajax({
        url: "<?php echo base_url(); ?>auth/get_sales_by_toko",
        data: {
            id_toko: toko
        },
        dataType: "json",
        success: function(data) {
            // console.log(data);
            var Body = "";
            for(var key in data){
              Body +=`<option value="${data[key]['user_id']}">${data[key]['user_nama']}</option>`;
            }
            $("#sales_select").append(Body);
        }
    });
    
});






  
  $(document).ready(function(){

        $('#filterModal').on('click','#button_filter_data', function (e) {
           // console.log($('#tanggal1').val());
            var tanggal1 = $('#tanggal1').val();
            var tanggal2 = $('#tanggal2').val();
            var id_sales = $('#sales_select').val();
            var rute = "";
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
                    getmain(toko,tanggal1,tanggal2,id_sales,rute);
                    // console.log(id_sales+" = "+tanggal1+" = "+tanggal2+" = "+toko+" = "+rute);

                  swal.close();
                  $('#filterModal').modal('hide');
                } 
              });
            }
            

        });

    });


function cetak(id){
    window.open("<?php echo base_url('auth/pas_nota?')?>nota="+id,"_blank");
  }

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


