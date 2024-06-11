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

  .dashboard-row-1 {
    height: 52%;
    border-radius: 20px;
    display: flex;
    gap: 10px;
  }

  .dashboard-row-2 {
    height: 46%;
    border-radius: 20px;
    display: flex;
    gap: 10px;
  }

  .today-tasks {
    background-color: #fff;
    border-radius: 20px;
    flex: 1.3;
    padding: 10px;
  }

  .today-tasks .tarea-contenedor {
    padding: 10px;
    overflow-y: auto;
    max-height: 190px;
    /* Ajusta este valor según sea necesario */
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
    flex: 1;
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
    width: 38px;
    height: 38px;

  }

  .titulo-icono ion-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    transform: translate(25%, -12%);
    font-size: 19px;
  }

  .titulo-icono i {
    font-size: 16px;
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
    overflow-y: auto;
    max-height: 400px;
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

  .tarea-contenedor {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    height: 100%;
  }

  .tarea {
    flex: 1 1 calc(50% - 10px);
    background-color: #f2f2f2;
    margin-bottom: 10px;
    border-radius: 25px;
    padding: 15px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .tarea strong {
    font-size: 16px;
    color: #333;
  }

  .tarea .descripcion {
    font-size: 14px;
    color: #777;
    margin: 10px 0;
  }

  .tarea .estado {
    font-size: 12px;
    color: #999;
  }

  .tarea .progress {
    display: flex;
    align-items: center;
    margin-top: 10px;
    background-color: transparent;
  }

  .tarea .progress-bar {
    flex: 1;
    height: 14px;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    position: relative;
  }

  .tarea .progress-bar span {
    display: block;
    height: 100%;
    border-radius: 8px;
    background-color: #11af85;
  }

  .tarea .progress-text {
    font-size: 12px;
    color: #777;
    margin-left: 10px;
  }

  a,
  a:hover {
    color: #222;
  }

  /* Ajusta la altura de las filas */
  .fc-daygrid-day {
    height: 35px;
    /* Ajusta el valor según sea necesario */
  }

  /* Ajusta la altura del calendario */
  .fc-direction-ltr {
    height: 82%;
  }

  /* Centra los números en las celdas y los redondea */
  .fc-daygrid-day-frame {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
  }

  .fc-daygrid-day-number {
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    /* Ajusta el valor según sea necesario */
    height: 32px;
    /* Asegúrate de que el alto sea igual al ancho para hacer un círculo perfecto */
    border-radius: 50%;
    /* Hace que el contenedor sea redondeado */
    background-color: #f0f0f0;
    /* Color de fondo, ajusta según tu preferencia */
    text-align: center;
    /* Centra el texto horizontalmente */
    font-size: 12px;
    /* Tamaño de la fuente ajustado */
    line-height: 24px;
    /* Alineación vertical del texto */
  }

  .fc-day-other .fc-daygrid-day-number {
    background-image: linear-gradient(135deg, #d1d1d1 25%, transparent 25%, transparent 50%, #d1d1d1 50%, #d1d1d1 75%, transparent 75%, transparent);
    background-size: 10px 10px;
    background-color: transparent;
    color: transparent;
  }

  .fc-day-other .fc-daygrid-day-number:hover {
    background-image: linear-gradient(135deg, #d1d1d1 25%, transparent 25%, transparent 50%, #d1d1d1 50%, #d1d1d1 75%, transparent 75%, transparent);
    background-size: 10px 10px;
    background-color: transparent;
    color: transparent;
  }

  .fc-day-today {
    background-color: transparent !important;
  }

  .fc-day-today .fc-daygrid-day-number {
    background-color: #ff5f43 !important;
    color: white;
  }

  .fc-has-events .fc-daygrid-day-number {
    background-color: #11af85 !important;
    color: white !important;
  }

  /* Ocultar eventos */
  .fc-event {
    display: none !important;
  }

  /* Añade padding inferior a los encabezados de los días de la semana */
  .fc-col-header {
    margin-bottom: 10px;
    /* Ajusta el valor según sea necesario */
  }

  /* Estilos para personalizar el <select> */
  .boton-titulo-opciones select {
    background-color: transparent;
    border: solid 1px #f2f2f2;
    border-radius: 20px;
    padding: 5px 0 5px 10px;
    font-size: 14px;
    color: #222;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
  }

  .boton-titulo-opciones select:focus {
    outline: none;
  }

  .boton-titulo-opciones select::-ms-expand {
    display: none;
  }

  .boton-titulo-opciones {
    position: relative;
  }

  .boton-titulo-opciones::after {
    content: '';
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-40%);
    pointer-events: none;
    color: #222;
  }

  .boton-titulo-opciones ion-icon {
    position: absolute;
    top: 46%;
    right: 0px;
    transform: translateY(-50%);
    pointer-events: none;
    color: #222;
    font-size: 14px;
  }

  .numero-tareas-totales {
    background-color: #222;
    height: 50px;
    color: #fff;
    border-radius: 40px;
    display: flex;
    align-items: center;
    justify-content: left;
    padding: 0 20px;
  }

  .numero-tareas-totales svg {
    margin-right: 10px;
    height: 20px;
    width: 20px;
    color: white;
  }

  /* Estilos para los estados de las tareas */
  .tarea-estado-0 {
    color: #ff5f43 !important;
    padding: 6px;
    width: 53%;
    border-radius: 15px;
    /* Color para estado 0: pendiente */
  }

  .tarea-estado-1 {
    color: #8c6b4c !important;
    background-color: #fff4ea;
    width: 53%;
    /* Color para estado 1: en proceso */
  }

  .tarea-estado-2 {
    color: #a35c5b !important;
    background-color: #fef1f1;
    width: 53%;
    /* Color para estado 2: en revisión */
  }

  .tarea-estado-3 {
    padding: 0px 10px;
    border-radius: 15px;
    color: #63a782 !important;
    background-color: #eff9f4;
    width: 53%;
  }


  .pomodoro-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: #fff;
    border-radius: 15px;
    padding: 20px;
    position: relative;
    margin: 0 auto;
    height: 90%;
  }

  .flex-items {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .pomodoro-timer {
    font-size: 32px;
    font-weight: bold;
    text-align: center;
    margin-top: 20px;
    font-family: 'graphik-bold';
  }

  .pomodoro-time-range {
    font-size: 16px;
    color: #888;
    margin-top: 10px;
  }

  .pomodoro-buttons {
    display: flex;
    gap: 10px;
    margin-top: 20px;
  }

  .pomodoro-button {
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    background-color: #f2f2f2;
    color: #fff;
    cursor: pointer;
    font-size: 16px;
    color: #222;

  }

  .pomodoro-button:hover {
    background-color: #222;
    color: #fff;
  }

  /* Media Queries para Responsiveness */
  @media (max-width: 1200px) {
    .flex-container {
      flex-direction: column;
      height: auto;
    }

    .content-wrapper {
      overflow: auto;

    }

    .flex-items {
      width: 100%;
      margin-bottom: 20px;
    }

    .dashboard-row-1,
    .dashboard-row-2 {
      flex-direction: column;
      height: auto;
    }

    .dashboard-row-1>div,
    .dashboard-row-2>div {
      flex: 1;
      margin-bottom: 10px;
    }

    .tarea {
      flex: 1 1 100%;
    }
  }

  @media (max-width: 768px) {
    .titulo-texto h3 {
      font-size: 16px;
    }

    .content-wrapper {
      overflow: auto;

    }

    .titulo-texto span {
      font-size: 14px;
    }

    .boton-titulo span {
      font-size: 12px;
    }

    .pomodoro-timer {
      font-size: 24px;
    }

    .pomodoro-button {
      font-size: 14px;
    }
  }
</style>

<section>
  <div class="flex-container">
    <div class="flex-items">
      <div class="dashboard-row-1">
        <div class="today-tasks">
          <div class="titulo">
            <div class="titulo-icono">
              <ion-icon name="analytics-outline"></ion-icon>
            </div>
            <div class="titulo-texto">
              <h3>Tareas de hoy</h3>
            </div>
            <div class="boton-titulo">
              <span>
                <a href="<?= base_url('tareas') ?>">
                  <span>Ver todas</span>
                </a>
                <i class="fa-solid fa-chevron-right"></i>
              </span>
            </div>
          </div>
          <div class="tarea-contenedor" id="taskContainer" style="height: calc(100% - 50px);">
            <!-- Tareas se cargarán aquí -->
          </div>
          <div class="numero-tareas-totales">
          </div>
        </div>

        <div class="dashboard-calendar">
          <div class="titulo">
            <div class="titulo-icono">
              <ion-icon name="calendar-outline"></ion-icon>
            </div>
            <div class="titulo-texto">
              <h3>Calendario</h3>
            </div>
            <!-- Incluye la biblioteca Ionicons -->
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

            <div class="boton-titulo-opciones">
              <select id="monthSelector">
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
              </select>
              <ion-icon name="chevron-down-outline"></ion-icon>
            </div>

          </div>
          <div id="minicalendarioderecha" class="minicalendario"></div>
        </div>
      </div>
      <div class="dashboard-row-2 mt-3">
        <div class="progreso-tasks">
          <div class="titulo">
            <div class="titulo-icono">
              <ion-icon name="flash-outline"></ion-icon>
            </div>
            <div class="titulo-texto">
              <h3>Progreso</h3>
            </div>
            <div class="boton-titulo-opciones">
              <i class="fa-solid fa-ellipsis"></i>
            </div>
          </div>

          <canvas id="taskProgressChart" width="300" height="180" style="padding:30px;"></canvas>
        </div>

        <div class="today-tasks">
          <div class="titulo">
            <div class="titulo-icono">
              <ion-icon name="documents-outline"></ion-icon>
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
          <ion-icon name="hourglass-outline"></ion-icon>
        </div>
        <div class="titulo-texto">
          <h3>Pomodoro</h3>
        </div>
        <div class="boton-titulo">
          <span>
            <a href="<?= base_url('pomodoro') ?>">
              <span>Ver pomodoro</span>
            </a>
            <i class="fa-solid fa-chevron-right"></i>
          </span>
        </div>
      </div>
      <div class="pomodoro-container">
        <div id="pomodoro-progress" style="width: 200px; height: 200px;"></div>
        <div class="pomodoro-buttons">
          <button class="pomodoro-button" id="pomodoro-start">Iniciar</button>
          <button class="pomodoro-button" id="pomodoro-pause">Pausar</button>
          <button class="pomodoro-button" id="pomodoro-reset">Reiniciar</button>
        </div>
        <div class="pomodoro-time-range" id="pomodoro-time-range">0:00 → 25:00</div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/progressbar.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

  <script>document.addEventListener('DOMContentLoaded', function () {
      // Función para cargar tareas desde el servidor
      function loadTasks() {
        fetch('<?= base_url('tasks') ?>')
          .then(response => response.json())
          .then(data => {
            const taskContainer = document.getElementById('taskContainer');
            taskContainer.innerHTML = '';
            const tasksToShow = data.tasks.slice(0, 2); // Mostrar solo las dos primeras tareas
            const nonType3Tasks = data.tasks.filter(task => task.estado !== '3'); // Filtrar tareas que no sean de tipo 3

            tasksToShow.forEach(task => {
              const taskElement = document.createElement('div');
              taskElement.classList.add('tarea');
              const progress = Math.floor(Math.random() * 100); // Ejemplo de progreso aleatorio

              // Mapear el estado a texto
              let estadoTexto;
              switch (task.estado) {
                case '0':
                  estadoTexto = 'Pendiente';
                  break;
                case '1':
                  estadoTexto = 'En Proceso';
                  break;
                case '2':
                  estadoTexto = 'En Revisión';
                  break;
                case '3':
                  estadoTexto = 'Completado';
                  break;
                default:
                  estadoTexto = 'Desconocido';
              }

              taskElement.innerHTML = `
          <strong>${task.nombre_tarea}</strong>
          <div class="descripcion">${task.descripcion_tarea}</div>
          <div class="estado tarea-estado-${task.estado}">${estadoTexto}</div>
          <div class="progress">
            <div class="progress-bar">
              <span style="width: ${progress}%;"></span>
            </div>
            <div class="progress-text">${progress}%</div>
          </div>
        `;
              taskContainer.appendChild(taskElement);
            });

            // Mostrar el número total de tareas que no sean de tipo 3
            const totalTasksElement = document.querySelector('.numero-tareas-totales');
            totalTasksElement.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
          <path d="M10,23c0,.552-.447,1-1,1H5c-2.757,0-5-2.243-5-5V7C0,4.955,1.237,3.198,3,2.424V1c0-.552,.447-1,1-1s1,.448,1,1v1h2V1c0-.552,.447-1,1-1s1,.448,1,1v1h2V1c0-.552,.447-1,1-1s1,.448,1,1v1h2V1c0-.552,.447-1,1-1s1,.448,1,1v1.424c1.763,.774,3,2.531,3,4.576,0,.552-.447,1-1,1s-1-.448-1-1c0-1.654-1.346-3-3-3H5c-1.654,0-3,1.346-3,3v12c0,1.654,1.346,3,3,3h4c.553,0,1,.448,1,1Zm5-15c0-.552-.447-1-1-1H6c-.553,0-1,.448-1,1s.447,1,1,1H14c.553,0,1-.448,1-1Zm9,9c0,3.86-3.141,7-7,7s-7-3.14-7-7,3.141-7,7-7,7,3.14,7,7Zm-2,0c0-2.757-2.243-5-5-5s-5,2.243-5,5,2.243,5,5,5,5-2.243,5-5ZM6,11c-.553,0-1,.448-1,1s.447,1,1,1h2.5c.553,0,1-.448,1-1s-.447-1-1-1h-2.5Zm12.808,4.758l-2.223,2.134c-.144,.14-.379,.143-.522,0l-1.131-1.108c-.396-.385-1.028-.38-1.414,.015-.387,.395-.381,1.027,.014,1.414l1.131,1.108c.46,.45,1.062,.674,1.664,.674s1.2-.224,1.653-.671l2.213-2.124c.398-.383,.411-1.016,.029-1.414s-1.017-.412-1.414-.029Z"/>
        </svg>
        Tienes ${nonType3Tasks.length} tareas sin completar. Animo!
      `;
          })
          .catch(error => console.error('Error al cargar tareas:', error));
      }

      function loadNotes() {
        fetch('<?= base_url('notes') ?>')
          .then(response => response.json())
          .then(data => {
            const noteContainer = document.querySelector('div.notas');
            noteContainer.innerHTML = '';
            const noteList = document.createElement('ul');

            // Selecciona las últimas cuatro notas y las invierte
            const lastFourNotes = data.notes.slice(-4).reverse();

            lastFourNotes.forEach(note => {
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

        // Inicialización del calendario y otras funciones...
      });

      // Inicialización del calendario
      var calendarEl = document.getElementById('minicalendarioderecha');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        firstDay: 1,
        headerToolbar: false, // Quita el encabezado
        dayHeaderContent: function (args) {
          const shortDayNames = {
            'dom': 'D',
            'lun': 'L',
            'mar': 'M',
            'mié': 'X',
            'jue': 'J',
            'vie': 'V',
            'sáb': 'S'
          };
          return shortDayNames[args.text.toLowerCase()];
        },
        events: function (fetchInfo, successCallback, failureCallback) {
          fetch('<?= base_url('get-events') ?>')
            .then(response => response.json())
            .then(events => {
              events.forEach(event => {
                let eventStart = new Date(event.start);
                let eventEnd = new Date(event.end || event.start);
                let currentDate = new Date(eventStart);

                while (currentDate <= eventEnd) {
                  let eventDayEl = document.querySelector(`[data-date='${currentDate.toISOString().split('T')[0]}']`);
                  if (eventDayEl && !eventDayEl.classList.contains('fc-day-other')) {
                    eventDayEl.classList.add('fc-has-events');
                  }
                  currentDate.setDate(currentDate.getDate() + 1);
                }
              });
              successCallback(events);
            })
            .catch(error => {
              console.error('Error cargando eventos:', error);
              failureCallback(error);
            });
        }
      });

      calendar.render();

      var monthSelector = document.getElementById('monthSelector');
      monthSelector.addEventListener('change', function () {
        var selectedMonth = this.value;
        var date = new Date(calendar.getDate());
        date.setMonth(selectedMonth - 1); // Los meses en JavaScript son de 0 a 11
        calendar.gotoDate(date);
      });

      loadTasks();
      loadNotes();

      // Función para crear el patrón diagonal
      function createDiagonalPattern(ctx) {
        const canvas = document.createElement('canvas');
        canvas.width = 40;  // Ancho del patrón
        canvas.height = 40; // Altura del patrón
        const context = canvas.getContext('2d');

        context.fillStyle = '#f1f1f1';
        context.fillRect(0, 0, 40, 40); // Fondo del patrón

        context.lineWidth = 6; // Ancho de las líneas

        // Dibuja las líneas diagonales grises
        context.strokeStyle = '#ccc';
        context.beginPath();
        context.moveTo(0, 20);
        context.lineTo(20, 0);
        context.stroke();
        context.beginPath();
        context.moveTo(0, 40);
        context.lineTo(40, 0);
        context.stroke();
        context.beginPath();
        context.moveTo(20, 40);
        context.lineTo(40, 20);
        context.stroke();

        // Dibuja las líneas diagonales blancas
        context.strokeStyle = '#fff';
        context.beginPath();
        context.moveTo(10, 40);
        context.lineTo(40, 10);
        context.stroke();
        context.beginPath();
        context.moveTo(0, 30);
        context.lineTo(30, 0);
        context.stroke();
        context.beginPath();
        context.moveTo(30, 40);
        context.lineTo(40, 30);
        context.stroke();

        return ctx.createPattern(canvas, 'repeat');
      }

      fetch('<?= base_url('tareas/progreso') ?>')
        .then(response => response.json())
        .then(data => {
          const ctx = document.getElementById('taskProgressChart').getContext('2d');
          const gradientPattern = createDiagonalPattern(ctx);

          new Chart(ctx, {
            type: 'bar',
            data: {
              labels: ['En Progreso', 'Revisadas', 'Completadas', 'En Revisión'],
              datasets: [{
                label: 'Número de Tareas',
                data: [data.en_progreso, data.revisadas, data.completadas, data.en_revision],
                backgroundColor: gradientPattern,
                borderWidth: 2, // Establecer el grosor del borde
                borderRadius: 35, // Borde redondeado
              }]
            },
            options: {
              responsive: true,
              plugins: {
                legend: {
                  display: false, // Ocultar leyenda
                },
                title: {
                  display: false,
                },
                tooltip: {
                  enabled: false
                },
                datalabels: {
                  label: 'Número de Tareas',
                  data: [data.en_progreso, data.revisadas, data.completadas, data.en_revision],
                  backgroundColor: function (context) {
                    let value = context.dataIndex;
                    switch (value) {
                      case 0:
                        return '#f2f2f2'; // Fondo gris para valores 0
                      case 1:
                        return '#fff4ea'; // Fondo para valores 1
                      case 2:
                        return '#fef1f1'; // Fondo para valores 2
                      case 3:
                        return '#eff9f4'; // Fondo rojo para valores 3
                      default:
                        return '#000'; // Fondo negro para otros valores
                    }
                  },
                  borderRadius: 13,
                  borderColor: '#999', // Color del borde
                  borderWidth: 1, // Grosor del borde
                  padding: 7,
                  color: '#222', // Texto blanco
                  font: {
                    size: 17
                  },
                  formatter: function (value) {
                    return value + ' tareas'; // Formato del texto de los datalabels
                  },

                }
              },
              scales: {
                x: {
                  grid: {
                    display: false // Ocultar líneas de la cuadrícula en el eje X
                  },
                  ticks: {
                    display: false // Ocultar números en el eje X
                  }
                },
                y: {
                  beginAtZero: true,
                  grid: {
                    display: false // Ocultar líneas de la cuadrícula en el eje Y
                  },
                  ticks: {
                    display: false // Ocultar números en el eje Y
                  }
                }
              }
            },
            plugins: [ChartDataLabels] // Asegúrate de incluir el plugin aquí
          });
        })
        .catch(error => console.error('Error al cargar datos de progreso de tareas:', error));
    });

  </script>

  <script>
    const startButton = document.getElementById('pomodoro-start');
    const pauseButton = document.getElementById('pomodoro-pause');
    const resetButton = document.getElementById('pomodoro-reset');
    const timeRangeDisplay = document.getElementById('pomodoro-time-range');

    const POMODORO_TIME = 1500; // 25 minutes in seconds
    const SHORT_BREAK_TIME = 300; // 5 minutes in seconds
    const LONG_BREAK_TIME = 900; // 15 minutes in seconds

    let timeLeft = POMODORO_TIME;
    let isPaused = true;
    let timerInterval;
    let sessionCount = 0;
    let currentMode = 'pomodoro';

    const bar = new ProgressBar.Circle('#pomodoro-progress', {
      strokeWidth: 6,
      easing: 'easeInOut',
      duration: 1500 * 1000,
      color: '#FF6347',
      trailColor: '#eee',
      trailWidth: 6,
      svgStyle: null,
      text: {
        value: formatTime(timeLeft),
        style: {
          color: '#333',
          position: 'absolute',
          left: '50%',
          top: '50%',
          padding: 0,
          margin: 0,
          transform: {
            prefix: true,
            value: 'translate(-50%, -50%)'
          },
          fontSize: '32px',
          fontFamily: 'graphik-bold'
        }
      },
      step: (state, bar) => {
        bar.setText(formatTime(timeLeft));
      },
      // Adding rounded corners to the progress bar
      svgStyle: {
        strokeLinecap: 'round'
      }
    });

    function formatTime(seconds) {
      const minutes = String(Math.floor(seconds / 60)).padStart(2, '0');
      const remainingSeconds = String(seconds % 60).padStart(2, '0');
      return `${minutes}:${remainingSeconds}`;
    }

    function updateTimerDisplay() {
      bar.set(1 - (timeLeft / POMODORO_TIME));
      bar.setText(formatTime(timeLeft));
    }

    function updateRangeDisplay() {
      const startTime = new Date();
      const startHours = String(startTime.getHours()).padStart(2, '0');
      const startMinutes = String(startTime.getMinutes()).padStart(2, '0');
      const endTime = getEndTime(timeLeft);
      timeRangeDisplay.textContent = `${startHours}:${startMinutes} → ${endTime}`;
    }

    function getEndTime(seconds) {
      const now = new Date();
      const endTime = new Date(now.getTime() + seconds * 1000);
      const endHours = String(endTime.getHours()).padStart(2, '0');
      const endMinutes = String(endTime.getMinutes()).padStart(2, '0');
      return `${endHours}:${endMinutes}`;
    }

    function startTimer() {
      if (isPaused) {
        isPaused = false;
        timerInterval = setInterval(() => {
          if (timeLeft > 0) {
            timeLeft--;
            updateTimerDisplay();
          } else {
            clearInterval(timerInterval);
            switchMode();
          }
        }, 1000);
        bar.animate(1, { duration: timeLeft * 1000 });
      }
    }

    function pauseTimer() {
      isPaused = true;
      clearInterval(timerInterval);
      bar.stop();
    }

    function resetTimer() {
      isPaused = true;
      clearInterval(timerInterval);
      timeLeft = POMODORO_TIME;
      currentMode = 'pomodoro';
      updateTimerDisplay();
      updateRangeDisplay();
      bar.set(0);
    }

    function switchMode() {
      if (currentMode === 'pomodoro') {
        sessionCount++;
        if (sessionCount % 4 === 0) {
          timeLeft = LONG_BREAK_TIME;
          currentMode = 'longBreak';
        } else {
          timeLeft = SHORT_BREAK_TIME;
          currentMode = 'shortBreak';
        }
      } else {
        timeLeft = POMODORO_TIME;
        currentMode = 'pomodoro';
      }
      updateRangeDisplay();
      startTimer();
    }

    startButton.addEventListener('click', startTimer);
    pauseButton.addEventListener('click', pauseTimer);
    resetButton.addEventListener('click', resetTimer);

    updateTimerDisplay();
    updateRangeDisplay();

  </script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
  <script src="assets/js/pomodoro/worker.js"></script>
  <script src="assets/js/pomodoro/sw.js"></script>
  <?= $this->endSection() ?>