<div class="modal fade" id="modalAdd">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <?= form_open('atribut/kategori', ['id' => 'add']) ?>
      <div class="modal-body">

        <div class="form-group">
          <label for="nama_kategori" class="col-form-label">Nama Kategori<small class="text-danger">*</small> </label>
          <input class="form-control" type="text" id="nama_kategori" name="nama_kategori">
        </div>

        <div class="form-group">
          <label for="keterangan" class="col-form-label">Keterangan</label>
          <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
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