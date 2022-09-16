<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/page/') ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/page/') ?>/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/page/') ?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/page/') ?>/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url('assets/page/') ?>/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/page/') ?>/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/page/') ?>/vendor/aos/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('assets/material/plugins/font-awesome/') ?>css/font-awesome.min.css">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/page/') ?>/css/style.css" rel="stylesheet">
  <script src="<?= base_url('assets/page/') ?>vendor/jquery/jquery.min.js"></script>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="<?= base_url('home') ?>"><img src="<?= base_url('assets/img/logo-dark.jpeg') ?>" alt="logo"></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      <?php
      $url = $this->uri->segment(1);
      ?>
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="<?= $url == 'home' ? 'active' : '' ?>"><a href="<?= base_url('home') ?>">Home</a></li>
          <li class="<?= $url == 'tentang' ? 'active' : '' ?>"><a href="<?= base_url('tentang') ?>">Tentang</a></li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
  <script>
    function ajaxcsrf() {
      var csrfname = '<?= $this->security->get_csrf_token_name() ?>';
      var csrfhash = '<?= $this->security->get_csrf_hash() ?>';
      var csrf = {};
      csrf[csrfname] = csrfhash;
      $.ajaxSetup({
        "data": csrf
      });
    }

    let base_url = '<?= base_url() ?>';

    $('#dd').click((e) => e.preventDefault());
  </script>