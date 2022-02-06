
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Ubah Data Pemasukan Desa</h1>
      </div>

      <div class="card" style="margin-top: -50px;">
            <div class="card-body">
              <div class="table-responsive">
                
        <div style="width: 500px;" >
          <?= form_open_multipart(); ?>
              <input type="hidden" id="id_masuk" value="<?= $data_edit['id_masuk'];?>">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Jenis Pemasukan</label>
                <input type="text" class="form-control" placeholder="jenis pemasukan" name="jenis" value="<?= $data_edit['jenis_masuk']; ?>" id="form1">
              </div>
              <div class="mb-3"  style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Asal Pemasukan</label>
                <input type="text" class="form-control" placeholder="asal pemasukan" name="asal" value="<?= $data_edit['asal_masuk']; ?>" id="form2">
              </div>
              <div class="mb-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Tahun Pemasukan</label>
                <input type="number" class="form-control" name="tahun"  placeholder="tahun" value="<?= $data_edit['tahun_masuk']; ?>" id="form3">
              </div>
              <div class="mt-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Jumlah (Rp.)</label>
                <input type="number" class="form-control" name="jumlah" placeholder="Rp." value="<?= $data_edit['jumlah_masuk']; ?>" id="form4">
              </div>
              
                <button type="button" onclick="button_kembali()" style="margin-top: 25px;" class="btn btn-focus"><i class="fas fa-times"></i> Buang Perubahan</button>
                <button type="button" id="button_simpan_edit" style="margin-top: 25px;" class="btn btn-primary"><i class="fas fa-edit"></i> Simpan Perubahan</button>
                <?= form_close(); ?>
            </div>
      

              </div>
            </div>
        </div>

    