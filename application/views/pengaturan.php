<div class="row">

  <div class="col-md-9">
    <div class="card border-left-secondary shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengaturan Surat</h6>
      </div>
      <div class="card-body">
        <div id="error-replacement"></div>

        <?= form_open_multipart('pengaturan/aksi_pengaturan', ['id' => 'add']) ?>
        <div class="btn-wrapper d-flex justify-content-end">
          <button class="btn btn-primary mr-2" type="submit"><i class="fe fe-save"></i> Simpan</button>
          <button class="btn btn-warning" type="reset"><i class="fe fe-refresh-ccw"></i> Reset</button>
        </div>

        <?= custom_input('nama_penyetuju', $data->nama_penyetuju, 'Nama Penyetuju') ?>
        <?= custom_file('ttd_penyetuju', 'Tanda Tangan Penyetuju', '.jpg, .png, .jpeg', false) ?>

        <img src="<?= $data->ttd_penyetuju ? ass_url("img/pengaturan/$data->ttd_penyetuju") : '' ?>" alt="" class="penyetuju-preview <?= $data->ttd_penyetuju ? '' : 'd-none' ?>" width="200">

        <?php if (isset($data->ttd_penyetuju)) : ?>
          <button class="btn btn-danger d-block my-2 hapusTTD" data-type="ttd_penyetuju" data-gambar="<?= $data->ttd_penyetuju ?>" type="button">Hapus TTD</button>
        <?php endif ?>

        <?= custom_input('jabatan_penyetuju', $data->jabatan_penyetuju, 'Jabatan Penyetuju') ?>


        <?= custom_input('nama_pemeriksa', $data->nama_pemeriksa, 'Nama Pemeriksa') ?>
        <?= custom_file('ttd_pemeriksa', 'Tanda Tangan Pemeriksa', '.jpg, .png, .jpeg', false) ?>
        <img src="<?= $data->ttd_pemeriksa ? ass_url("img/pengaturan/$data->ttd_pemeriksa") : '' ?>" alt="" class="pemeriksa-preview <?= $data->ttd_pemeriksa ? '' : 'd-none' ?>" width="200">

        <?php if (isset($data->ttd_pemeriksa)) : ?>
          <button class="btn btn-danger d-block my-2 hapusTTD" data-type="ttd_pemeriksa" data-gambar="<?= $data->ttd_pemeriksa ?>" type="button">Hapus TTD</button>
        <?php endif ?>

        <?= custom_input('jabatan_pemeriksa', $data->jabatan_pemeriksa, 'Jabatan Pemeriksa') ?>


        <?= custom_input('nama_pembuat', $data->nama_pembuat, 'Nama Pengesah') ?>
        <?= custom_file('ttd_pembuat', 'Tanda Tangan Pengesah', '.jpg, .png, .jpeg', false) ?>
        <img src="<?= $data->ttd_pembuat ? ass_url("img/pengaturan/$data->ttd_pembuat") : '' ?>" alt="" class="pembuat-preview <?= $data->ttd_pembuat ? '' : 'd-none' ?>" width="200">

        <?php if (isset($data->ttd_pembuat)) : ?>
          <button class="btn btn-danger d-block my-2 hapusTTD" data-type="ttd_pembuat" data-gambar="<?= $data->ttd_pembuat ?>" type="button">Hapus TTD</button>
        <?php endif ?>

        <?= custom_input('jabatan_pembuat', $data->jabatan_pembuat, 'Jabatan Pengesah') ?>


        <?= custom_input('nama_pengesah', $data->nama_pengesah, 'Nama Pengesah') ?>
        <?= custom_file('ttd_pengesah', 'Tanda Tangan Pengesah', '.jpg, .png, .jpeg', false) ?>
        <img src="<?= $data->ttd_pengesah ? ass_url("img/pengaturan/$data->ttd_pengesah") : '' ?>" alt="" class="pengesah-preview <?= $data->ttd_pengesah ? '' : 'd-none' ?>" width="200">

        <?php if (isset($data->ttd_pengesah)) : ?>
          <button class="btn btn-danger d-block my-2 hapusTTD" data-type="ttd_pengesah" data-gambar="<?= $data->ttd_pengesah ?>" type="button">Hapus TTD</button>
        <?php endif ?>

        <?= custom_input('jabatan_pengesah', $data->jabatan_pengesah, 'Jabatan Pengesah') ?>

        <div class="btn-wrapper d-flex justify-content-end">
          <button class="btn btn-primary mr-2" type="submit"><i class="fe fe-save"></i> Simpan</button>
          <button class="btn btn-warning" type="reset"><i class="fe fe-refresh-ccw"></i> Reset</button>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    ubahSourceGambar('ttd_penyetuju', 'penyetuju-preview');
    ubahSourceGambar('ttd_pemeriksa', 'pemeriksa-preview');
    ubahSourceGambar('ttd_pembuat', 'pembuat-preview');
    ubahSourceGambar('ttd_pengesah', 'pengesah-preview');

    $('#add').validate({
      rules: {
        // nama_penyetuju: 'required',
        jabatan_penyetuju: 'required',
        ttd_penyetuju: {
          accept: "png,jpeg,jpg",
          filesize_max: 2000000,
        },
        nama_pemeriksa: 'required',
        jabatan_pemeriksa: 'required',
        ttd_pemeriksa: {
          accept: "png,jpeg,jpg",
          filesize_max: 2000000,
        },
        nama_pembuat: 'required',
        jabatan_pembuat: 'required',
        ttd_pembuat: {
          accept: "png,jpeg,jpg",
          filesize_max: 2000000,
        },
        nama_pengesah: 'required',
        jabatan_pengesah: 'required',
        ttd_pengesah: {
          accept: "png,jpeg,jpg",
          filesize_max: 2000000,
        },
      },
      submitHandler: function(form, e) {
        const validate = $(this);
        e.preventDefault();
        $.ajax({
          url: base_url + 'pengaturan/aksi_edit',
          method: 'POST',
          dataType: 'json',
          contentType: false,
          processData: false,
          cache: false,
          beforeSend: function() {
            $('.btn-primary').attr('disabled', 'disabled');
            $('.btn-primary').html(`
            <div class="spinner-border text-light" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            Simpan
            `);
          },
          data: new FormData(form),
          success: (data) => {
            if (data.error && !data.error.status) {

              let errMess = '<div class="alert alert-danger">'
              errMess += '<ol>';

              $.each(data.error, (inx, val) => {
                if (inx != 'status' && val !== '') {
                  errMess += '<li>' + val + '</li>';
                }
              })

              errMess += '</ol>';
              errMess += "</div>";

              $('#error-replacement').html(errMess);

              setTimeout(() => {
                $('.alert-danger').hide(400);
                $('#error-replacement').html('');
              }, 4000)

            }

            if (data.message) {
              new Noty({
                type: 'success',
                text: data.message
              }).show();
            }

            $('.btn-primary').html(`
            <i class="fe fe-save"></i> Simpan
            `);
            $('.btn-primary').removeAttr('disabled');

            $('.is-valid').removeClass('is-valid');
          }
        })
      }
    })

    $('.hapusTTD').on('click', function() {
      const type = $(this).data('type');
      const gambar = $(this).data('gambar');

      $.ajax({
        url: base_url + 'pengaturan/hapusGambar',
        data: {
          type: type,
          gambar: gambar,
        },
        dataType: 'json',
        method: 'post',
        success: (res) => {
          if (res.message) {
            new Noty({
              type: 'success',
              text: res.message
            }).show()

            $(this).prev('img').addClass('d-none').attr('src', '');
            $(this).remove();

          }
        }
      })

    })

  })
</script>