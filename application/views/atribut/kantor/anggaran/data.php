<div class="row">

  <div class="col-md-10">
    <div class="card shadow mb-4">
      <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Kantor Anggaran Air</h6>
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
          <th>Lokasi</th>
          <th>Cabang</th>
          <th>Pemilik Kantor</th>
          <th>Aksi</th>
        </tr>
        <?= table_close_head() ?>
        <?php $i = 1;
        foreach ($kantor as $k) : ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $k->lokasi ?></td>
            <td><?= $k->cabang ?></td>
            <td><?= $k->full_name ?? '-' ?></td>
            <td>
              <?= btn_editmodal($k->id_kantor) ?>
              <?php if ($this->ion_auth->is_admin()) : ?>
                <?= btn_hapus('atribut/hapus/kantor/anggaran', $k->id_kantor) ?>
              <?php endif ?>
            </td>
          </tr>
        <?php endforeach; ?>
        <?= table_foot() ?>

      </div>
    </div>
  </div>

</div>


<?php $this->load->view('atribut/kantor/anggaran/modal_tambah') ?>
<?php $this->load->view('atribut/kantor/anggaran/modal_ubah') ?>

<script>
  $(document).ready(function() {

    $('#add').validate({
      rules: {
        lokasi: {
          required: true,
          maxlength: 100
        },
        cabang: {
          required: true,
          maxlength: 200
        }
      },
    });

    $('#edit').validate({
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


    $('.edit').on('click', function() {
      const id = $(this).data('id');
      $.getJSON(base_url + 'atribut/getKantorAnggaran/' + id, kantor => {
        $('#lokasiu').val(kantor.lokasi);
        $('#cabangu').val(kantor.cabang);
        $('#id').val(kantor.id_kantor);
      });
    })
  })
</script>