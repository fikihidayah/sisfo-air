<div class="row">

  <div class="col-md-9">
    <div class="card border-left-secondary shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kantor Aliran</h6>
      </div>
      <div class="card-body">

        <?php if (isset($kantor)) : ?>

          <?= form_open('alamat_air') ?>
          <input type="hidden" id="id" name="id" value="<?= $kantor->id_kantor_aliran ?>">
          <div class="form-group">
            <label for="nama_pemilik" class="col-form-label">Nama Pemilik<small class="text-danger">*</small> </label>
            <input class="form-control" type="text" id="nama_pemilik" name="nama_pemilik" value="<?= $kantor->nama_pemilik ?>">
          </div>

          <div class="form-group">
            <label for="alamat" class="col-form-label">Alamat<small class="text-danger">*</small> </label>
            <input class="form-control" type="text" id="alamat" name="alamat" value="<?= $kantor->alamat ?>">
          </div>

          <div class="form-group">
            <label for="no_register" class="col-form-label">Nomor Register</label>
            <input class="form-control" type="text" id="no_register" name="no_register" value="<?= $kantor->no_register ?>">
          </div>

          <button class="btn btn-success" type="submit"><i class="fe fe-save"></i> Ubah</button>

          <?= form_close() ?>

        <?php else : ?>
          <?= form_open('alamat_air') ?>

          <div class="form-group">
            <label for="nama_pemilik" class="col-form-label">Nama Pemilik<small class="text-danger">*</small> </label>
            <input class="form-control" type="text" id="nama_pemilik" name="nama_pemilik" value="<?= set_value('nama_pemilik') ?>">
          </div>

          <div class="form-group">
            <label for="alamat" class="col-form-label">Alamat<small class="text-danger">*</small> </label>
            <input class="form-control" type="text" id="alamat" name="alamat" value="<?= set_value('alamat') ?>">
          </div>

          <div class="form-group">
            <label for="no_register" class="col-form-label">Nomor Register</label>
            <input class="form-control" type="text" id="no_register" name="no_register" value="<?= set_value('no_register') ?>">
          </div>

          <button class="btn btn-primary" type="submit"><i class="fe fe-save"></i> Simpan</button>
          <?= form_close() ?>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

    $('form').validate({
      rules: {
        lokasi: {
          required: true,
          maxlength: 100
        },
        cabang: {
          required: true,
          maxlength: 200
        },
      },
    });
  });
</script>