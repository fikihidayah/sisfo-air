<div class="row">

  <div class="col-md-10">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <button class="btn btn-outline-info float-right mr-2" type="button" data-toggle="modal" data-target="#modalPetunjuk"><i class="fe fe-info"></i> Petunjuk pengisian</button>
        <h6 class="m-0 font-weight-bold"><?= lang('index_heading'); ?></h6>
      </div>
      <div class="card-body">
        <?= table_head() ?>
        <tr>
          <th width="5%">No.</th>
          <th>Nama Role</th>
          <th>Deskripsi</th>
          <th>Aksi</th>
        </tr>
        <?= table_close_head() ?>
        <?php $i = 1;
        foreach ($role as $key => $r) : ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $r->name ?></td>
            <td><?= $r->description ?></td>

            <td>
              <?= btn_editmodal($r->id) ?>
            </td>
          </tr>
        <?php endforeach; ?>
        <?= table_foot() ?>
      </div>
    </div>
  </div>

</div>

<div class="modal fade" id="modalEdit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit </h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <?= form_open('user/edit_role', ['id' => 'edit']) ?>
      <div class="modal-body">
        <input type="hidden" id="idu" name="id">
        <div class="form-group">
          <label for="name" class="col-form-label">Nama<small class="text-danger">*</small> </label>
          <input class="form-control" type="text" id="nameu" name="name">
        </div>

        <div class="form-group">
          <label for="descriptionu" class="col-form-label">Deskripsi</label>
          <input class="form-control" type="text" id="descriptionu" name="description">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fe fe-x-circle"></i> Tutup</button>
        <button type="submit" class="btn btn-outline-success save"><i class="fe fe-save"></i> Simpan</button>
      </div>

      <?= form_close() ?>
    </div>
  </div>
</div>

<div class="modal fade" id="modalPetunjuk">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Petunjuk </h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <p>Ada 3 nama aktor di aplikasi ini:</p>
        <ol>
          <li>admin : Mengatur Segala urusan Di Program INI</li>
          <li>petugas : yang memverifikasi/konfirmasi pengisian form anggaran atau pendistribusian air masyarakat</li>
          <li>user: mengajukan anggaran atau pendistribusian air.</li>
        </ol>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fe fe-x-circle"></i> Tutup</button>
      </div>

    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

    $('#add, #edit').validate({
      rules: {
        name: {
          required: true,
          maxlength: 50
        }
      },
    });


    $('.edit').on('click', function() {
      const id = $(this).data('id');
      $.getJSON(base_url + 'user/getRole/' + id, jd => {
        $('#nameu').val(jd.name);
        $('#descriptionu').val(jd.description);
        $('#idu').val(jd.id);
      });
    })
  })
</script>