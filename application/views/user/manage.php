<div class="row">

  <div class="col-md">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <?= btn_add('user/tambah') ?>
        <h6 class="m-0 font-weight-bold"><?= lang('index_heading'); ?></h6>
      </div>
      <div class="card-body">
        <?= $this->session->flashdata('message') ?>
        <?= table_head() ?>
        <tr>
          <th width="5%">No.</th>
          <th>Nama Lengkap</th>
          <th>Email</th>
          <th>Role</th>
          <th>Aktivasi</th>
          <th width="15%">Aksi</th>
        </tr>
        <?= table_close_head() ?>
        <?php $i = 1;
        foreach ($users as $key => $user) : ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $user->full_name ?></td>
            <td><?= $user->email ?></td>
            <td>
              <?php foreach ($user->groups as  $group) : ?>
                <?= $group->name; ?>
              <?php endforeach ?>
            </td>
            <td>
              <?php
              $id_login_user = $this->ion_auth->user()->row()->id;
              $prop = 'disabled';
              $check = 'checked';
              if ($user->active) {
                // di check, jika active
                if ($user->id != 1 && $id_login_user != $user->id) {
                  $prop = '';
                }
              } else {
                // di uncheck jika tidak active
                if ($user->id != 1 && $id_login_user != $user->id) {
                  $prop = '';
                  $check = '';
                }
              }
              ?>
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input activasi" id="customSwitch<?= ++$key ?>" <?= $prop . ' ' . $check ?> data-userid="<?= $user->id ?>">
                <label class="custom-control-label" for="customSwitch<?= $key ?>"></label>
              </div>
            </td>
            <td>
              <a href="<?= base_url('user/detail?m=' . $user->id) ?>" class="btn btn-info btn-sm lihat mb-2"><i class="fe fe-eye"></i></a>

              <?php
              if ($id_login_user == $user->id) {
                $url = 'edit_user';
              } else {
                $url = 'user/edit/' . $user->id;
              } ?>


              <?php if ($user->id != 1) : ?>
                <?= btn_edit($url) ?>
              <?php endif; ?>
              <!-- 
                Algoritma
                1. User yang idnya bukan 1 bisa dihapus.
                2. User yang sedang login tidak bisa dihapus, yang artinya dia admin tapi bukan admin dengan id 1
              -->
              <?php
              $user_login_isadmin = $this->ion_auth->is_admin($user->id);

              if ($id_login_user != $user->id || !$user_login_isadmin) :
                if ($user->id != 1) : ?>
                  <?= btn_hapus('user/hapus', $user->id) ?>
              <?php endif;
              endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
        <?= table_foot() ?>
      </div>
    </div>
  </div>

</div>

<script>
  $('.activasi').on('click', function() {
    const isChecked = $(this).prop('checked');
    const userId = $(this).data('userid');
    if (isChecked) {
      // mengaktifkan user
      $.ajax({
        url: base_url + 'gate/activate/' + userId,
        method: 'get',
        dataType: 'json',
        success: res => {
          if (res.status) {
            new Noty({
              type: 'success',
              text: res.pesan,
            }).show();
          } else {
            new Noty({
              type: 'error',
              text: res.pesan,
            }).show();
          }
        }
      })
    } else {
      // menonaktifkan user
      $.ajax({
        url: base_url + 'gate/deactivate/' + userId,
        method: 'get',
        dataType: 'json',
        success: res => {
          if (res.status) {
            new Noty({
              type: 'success',
              text: res.pesan,
            }).show();
          } else {
            new Noty({
              type: 'error',
              text: res.pesan,
            }).show();
          }
        }
      })
    }

  });
</script>