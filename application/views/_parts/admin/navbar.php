<nav class="topnav navbar navbar-light">
  <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
    <i class="fe fe-menu navbar-toggler-icon"></i>
  </button>
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
        <i class="fe fe-sun fe-16"></i>
      </a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php
        $user = $this->ion_auth->user()->row();
        if ($this->ion_auth->is_admin()) {
          $url_edit = 'edit_user';
        } else {
          $url_edit = 'edit_profile';
        }
        ?>
        <span class="avatar avatar-sm mt-2">
          <img src="<?= ass_url('img/profile/' . $user->picture) ?>" class="avatar-img rounded-circle">
        </span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
        <a class="dropdown-item" href="<?= base_url($url_edit) ?>"><i class="fe fe-user mr-2"></i> Profile</a>
        <a class="dropdown-item" href="#" data-target="#logoutModal" data-toggle="modal"><i class="fe fe-log-out mr-2"></i> Logout</a>
      </div>
    </li>
  </ul>
</nav>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Keluar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> Anda yakin? </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn mb-2 btn-secondary" data-dismiss="modal">Tidak</button>
        <button type="button" class="btn mb-2 btn-success" onclick="window.location.href=base_url+'gate/logout'">Iya</button>
      </div>
    </div>
  </div>
</div>