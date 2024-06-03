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
  <script src='assets/js/calendario/index.global.js'></script>
  <script src='assets/js/ckeditor.js'></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/general.css">
  <link rel="stylesheet" href="assets/css/styles.css">

  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="ajustes-modal">
      <div class="ajustes-contenedor">
        <div class="ajustes">
          <div class="ajustes-sidebar">
            <span class="conf-title">Configuración</span>
            <ul>
              <li ata-option="cuentas" onclick="showContent('cuentas')">
                <span>
                  <ion-icon name="person-outline"></ion-icon>
                  Cuenta
                </span>
              </li>
              <li data-option="integraciones" onclick="showContent('integraciones')">
                <span>
                  <ion-icon name="copy-outline"></ion-icon>
                  Integraciones
                </span>
              </li>
              <li data-option="social" onclick="showContent('social')">
                <span>
                  <ion-icon name="people-outline"></ion-icon> Social
                </span>
              </li>


              <li data-option="preferencias" onclick="showContent('preferencias')">
                <span>
                  <ion-icon name="moon-outline"></ion-icon>
                  Preferencias
                </span>
              </li>

              <li data-option="seguridad" onclick="showContent('seguridad')">
                <span>
                  <ion-icon name="lock-closed-outline"></ion-icon>
                  Seguridad
                </span>
              </li>


              <li data-option="privacidad" onclick="showContent('privacidad')">
                <span>
                  <ion-icon name="finger-print-outline"></ion-icon> Privacidad
                </span>
              </li>
              <form action="<?= site_url('auth/logout') ?>" method="get">
                <button type="submit">Salir</button>
              </form>
            </ul>

          </div>
          <div class="ajustes-panel">
            <div class="main-content" id="cuentas">
              <div class="seccion-ajuste">
                <h2 class="titulo-configuracion">Insercion</h2>
                <div class="secciones">s</div>

              </div>
            </div>
            <div class="main-content" id="integraciones">
              <div class="seccion-ajuste">
                <h2 class="titulo-configuracion">Cuentas</h2>
                <!-- Your contents -->
              </div>
            </div>
            <div class="main-content" id="social">
              <div class="seccion-ajuste">
                <h2 class="titulo-configuracion">Control errores</h2>
                <!-- Your contents -->
              </div>
            </div>
            <div class="main-content" id="seguridad">
              <div class="seccion-ajuste">
                <h2 class="titulo-configuracion">Herramientas</h2>
                <!-- Your contents -->
              </div>
            </div>
            <div class="main-content" id="preferencias">
              <div class="seccion-ajuste">
                <h2 class="titulo-configuracion">Seguridad</h2>
                <!-- Your contents -->
              </div>
            </div>
            <div class="main-content" id="privacidad">
              <div class="seccion-ajuste">
                <h2 class="titulo-configuracion">Seguridad</h2>
                <!-- Your contents -->
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>


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
                <i class="nav-icon fa-solid fa-house"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('tareas') ?>" class="nav-link <?php if ($page_title == 'Tareas')
                  echo 'active'; ?> ">
                <ion-icon name="chevron-down-circle"></ion-icon>
                <p>Tareas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('temporizador') ?>" class="nav-link <?php if ($page_title == 'Temporizadores')
                  echo 'active'; ?> ">
                <ion-icon name="stopwatch"></ion-icon>
                <p>Temporizador</p>
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
              <a id="ajustes" class="nav-link">
                <ion-icon name="hammer"></ion-icon>
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>