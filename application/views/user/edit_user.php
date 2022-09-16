<div class="row">

  <div class="col-md-9">
    <div class="card border-left-secondary shadow mb-4">
      <div class="card-header py-3">
        <button class="btn btn-sm btn-outline-primary float-right" type="button" onclick="window.location.href=base_url + 'user/manage'"><i class="fas fa-fw fa-arrow-left"></i> Kembali</button>
        <h6 class="m-0 font-weight-bold text-primary">Edit Data Pengguna</h6>
      </div>
      <div class="card-body">
        <?= form_open_multipart('user/edit/' . $id, ['id' => 'editUser']) ?>
        <input type="hidden" id="id" name="id" value="<?= $id ?>">
        <div class="form-group">
          <label for="full_name">Nama Lengkap</label>
          <input type="text" name="full_name" id="full_name" class="form-control" value="<?= $user->full_name ? $user->full_name : set_value('full_name') ?>">
          <?= form_error('full_name') ?>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" name="email" id="email" class="form-control" value="<?= $user->email ? $user->email : set_value('email') ?>">
          <?= form_error('email') ?>
        </div>


        <div class="form-group">
          <label for="group">Role</label>
          <select name="group" id="group" class="form-control">
            <option value="">-pilih-</option>
            <?php foreach ($group as $g) : ?>
              <?php $user_group = $this->ion_auth->get_users_groups($user->id)->row()->id; ?>
              <option value="<?= $g->id ?>" <?= $user_group == $g->id ? 'selected' : '' ?>><?= $g->name ?></option>
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

        <img src="<?= ass_url('img/profile/' . $user->picture) ?>" alt="gambar" class="img-preview w-25 img-fluid">

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control" value="<?= set_value('password') ?>">
          <?= form_error('password') ?>
        </div>
        <div class="form-group">
          <label for="password_confirm">Komfirmasi Password</label>
          <input type="password" name="password_confirm" id="password_confirm" class="form-control" value="<?= set_value('password_confirm') ?>">
          <?= form_error('password_confirm') ?>
        </div>

        <?= form_submit('submit', 'Simpan', ['class' => 'btn btn-outline-primary']) ?>
        <?= form_close() ?>
      </div>
    </div>
  </div>

</div>

<script>
  $(function() {
    ubahSourceGambar('gambar', 'img-preview');
  });

  $.ajaxSetup({
    async: false
  });


  $('#editUser').validate({
    rules: {
      full_name: {
        required: true,
        maxlength: 30
      },
      email: {
        required: true,
        email: true,
        remote: {
          url: base_url + 'atribut/email_check_edit',
          type: 'post',
          data: {
            id: $('#id').val()
          }
        },
        maxlength: 30
      },
      titel: 'required',
      password: {
        minlength: 6,
      },
      password_confirm: {
        minlength: 6,
        equalTo: '#password',
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