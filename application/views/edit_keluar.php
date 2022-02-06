
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Ubah Data Pengeluaran Desa</h1>
      </div>

      <div class="card" style="margin-top: -50px;">
            <div class="card-body">
              <div class="table-responsive">
                
        <div style="width: 500px;" >
          <?= form_open_multipart(); ?>
              <input type="hidden" id="id_keluar" value="<?= $data_edit['id_keluar'];?>">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Jenis Pengeluaran</label>
                <input type="text" class="form-control" placeholder="jenis pengeluaran" name="jenis" value="<?= $data_edit['jenis_keluar']; ?>" id="form1">
              </div>
              <div class="mb-3"  style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Tujuan Pengeluaran</label>
                <input type="text" class="form-control" placeholder="tujuan pengeluaran" name="tujuan" value="<?= $data_edit['tujuan_keluar']; ?>" id="form2">
              </div>
              <div class="mb-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Tahun Pengeluaran</label>
                <input type="number" class="form-control" name="tahun"  placeholder="tahun" value="<?= $data_edit['tahun_keluar']; ?>" id="form3">
              </div>
              <div class="mt-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Jumlah (Rp.)</label>
                <input type="number" class="form-control" name="jumlah" placeholder="Rp." value="<?= $data_edit['jumlah_keluar']; ?>" id="form4">
              </div>
              
                <button type="button" onclick="button_kembali()" style="margin-top: 25px;" class="btn btn-focus"><i class="fas fa-times"></i> Buang Perubahan</button>
                <button type="button" id="button_simpan_edit" style="margin-top: 25px;" class="btn btn-primary"><i class="fas fa-edit"></i> Simpan Perubahan</button>
                <?= form_close(); ?>
            </div>
      

              </div>
            </div>
        </div>

    