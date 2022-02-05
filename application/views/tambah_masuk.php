
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Tambah Pemasukan Desa</h1>
      </div>

      <div class="card" style="margin-top: -50px;">
            <div class="card-body">
              <div class="table-responsive">
                
        <form style="width: 500px;" method="post" action="<?= base_url('admin/tambah_masuk'); ?>">
              
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Jenis Pemasukan</label>
                <input type="text" class="form-control" placeholder="jenis pemasukan" name="jenis" value="<?= set_value('jenis'); ?>" id="form1">
              </div>
              <div class="mb-3"  style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Asal Pemasukan</label>
                <input type="text" class="form-control" placeholder="asal pemasukan" name="asal" value="<?= set_value('asal'); ?>" id="form2">
              </div>
              <div class="mb-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Tahun Pemasukan</label>
                <input type="number" class="form-control" name="tahun"  placeholder="tahun" value="<?= set_value('tahun'); ?>" id="form3">
              </div>
              <div class="mt-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Jumlah (Rp.)</label>
                <input type="number" class="form-control" name="jumlah" placeholder="Rp." value="<?= set_value('jumlah'); ?>" id="form4">
              </div>
              
            
                <button type="button" id="button_tambah" style="margin-top: 25px;" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah data</button>
            </form>
      

              </div>
            </div>
        </div>

    