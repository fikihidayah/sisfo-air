<div class="row">

  <div class="col-md">
    <div class="card shadow mb-4">
      <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Aliran Air PIPA Di Tiap Rumah Lewat PDAM</h6>
        <?= btn_add('master/aliran/tambahisian') ?>
      </div>
      <div class="card-body">
        <?= table_head() ?>
        <tr>
          <th width="5%">No.</th>
          <th>Nama Pemilik</th>
          <th>Alamat</th>
          <th>Tanggal Dibuat</th>
          <th>Status Konfirmasi</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr>
        <?= table_close_head() ?>
        <?php
        $i = 1;
        foreach ($aliran as $a) : ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $a->nama_pemilik ?></td>
            <td><?= $a->alamat ?></td>
            <td><?= tgl_indo($a->tgl_pengisian) ?></td>
            <td><?= $a->status_konfirmasi ? 'Terkonfirmasi' : 'Belum dikonfirmasi' ?></td>
            <td><?= $a->keterangan ?></td>
            <td>
              <?= btn_detail('master/detail?air=' . $a->id_isian) ?>

              <!-- Petugas saja yang bisa mengkonfiramsi -->
              <?php if ($this->ion_auth->get_users_groups()->row()->id == 4) : ?>

                <?= form_open('master/konfirmasi/aliran', ['class' => 'd-inline konfirmForm'], ['pengisian_id' => $a->id_isian]) ?>
                <button type="submit" class="btn btn-sm btn-success konfirm mb-2" <?= $a->status_konfirmasi ? 'disabled="disabled"' : '' ?>><i class="fe fe-external-link"></i></button>
                <?= form_close() ?>

              <?php endif ?>

              <?php if ($this->ion_auth->get_users_groups()->row()->id != 4) : ?>
                <?= form_open('master/hapus/aliran', ['class' => 'd-inline hapusForm']) ?>
                <input type="hidden" name="_method" value="delete">
                <input type="hidden" name="pengisian_id" value="<?= $a->id_isian ?>">
                <button type="submit" class="btn btn-sm btn-danger mb-2 hapus"><i class="fe fe-trash"></i></button>
                <?= form_close() ?>
              <?php endif ?>
            </td>
          </tr>
        <?php endforeach; ?>
        <?= table_foot() ?>

      </div>
    </div>
  </div>

</div>