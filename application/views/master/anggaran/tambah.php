<div class="row">

  <div class="col-md-9">
    <div class="card border-left-secondary shadow mb-4">
      <div class="card-header py-3">
        <?= btn_back('master/anggaran') ?>
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Anggaran PDAM</h6>
      </div>
      <div class="card-body">
        <?php $role = $this->ion_auth->get_users_groups()->row()->id ?>

        <?= form_open('master/anggaran/tambah', ['id' => 'add']) ?>
        <div class="form-group">
          <label for="kantor_id">Lokasi Pekerjaan - Cabang<span class="text-danger">*</span></label>
          <select name="kantor_id" id="kantor_id" class="form-control">
            <option value="">-pilih-</option>
            <?php foreach ($kantor as $k) : ?>
              <option value="<?= $k->id_kantor ?>"><?= $k->lokasi . ' - ' . $k->cabang ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-group">
          <label for="kategori_id">Kategori<span class="text-danger">*</span></label>
          <select name="kategori_id" id="kategori_id" class="form-control">
            <option value="">-pilih-</option>
            <?php foreach ($kategori as $k) : ?>
              <option value="<?= $k->id_kat ?>"><?= $k->nama_kategori ?></option>
            <?php endforeach ?>
          </select>
        </div>


        <?= custom_input('nama_bahan', false, 'Nama Bahan') ?>

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

        <?= custom_input('jumlah') ?>

        <?php if ($role != 5) : ?>
          <div class="form-group">
            <label for="user_id">Akun Pengguna (Email - Nama)</label>
            <select name="user_id" id="user_id" class="form-control">
              <option value="">-pilih-</option>
              <?php foreach ($users as $u) : ?>
                <option value="<?= $u->user_id ?>"><?= $u->email . ' - ' . $u->full_name ?></option>
              <?php endforeach ?>
            </select>
          </div>

        <?php endif ?>

        <div class="form-group">
          <label for="analisa">Analisa<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="analisa" id="analisa" placeholder="TABEL">
        </div>

        <?= custom_input('harga_satuan', false, 'Harga Satuan (Rp.)') ?>

        <?= custom_input('jumlah_harga', false, 'Jumlah Harga (Rp.)') ?>


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
        kantor_id: "required",
        kategori_id: 'required',
        satuan_id: 'required',
        nama_bahan: {
          required: true,
          maxlength: 100
        },
        ukuran: 'required',
        ukuran_satuan: 'required',
        analisa: {
          required: true,
          maxlength: 30
        },
        harga_satuan: {
          required: true,
          number: true
        },
        jumlah: {
          required: true,
          number: true
        },
        jumlah_harga: {
          required: true,
          number: true
        },
      }
    });
  })
</script>