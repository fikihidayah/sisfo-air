<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Aplikasi Monitoring Shipping">
  <meta name="author" content="SF">
  <link rel="icon" href="favicon.ico">
  <title><?= $title ?></title>
  <!-- Simple bar CSS -->
  <link rel="stylesheet" href="<?= admin_url('') ?>css/simplebar.css">
  <!-- Fonts CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Icons CSS -->
  <link rel="stylesheet" href="<?= admin_url('') ?>css/feather.css">
  <!-- Date Range Picker CSS -->
  <link rel="stylesheet" href="<?= admin_url('') ?>css/daterangepicker.css">
  <link rel="stylesheet" href="<?= admin_url('') ?>css/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?= admin_url('') ?>css/select2-bootstrap4.css">
  <!-- App CSS -->
  <link rel="stylesheet" href="<?= admin_url('') ?>css/app-light.css" id="lightTheme">
  <link rel="stylesheet" href="<?= admin_url('') ?>css/app-dark.css" id="darkTheme" disabled>
  <link href="<?= admin_url('vendor/noty/') ?>lib/noty.css" rel="stylesheet">
  <link href="<?= admin_url('vendor/noty/') ?>demo/animate.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= ass_url('plugins/summernote/summernote.min.css') ?>">
  <link rel="stylesheet" href="<?= ass_url('plugins/summernote/summernote-bs4.min.css') ?>">
  <link rel="apple-touch-icon" sizes="180x180" href="<?= ass_url('favicon') ?>/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= ass_url('favicon') ?>/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= ass_url('favicon') ?>/favicon-16x16.png">
  <link rel="manifest" href="<?= ass_url('favicon') ?>/site.webmanifest">
  <link rel="mask-icon" href="<?= ass_url('favicon') ?>/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">


  <style>
    .row {
      margin-left: 0;
      margin-right: 0;
    }

    .dataTables_length label {
      margin-bottom: 0 !important;
    }

    .fe.act {
      font-size: 10px;
    }

    .noty_buttons {
      text-align: center;
    }

    .spinner-border {
      width: 1rem;
      height: 1rem;
    }

    .btn-wrapper {
      display: flex;
      justify-content: space-between;
    }

    .btn-wrapper button {
      margin: 0 5px;
    }

    .btn-wrapper button:last-child {
      margin-right: 0;
    }

    .daterangepicker select.monthselect,
    .daterangepicker select.yearselect {
      border: 1px solid #ccc;
      background-color: #fff !important;
      padding: 3px 7px;
    }

    .daterangepicker select.monthselect:focus,
    .daterangepicker select.yearselect:focus {
      border: 1px solid var(--primary);
      box-shadow: 0 0 7px 3px rgb(71, 181, 255, 0.5);
    }
  </style>
  <script src="<?= admin_url('') ?>js/jquery.min.js"></script>
  <!-- jquery validation -->
  <script type="text/javascript" src="<?= ass_url('plugins/jquery-validation/') ?>/dist/jquery.validate.js"></script>
  <script src="<?= ass_url('plugins/jquery-validation/') ?>/dist/additional-methods.js"></script>
  <script type="text/javascript" src="<?= ass_url('plugins/jquery-validation/') ?>/dist/localization/messages_id.js"></script>
  <!-- noty js -->
  <script src="<?= admin_url('vendor/noty/') ?>lib/noty.js" type="text/javascript"></script>

  <script>
    var base_url = "<?= base_url() ?>";

    // default jquery validate
    $.validator.setDefaults({
      errorElement: "div",
      errorClass: "invalid",
      errorPlacement: function(error, element) {
        // Add the `invalid-feedback` class to the error element
        error.addClass("invalid-feedback");
        if (element.prop("type") === "checkbox") {
          error.insertAfter(element.next("label"));
        } else if (element.parent().attr('class') == 'input-group') {
          error.insertAfter(element.parent());
        } else if (element.attr('class') == 'form-control select2 select2-hidden-accessible is-invalid') {
          error.insertAfter($('.select2-container'));
        } else {
          error.insertAfter(element);
        }
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass("is-invalid").removeClass("is-valid");
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).addClass("is-valid").removeClass("is-invalid");
      }
    });

    Noty.overrideDefaults({
      layout: 'bottomRight',
      theme: 'mint',
      timeout: 4000,
      progressBar: true,
      closeWith: ['button'],
      animation: {
        open: 'animated zoomInLeft',
        close: 'animated zoomOutRight'
      }
    });
  </script>
</head>

<body class="vertical  light  ">
  <div class="wrapper">