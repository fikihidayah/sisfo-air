<div class="row">

  <div class="col-md-9">
    <div class="card border-left-secondary shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Kantor Anggaran</h6>
      </div>
      <div class="card-body">

        <?php if (isset($kantor)) : ?>

          <?= form_open('kantor_anggaran') ?>
          <input type="hidden" id="id" name="id" value="<?= $kantor->id_kantor ?>">
          <div class="form-group">
            <label for="lokasi" class="col-form-label">Lokasi<small class="text-danger">*</small> </label>
            <input class="form-control" type="text" id="lokasi" name="lokasi" value="<?= $kantor->lokasi ?>">
          </div>

          <div class="form-group">
            <label for="cabang" class="col-form-label">Cabang<small class="text-danger">*</small> </label>
            <input class="form-control" type="text" id="cabang" name="cabang" value="<?= $kantor->cabang ?>">
          </div>

          <button class="btn btn-success" type="submit"><i class="fe fe-save"></i> Ubah</button>

          <?= form_close() ?>

        <?php else : ?>
          <?= form_open('kantor_anggaran') ?>

          <div class="form-group">
            <label for="lokasi" class="col-form-label">Lokasi<small class="text-danger">*</small> </label>
            <input class="form-control" type="text" id="lokasi" name="lokasi">
          </div>

          <div class="form-group">
            <label for="cabang" class="col-form-label">Cabang<small class="text-danger">*</small> </label>
            <input class="form-control" type="text" id="cabang" name="cabang">
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