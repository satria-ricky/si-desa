
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Tambah Pemasukan Desa</h1>
      </div>

      <div class="card" style="margin-top: -50px;">
            <div class="card-body">
              <div class="table-responsive">
                
        <form style="width: 500px;" id="form_tambah" method="post" action="<?= base_url();?><?= $form_action;?>/tambah_masuk">
              
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
                </select>
                <?= form_error('jenis', '<small class="text-danger">', '</small>'); ?>
              </div>

              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Rincian</label>
                <input type="text" class="form-control" placeholder="rincian" name="rincian" value="<?= set_value('rincian'); ?>" id="form1">
              </div>
              <div class="mb-3"  style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Kode Rekening</label>
                <input type="text" class="form-control" placeholder="kode rekening" name="kode_rekening" value="<?= set_value('kode_rekening'); ?>" id="form2" onkeypress="return isNumberKey(event)">
                <?= form_error('kode_rekening', '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="mt-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Jumlah (Rp.)</label>
                <input type="number" class="form-control" name="jumlah" placeholder="Rp." value="<?= set_value('jumlah'); ?>" id="form3">
              </div>
              <div class="mb-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Tahun Pemasukan</label>
                <input type="number" class="form-control" name="tahun"  placeholder="tahun" value="<?= set_value('tahun'); ?>" id="form4">
              </div>
              
            
                <button type="button" id="button_tambah" style="margin-top: 25px;" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah data</button>
            </form>
      

              </div>
            </div>
        </div>

    