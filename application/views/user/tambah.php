<div class="row">

  <div class="col-md-9">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <?= btn_back('user/manage') ?>
        <h6 class="m-0 font-weight-bold">Tambah Data Pengguna</h6>
      </div>
      <div class="card-body">
        <?= $this->ion_auth->errors() ?>
        <?= form_open_multipart('user/tambah', ['id' => 'addUser']) ?>
        <?= custom_input('full_name', false, 'Nama Lengkap') ?>

        <?= custom_input('email', false) ?>


        <div class="form-group">
          <label for="group">Role<small class="text-danger">*</small></label>
          <select name="group" id="group" class="form-control">
            <option value="">-pilih-</option>
            <?php foreach ($group as $i => $g) : ?>
              <?php if ($i > 1) continue; ?>
              <option value="<?= $g->id ?>" <?= set_value('group') == $g->id ? 'selected' : '' ?>><?= $g->name ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="gambar">Foto Profil</label>
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="gambar" name="gambar" accept=".jpg, .png, .jpeg">
            <label class="custom-file-label" for="gambar">Pilih file</label>
          </div>
          <small class="text-muted">Ukuran file tidak lebih dari 2mb</small> <br>
          <?= $this->session->flashdata('file_error') ?>
        </div>

        <img src="<?= ass_url('img/profile/default.png') ?>" alt="gambar" class="img-preview w-25 img-fluid">

        <?= custom_password('password') ?>
        <?= custom_password('password_confirm', 'Konfirmasi Password') ?>

        <button type="submit" class="btn btn-outline-primary">Daftar</button>
        <?= form_close() ?>
      </div>
    </div>
  </div>

</div>

<script>
  $(function() {
    ubahSourceGambar('gambar', 'img-preview');
  })

  $('#addUser').validate({
    rules: {
      full_name: {
        required: true,
        maxlength: 30
      },
      email: {
        required: true,
        email: true,
        remote: {
          url: base_url + 'atribut/email_check',
          type: 'post',
        },
        maxlength: 30
      },
      password: {
        required: true,
        minlength: 6,
      },
      password_confirm: {
        required: true,
        minlength: 6,
        equalTo: '#password',
      },
      group: {
        required: true,
      },
      gambar: {
        accept: "png,jpeg,jpg",
        filesize_max: 2000000,
      }
    },
    messages: {
      email: {
        remote: "Email sudah ada silahkan cari yang lain"
      },
      password_confirm: {
        equalTo: "Password harus sama dengan konfirmasi password"
      }
    }
  });
</script>