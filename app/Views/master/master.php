<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mond | <?= $page_title ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.css">
  <link rel="stylesheet" href="assets/css/styles.css">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">

  <style>
    body {
      font-family: 'sf-regular', sans-serif;
      background-color: #1c1c1c;
      margin-right: 27px;
      z-index: 9999999;
    }

    .left-section {
      background-color: #f8f9fa;
      padding: 20px;
      flex-grow: 1;
    }

    .right-section {
      padding: 20px;
      flex-grow: 1;
    }

    .content_header {
      background: white;
    }

    .main-sidebar {
      background-color: #1c1c1c;
      padding-top: 25px;

    }

    .brand-link {
      padding-bottom: 25px;

    }

    .nav-sidebar .nav-item>.nav-link {
      position: relative;
      margin-bottom: 15px;
      font-family: 'swiss', sans-serif;
    }

    .main-sidebar .nav-item p {
      color: #868b8f;
      font-weight: 600;
      padding-left: 10px;
    }

    .main-sidebar .nav-item i {
      color: #868b8f;
    }

    [class*=sidebar-dark] .brand-link {
      border-bottom: 0px;
    }

    .main-header {
      background-color: #fbfbfb;
      border: 0px;
    }


    [class*=sidebar-dark-] .nav-sidebar>.nav-item>.nav-link.active {
      box-shadow: none;

    }

    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
    .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
      background: #efefef;
      border-radius: 10px;
      color: #2d2f32;

    }

    .main-sidebar .nav-sidebar>.nav-item>.nav-link.active i,
    .main-sidebar .nav-sidebar>.nav-item>.nav-link.active p {
      color: #2d2f32;

    }

    .container .card {
      background-color: white;
      box-shadow: none
    }

    .card {
      border-radius: 15px;
    }

    .preloader {
      background: #1c1c1c;
    }

    .user-image {
      margin-top: -95px;
      margin-left: -45px;
      float: left;
      width: 135px;
    }





    /* TODO */

    .option-input {
      -webkit-appearance: none;
      -moz-appearance: none;
      -ms-appearance: none;
      -o-appearance: none;
      appearance: none;
      position: relative;
      top: 10.3px;
      right: 0;
      bottom: 0;
      left: 0;
      height: 30px;
      width: 30px;
      background: #fce9eb;
      border: 2px solid #e06c6e;
      color: #fff;
      cursor: pointer;
      display: inline-block;
      margin-right: 0.5rem;
      outline: none;
      position: relative;
      z-index: 1000;
    }


    .option-input:checked {
      background: #dc7274;
    }

    .option-input:checked::before {
      height: 26px;
      width: 26px;
      position: absolute;
      content: "\f058";
      font-family: "Font Awesome 5 Free";
      display: inline-block;
      font-size: 16.7px;
      text-align: center;
      line-height: 27px;
    }

    .option-input:checked::after {
      -webkit-animation: click-wave 0.25s;
      -moz-animation: click-wave 0.25s;
      background: red;
      content: '';
      display: block;
      position: relative;
      z-index: 100;
    }

    .option-input.radio {
      border-radius: 50%;
    }

    .option-input.radio::after {
      border-radius: 50%;
    }

    .completed {
      color: gray;
      text-decoration: line-through;
    }

    .line-text {
      width: 100%;
      text-align: center;
      border-bottom: 1px solid #eee;
      line-height: 0.1em;
      margin: 10px 0 20px;
    }

    .line-text span {
      background: #fff;
      padding: 0 10px;
      color: #212529;
    }

    .tareas-dashboard {
      overflow: auto;

    }

    .content-wrapper {
      background: white;
      height: 90vh;
      margin: 30px;
      margin-right: 0;
      border-radius: 30px;
      padding: 20px;

    }

    .main-sidebar {
      background: #1c1c1c;
    }

    .brand-link {
      background: #1c1c1c;
    }

    .nav-pills {
      padding: 15px;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
      background: white;
      border-radius: 20px;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <aside class="main-sidebar">
      <a href="/">
        <img src="assets/img/logo-white.png" alt="AdminLTE Logo" width="200px" class="brand-image "
          style="padding:30px;">
      </a>
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item ">
              <a href="<?= base_url('dashboard') ?>" class=" nav-link">
                <i class="nav-icon fa-solid fa-house"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('tareas') ?>" class="nav-link active">
                <i class="fa-solid fa-bars-progress nav-icon"></i>
                <p>Tareas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('temporizador') ?>" class="nav-link">
                <i class="fa-solid fa-clock nav-icon"></i>
                <p>Temporizador</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('analiticas') ?>" class="nav-link">
                <i class="fa-solid fa-chart-pie nav-icon"></i>
                <p>Analíticas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('notas') ?>" class="nav-link">
                <i class="fa-solid fa-bolt nav-icon"></i>
                <p>Notas rápidas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('proyectos') ?>" class="nav-link">
                <i class="fa-solid fa-diagram-project nav-icon"></i>
                <p>Proyectos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('equipos') ?>" class="nav-link">
                <i class="fa-solid fa-calendar-check nav-icon"></i>
                <p>Equipos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= site_url('ajustes') ?>" class="nav-link">
                <i class="fa-solid fa-gear nav-icon"></i>
                <p>Ajustes</p>

              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper">
      <?= $this->renderSection('content'); ?>
    </div>

  </div>

  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/plugins/chart.js/Chart.min.js"></script>
  <script src="assets/plugins/sparklines/sparkline.js"></script>
  <script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
  <script src="assets/plugins/moment/moment.min.js"></script>
  <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
  <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="assets/js/adminlte.js"></script>
  <script src="assets/js/demo.js"></script>
  <script src="assets/js/pages/dashboard.js"></script>
  <script src="assets/js/dashboard.js"></script>

</body>

</html>