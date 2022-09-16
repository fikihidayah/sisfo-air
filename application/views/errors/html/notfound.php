<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="favicon.ico">
  <title>404</title>

  <!-- Fonts CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Icons CSS -->

  <!-- App CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/tinydash/light/') ?>css/app-light.css" id="lightTheme">
  <link rel="stylesheet" href="<?= base_url('assets/tinydash/light/') ?>css/app-dark.css" id="darkTheme" disabled>
</head>

<body class="light ">
  <div class="wrapper vh-100">
    <div class="align-items-center h-100 d-flex w-50 mx-auto">
      <div class="mx-auto text-center">
        <h1 class="display-1 m-0 font-weight-bolder text-muted" style="font-size:80px;">404</h1>
        <h1 class="mb-1 text-muted font-weight-bold">OOPS!</h1>
        <h6 class="mb-3 text-muted"><?= $message ?? 'Halaman Tidak ditemukan' ?></h6>
        <?php if (!isset($back)) {
          $back = '';
        } ?>
        <a class="btn btn-primary btn-lg" href="<?= base_url($back) ?>">Kembali</a>
      </div>
    </div>
  </div>
  <script src="<?= base_url('assets/tinydash/light/') ?>js/jquery.min.js"></script>
  <script src="<?= base_url('assets/tinydash/light/') ?>js/popper.min.js"></script>
  <script src="<?= base_url('assets/tinydash/light/') ?>js/moment.min.js"></script>
  <script src="<?= base_url('assets/tinydash/light/') ?>js/bootstrap.min.js"></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
  </script>
</body>

</html>
</body>

</html>