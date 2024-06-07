<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>

<style>
  /* Incluye tus estilos aquí */
  .content-wrapper {
    background-color: #f2f2f2;
  }

  .flex-container {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: normal;
    align-items: normal;
    align-content: normal;
    height: 92vh;
    padding: 15px;
    gap: 10px;
  }

  .flex-items:nth-child(1) {
    display: block;
    flex-grow: 2.4;
    flex-shrink: 0;
    flex-basis: auto;
    align-self: auto;
    order: 0;
  }

  .flex-items:nth-child(2) {
    display: block;
    flex-grow: 1;
    flex-shrink: 1;
    flex-basis: auto;
    align-self: auto;
    order: 0;
    background-color: #fff;
    border-radius: 20px;
    padding: 10px;
  }

  .dashboard-row {
    height: 49%;
    border-radius: 20px;
    display: flex;
    gap: 10px;
  }

  .today-tasks {
    background-color: #fff;
    border-radius: 20px;
    flex: 1.3;
    padding: 10px;
    overflow: auto;
  }

  .v {
    overflow: auto;
  }

  .dashboard-calendar {
    border-radius: 20px;
    background-color: #fff;
    flex: 1;
    padding: 10px;
  }

  .progreso-tasks {
    border-radius: 20px;
    background-color: #fff;
    flex: 1.3;
    padding: 10px;
  }

  .titulo {
    border-radius: 15px;
    color: #fff;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: stretch;
    padding: 6px;
    min-width: 300px;
    animation-duration: 0.5s;
    animation-fill-mode: both;
  }

  .titulo-icono {
    background-color: #f2f2f2;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 30px;
    color: #222;
    width: 45px;
  }

  .titulo-icono i {
    font-size: 18px;
  }

  .titulo-texto {
    flex-grow: 10;
    padding: 7px 15px;
    font-family: 'sf-bold';
    letter-spacing: 0.4px;
  }

  .boton-titulo {
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 30px;
    padding: 5px;
    color: #222;
    width: auto;
    height: 35px;
    border: solid 2px #f2f2f2;
  }

  .boton-titulo-opciones {
    display: flex;
    color: #222;
    align-items: center;
    justify-content: center;
    border-radius: 30px;
    padding: 5px;
    background-color: #f2f2f2;
    width: 45px;
    height: 45px;
    border: solid 2px #f2f2f2;
  }

  .boton-titulo span {
    margin-right: 5px;
    padding: 0 10px;
  }

  .boton-titulo i {
    margin-left: 3px;
  }

  .titulo-texto h3 {
    font-size: 20px;
    margin: 0;
    font-weight: bold;
    color: #333;
  }

  .titulo-texto span {
    font-size: 18px;
  }

  .tarea-contenedor {
    padding: 10px;
  }

  .contenedor-scroll {
    overflow: auto;
  }

  .notas-contenedor ul {
    padding: 10px;
    overflow: auto;
    list-style: none;
  }

  .notas li {
    background-color: #f2f2f2;
    margin-bottom: 10px;
    border-radius: 15px;
    padding: 7px 20px;
    color: #222;
  }

  .notas a {
    color: #222;
  }

  .tarea {
    background-color: #f2f2f2;
    margin-bottom: 10px;
    border-radius: 15px;
    padding: 7px 20px;
  }
</style>

<section>
  <div class="flex-container">
    <div class="flex-items">
      <div class="dashboard-row">
        <div class="today-tasks">
          <div class="titulo">
            <div class="titulo-icono">
              <i class="fa-solid fa-list-check"></i>
            </div>
            <div class="titulo-texto">
              <h3>Tareas de hoy</h3>
            </div>
            <div class="boton-titulo">
              <span>Ver todas
                <i class="fa-solid fa-chevron-right"></i>
              </span>
            </div>
          </div>
          <div class="tarea-contenedor" id="taskContainer">
            <!-- Tareas se cargarán aquí -->
          </div>
        </div>
        <div class="dashboard-calendar">
          <div class="titulo">
            <div class="titulo-icono">
              <i class="fa-solid fa-calendar-days"></i>
            </div>
            <div class="titulo-texto">
              <h3>Calendario</h3>
            </div>
            <div class="boton-titulo-opciones">
              <i class="fa-solid fa-ellipsis"></i>
            </div>
          </div>
          <div id="minicalendarioderecha" class="minicalendario"></div>
        </div>
      </div>
      <div class="dashboard-row mt-3">
        <div class="progreso-tasks">
          <div class="titulo">
            <div class="titulo-icono">
              <i class="fa-solid fa-chart-simple"></i>
            </div>
            <div class="titulo-texto">
              <h3>Progreso</h3>
            </div>
            <div class="boton-titulo-opciones">
              <i class="fa-solid fa-ellipsis"></i>
            </div>
          </div>
        </div>
        <div class="today-tasks">
          <div class="titulo">
            <div class="titulo-icono">
              <i class="fa-regular fa-note-sticky"></i>
            </div>
            <div class="titulo-texto">
              <h3>Notas </h3>
            </div>
            <div class="boton-titulo-opciones">
              <i class="fa-solid fa-ellipsis"></i>
            </div>
          </div>
          <div class="lista-notas">
            <div class="contenedor-scroll">
              <div class="notas-contenedor">
                <div class="notas">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="flex-items">
      <div class="titulo">
        <div class="titulo-icono">
          <i class="fa-regular fa-comments"></i>
        </div>
        <div class="titulo-texto">
          <h3>Chats</h3>
        </div>
        <div class="boton-titulo">
          <span>Ver todos
            <i class="fa-solid fa-chevron-right"></i>
          </span>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  // Función para cargar tareas desde el servidor
  function loadTasks() {
    fetch('<?= base_url('tasks') ?>')
      .then(response => response.json())
      .then(data => {
        const taskContainer = document.getElementById('taskContainer');
        taskContainer.innerHTML = '';
        data.tasks.forEach(task => {
          const taskElement = document.createElement('div');
          taskElement.classList.add('tarea');
          taskElement.textContent = task.nombre_tarea;
          taskContainer.appendChild(taskElement);
        });
      })
      .catch(error => console.error('Error al cargar tareas:', error));
  }

  // Función para cargar notas desde el servidor
  function loadNotes() {
    fetch('<?= base_url('notes') ?>')
      .then(response => response.json())
      .then(data => {
        const noteContainer = document.querySelector('div.notas');
        noteContainer.innerHTML = '';
        const noteList = document.createElement('ul');
        data.notes.forEach(note => {
          const noteElement = document.createElement('li');
          const noteLink = document.createElement('a');
          noteLink.href = '#';
          noteLink.textContent = note.titulo_nota;
          noteLink.onclick = () => showNoteDetails(note);
          noteElement.appendChild(noteLink);
          noteList.appendChild(noteElement);
        });
        noteContainer.appendChild(noteList);
      })
      .catch(error => console.error('Error al cargar notas:', error));
  }

  document.addEventListener('DOMContentLoaded', function () {
    loadTasks();
    loadNotes();
  });
</script>

<?= $this->endSection() ?>