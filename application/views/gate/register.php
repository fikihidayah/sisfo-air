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
      <?= form_open('gate/register', ['class' => 'col-lg-6 col-md-8 col-10 mx-auto']) ?>


      <div class="mx-auto text-center my-4">
        <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="<?= base_url('gate/register') ?>">
          <img src="<?= ass_url('img/tritanadi.png') ?>" class="img-fluid w-75 mb-3" alt="logo">
        </a>
        <h2 class="my-3">Daftar</h2>
        <?php if (validation_errors()) : ?>
          <div class="alert alert-danger text-left">
            <ul>
              <?= validation_errors('<li>', '</li>') ?>
            </ul>
          </div>
        <?php endif ?>
        <div class="text-left">
          <?= $this->session->userdata('message') ?>
        </div>
      </div>
      <div class="form-group">
        <label for="email">Email<small class="text-danger">*</small></label>
        <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>">
      </div>
      <div class="form-group">
        <label for="fullname">Nama Lengkap<small class="text-danger">*</small></label>
        <input type="text" id="fullname" name="full_name" class="form-control" value="<?= set_value('full_name') ?>">
      </div>

      <hr class="my-4">

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="password">Password<small class="text-danger">*</small></label>
          <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group col-md-6">
          <label for="password2">Konfirmasi Password<small class="text-danger">*</small></label>
          <input type="password" class="form-control" id="password2" name="password2">
        </div>
      </div>

      <div class="custom-control custom-checkbox mb-3">
        <input type="checkbox" class="custom-control-input" name="is_cabang" id="ya" value="1">
        <label class="custom-control-label" for="ya">Mendaftar Sebagai Cabang</label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Daftar</button>
      <p class="mt-2">Sudah daftar? <a href="<?= base_url('gate/login') ?>">Login</a></p>
      <p class="mt-5 mb-3 text-muted text-center">© <?= date('Y') ?></p>
      <?= form_close() ?>
    </div>
  </div>
</body>

</html>