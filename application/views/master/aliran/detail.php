<div class="row">

  <div class="col-md">
    <div class="card shadow mb-4">
      <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 font-weight-bold text-primary">Rincian Data Anggaran Investasi PIPA PDAM</h6>

        <div class="btn-wrapper">
          <?= btn_print('master/aliran/cetak?air=' . $detail['pengisian']) ?>
          <?= btn_add('master/aliran/tambah') ?>
          <?= btn_back('master/aliran') ?>
        </div>
      </div>
      <div class="card-body">
        <p><b>Atas Nama :</b> <?= $detail['nama_pemilik'] ?></p>
        <p><b>Alamat :</b> <?= $detail['alamat'] ?></p>
        <p><b>No. Register :</b> <?= $detail['no_register'] ?></p>

        <table>
          <tr>
            <td>WiL/NPA : 02 / 29</td>
            <td>TGL : <?= tgl_indo($detail['date']) ?></td>
          </tr>
        </table>

        <?= table_head(false) ?>
        <tr>
          <th>No</th>
          <th>Material</th>
          <th>Ukuran</th>
          <th>Jumlah</th>
          <th>Satuan</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr>
        <?= table_close_head() ?>
        <?php $i = 1;
        $subRomawi = '';
        foreach ($data as $a) : ?>
          <tr class="bg-light">
            <td><b><?= numberToRoman($i) ?></b></td>
            <td colspan="4"><?= $a['nama'] ?></td>
            <?php if ($i == 1) : ?>
              <td rowspan="<?= (count($a['aliran']) + 1) * count($data) ?>"><?= $detail['keterangan'] ?></td>
            <?php endif ?>
          </tr>
          <?php
          $i2 = 1;
          $totalSubAnggaran = 0;
          foreach ($a['aliran'] as $aldetail) : ?>
            <tr>
              <td><?= $i2++ ?></td>
              <td><?= $aldetail->nama_material ?></td>
              <td><?= $aldetail->ukuran ?></td>
              <td><?= $aldetail->jumlah ?></td>
              <td><?= $aldetail->nama_satuan ?></td>
              <td>
                <?= btn_edit('master/aliran/edit/' . $aldetail->id_aliran) ?>
                <?php if ($this->ion_auth->get_users_groups()->row()->id != 4) : ?>
                  <?= btn_hapus('master/hapus/aliran', $aldetail->id_aliran) ?>
                <?php endif ?>
              </td>
            </tr>

            <?php $subRomawi .= numberToRoman($i++) . '+' ?>

          <?php endforeach ?>
        <?php endforeach ?>

        <?= table_foot() ?>

      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.table-responsive .carik').remove();
  })
</script>