

<body>
  <div class="wrapper">
    <div class="main-header">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="blue">
        
        <a href="#" class="logo">
          <!-- <img src="<?= base_url('assets/'); ?>img/logo.svg" alt="navbar brand" class="navbar-brand"> --> 
          <h2 class="text-white pt-3 fw-bold">BATU BULAN</h2>
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">
            <i class="icon-menu"></i>
          </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="icon-menu"></i>
          </button>
        </div>
      </div>
      <!-- End Logo Header -->

  <!-- Navbar Header -->
      <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        
        <div class="container-fluid">
          <div class="collapse" id="search-nav">
            
          </div>
          <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
           

                <a class="nav-link" href="#" id="messageDropdown" role="button" aria-haspopup="true" data-toggle="dropdown" aria-expanded="false">
                <h6 class="text-white pt-2 fw-bold"><?= $data_pengguna['user_nama'];  ?></h6>
              </a>

              
            <li class="nav-item dropdown hidden-caret">
              <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                <div class="avatar-sm">
                  <img src="<?= base_url('assets/foto/user/').$data_pengguna['user_foto']; ?>" alt="..." class="avatar-img rounded-circle">
                </div>
              </a>
              <ul class="dropdown-menu dropdown-user animated fadeIn">
                <div class="dropdown-user-scroll scrollbar-outer">
                  <li>
                    <div class="user-box">
                      <div class="avatar-lg"><img src="<?= base_url('assets/foto/user/').$data_pengguna['user_foto']; ?>" alt="image profile" class="avatar-img rounded"></div>
                      <div class="u-text">
                        <h4><?= $data_pengguna['user_nama'];  ?></h4>
                        <p class="text-muted"><?= $data_pengguna['user_username'];  ?></p><a href="<?= base_url(); ?><?= $data_pengguna['level_nama'];?>/profile" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"  href="<?= base_url(); ?><?= $data_pengguna['level_nama'];?>/edit_profile">Edit profile</a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item"  onclick="logout()" style="cursor: pointer;">Logout</a>
                  </li>
                </div>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <!-- End Navbar -->
    </div>