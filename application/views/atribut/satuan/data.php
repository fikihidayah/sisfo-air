<div class="row">

  <div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Satuan</h6>
        <?= btn_addmodal() ?>
      </div>
      <div class="card-body">
        <?= $this->session->flashdata('message') ?>
        <?php if (validation_errors()) : ?>
          <div class="alert alert-danger alert-dismissable show fade">
            <button class="close" type="button" data-dismiss="alert"><span>x</span></button>
            <?= validation_errors('<p>', '</p>') ?>
          </div>
        <?php endif ?>

        <?= table_head() ?>
        <tr>
          <th width="5%">No.</th>
          <th>Nama Satuan</th>
          <th>Aksi</th>
        </tr>
        <?= table_close_head() ?>
        <?php $i = 1;
        foreach ($satuan as $s) : ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $s->nama_satuan ?></td>
            <td>
              <?= btn_editmodal($s->id_satuan) ?>
              <?= btn_hapus('atribut/hapus/satuan', $s->id_satuan) ?>
            </td>
          </tr>
        <?php endforeach; ?>
        <?= table_foot() ?>

      </div>
    </div>
  </div>

</div>

<?php $this->load->view('atribut/satuan/modal_tambah') ?>
<?php $this->load->view('atribut/satuan/modal_ubah') ?>

<script>
  $(document).ready(function() {

    $('#add').validate({
      rules: {
        nama_satuan: {
          required: true,
          maxlength: 50
        }
      },
    });

    $('#edit').validate({
      rules: {
        nama_satuan: {
          required: true,
          maxlength: 50
        }
      },
    });


    $('.edit').on('click', function() {
      const id = $(this).data('id');
      $.getJSON(base_url + 'atribut/getSatuan/' + id, satuan => {
        $('#nama_satuanu').val(satuan.nama_satuan);
        $('#id').val(satuan.id_satuan);
      });
    })
  })
</script>