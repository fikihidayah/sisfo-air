<div class="row">

  <div class="col-md">
    <div class="card shadow mb-4">
      <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Anggaran Investasi PIPA PDAM</h6>
        <?= btn_add('master/anggaran/tambah') ?>
      </div>
      <div class="card-body">
        <?php $role = $this->ion_auth->get_users_groups()->row()->id ?>
        <?= table_head() ?>
        <tr>
          <th width="5%">ID.</th>
          <!-- dapat melihat siapa penggunanya -->
          <?php if ($role != 5) : ?>
            <th>Akun Pengguna</th>
          <?php endif ?>
          <th>Lokasi Pekerjaan</th>
          <th>Cabang</th>
          <th>Status Konformasi</th>
          <th>Tanggal Dibuat</th>
          <th>Aksi</th>
        </tr>
        <?= table_close_head() ?>
        <?php
        foreach ($anggaran as $a) : ?>
          <tr>
            <td><?= $a->id ?></td>
            <?php if ($role != 5) :
              // jika yang ngisi user 
              if ($a->user_id) :  ?>
                <td><?= $this->ion_auth->user($a->user_id)->row()->email ?></td>
              <?php
              else : ?>
                <td>Belum diisi user</td>
            <?php endif;
            endif; ?>
            <td><?= $a->lokasi ?></td>
            <td><?= $a->cabang ?></td>
            <td><?= $a->status_konfirmasi ? 'Terkonfirmasi' : 'Belum dikonfirmasi' ?></td>
            <td><?= tgl_indo($a->date_created) ?></td>
            <td>
              <?= btn_detail('master/detail?ang=' . $a->kantor_id . '&date=' . strtotime($a->date_created)) ?>

              <!-- Petugas saja yang bisa mengkonfiramsi -->
              <?php if ($role == 4) : ?>

                <?= form_open('master/konfirmasi/anggaran', ['class' => 'd-inline konfirmForm'], [
                  'kantor_id' => $a->kantor_id,
                  'date_created' => $a->date_created,
                ]) ?>
                <button type="submit" class="btn btn-sm btn-success konfirm mb-2" <?= $a->status_konfirmasi ? 'disabled="disabled"' : '' ?>><i class="fe fe-external-link"></i></button>
                <?= form_close() ?>

              <?php endif ?>

              <?php if ($role != 4) : ?>

                <?= form_open('master/hapus/anggaran', ['class' => 'd-inline hapusForm']) ?>
                <input type="hidden" name="_method" value="delete">
                <input type="hidden" name="kantor_id" value="<?= $a->kantor_id ?>">
                <input type="hidden" name="date_created" value="<?= $a->date_created ?>">
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