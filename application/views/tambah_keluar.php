
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Tambah Pengeluaran Desa</h1>
      </div>

      <div class="card" style="margin-top: -50px;">
            <div class="card-body">
              <div class="table-responsive">
                
        <form style="width: 500px;" method="post" action="<?= base_url('admin/tambah_keluar'); ?>">
              
              <div class="form-group">
                <label for="exampleFormControlSelect1">Bidang</label>
                <select class="form-control" id="bidang" name="bidang">
                  <?= $isi_bidang; ?>
                </select>
                <?= form_error('bidang', '<small class="text-danger">', '</small>'); ?>
              </div>

              <div class="form-group">
                <label for="exampleFormControlSelect1">Sub Bidang</label>
                <select class="form-control" id="sub_bidang" name="sub_bidang">
                  <option value=""> -- Pilih subbidang -- </option>
                </select>
                <?= form_error('sub_bidang', '<small class="text-danger">', '</small>'); ?>
              </div>

              <div class="mb-3"  style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Tujuan Pengeluaran</label>
                <input type="text" class="form-control" placeholder="tujuan pengeluaran" name="tujuan" value="<?= set_value('tujuan'); ?>" id="form2">
              </div>
              <div class="mb-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Tahun Pengeluaran</label>
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

    