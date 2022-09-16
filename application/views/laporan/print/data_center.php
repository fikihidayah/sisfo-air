<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?= $title ?></title>
  <!-- bootstrap 4 -->
  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="<?= admin_url('css/') ?>normalize.min.css">
  <link rel="stylesheet" href="<?= admin_url('vendor/fontawesome-free/') ?>css/all.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="<?= admin_url('css/') ?>paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
    @page {
      size: A4
    }

    @media print {
      .print-btn {
        display: none;
      }
    }

    body {
      font-family: sans-serif;
      font-size: 14px;
    }

    table.log {
      border-collapse: collapse;
    }

    table.log tr td,
    table.log tr th {
      border: 2px solid #222;
      padding: 5px;
    }

    table.log tr th {
      text-transform: capitalize;
      font-weight: 700;
      font-size: 16px;
    }

    table.log tr td {
      font-size: 14px;
    }

    table.des {
      margin-bottom: 10px;
    }

    table.des tr th {
      text-align: left;
      width: 30%;
    }

    table.des tr th,
    table.des tr td {
      padding: 5px;
    }

    table.ttd {
      margin-bottom: 10px;
    }

    .bb {
      border-bottom: 2px solid #222;
    }

    .cen {
      text-align: center;
    }

    .print-btn {
      background-color: #43b0f1;
      padding: 5px 10px;
      border: none;
      color: white;
      border-radius: 5px;
    }

    .print-btn:hover {
      background-color: #057dcd;
      cursor: pointer;
    }

    .r90 {
      transform: rotate(90deg);
    }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
    <article>
      <button class="print-btn" type="button" onclick="window.print()">Print</button>
      <div class="cen">
        <h3>Data Center Room Monthly Cleaning</h3>
        <!-- <h3 style="margin-bottom: 0;">MONTHLY INSPECTION FIRE EXTINGUISHER</h3> -->
        <!-- <h3 style="margin-top: 3px;">Plant Facility Departement</h3> -->
      </div>

      <div style="width: 35%; display:inline-block">
        <table class="des">
          <tr>
            <th>Lokasi</th>
            <td>:</td>
            <td><?= $dc[0]->loc ?></td>
          </tr>
        </table>
      </div>

      <div style="width: 100%; display:inline-block">

        <table class="log">
          <thead>
            <tr>
              <th rowspan="2">No</th>
              <th rowspan="2">Date</th>
              <th colspan="<?= count($jobdesc) ?>">Job Description</th>

              <th rowspan="2">Done By</th>
              <th rowspan="2">Owner</th>
            </tr>
            <tr>
              <?php foreach ($jobdesc as $jd) : ?>
                <th><?= $jd->jobdesc ?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1;
            foreach ($dc as $key => $d) : ?>
              <?php if ($key == 58) {
                break;
              } ?>
              <tr>
                <td><?= $i++ ?>.</td>
                <td><?= date("d/m/Y", strtotime($d->tgl)) ?></td>
                <?php foreach ($jobdesc as $key => $jd) : ?>
                  <td class="cen">
                    <?php
                    $jobdescselect = json_decode($d->jobdesc);
                    if (array_search(isset($jobdescselect[$key]), $jobdescselect) !== FALSE) {
                      echo "<i class='fas fa-fw fa-check'></i>";
                    } else {
                      echo "-";
                    }
                    ?>
                  </td>
                <?php endforeach; ?>
                <td><?= $d->petugas ?></td>
                <td><?= $d->owner ?></td>

              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

    </article>
  </section>
  <?php if (array_key_exists(58, $dc)) : ?>
    <section class="sheet padding-10mm">
      <article>
        <table class="log">
          <thead>
            <tr>
              <th>No</th>
              <th>Date</th>
              <?php foreach ($jobdesc as $jd) : ?>
                <th><?= $jd->jobdesc ?></th>
              <?php endforeach; ?>
              <th>Done By</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 58;
            foreach ($dc as $key => $d) : ?>
              <?php if ($key < 58) {
                continue;
              } ?>
              <tr>
                <td><?= $i++ ?>.</td>
                <td><?= date("d-m-Y", strtotime($d->tgl)) ?></td>
                <?php foreach ($jobdesc as $key => $jd) : ?>
                  <td class="cen">
                    <?php
                    $jobdescselect = json_decode($d->jobdesc);
                    if (array_search(isset($jobdescselect[$key]), $jobdescselect) !== FALSE) {
                      echo "<i class='fas fa-fw fa-check'></i>";
                    } else {
                      echo "-";
                    }
                    ?>
                  </td>
                <?php endforeach; ?>
                <td><?= $d->petugas ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </article>
    </section>
  <?php endif; ?>
  <script>
    // window.print();
  </script>
</body>

</html>