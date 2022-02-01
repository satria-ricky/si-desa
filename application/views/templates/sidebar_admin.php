<!-- Sidebar -->
    <div class="sidebar sidebar-style-2">     
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <div class="user">
            <div class="avatar-sm float-left mr-2">
              <img src="<?= base_url('assets/foto/user/').$data_pengguna['user_foto']; ?>" alt="..." class="avatar-img rounded-circle">
            </div>
            <div class="info">
              <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                <span>
                  <?= $data_pengguna['user_nama'];  ?>
                  <span class="user-level"><?= $data_pengguna['level_nama'];  ?></span>
                  <span class="caret"></span>
                </span>
              </a>
              <div class="clearfix"></div>

              <div class="collapse in" id="collapseExample">
                <ul class="nav">
                  <li>
                    <a href="<?= base_url(); ?><?= $data_pengguna['level_nama'];?>/profile">
                      <span class="link-collapse">My Profile</span>
                    </a>
                  </li>
                
                  <li>
                    <a href="<?= base_url(); ?><?= $data_pengguna['level_nama'];?>/edit_profile">
                      <span class="link-collapse">Edit Profile</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <ul class="nav nav-primary">

            <li class="nav-item <?= ($title === 'Daftar produk masuk' || $title === 'Daftar produk keluar') ? 'active' : '' ?>">
              <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                <i class="fas fa-home"></i>
                <p>CEK PRODUK</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="dashboard">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url(); ?><?= $data_pengguna['level_nama'];?>/produk_masuk">
                      <span class="sub-item">Produk masuk</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?><?= $data_pengguna['level_nama'];?>/produk_keluar">
                      <span class="sub-item">Produk keluar</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <hr class="sidebar-divider">
             <li class="nav-item <?= ($title === 'Daftar rute' || $title === 'Tambah rute') ? 'active' : '' ?> ">
              <a data-toggle="collapse" href="#rute">
                <i class="fas fa-map-marked-alt"></i>
                <p>RUTE</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="rute">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url(); ?><?= $data_pengguna['level_nama'];?>/daftar_rute">
                      <span class="sub-item">Daftar Rute</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?><?= $data_pengguna['level_nama'];?>/tambah_rute">
                      <span class="sub-item">Tambah Rute</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <hr class="sidebar-divider">


            <li class="nav-item <?= ($title === 'Daftar toko' || $title === 'Tambah Toko' || $title === 'Detail toko' || $title === 'Edit toko' || $title === 'Edit riwayat toko'  ) ? 'active' : '' ?> ">
              <a data-toggle="collapse" href="#toko">
                <i class="fas fa-store"></i>
                <p>TOKO</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="toko">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url()?><?= $data_pengguna['level_nama'];?>/daftar_toko">
                      <span class="sub-item">Daftar Toko</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url()?><?= $data_pengguna['level_nama'];?>/tambah_toko">
                      <span class="sub-item">Tambah Toko</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

             <hr class="sidebar-divider">


             <li class="nav-item <?= ($title === 'Daftar sales' || $title === 'Tambah Sales' || $title === 'Detail sales' || $title === 'Edit sales' || $title === 'Edit riwayat sales'  ) ? 'active' : '' ?>">
              <a data-toggle="collapse" href="#sales">
                <i class="fas fa-user-friends"></i>
                <p>SALES</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="sales">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url(); ?><?= $data_pengguna['level_nama'];?>/daftar_sales">
                      <span class="sub-item">Daftar Sales</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?><?= $data_pengguna['level_nama'];?>/tambah_sales">
                      <span class="sub-item">Tambah Sales</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

             <hr class="sidebar-divider">


             <li class="nav-item <?= ($title === 'Sampah') ? 'active' : '' ?>">
              <a data-toggle="collapse" href="#sampah">
                <i class="fas fa-trash-alt"></i>
                <p>SAMPAH</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="sampah">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url(); ?><?= $data_pengguna['level_nama'];?>/transaksi">
                      <span class="sub-item">Transaksi</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>


            <hr class="sidebar-divider">

              <li class="nav-item">
                <a onclick="logout()" class="btn btn-danger" style="cursor: pointer;">
                  <i class="fas fa-arrow-alt-circle-left text-white"></i>
                  <p class="text-white">Logout</p>
                </a>
              </li>
            <hr class="sidebar-divider">


          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->