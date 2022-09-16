<div class="row">

  <div class="col-md-8">
    <div class="card shadow mb-4">
      <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori</h6>
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
          <th>Nama Kategori</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr>
        <?= table_close_head() ?>
        <?php $i = 1;
        foreach ($kategori as $s) : ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $s->nama_kategori ?></td>
            <td><?= $s->keterangan ?></td>
            <td>
              <?= btn_editmodal($s->id_kat) ?>
              <?= btn_hapus('atribut/hapus/kategori', $s->id_kat) ?>
            </td>
          </tr>
        <?php endforeach; ?>
        <?= table_foot() ?>

      </div>
    </div>
  </div>

</div>

<?php $this->load->view('atribut/kategori/modal_tambah') ?>
<?php $this->load->view('atribut/kategori/modal_ubah') ?>

<script>
  $(document).ready(function() {

    $('#add').validate({
      rules: {
        nama_kategori: {
          required: true,
          maxlength: 50
        },
        keterangan: {
          maxlength: 300
        }
      },
    });

    $('#edit').validate({
      rules: {
        nama_kategori: {
          required: true,
          maxlength: 50
        },
        keterangan: {
          maxlength: 300
        }
      },
    });


    $('.edit').on('click', function() {
      const id = $(this).data('id');
      $.getJSON(base_url + 'atribut/getKategori/' + id, kategori => {
        $('#nama_kategoriu').val(kategori.nama_kategori);
        $('#keteranganu').val(kategori.keterangan);
        $('#id').val(kategori.id_kat);
      });
    })
  })
</script>