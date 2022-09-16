<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="favicon.ico">
  <title><?= $title ?></title>
  <!-- Simple bar CSS -->
  <link rel="stylesheet" href="css/simplebar.css">
  <!-- Fonts CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Icons CSS -->
  <link rel="stylesheet" href="<?= admin_url('') ?>css/feather.css">
  <!-- Date Range Picker CSS -->
  <link rel="stylesheet" href="<?= admin_url('') ?>css/daterangepicker.css">
  <!-- App CSS -->
  <link rel="stylesheet" href="<?= admin_url('') ?>css/app-light.css" id="lightTheme">
  <link rel="stylesheet" href="<?= admin_url('') ?>css/app-dark.css" id="darkTheme" disabled>
  <style>
    .row {
      margin-left: 0 !important;
      margin-right: 0 !important;
    }
  </style>

</head>

<body class="light ">
  <div class="wrapper vh-100">
    <div class="row align-items-center h-100">
      <?= form_open("gate/login", ['class' => 'col-lg-3 col-md-4 col-10 mx-auto text-center']); ?>
      <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="#">
        <img src="<?= ass_url('img/tritanadi.png') ?>" class="img-fluid w-75 mb-3" alt="logo">
      </a>
      <h1 class="h4 mb-3">Masuk</h1>
      <div class="text-left">
        <?= $this->session->userdata('message') ?>
        <?php if ($this->session->flashdata('success')) : ?>
          <div class="alert alert-success alert-dismissable fade show">
            <?= $this->session->userdata('success') ?>
            <button class="close" type="button" data-dismiss="alert">x</button>
          </div>
        <?php endif ?>
      </div>
      <div class="form-group">
        <label for="identity">Email</label>
        <input type="text" id="identity" name="identity" class="form-control form-control-lg <?= red('identity') ?>" value="<?= set_value('identity') ?>">
        <?= form_error('identity') ?>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control form-control-lg <?= red('password') ?>">
        <?= form_error('password') ?>
      </div>

      <button type="submit" class="btn-lg btn-primary btn-block">Masuk</button>
      <p class="mt-2">Belum daftar? <a href="<?= base_url('gate/register') ?>">Daftar</a></p>
      <p class="mt-5 mb-3 text-muted">© <?= date('Y') ?></p>
      <?= form_close(); ?>
    </div>
  </div>
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/moment.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/simplebar.min.js"></script>
  <script src='js/daterangepicker.js'></script>
  <script src='js/jquery.stickOnScroll.js'></script>
  <script src="js/tinycolor-min.js"></script>
  <script src="js/config.js"></script>
  <script src="js/apps.js"></script>
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