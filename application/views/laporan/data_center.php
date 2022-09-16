<!-- <link rel="stylesheet" href="<?= ass_url('plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') ?>"> -->

<style>
  @media (min-width: 720px) {
    .sd {
      margin-top: 36px;
    }
  }
</style>
<div class="row">
  <div class="col-md-12">
    <div class="card shadow border-left-secondary mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Data Center</h6>
      </div>
      <div class="card-body">
        <?= form_open('laporan/data_center') ?>
        <div class="row p-sm-3">
          <div class="col-md-4">
            <div class="form-group <?= red('tgl_mulai') ?>">
              <label for="tgl_mulai">Tanggal Mulai<span class="text-danger">*</span></label>
              <input type="text" id="tgl_mulai" class="form-control" name="tgl_mulai" value="<?= set_value('tgl_mulai') ? set_value('tgl_mulai') : date('d-m-Y', now('asia/jakarta')) ?>" data-toggle="datetimepicker">
              <small class="help-block"><?= form_error('tgl_mulai') ?></small>
            </div>
          </div>
          <div class="col-md-1">
            <div class="d-flex h-100 justify-content-sm-center align-items-sm-center">
              <span>S/D</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group <?= red('tgl_selesai') ?>">
              <label for="tgl_selesai">Tanggal Selesai<span class="text-danger">*</span></label>
              <input type="text" id="tgl_selesai" class="form-control" name="tgl_selesai" value="<?= set_value('tgl_selesai') ? set_value('tgl_selesai') : date('d-m-Y', now('asia/jakarta')) ?>" data-toggle="datetimepicker">
              <small class="help-block"><?= form_error('tgl_selesai') ?></small>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group <?= red('loc') ?>">
              <label for="loc">Lokasi<span class="text-danger">*</span></label>
              <select name="loc" id="loc" class="form-control select2">
                <option value="">-pilih-</option>
                <?php foreach ($lok as $l) : ?>
                  <option value="<?= $l->loc ?>" <?= $l->loc == @$_POST['loc'] ? 'selected' : '' ?>><?= $l->loc ?></option>
                <?php endforeach; ?>
              </select>
              <small class="help-block"><?= form_error('loc') ?></small>
            </div>
          </div>

        </div>
        <button class="btn btn-primary ml-3" type="submit"><i class="fa fa-filter"></i> Filter</button>
        <?php if (isset($hasil)) : ?>
          <a href="<?= base_url('laporan/print_dc/' . $_POST['tgl_mulai'] . '/' . $_POST['tgl_selesai'] . '/' . str_replace(' ',  '_', $_POST['loc'])) ?>" class="btn btn-warning" target="_blank"><i class="fas fa-fs fa-print"></i> Cetak</a>
        <?php endif; ?>

        <?php form_close() ?>

        <div class="row p-3">
          <div class="col-md-12 table-responsive">
            <table id="laporan" width="100%" class="table table-striped table-hover mt-2 dataTable">
              <thead class="bg-primary text-light">
                <tr>
                  <th>No.</th>
                  <th>Date</th>
                  <?php foreach ($jobdesc as $jd) : ?>
                    <th><?= $jd->jobdesc ?></th>
                  <?php endforeach; ?>
                  <th>Done By</th>
                </tr>
              </thead>
              <tbody>
                <?php if (isset($hasil)) :
                  if ($hasil->num_rows() > 0) :
                    $i = 1;
                    foreach ($hasil->result() as $h) : ?>
                      <tr>
                        <td><?= $i++ ?></td>
                        <td><?= date("d-F-Y", strtotime($h->tgl)) ?></td>
                        <?php foreach ($jobdesc as $key => $jd) : ?>
                          <td>
                            <?php
                            $jobdescselect = json_decode($h->jobdesc);
                            if (array_search(isset($jobdescselect[$key]), $jobdescselect) !== FALSE) {
                              echo "<i class='fas fa-fw fa-check text-success'></i>";
                            } else {
                              echo "-";
                            }
                            ?>
                          </td>
                        <?php endforeach; ?>
                        <td><?= $h->petugas ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- <script src="<?= ass_url('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') ?>"></script> -->


<script>
  $(document).ready(function() {

    // $('#tgl_mulai, #tgl_selesai').datepicker({
    //   autoclose: true,
    //   format: "LT",
    //   todayBtn: true
    // });

    $('#tgl_mulai, #tgl_selesai').datetimepicker({
      format: 'DD-MM-YYYY'
    });


  });
</script>