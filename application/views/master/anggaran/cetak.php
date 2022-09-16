<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
  <style>
    table {
      border: 1px solid #111;
      width: 100%;
      border-collapse: collapse;
    }

    table tr th {
      font-size: 14px;
      font-weight: bolder;
      color: #333;
    }

    table tr th,
    table tr td {
      border: 1px solid #111;
      padding: 3px 5px;
      font-size: 10pt;
    }

    table.no-border {
      border: 0;
    }

    table.no-border tr th,
    table.no-border tr td {
      border: 0;
    }

    * {
      font-family: Arial, Helvetica, sans-serif;
    }

    .center {
      text-align: center;
    }

    .right {
      text-align: right;
    }

    .deskripsi {
      margin-bottom: 20px;
    }

    p {
      margin: 0;
    }

    .top-logo {
      float: left;
      text-align: center;
      width: 20%;
    }

    .top-logo p {
      font-weight: bold;
    }

    .judul {
      float: right;
      text-align: center;
      width: 80%;
    }

    .judul h4 {
      font-weight: bolder;
      text-transform: uppercase;
    }

    .clearfix {
      clear: both;
    }

    .terbilang {
      margin-top: 30px;
      font-style: italic;
      font-weight: bolder;
    }

    .empty-thumb {
      width: 100px;
      height: 70px;
    }

    .gambar-ttd {
      margin-top: 12pt;
    }

    .gambar-ttd img {
      height: 70px;
    }

    .nama-ttd {
      font-weight: bold;
      border-bottom: 2px solid #111;
      margin-top: 12pt;
      display: inline-block;
    }
  </style>
</head>

<body>
  <div class="top-logo">
    <p>PDAM TIRTANADI</p>
    <img src="<?= ass_url('img/tritanadi.png') ?>" alt="logo" width="80">
  </div>

  <div class="judul">
    <h4>Anggaran Biaya Ivestasi (ABI) PIPA DISTRIBUSI</h4>
    <h4>PENGEMBANGAN / NON PENGEMBANGAN</h4>
  </div>
  <div class="clearfix"></div>


  <p style="margin-top: 12pt;"><b>Lokasi Pekerjaan :</b> <?= $detail['lokasi'] ?></p>
  <p style="margin-bottom: 12pt;"><b>Cabang :</b> <?= $detail['cabang'] ?></p>

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
  </tr>
  <?= table_close_head() ?>
  <?php $i = 1;
  $subRomawi = '';
  $total = 0;
  foreach ($data as $a) : ?>
    <tr class="bg-light">
      <td><b><?= numberToRoman($i) ?></b></td>
      <td><?= $a['nama'] ?></td>
      <td colspan="7"></td>
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
      </tr>
      <?php $totalSubAnggaran += $agdetail->jumlah_harga ?>

      <?php $subRomawi .= numberToRoman($i) . '+' ?>

      <tr>
        <td colspan="7" class="right"><b>Total <?= numberToRoman($i++) ?> :</b></td>

        <td class="right" colspan="2"><b><?= number_format($totalSubAnggaran, 2, ',', '.') ?></b></td>
      </tr>

      <?php $total += $agdetail->jumlah_harga ?>

    <?php endforeach ?>
  <?php endforeach ?>
  <tr>
    <td colspan="6" style="border-right: 0;"></td>
    <td class="right" style="border-left: 0;"><b>Total <?= rtrim($subRomawi, '+') ?></b></td>
    <td class="right" colspan="2"><b><?= number_format($total, 2, ',', '.') ?></b></td>
  </tr>

  <tr>
    <td colspan="7" class="right"><b>Ppn 11%</b></td>
    <?php
    $totalSebelumPpn = $total;
    $totalPpn = (11 / 100) * $totalSebelumPpn;
    ?>
    <td class="right" colspan="2"><b><?= number_format($totalPpn, 2, ',', '.') ?></b></td>
  </tr>

  <tr>
    <?php
    $totalSetelahPpn = (int) $totalSebelumPpn + (int) $totalPpn;
    ?>
    <td colspan="7" class="right"><b>Jumlah</b></td>
    <td class="right" colspan="2"><b><?= number_format($totalSetelahPpn, 2, ',', '.') ?></b></td>
  </tr>

  <tr>
    <td colspan="7" class="right"><b>Dibulatkan</b></td>
    <td class="right" colspan="2"><b><?= pembulatan($totalSetelahPpn)['huruf'] ?></b></td>
  </tr>

  <?= table_foot() ?>

  <div class="center terbilang">
    <?= 'Terbilang : &nbsp;' . ucwords(to_word(pembulatan($totalSetelahPpn)['angka'])) . 'Rupiah' ?>
  </div>

  <table class="no-border" style="margin-top: 18pt;">
    <tr>
      <td class="center">
        <p>Disetujui Oleh :</p>
        <div class="gambar-ttd">
          <?php if (isset($sett->ttd_penyetuju)) : ?>
            <img src="<?= ass_url('img/pengaturan/' . $sett->ttd_penyetuju) ?>" alt="ttd penyetuju" width="100">
          <?php else : ?>
            <div class="empty-thumb"></div>
          <?php endif ?>
          <div class="deskripsi-ttd">
            <p class="nama-ttd"><?= $sett->nama_penyetuju ?></p>
            <p class="jabatan"><?= $sett->jabatan_penyetuju ?></p>
          </div>
        </div>
      </td>
      <td class="center">
        <p>Diperiksa Oleh :</p>
        <div class="gambar-ttd">
          <?php if (isset($sett->ttd_pemeriksa)) : ?>
            <img src="<?= ass_url('img/pengaturan/' . $sett->ttd_pemeriksa) ?>" alt="ttd pemeriksa" width="100">
          <?php else : ?>
            <div class="empty-thumb"></div>
          <?php endif ?>
          <div class="deskripsi-ttd">
            <p class="nama-ttd"><?= $sett->nama_pemeriksa ?></p>
            <p class="jabatan"><?= $sett->jabatan_pemeriksa ?></p>
          </div>
        </div>
      </td>
      <td class="center">
        <p>Dibuat Oleh :</p>
        <div class="gambar-ttd">
          <?php if (isset($sett->ttd_pembuat)) : ?>
            <img src="<?= ass_url('img/pengaturan/' . $sett->ttd_pembuat) ?>" alt="ttd pembuat" width="100">
          <?php else : ?>
            <div class="empty-thumb"></div>
          <?php endif ?>
          <div class="deskripsi-ttd">
            <p class="nama-ttd"><?= $sett->nama_pembuat ?></p>
            <p class="jabatan"><?= $sett->jabatan_pembuat ?></p>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td></td>
      <td class="center" style="padding-top: 30px;">
        <p>Disyahkan Oleh :</p>
        <div class="gambar-ttd">
          <?php if (isset($sett->ttd_pengesah)) : ?>
            <img src="<?= ass_url('img/pengaturan/' . $sett->ttd_pengesah) ?>" alt="ttd pengesah" width="100">
          <?php else : ?>
            <div class="empty-thumb"></div>
          <?php endif ?>
        </div>
        <div class="deskripsi-ttd">
          <p class="nama-ttd"><?= $sett->nama_pengesah ?></p>
          <p class="jabatan"><?= $sett->jabatan_pengesah ?></p>
        </div>
      </td>
      <td></td>
    </tr>
  </table>

</body>

</html>