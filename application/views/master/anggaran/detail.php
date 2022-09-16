<div class="row">

  <div class="col-md">
    <div class="card shadow mb-4">
      <div class="card-header d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 font-weight-bold text-primary">Rincian Data Anggaran Investasi PIPA PDAM</h6>

        <div class="btn-wrapper">
          <?= btn_print('master/anggaran/cetak?ang=' . $detail['kantor'] . '&date=' . strtotime($detail['date'])) ?>
          <?= btn_add('master/anggaran/tambah') ?>
          <?= btn_back('master/anggaran') ?>
        </div>
      </div>
      <div class="card-body">
        <p><b>Lokasi Pekerjaan :</b> <?= $detail['lokasi'] ?></p>
        <p><b>Cabang :</b> <?= $detail['cabang'] ?></p>

        <?= table_head(false) ?>
        <tr>
          <th>No</th>
          <th>Nama Bahan</th>
          <th>Ukuran</th>
          <th>Jumlah</th>
          <th>Satuan</th>
          <th>Analisa</th>
          <th>Harga Satuan(Rp.)</th>
          <th>Jlh Harga(Rp.)</th>
          <th>Total(Rp.)</th>
          <th>Aksi</th>
        </tr>
        <?= table_close_head() ?>
        <?php $i = 1;
        $subRomawi = '';
        $total = 0;
        foreach ($data as $a) : ?>
          <tr class="bg-light">
            <td><b><?= numberToRoman($i) ?></b></td>
            <td><?= $a['nama'] ?></td>
            <td colspan="8"></td>
          </tr>
          <?php
          $i2 = 1;
          $totalSubAnggaran = 0;
          foreach ($a['anggaran'] as $agdetail) : ?>
            <tr>
              <td><?= $i2++ ?></td>
              <td><?= $agdetail->nama_bahan ?></td>
              <td><?= $agdetail->ukuran ?></td>
              <td><?= $agdetail->jumlah ?></td>
              <td><?= $agdetail->nama_satuan ?></td>
              <td><?= $agdetail->analisa ?></td>
              <td><?= number_format($agdetail->harga_satuan, 2, ',', '.') ?></td>
              <td><?= number_format($agdetail->jumlah_harga, 2, ',', '.') ?></td>
              <td></td>
              <td>
                <?= btn_edit('master/anggaran/edit/' . $agdetail->id) ?>
                <?php if ($this->ion_auth->get_users_groups()->row()->id != 4) : ?>
                  <?= btn_hapus('master/hapus/anggaran', $agdetail->id) ?>
                <?php endif ?>
              </td>
            </tr>
            <?php $totalSubAnggaran += $agdetail->jumlah_harga ?>

            <?php $subRomawi .= numberToRoman($i) . '+' ?>

            <tr>
              <td colspan="8" class="text-right">Total <?= numberToRoman($i++) ?> :</td>
              <td colspan="2" class="text-right"><b><?= number_format($totalSubAnggaran, 2, ',', '.') ?></b></td>
            </tr>

            <?php $total += $agdetail->jumlah_harga ?>

          <?php endforeach ?>
        <?php endforeach ?>
        <tr>
          <td colspan="8" class="text-right">Total <?= rtrim($subRomawi, '+') ?></td>
          <td colspan="2" class="text-right"><b><?= number_format($total, 2, ',', '.') ?></b></td>
        </tr>

        <tr>
          <td colspan="8" class="text-right">Ppn 11%</td>
          <?php
          $totalSebelumPpn = $total;
          $totalPpn = (11 / 100) * $totalSebelumPpn;
          ?>
          <td colspan="2" class="text-right"><b><?= number_format($totalPpn, 2, ',', '.') ?></b></td>
        </tr>

        <tr>
          <?php
          $totalSetelahPpn = (int) $totalSebelumPpn + (int) $totalPpn;
          ?>
          <td colspan="8" class="text-right">Jumlah</td>
          <td colspan="2" class="text-right"><b><?= number_format($totalSetelahPpn, 2, ',', '.') ?></b></td>
        </tr>

        <tr>
          <td colspan="8" class="text-right">Dibulatkan</td>
          <td colspan="2" class="text-right"><b><?= pembulatan($totalSetelahPpn)['huruf'] ?></b></td>
        </tr>

        <?= table_foot() ?>

        <div class="text-center font-weight-bold">
          <?= 'Terbilang : &nbsp;' . ucwords(to_word(pembulatan($totalSetelahPpn)['angka'])) . 'Rupiah' ?>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('.table-responsive .carik').remove();
  })
</script>