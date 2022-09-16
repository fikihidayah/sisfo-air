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
      width: 250px;
    }

    .top-logo .descript-logo {
      float: right;
      margin-top: 20px;
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
    <img src="<?= ass_url('img/tritanadi.png') ?>" alt="logo" width="80" style="float: left;">
    <div class="descript-logo">
      <p>PDAM TIRTANADI</p>
      <p>Prop. Sumatera Utara</p>
    </div>
    <div class="clearfix"></div>
  </div>


  <table class="no-border">
    <tr>
      <td>Atas Nama</td>
      <td>:</td>
      <td colspan="4"><?= $detail['nama_pemilik'] ?></td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td colspan="4"><?= $detail['alamat'] ?></td>
    </tr>
    <tr>
      <td>No. Register</td>
      <td>:</td>
      <td><?= $detail['no_register'] ?></td>
      <td>Wil / NPA :</td>
      <td>02 / 29</td>
      <td>TGL :</td>
      <td><?= tgl_indo($detail['date']) ?></td>
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
  </tr>
  <?= table_close_head() ?>
  <?php $i = 1;
  $subRomawi = '';
  foreach ($data as $a) : ?>
    <tr>
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
      </tr>

      <?php $subRomawi .= numberToRoman($i++) . '+' ?>

    <?php endforeach ?>
  <?php endforeach ?>

  <?= table_foot() ?>


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