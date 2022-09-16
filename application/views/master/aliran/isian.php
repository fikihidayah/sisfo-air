<div class="row">

  <div class="col-md-9">
    <div class="card border-left-secondary shadow mb-4">
      <div class="card-header py-3">
        <?= btn_back('master/aliran') ?>
        <h6 class="m-0 font-weight-bold text-primary">Tambah Isian Berdasakan Pemilik Rumah PDAM</h6>
      </div>
      <div class="card-body">
        <?= form_open('master/aliran/tambahisian', ['id' => 'add']) ?>
        <div class="form-group">
          <label for="kantor_id">Nama Pemilik - Alamat<span class="text-danger">*</span></label>
          <select name="kantor_id" id="kantor_id" class="form-control">
            <option value="">-pilih-</option>
            <?php foreach ($kantor as $k) : ?>
              <option value="<?= $k->id_kantor_aliran ?>"><?= $k->nama_pemilik . ' - ' . $k->alamat ?></option>
            <?php endforeach ?>
          </select>
        </div>


        <div class="form-group">
          <label for="tgl_pengisian" class="col-form-label">Tanggal Pengisian<small class="text-danger">*</small> </label>

          <div class="input-group">
            <input type="text" class="form-control drgpicker" name="tgl_pengisian" id="tgl_pengisian" readonly>
            <div class="input-group-append">
              <button class="input-group-text bg-primary border-primary text-white" type="button" onclick="$('#tgl_pengisian').focus()"><i class="fe fe-calendar fe-16"></i></button>
            </div>
          </div>
        </div>

        <?= custom_textarea('keterangan') ?>


        <button type="submit" class="btn btn-outline-success save"><i class="fas fa-save"></i> Simpan</button>
        <a href="<?= base_url('master/aliran/tambah') ?>" class="btn btn-outline-warning">Langsung Menambah Item</a>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

    $('#add').validate({
      rules: {
        kantor_id: "required",
        tgl_pengisian: {
          required: true,
          remote: {
            url: base_url + 'master/check_isian_uniq',
            type: 'post',
            data: {
              kantor_id: function() {
                return $('#kantor_id').val()
              }
            }
          }
        },
        satuan_id: 'required',
        keterangan: {
          maxlength: 1000
        },
      },
      messages: {
        tgl_pengisian: {
          remote: "Tanggal pengisian dan nama pemilik tidak boleh sama, silahkan lihat pada menu utama(aliran air)"
        }
      }
    });

    $('#keterangan').summernote({
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
      ],
      minHeight: 300
    })
  })
</script>