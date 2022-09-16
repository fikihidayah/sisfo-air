<div class="modal fade" id="modalAdd">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <?= form_open('atribut/kantor_aliran', ['id' => 'add']) ?>
      <div class="modal-body">

        <div class="form-group">
          <label for="nama_pemilik" class="col-form-label">Nama Pemilik<small class="text-danger">*</small> </label>
          <input class="form-control" type="text" id="nama_pemilik" name="nama_pemilik">
        </div>

        <div class="form-group">
          <label for="alamat" class="col-form-label">Alamat<small class="text-danger">*</small> </label>
          <input class="form-control" type="text" id="alamat" name="alamat">
        </div>

        <div class="form-group">
          <label for="no_register" class="col-form-label">Nomor Register</label>
          <input class="form-control" type="text" id="no_register" name="no_register">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times-circle"></i> Tutup</button>
        <button type="submit" class="btn btn-outline-success save"><i class="fas fa-save"></i> Simpan</button>
      </div>

      <?= form_close() ?>
    </div>
  </div>
</div>