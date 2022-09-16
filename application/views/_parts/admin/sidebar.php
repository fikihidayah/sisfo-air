<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
  <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
    <i class="fe fe-x"><span class="sr-only"></span></i>
  </a>
  <nav class="vertnav navbar navbar-light">
    <!-- nav bar -->
    <div class="w-100 mb-4 d-flex">
      <a class="navbar-brand mx-auto mt-2 flex-fill text-center text-primary font-weight-bold" href="<?= base_url() ?>">
        <img src="<?= base_url('assets/img/tritanadi.png') ?>" alt="logo" width="50">
      </a>
    </div>
    <?php
    $uri = $this->uri->segment(1);
    $uri2 = $this->uri->segment(2);
    $uri3 = $this->uri->segment(3);
    $user = ['manage', 'tambah', 'edit'];
    $aliran = ['', 'tambah', 'tambahisian', 'edit'];
    $anggaran = ['', 'tambah', 'edit'];
    $get = $this->input->get(null);

    $role = $this->ion_auth->get_users_groups()->row()->id;
    $type = $this->ion_auth->user()->row()->is_cabang;
    // $role = 1 == 'admin'
    // $role = 4 == 'petugas'
    // $role = 5 == 'pengguna'
    ?>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item <?= $uri == '' ? 'active' : '' ?> w-100">
        <a class="nav-link" href="<?= base_url('') ?>">
          <i class="fe fe-monitor fe-16"></i>
          <span class="ml-3 item-text">Dashboard</span>
        </a>
      </li>
    </ul>
    <p class="text-muted nav-heading mt-4 mb-1">
      <span>Menu Pendukung Data</span>
    </p>

    <!-- pengguna -->
    <?php if ($role == 5) : ?>
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <?php if ($type) : ?>
          <li class="nav-item <?= $uri == 'kantor_anggaran' ? 'active' : '' ?> w-100">
            <a class="nav-link" href="<?= base_url('kantor_anggaran') ?>">
              <i class="fe fe-pen-tool fe-16"></i>
              <span class="ml-3 item-text">Kantor Anggaran</span>
            </a>
          </li>

        <?php else : ?>
          <li class="nav-item <?= $uri == 'alamat_air' ? 'active' : '' ?> w-100">
            <a class="nav-link" href="<?= base_url('alamat_air') ?>">
              <i class="fe fe-pen-tool fe-16"></i>
              <span class="ml-3 item-text">Kantor Aliran</span>
            </a>
          </li>
        <?php endif ?>
      </ul>
    <?php endif ?>

    <!-- petugas -->
    <?php if ($role == 4) : ?>
      <ul class="navbar-nav flex-fill w-100 mb-2">

        <li class="nav-item <?= $uri == 'atribut' && $uri2 == 'kantor_anggaran' ? 'active' : '' ?> w-100">
          <a class="nav-link" href="<?= base_url('atribut/kantor_anggaran') ?>">
            <i class="fe fe-pen-tool fe-16"></i>
            <span class="ml-3 item-text">Kantor Anggaran</span>
          </a>
        </li>

        <li class="nav-item <?= $uri == 'atribut' && $uri2 == 'kantor_aliran' ? 'active' : '' ?> w-100">
          <a class="nav-link" href="<?= base_url('atribut/kantor_aliran') ?>">
            <i class="fe fe-pen-tool fe-16"></i>
            <span class="ml-3 item-text">Kantor Aliran</span>
          </a>
        </li>
      </ul>
    <?php endif ?>

    <?php if ($this->ion_auth->is_admin()) : ?>
      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item <?= $uri == 'atribut' && $uri2 == 'satuan' ? 'active' : '' ?> w-100">
          <a class="nav-link" href="<?= base_url('atribut/satuan') ?>">
            <i class="fe fe-anchor fe-16"></i>
            <span class="ml-3 item-text">Satuan</span>
          </a>
        </li>
        <li class="nav-item <?= $uri == 'atribut' && $uri2 == 'kategori' ? 'active' : '' ?> w-100">
          <a class="nav-link" href="<?= base_url('atribut/kategori') ?>">
            <i class="fe fe-command fe-16"></i>
            <span class="ml-3 item-text">Kategori</span>
          </a>
        </li>
        <li class="nav-item <?= $uri == 'atribut' && $uri2 == 'kantor_anggaran' ? 'active' : '' ?> w-100">
          <a class="nav-link" href="<?= base_url('atribut/kantor_anggaran') ?>">
            <i class="fe fe-pen-tool fe-16"></i>
            <span class="ml-3 item-text">Kantor Anggaran</span>
          </a>
        </li>
        <li class="nav-item <?= $uri == 'atribut' && $uri2 == 'kantor_aliran' ? 'active' : '' ?> w-100">
          <a class="nav-link" href="<?= base_url('atribut/kantor_aliran') ?>">
            <i class="fe fe-pen-tool fe-16"></i>
            <span class="ml-3 item-text">Kantor Aliran</span>
          </a>
        </li>

      </ul>

    <?php endif ?>


    <p class="text-muted nav-heading mt-4 mb-1">
      <span>Menu Utama</span>
    </p>


    <ul class="navbar-nav flex-fill w-100 mb-2">

      <?php if ($type == 1 || $role != 5) : ?>
        <li class="nav-item <?= (($uri == 'master' && $uri2 == 'anggaran' || ($uri2 == 'detail' && isset($get['ang'])))) && in_array($uri3, $anggaran) ? 'active' : '' ?> w-100">
          <a class="nav-link" href="<?= base_url('master/anggaran') ?>">
            <i class="fe fe-monitor fe-16"></i>
            <span class="ml-3 item-text">Anggaran</span>
          </a>
        </li>

      <?php endif ?>

      <?php if ($type != 1) : ?>
        <li class="nav-item <?= (($uri == 'master' && $uri2 == 'aliran' || ($uri2 == 'detail' && isset($get['air'])))) && in_array($uri3, $aliran) ? 'active' : '' ?> w-100">
          <a class="nav-link" href="<?= base_url('master/aliran') ?>">
            <i class="fe fe-monitor fe-16"></i>
            <span class="ml-3 item-text">Aliran Air</span>
          </a>
        </li>

      <?php endif ?>

      <?php if ($this->ion_auth->is_admin()) : ?>
        <li class="nav-item <?= $uri == 'pengaturan' ? 'active' : '' ?> w-100">
          <a class="nav-link" href="<?= base_url('pengaturan') ?>">
            <i class="fe fe-tool fe-16"></i>
            <span class="ml-3 item-text">Pengaturan</span>
          </a>
        </li>
      <?php endif ?>

    </ul>


    <?php if ($this->ion_auth->is_admin()) : ?>
      <p class="text-muted nav-heading mt-4 mb-1">
        <span>Manajemen Pengguna</span>
      </p>

      <ul class="navbar-nav flex-fill w-100 mb-2">
        <li class="nav-item <?= $uri2 == 'role' ? 'active' : '' ?> w-100">
          <a class="nav-link" href="<?= base_url('user/role') ?>">
            <i class="fe fe-target fe-16"></i>
            <span class="ml-3 item-text">Aktor</span>
          </a>
        </li>
        <li class="nav-item w-100 <?= in_array($uri2, $user) && $uri == 'user' ? 'active' : '' ?>">
          <a class="nav-link" href="<?= base_url('user/manage') ?>">
            <i class="fe fe-users fe-16"></i>
            <span class="ml-3 item-text">Seluruh Pengguna</span>
          </a>
        </li>
      </ul>

    <?php endif ?>

    <!-- <p class="text-muted nav-heading mt-4 mb-1">
      <span>Laporan</span>
    </p>

    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item w-100">
        <a class="nav-link" href="<?= base_url('user/role') ?>">
          <i class="fe fe-list fe-16"></i>
          <span class="ml-3 item-text">Anggaran</span>
        </a>
      </li>
    </ul> -->
  </nav>
</aside>

<!-- Container Fluid -->
<main role="main" class="main-content">
  <div class="container-fluid">