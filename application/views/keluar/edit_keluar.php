
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Ubah Data Pengeluaran Desa</h1>
      </div>

      <div class="card" style="margin-top: -50px;">
            <div class="card-body">
              <div class="table-responsive">
                
        <div style="width: 500px;" >
         <form style="width: 500px;" id="form_edit" method="post">
              <input type="hidden" id="id_keluar" name="id" value="<?= $data_edit['id_keluar'];?>">
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
                  <?= $isi_subbidang; ?>
                </select>
                <?= form_error('sub_bidang', '<small class="text-danger">', '</small>'); ?>
              </div>

              <div class="mb-3"  style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Rincian</label>
                <input type="text" class="form-control" placeholder="rincian" name="rincian" value="<?= $data_edit['rincian_keluar']; ?>" id="form1">
              </div>
              <div class="mb-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Kode Rekening</label>
                <input type="text" class="form-control" name="kode_rekening"  placeholder="Cth*'00.00.00'" value="<?= $data_edit['rekening_keluar']; ?>" id="form2" onkeypress="return isNumberKey(event)">
                <?= form_error('kode_rekening', '<small class="text-danger">', '</small>'); ?>
              </div>


              <div class="mb-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Tahun Pengeluaran</label>
                <select class="form-control" id="form3" name="tahun">
                  <?= $isi_tahun; ?>
                </select>
                 
              </div>
              <div class="mt-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Jumlah (Rp.)</label>
                <input type="number" class="form-control" name="jumlah" placeholder="Rp." value="<?= $data_edit['jumlah_keluar']; ?>" id="form4">
              </div>
              
                <button type="button" onclick="button_kembali()" style="margin-top: 25px;" class="btn btn-focus"><i class="fas fa-times"></i> Buang Perubahan</button>
                <button type="button" id="button_simpan_edit" style="margin-top: 25px;" class="btn btn-primary"><i class="fas fa-edit"></i> Simpan Perubahan</button>
              </form>
            </div>
      

              </div>
            </div>
        </div>

    