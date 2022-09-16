<div class="modal fade" id="modalAdd">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <?= form_open('atribut/satuan', ['id' => 'add']) ?>
      <div class="modal-body">

        <div class="form-group">
          <label for="nama_satuan" class="col-form-label">Nama Satuan<small class="text-danger">*</small> </label>
          <input class="form-control" type="text" id="nama_satuan" name="nama_satuan">
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