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

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.css">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Ajustes Modal -->
    <div id="ajustesModal" class="modal">
      <div class="modal-content">
        <div class="row">
          <div class="col-3">
            <div class="nav flex-column nav-pills me-3 modal-sidebar" id="v-pills-tab" role="tablist"
              aria-orientation="vertical">
              <span class="ajustes-title">Configuración</span>
              <button class="nav-link " id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"
                type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i
                  class="fa-regular fa-circle-user mr-2"></i>Cuenta</button>
              <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile"
                type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                <i class="fa-solid fa-fingerprint mr-2"></i>Tus datos</button>
              <button class="nav-link " id="v-pills-messages-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages"
                aria-selected="false"><i class="fa-solid fa-paint-roller mr-2"></i>Colores</button>
              <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings"
                aria-selected="false"><i class="fa-solid fa-sliders mr-2"></i>Preferencias</button>
            </div>
          </div>
          <div class="col-9 ajustes-content">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
              ..f
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">.ss
            </div>
            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
              sss
            </div>
            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
              dd </div>

          </div>
        </div>
      </div>
    </div>



    <!-- Incluye los scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>


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
              <a href="<?= base_url('calendario') ?>" class="nav-link">
                <i class="fa-regular fa-sun nav-icon"></i>
                <p>Calendario</p>
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
              <a id="ajustes" class="nav-link">
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

  <script>
    $(document).ready(function () {
      // Get the modal
      var modal = document.getElementById("ajustesModal");

      // Get the button that opens the modal
      var btn = document.getElementById("ajustes");

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // When the user clicks the button, open the modal 
      btn.onclick = function () {
        modal.style.display = "block";
      }

      // When the user clicks on <span> (x), close the modal
      span.onclick = function () {
        modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function (event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }

      // Handle section switching
      $('.modal-sidebar ul li').click(function () {
        var sectionToShow = $(this).data('section');
        $('.section').removeClass('active');
        $('#' + sectionToShow).addClass('active');
      });
    });
  </script>

</body>

</html>