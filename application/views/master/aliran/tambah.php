<div class="row">

  <div class="col-md-9">
    <div class="card border-left-secondary shadow mb-4">
      <div class="card-header py-3">
        <?= btn_back('master/aliran') ?>
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Aliran PDAM</h6>
      </div>
      <div class="card-body">
        <?= form_open('master/aliran/tambah', ['id' => 'add']) ?>
        <div class="form-group">
          <label for="pengisian_id">Isian (Nama Pemilik - Alamat - Tanggal Mengisi)<span class="text-danger">*</span></label>
          <select name="pengisian_id" id="pengisian_id" class="form-control">
            <option value="">-pilih-</option>
            <?php foreach ($isian as $i) : ?>
              <option value="<?= $i->id_isian ?>"><?= $i->nama_pemilik . ' - ' . $i->alamat . ' - ' . date('d m Y', strtotime($i->tgl_pengisian)) ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <?= custom_input('nama_material', false, 'Nama Material') ?>

        <div class="form-group">
          <label for="kategori_id">Kategori<span class="text-danger">*</span></label>
          <select name="kategori_id" id="kategori_id" class="form-control">
            <option value="">-pilih-</option>
            <?php foreach ($kategori as $k) : ?>
              <option value="<?= $k->id_kat ?>"><?= $k->nama_kategori ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="row">
          <div class="col-md-6 pl-0">
            <?= custom_input('ukuran') ?>
            <small class="text-muted">Bidang Ukuran Ketikan '-' jika tidak ingin diisi</small>
          </div>
          <div class="col-md-6 pr-0">
            <div class="form-group">
              <label for="ukuran_satuan">Satuan Ukuran</label>
              <select name="ukuran_satuan" id="ukuran_satuan" class="form-control">
                <option value="">-pilih-</option>
                <option value="mm">MM</option>
                <option value="''">''</option>
                <option value="no" disabled>Kosong</option>
              </select>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="satuan_id">Satuan<span class="text-danger">*</span></label>
          <select name="satuan_id" id="satuan_id" class="form-control">
            <option value="">-pilih-</option>
            <?php foreach ($satuan as $s) : ?>
              <option value="<?= $s->id_satuan ?>"><?= $s->nama_satuan ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group">
          <label for="user_id">Akun Pengguna (Email - Nama)</label>
          <select name="user_id" id="user_id" class="form-control">
            <option value="">-pilih-</option>
            <?php foreach ($users as $u) : ?>
              <option value="<?= $u->user_id ?>"><?= $u->email . ' - ' . $u->full_name ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <?= custom_input('jumlah') ?>

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