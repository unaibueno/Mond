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
    <div class="ajustes-modal ">
      <div class="ajustes-contenedor">
        <div class="ajustes">
          <div class="ajustes-sidebar">
            <span class="conf-title">Configuración</span>
            <ul>
              <li data-option="cuentas" onclick="showContent('cuentas')">
                <span>
                  <ion-icon name="person-outline"></ion-icon>
                  Mi cuenta
                </span>
              </li>
              <li>
                <a href="<?= site_url('auth/logout') ?>">
                  <span>
                    <ion-icon name="log-out-outline"></ion-icon> Cerrar sesión
                  </span>
                </a>
              </li>
            </ul>
          </div>
          <div class="ajustes-panel">
            <div class="main-content" id="cuentas">
              <div class="seccion-ajuste">
                <div class="contenedor-ajustes-usuario">
                  <div class="col-12">
                    <h2 class="titulo-interior-configuracion">Perfil</h2>
                  </div>
                  <div class="d-flex align-items-start py-3 seccion-imagen-usuario">
                    <img
                      src="https://www.shutterstock.com/image-vector/blank-avatar-photo-place-holder-600nw-1095249842.jpg"
                      class="img-usuario" alt="">
                    <div class="pl-sm-4 pl-2" id="img-section">
                      <label for="firstname">Nombre</label>
                      <input type="text" id="nombre" class="form-control" placeholder="Unai Bueno">
                    </div>
                  </div>

                  <div class="py-3">
                    <div class="col-12">
                      <h2 class="titulo-interior-configuracion">Seguridad</h2>
                    </div>
                    <div class="row py-2">
                      <div class="col-md-7">
                        <div class="opcion-ajuste-titulo">Correo electrónico</div>
                        <div class="opcion-ajuste-descripcion" id="correo-electronico">unaibueno@gmail.com</div>
                      </div>
                      <div class="col-md-5 pt-md-0 pt-3 d-flex justify-content-end">
                        <button type="text" class="btn-ajuste" id="cambiar-correo">Cambiar correo electronico</button>
                      </div>
                    </div>
                    <div class="row py-2">
                      <div class="col-md-7">
                        <div class="opcion-ajuste-titulo">Contraseña</div>
                        <div class="opcion-ajuste-descripcion">Esta opción cambiará tu contraseña</div>
                      </div>
                      <div class="col-md-5 pt-md-0 pt-3 d-flex justify-content-end">
                        <button type="text" class="btn-ajuste" id="cambiar-contrasena">Cambiar contraseña</button>
                      </div>
                    </div>
                  </div>

                  <div class="py-3">
                    <div class="col-12">
                      <h2 class="titulo-interior-configuracion">Acciones</h2>
                    </div>
                    <div class="row py-2">
                      <div class="col-md-7">
                        <div class="opcion-ajuste-titulo text-eliminar-cuenta">Eliminar mi cuenta</div>
                        <div class="opcion-ajuste-descripcion">¡Cuidado! Esta accion es irreversible</div>
                      </div>
                      <div class="col-md-5 pt-md-0 pt-3 d-flex justify-content-end">
                        <button type="text" class="btn-ajuste" id="eliminar-cuenta">Eliminar mi cuenta</button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="modalCorreo" tabindex="-1" aria-labelledby="modalCorreoLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCorreoLabel">Cambiar correo electrónico</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="email" id="nuevo-correo" class="form-control" placeholder="Nuevo correo electrónico">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-modal" id="guardar-correo">Guardar cambios</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalContrasena" tabindex="-1" aria-labelledby="modalContrasenaLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalContrasenaLabel">Cambiar contraseña</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                class="fa-solid fa-xmark"></i></button>
          </div>
          <div class="modal-body">
            <input type="password" id="nueva-contrasena" class="form-control mt-2" placeholder="Contraseña actual">
            <input type="password" id="nueva-contrasena" class="form-control mt-2" placeholder="Nueva contraseña">
            <input type="password" id="nueva-contrasena" class="form-control mt-2" placeholder="Confirmar contraseña">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-modal" id="guardar-contrasena">Cambiar contraseña</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalEliminarCuenta" tabindex="-1" aria-labelledby="modalEliminarCuentaLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEliminarCuentaLabel">Eliminar cuenta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn-modal" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn-modal" id="confirmar-eliminar-cuenta">Eliminar cuenta</button>
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
              <a id="ajustes" class="nav-link">
                <ion-icon name="settings-outline"></ion-icon>
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
    function showContent(option = 'cuentas') {
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

      // Initialize with 'cuentas' as the default option
      showContent('cuentas');

      // Modal event handlers
      $('#cambiar-correo').on('click', function () {
        $('#modalCorreo').modal('show');
      });

      $('#cambiar-contrasena').on('click', function () {
        $('#modalContrasena').modal('show');
      });

      $('#eliminar-cuenta').on('click', function () {
        $('#modalEliminarCuenta').modal('show');
      });

      $('#guardar-correo').on('click', function () {
        const nuevoCorreo = $('#nuevo-correo').val();
        // Add AJAX request to update email here
        alert('Correo actualizado a: ' + nuevoCorreo);
        $('#modalCorreo').modal('hide');
      });

      $('#guardar-contrasena').on('click', function () {
        const nuevaContrasena = $('#nueva-contrasena').val();
        // Add AJAX request to update password here
        alert('Contraseña actualizada.');
        $('#modalContrasena').modal('hide');
      });

      $('#confirmar-eliminar-cuenta').on('click', function () {
        // Add AJAX request to delete account here
        alert('Cuenta eliminada.');
        $('#modalEliminarCuenta').modal('hide');
      });

      // Cargar datos del usuario
      $.ajax({
        url: '<?= base_url('user') ?>',
        method: 'GET',
        success: function (data) {
          $('#nombre').val(data.nombre);
          $('#correo-electronico').text(data.email);
        }
      });

      // Guardar cambios
      $('#guardar-cambios').on('click', function () {
        const nombre = $('#nombre').val();
        const email = $('#correo-electronico').text();

        $.ajax({
          url: '<?= base_url('users/updateUser') ?>',
          method: 'POST',
          data: {
            nombre: nombre,
            email: email
          },
          success: function (data) {
            if (data.success) {
              alert('Datos actualizados exitosamente.');
            } else {
              alert('Error al actualizar los datos.');
            }
          }
        });
      });
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