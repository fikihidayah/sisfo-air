<style>
  .tbdetail tr td:nth-child(2) {
    padding-left: 10px;
    padding-right: 10px;
  }
</style>
<div class="row">
  <div class="col-md-8 pr-sm-3">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Detail Data Pengguna</h6>
      </div>
      <div class="card-body">
        <table class="tbdetail">
          <th>Nama Lengkap</th>
          <td>:</td>
          <td><?= $tuser->full_name ?></td>
          </tr>
          <tr>
            <th>Telah bergabung pada tanggal</th>
            <td>:</td>
            <td><?= date('d F Y', $tuser->created_on) ?></td>
          </tr>
          <tr>
            <th>Terakhir Login</th>
            <td>:</td>
            <td><?= $tuser->last_login ? date('d F Y', $tuser->last_login) : '-' ?></td>
          </tr>
          <tr>
            <th>Email</th>
            <td>:</td>
            <td><?= $tuser->email ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <?= btn_back('user/manage') ?>
        <h6 class="m-0 font-weight-bold">Foto Pengguna</h6>
      </div>
      <div class="card-body">
        <div class="text-center">
          <img src="<?= ass_url('img/profile/' . $tuser->picture) ?>" alt="gambar" class="img-fluid rounded-circle shadow-sm w-50 img-preview">
          <h5 class="text-muted mt-3"><?= $tuser->full_name ?></h5>
          <p class="text-primary">
            <?= $role ?>
        </div>
      </div>
    </div>
  </div>
</div>