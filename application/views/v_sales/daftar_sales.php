<div class="main-panel">
      <div class="content">
        <div class="panel-header bg-primary-gradient">
          <div class="page-inner py-5">
              
            <div class="page-header text-white">
              <h4 class="page-title text-white">Sales</h4>
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
                  <a href="#" class="text-white">Daftar sales</a>
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
                  <h4 class="card-title">Basic</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Password</th>
                          <th>Kontak</th>
                          <th>Alamat</th>
                          <th>Status</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Password</th>
                          <th>Kontak</th>
                          <th>Alamat</th>
                          <th>Status</th>
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


 <div class="modal fade bd-example-modal-lg" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog">
  
      <div class="modal-content" >
        
        <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">      
              Detail data sales
           </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
                        
        <div class="modal-body">
          
                        <div style="text-align: center;">
                          <img src="" id="foto_detail" alt="" class="avatar avatar-xxl rounded" style="width: 200px; height: 230px;" >
                          </div>
                      


                    <div class="form-group"> 
                        <label for="basic-url">Nama : </label>
                        <div class="form-control" id="nama_detail"></div>
                    </div>

                    <div class="form-group"> 
                        <label for="basic-url">Username : </label>
                        <div class="form-control" id="username_detail"></div>
                    </div>

                    <div class="form-group"> 
                        <label for="basic-url">Password : </label>
                        <div class="form-control" id="password_detail"></div>
                    </div>
                    
                    <div class="form-group"> 
                        <label for="basic-url">Kontak : </label>
                        <div class="form-control" id="kontak_detail"></div>
                    </div>

                    <div class="form-group">
                      <label for="basic-url ">Alamat</label>
                        <div class="border rounded pl-2 pb-2 pt-2 pr-2" id="alamat_detail"></div>
                    </div>

                    <div class="form-group"> 
                        <label for="basic-url">Akun dibuat pada : </label>
                        <div class="form-control" id="created_detail">
                        </div>
                    </div>

                    <div class="form-group"> 
                        <label for="basic-url">Status : </label>
                        <div class="form-control" id="status_detail"></div>
                    </div>

                    <input type="hidden" id="id_modal">
                      <div class="modal-footer">
                
                        <button type="button" onclick="cek_riwayat()" class="btn btn-primary float-right mr-2">
                                      <span class="btn-label">
                                        <i class="flaticon-right-arrow"></i>
                                      </span>
                                      Cek riwayat kerja 
                                    </button>
                        <button class="btn btn-focus" type="button" data-dismiss="modal">Kembali</button>
                      </div>
                                 
                        </div>
                      </div>
                    </div>
                  </div>

 
<script type="text/javascript">
  getdatasales();
  function getdatasales(id_status){

    $.ajax({
            url: "<?php echo base_url(); ?>admin/get_sales",
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
                            "data": "user_nama"
                        },
                        {
                            "data": "user_username"
                        },
                        {
                            "data": "user_password"
                        },
                        {
                            "data": "user_kontak"
                        },
                        {
                            "data": "user_alamat"
                        },
                        {
                            "data": "user_id_status",
                            "render": function(data, type, row, meta) {
                              if(row.user_id_status == '1'){
                                return `<h6 class="text-center"><span class="badge badge-success">${row.status_nama}</span></h6>`;
                                }
                              else{
                                return `<h6 class="text-center"><span class="badge badge-danger">${row.status_nama}</span></h6>`;
                              }
                            }
                        },
                        {
                            "data": "user_id",
                            "render": function(data, type, row, meta) {
                            return `
                              <button class="btn btn-primary btn-xs btn-round" onclick="detail(${row.user_id})">Detail</button>
                              <button class="btn btn-success btn-xs btn-round m-0" onclick="edit(${row.user_id})">Edit</button>
                              <button class="btn btn-danger btn-xs btn-round" onclick="hapus(${row.user_id})"> Hapus </button> 

                            `;
                            }
                        }
                      ]
                } );
            }
        });


  }


  function detail(id){
    $('#modal_detail').modal('show');
    setTimeout(function() {
        $('#modal_detail').modal('hide');
    }, 50000);
    
    // console.log(id);
    $.ajax({
        method: 'get',
        url: "<?php echo base_url(); ?>auth/detail_user",
        data: {
            id: id
        },
        dataType: "json",
        success: function(data) {

          // console.log(data);
          var url_foto = "<?= base_url(); ?>assets/foto/user/"+data.user_foto;
      
          $('#foto_detail').attr("src",url_foto);

          $('#nama_detail').html(data.user_nama);
          $('#username_detail').html(data.user_username);
          $('#password_detail').html(data.user_password);
          $('#kontak_detail').html(data.user_kontak);
          $('#alamat_detail').html(data.user_alamat);
        
          $('#created_detail').html(data.user_created);

          if (data.user_id_status == "1") {
            var status_content = '<h5><span class="badge badge-success"> '+data.status_nama+' </span></h5>';
          }else{
            var status_content = '<h5><span class="badge badge-danger"> '+data.status_nama+'</span></h5>';
          }

          $('#status_detail').html(status_content);
           document.getElementById('id_modal').value = data.user_id
           
         
        }

    });   
  }


  function hapus(id) {
    swal({
            title: 'Yakin dihapus?',
            text: 'Data riwayat transaksi sales akan terhapus dan tidak dapat dipulihkan!',
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
                    url: "<?php echo base_url(); ?>auth/hapus_user",
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
    document.location.href = "<?php echo base_url('admin/editpas_sales/')?>"+id;
  }


  function cek_riwayat(){

   var id = document.getElementById('id_modal').value;
  
   document.location.href = "<?php echo base_url('admin/detpas_sales/')?>"+id;
   
};

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