<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">

  <title>Mond | <?= $page_title ?></title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    #count_click {
      font-size: 2em;
      margin-bottom: 10px;
    }
  </style>
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
              <a href="<?= base_url('dashboard') ?>" class="nav-link <?php if ($page_title == 'Inicio')
                  echo 'active'; ?> ">
                <i class="nav-icon fa-solid fa-house"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('tareas') ?>" class="nav-link <?php if ($page_title == 'Tareas')
                  echo 'active'; ?> ">
                <i class="fa-solid fa-bars-progress nav-icon"></i>
                <p>Tareas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('temporizador') ?>" class="nav-link <?php if ($page_title == 'Temporizadores')
                  echo 'active'; ?> ">
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