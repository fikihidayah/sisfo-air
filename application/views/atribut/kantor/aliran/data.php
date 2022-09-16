<div class="row">

  <div class="col-md-10">
    <div class="card shadow mb-4">
      <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Kantor Aliran Air</h6>
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
          <th>Nama Pemilik</th>
          <th>Alamat</th>
          <th>Nomor Register</th>
          <th>Pemilik Akun</th>
          <th>Aksi</th>
        </tr>
        <?= table_close_head() ?>
        <?php $i = 1;
        foreach ($kantor as $k) : ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $k->nama_pemilik ?></td>
            <td><?= $k->alamat ?></td>
            <td><?= $k->no_register ?? '-' ?></td>
            <td><?= $k->full_name ?? '-' ?></td>
            <td>
              <?= btn_editmodal($k->id_kantor_aliran) ?>
              <?php if ($this->ion_auth->is_admin()) : ?>
                <?= btn_hapus('atribut/hapus/kantor/aliran', $k->id_kantor_aliran) ?>
              <?php endif ?>
            </td>
          </tr>
        <?php endforeach; ?>
        <?= table_foot() ?>

      </div>
    </div>
  </div>

</div>


<?php $this->load->view('atribut/kantor/aliran/modal_tambah') ?>
<?php $this->load->view('atribut/kantor/aliran/modal_ubah') ?>

<script>
  $(document).ready(function() {

    $('#add').validate({
      rules: {
        nama_pemilik: {
          required: true,
          maxlength: 100
        },
        alamat: {
          required: true,
          maxlength: 200
        },
        no_register: {
          maxlength: 70
        },
      },
    });

    $('#edit').validate({
      rules: {
        nama_pemilik: {
          required: true,
          maxlength: 100
        },
        alamat: {
          required: true,
          maxlength: 200
        },
        no_register: {
          maxlength: 70
        },
      },
    });


    $('.edit').on('click', function() {
      const id = $(this).data('id');
      $.getJSON(base_url + 'atribut/getKantorAliran/' + id, kantor => {
        $('#nama_pemiliku').val(kantor.nama_pemilik);
        $('#alamatu').val(kantor.alamat);
        $('#no_registeru').val(kantor.no_register);
        $('#id').val(kantor.id_kantor_aliran);
      });
    })
  })
</script>