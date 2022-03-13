
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Tambah Pengeluaran Desa</h1>
      </div>

      <div class="card" style="margin-top: -50px;">
            <div class="card-body">
              <div class="table-responsive">
                
        <form style="width: 500px;" id="form_tambah" method="post" action="<?= base_url();?><?= $form_action;?>/tambah_keluar">
              
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
                <label for="exampleFormControlInput1" class="form-label">Rincian</label>
                <input type="text" class="form-control" placeholder="rincian" name="rincian" value="<?= set_value('rincian'); ?>" id="form1">
              </div>
              <div class="mb-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Kode Rekening</label>
                <input type="text" class="form-control" name="kode_rekening"  placeholder="Cth*'00.00.00'" value="<?= set_value('kode_rekening'); ?>" id="form2" onkeypress="return isNumberKey(event)">
                <?= form_error('kode_rekening', '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="mt-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Jumlah (Rp.)</label>
                <input type="number" class="form-control" name="jumlah" placeholder="Rp." value="<?= set_value('jumlah'); ?>" id="form3">
              </div>
               <div class="mb-3" style="margin-top: 15px;">
                <label for="exampleFormControlInput1" class="form-label">Tahun Pengeluaran</label>
                <select class="form-control" id="form4" name="tahun">
                  <option value=""> -- Pilih tahun -- </option>
                  <?= $data_tahun; ?>
                </select>
                 <?= form_error('tahun', '<small class="text-danger">', '</small>'); ?>
              </div>
              
            
                <button type="button" id="button_tambah" style="margin-top: 25px;" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah data</button>
            </form>
      

              </div>
            </div>
        </div>

    