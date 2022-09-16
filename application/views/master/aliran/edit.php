<div class="row">

  <div class="col-md-9">
    <div class="card border-left-secondary shadow mb-4">
      <div class="card-header py-3">
        <?= btn_back('master/aliran') ?>
        <h6 class="m-0 font-weight-bold text-primary">Edit Data Aliran PDAM</h6>
      </div>
      <div class="card-body">
        <?= form_open(
          'master/aliran/edit/' . $aliran->id_aliran,
          ['id' => 'add'],
          ['id' => $aliran->id_aliran]
        ) ?>

        <div class="form-group">
          <label for="pengisian_id">Isian (Nama Pemilik - Alamat - Tanggal Mengisi)<span class="text-danger">*</span></label>
          <select name="pengisian_id" id="pengisian_id" class="form-control">
            <option value="">-pilih-</option>
            <?php foreach ($isian as $i) : ?>
              <option value="<?= $i->id_isian ?>" <?= $i->id_isian == $aliran->pengisian_id ? 'selected' : '' ?>><?= $i->nama_pemilik . ' - ' . $i->alamat . ' - ' . date('d m Y', strtotime($i->tgl_pengisian)) ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <?= custom_input('nama_material', $aliran->nama_material, 'Nama Material') ?>

        <div class="form-group">
          <label for="kategori_id">Kategori<span class="text-danger">*</span></label>
          <select name="kategori_id" id="kategori_id" class="form-control">
            <option value="">-pilih-</option>
            <?php foreach ($kategori as $k) : ?>
              <option value="<?= $k->id_kat ?>" <?= $k->id_kat == $aliran->kategori_id ? 'selected' : '' ?>><?= $k->nama_kategori ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <?php
        $ukuran = explode(' ', $aliran->ukuran);
        $ukuran_satuan = end($ukuran);
        $ukuran_ = implode(' ', array_slice($ukuran, 0, -1));
        if (empty($ukuran_)) $ukuran_ = '-';
        ?>
        <div class="row">
          <div class="col-md-6 pl-0">
            <?= custom_input('ukuran', $ukuran_) ?>
            <small class="text-muted">Bidang Ukuran Ketikan '-' jika tidak ingin diisi</small>
          </div>
          <div class="col-md-6 pr-0">
            <div class="form-group">
              <label for="ukuran_satuan">Satuan Ukuran</label>
              <select name="ukuran_satuan" id="ukuran_satuan" class="form-control" <?= $ukuran_satuan == '-' ? 'disabled' : '' ?>>
                <option value="">-pilih-</option>
                <option value="mm" <?= $ukuran_satuan == 'mm' ? 'selected' : '' ?>>MM</option>
                <option value="''" <?= $ukuran_satuan == "''" ? 'selected' : '' ?>>''</option>
                <option value="no" <?= $ukuran_satuan == '-' ? 'selected' : '' ?> disabled>Kosong</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="satuan_id">Satuan<span class="text-danger">*</span></label>
          <select name="satuan_id" id="satuan_id" class="form-control">
            <option value="">-pilih-</option>
            <?php foreach ($satuan as $s) : ?>
              <option value="<?= $s->id_satuan ?>" <?= $s->id_satuan == $aliran->satuan_id ? 'selected' : '' ?>><?= $s->nama_satuan ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group">
          <label for="user_id">Akun Pengguna (Email - Nama)</label>
          <select name="user_id" id="user_id" class="form-control">
            <option value="">-pilih-</option>
            <?php foreach ($users as $u) : ?>
              <option value="<?= $u->user_id ?>" <?= $u->user_id == $aliran->user_id ? 'selected' : '' ?>><?= $u->email . ' - ' . $u->full_name ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <?= custom_input('jumlah', $aliran->jumlah) ?>

        <button type="submit" class="btn btn-outline-success save"><i class="fas fa-save"></i> Simpan</button>

        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#ukuran').on('keyup', function() {
      let value = $(this).val();

      if (value == '-') {
        $('#ukuran_satuan').val('no')
        $('#ukuran_satuan').attr('disabled', 'disabled');
      } else {
        $('#ukuran_satuan').val('')
        $('#ukuran_satuan').removeAttr('disabled');
      }
    })

    $('#add').validate({
      rules: {
        pengisian_id: "required",
        kategori_id: 'required',
        satuan_id: 'required',
        nama_material: {
          required: true,
          maxlength: 100
        },
        ukuran: 'required',
        ukuran_satuan: 'required',
        jumlah: {
          required: true,
          number: true
        },
      }
    });
  })
</script>