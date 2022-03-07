
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Ubah Data Pemasukan Desa</h1>
      </div>

      <div class="card" style="margin-top: -50px;">
            <div class="card-body">
              <div class="table-responsive">
                
        <div style="width: 500px;" >
          <form style="width: 500px;" id="form_edit" method="post">
              <input type="hidden" id="id_masuk" name="id" value="<?= $data_edit['id_masuk'];?>">
              <div class="form-group">
                <label for="exampleFormControlSelect1">Sumber Pemasukan</label>
                <select class="form-control" id="sumber" name="sumber">
                  <?= $isi_sumber; ?>
                </select>
                <?= form_error('sumber', '<small class="text-danger">', '</small>'); ?>
              </div>

              <div class="form-group">
                <label for="exampleFormControlSelect1">Jenis Sumber Pemasukan</label>
                <select class="form-control" id="jenis" name="jenis">
                  <option value=""> -- Pilih jenis -- </option>
                  <?= $isi_jenis; ?>
                </select>
                <?= form_error('jenis', '<small class="text-danger">', '</small>'); ?>
              </div>

              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Rincian</label>
                <input type="text" class="form-control" placeholder="rincian" name="rincian" value="<?= $data_edit['rincian_masuk']; ?>" id="form1">
              </div>
              <div class="mb-3"  style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Kode Rekening</label>
                <input type="text" class="form-control" placeholder="kode rekening" name="kode_rekening" value="<?= $data_edit['rekening_masuk']; ?>" id="form2" onkeypress="return isNumberKey(event)">
                <?= form_error('kode_rekening', '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="mt-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Jumlah (Rp.)</label>
                <input type="number" class="form-control" name="jumlah" placeholder="Rp." value="<?= $data_edit['jumlah_masuk']; ?>" id="form3">
              </div>
              <div class="mb-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Tahun Pemasukan</label>
                <input type="number" class="form-control" name="tahun"  placeholder="tahun" value="<?= $data_edit['tahun_masuk']; ?>" id="form4">
              </div>

                <button type="button" onclick="button_kembali()" style="margin-top: 25px;" class="btn btn-focus"><i class="fas fa-times"></i> Buang Perubahan</button>
                <button type="button" id="button_simpan_edit" style="margin-top: 25px;" class="btn btn-primary"><i class="fas fa-edit"></i> Simpan Perubahan</button>
              </form>
            </div>
      

              </div>
            </div>
        </div>

    