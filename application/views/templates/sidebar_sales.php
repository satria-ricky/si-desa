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

            <li class="nav-item active">
              <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                <i class="fas fa-home"></i>
                <p>LET'S GO WORK !!!</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="dashboard">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="<?= base_url(); ?><?= $data_pengguna['level_nama'];?>/tambah_kerja">
                      <span class="sub-item">Tambah Kerja</span>
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url(); ?><?= $data_pengguna['level_nama'];?>/riwayat">
                      <span class="sub-item">Lihat Riwayat</span>
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