<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">

  <title>Mond | <?= $page_title ?></title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>

  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <script src='assets/js/calendario/index.global.js'></script>
  <script src='assets/js/ckeditor.js'></script>

  <script src="https://cdn.jsdelivr.net/npm/progressbar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/general.css">
  <link rel="stylesheet" href="assets/css/styles.css">

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <aside class="main-sidebar">
      <a href="/">
        <img src="assets/img/logo-white.png" alt="AdminLTE Logo" width="200px" class="brand-image"
          style="padding:30px;">
      </a>
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="<?= base_url('dashboard') ?>" class="nav-link <?php if ($page_title == 'Inicio')
                  echo 'active'; ?> ">
                <ion-icon name="copy-outline"></ion-icon>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('tareas') ?>" class="nav-link <?php if ($page_title == 'Tareas')
                  echo 'active'; ?> ">
                <ion-icon name="layers-outline"></ion-icon>
                <p>Tareas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('pomodoro') ?>" class="nav-link <?php if ($page_title == 'Pomodoro')
                  echo 'active'; ?> ">
                <ion-icon name="timer-outline"></ion-icon>
                <p>Pomodoro</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('calendario') ?>" class="nav-link <?php if ($page_title == 'Calendario')
                  echo 'active'; ?> ">
                <ion-icon name="calendar-number"></ion-icon>
                <p>Calendario</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('notas') ?>" class="nav-link <?php if ($page_title == 'Notas')
                  echo 'active'; ?> ">
                <ion-icon name="file-tray-stacked-outline"></ion-icon>
                <p>Notas</p>
              </a>
            </li>
            <li class="nav-item">
              <a id="ajustes" href="<?= site_url('auth/logout') ?>" class="nav-link">
                <ion-icon name="log-out-outline"></ion-icon>
                <p>Salir</p>
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

  <script>
    function showContent(option) {
      const sections = document.querySelectorAll(".main-content");
      const sidebarItems = document.querySelectorAll(".ajustes-sidebar li");

      sections.forEach((section) => {
        section.style.display = "none";
      });

      sidebarItems.forEach((item) => {
        item.classList.remove("active");
      });

      document.getElementById(option).style.display = "block";
      document.querySelector('.ajustes-sidebar li[data-option="' + option + '"]').classList.add("active");
    }

    $(document).ready(function () {
      $("#ajustes").on("click", function (e) {
        e.stopPropagation();
        $(".ajustes-modal").addClass("visible");
      });

      $(document).on("click", function (e) {
        if (!$(e.target).closest('.ajustes-modal, #ajustes').length) {
          $(".ajustes-modal").removeClass("visible");
        }
      });

      $(".ajustes-modal").on("click", function (e) {
        e.stopPropagation();
      });

      // Initialize first tab
      showContent('insercion');
    });

  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>