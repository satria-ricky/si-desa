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
                  <a href="#" class="text-white">Keluar</a>
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
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                      <thead style="text-align: center;">
                        <tr>
                          <th rowspan="2">Tanggal</th>
                          <th rowspan="2">Sales</th>
                          <th rowspan="2">Rute</th>
                          <th rowspan="2">Toko</th>
                          <th colspan="2">Banyaknya</th>
                          <th colspan="2">Bonus</th>
                          <th rowspan="2">Aksi</th>

                        </tr>
                        <tr>
                          <th>Spray</th>
                          <th>Roll</th> 
                          <th>Spray</th>
                          <th>Roll</th>
                        </tr>
                      </thead>
                        <tfoot>
                        <tr>
                          <th colspan="4" style="text-align: center;">TOTAL</th>
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
  
 getmain();

  function getmain(sales,tanggal1,tanggal2,rute,toko){
    // console.log(sales+" = "+tanggal1+" = "+tanggal2+" = "+rute+" = "+toko);
    
    $.ajax({
            url: "<?php echo base_url(); ?>auth/get_main",
            type: "post",
            data: {
                id_sales : sales,
                tanggal1 : tanggal1,
                tanggal2 : tanggal2,
                id_rute : rute,
                id_toko : toko
            },
            dataType: "json",
            success: function(data) {
                // console.log(data);
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
                            "data": "rute_nama"
                        },
                        {
                            "data": "toko_nama"
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
                            .column( 4 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        var stok_roll_total = api
                            .column( 5 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );


                        var bonus_sepray_total = api
                            .column( 6 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        var bonus_roll_total = api
                            .column( 7 )
                            .data()
                            .reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );
                        
             
                        // Update footer
                        $( api.column( 4 ).footer()).html(stok_sepray_total);
                        $( api.column( 5 ).footer()).html(stok_roll_total);
                        $( api.column( 6 ).footer()).html(bonus_sepray_total);
                        $( api.column( 7 ).footer()).html(bonus_roll_total);
                    }  

                } );
                
            }
        });

  }


$('#filter_button').click(function(e) {
    $('#filterModal').modal('show');
    
});


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
            var sales = $('#sales_select').val();
            var tanggal1 = $('#tanggal1').val();
            var tanggal2 = $('#tanggal2').val();
            var id_rute = $('#rute_select').val();
            var id_toko = $('#toko_select').val();
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
                    getmain(sales,tanggal1,tanggal2,id_rute,id_toko);
                    // console.log(sales+" = "+tanggal1+" = "+tanggal2+" = "+id_rute+" = "+id_toko);

                  swal.close();
                  $('#filterModal').modal('hide');
                } 
              });
            }
            

        });

    });


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