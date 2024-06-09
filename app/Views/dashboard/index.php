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
</style>

<section>
  <div class="flex-container">
    <div class="flex-items">
      <div class="dashboard-row-1">
        <div class="today-tasks">
          <div class="titulo">
            <div class="titulo-icono">
              <i class="fa-solid fa-list-check"></i>
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
          <div class="tarea-contenedor" id="taskContainer">
            <!-- Tareas se cargarán aquí -->
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
              <i class="fa-solid fa-chart-simple"></i>
            </div>
            <div class="titulo-texto">
              <h3>Progreso</h3>
            </div>
            <div class="boton-titulo-opciones">
              <i class="fa-solid fa-ellipsis"></i>
            </div>
          </div>
          <canvas id="taskProgressChart" width="400" height="200" style="padding:30px;"></canvas>
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

<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
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

    // Lógica para el selector de mes
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
      canvas.width = 20;
      canvas.height = 20;
      const context = canvas.getContext('2d');

      context.fillStyle = '#f1f1f1';
      context.fillRect(0, 0, 20, 20);

      context.strokeStyle = '#fff';
      context.lineWidth = 2;
      context.beginPath();
      context.moveTo(0, 20);
      context.lineTo(20, 0);
      context.stroke();
      context.beginPath();
      context.moveTo(0, 10);
      context.lineTo(10, 0);
      context.stroke();
      context.beginPath();
      context.moveTo(10, 20);
      context.lineTo(20, 10);
      context.stroke();

      return ctx.createPattern(canvas, 'repeat');
    }

    // Cargar datos de progreso de tareas y renderizar el gráfico
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
                display: false, // Ocultar título
              },
              tooltip: {
                enabled: false // Deshabilitar tooltips
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

<?= $this->endSection() ?>