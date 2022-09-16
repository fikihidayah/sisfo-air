<div class="row">

  <div class="col-md-7 pr-sm-3">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold"><?= lang('edit_user_heading'); ?></h6>
      </div>
      <div class="card-body">
        <?= form_open_multipart(uri_string()) ?>
        <p><b>Email : </b> <?= $email ?></p>

        <?= custom_input('full_name', $user->full_name, 'Nama Lengkap') ?>

        <?= custom_input('email', $user->email) ?>

        <div class="form-group">
          <label for="gambar">Foto Profil</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="gambar" name="gambar" accept=".jpg, .png, .jpeg">
            <label class="custom-file-label" for="gambar">Pilih file</label>
          </div>
          <small class="text-muted">Ukuran file tidak lebih dari 2mb</small> <br>
          <?= $this->session->flashdata('file_error') ?>
        </div>

        <img src="<?= ass_url('img/profile/' . $user->picture) ?>" alt="gambar" class="img-preview w-25 img-fluid">

        <?= custom_password('password', false, false) ?>
        <?= custom_password('password_confirm', 'Konfirmasi Password', false) ?>

        <?= form_hidden('id', $user->id); ?>
        <?= form_hidden($csrf); ?>

        <button class="btn btn-primary" type="submit">Simpan</button>
        <button class="btn btn-secondary reset" type="button">Reset</button>


        <?= form_close() ?>
      </div>
    </div>
  </div>

  <div class="col-md-5">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold">Preview Profil</h6>
      </div>
      <div class="card-body">
        <div class="text-center">
          <?php $user = $this->ion_auth->user()->row() ?>
          <img src="<?= ass_url('img/profile/' . $user->picture) ?>" alt="gambar" class="img-fluid rounded-circle shadow-sm w-50 img-preview">
          <h5 class="text-muted mt-3"><?= $user->full_name ?></h5>
          <p class="text-primary"><?= $role ?></p>
          <a href="<?= base_url('user/reset_picture/' . $user->id) ?>" class="btn btn-flat btn-outline-success mt-2">Reset Foto Profil</a>
        </div>
      </div>
    </div>
  </div>

</div>

<script>
  var userData = <?= json_encode($this->ion_auth->user()->row()) ?>;

  $(function() {
    ubahSourceGambar('gambar', 'img-preview');

    $('.reset').on('click', function(e) {
      e.preventDefault();
      $('#first_name').val(userData.first_name);
      $('#last_name').val(userData.last_name);
      $('#email').val(userData.email);
      $('#phone').val(userData.phone);
      $('#password, #password_confirm, #gambar').val('');
      $('.custom-file-label').text('Pilih file');
      $('.img-preview').attr('src', base_url + 'assets/img/profile/' + userData.picture);
    });
  })
</script>