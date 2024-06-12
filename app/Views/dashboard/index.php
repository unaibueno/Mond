<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="assets/css/dashboard.css">
<section>
  <div class="flex-container">
    <div class="flex-items">
      <div class="dashboard-row-1">

        <div class="today-tasks">
          <div class="titulo">
            <div class="titulo-icono">
              <ion-icon name="copy-outline"></ion-icon>
            </div>
            <div class="titulo-texto">
              <h3>Tareas </h3>
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
              <h3>Cronometro</h3>
            </div>
            <div class="boton-titulo-opciones">
              <i class="fa-solid fa-ellipsis"></i>
            </div>
          </div>
          <div class="contenedor-cronometro">
            <div class="contenedor-reloj">
              <div class="reloj" id="Horas">00</div>
              <div class="reloj" id="Minutos">:00</div>
              <div class="reloj" id="Segundos">:00</div>
              <div class="reloj" id="Centesimas">:00</div>
            </div>

            <div class="crono-buttons">
              <button class="crono-button" id="inicio" value="Start &#9658;" onclick="inicio();">
                <i class="fa-solid fa-hourglass-start"></i>
              </button>
              <button class="crono-button" id="parar" value="Stop &#8718;" onclick="parar();" disabled><i
                  class="fa-solid fa-pause"></i></button>
              <button class="crono-button" id="continuar" value="Resume &#8634;" onclick="inicio();" disabled> <i
                  class="fa-solid fa-play"></i>
              </button>
              <button class="crono-button" id="reinicio" value="Reset &#8635;" onclick="reinicio();" disabled><i
                  class="fa-solid fa-rotate-right"></i></button>
            </div>
          </div>
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
  <script>document.addEventListener('DOMContentLoaded', function () {
      // Obtener la fecha actual
      var currentDate = new Date();
      var currentMonth = currentDate.getMonth() + 1;
      document.getElementById("monthSelector").value = currentMonth;

      // Función para cargar tareas desde el servidor
      function loadTasks() {
        fetch('<?= base_url('tasks') ?>')
          .then(response => response.json())
          .then(data => {
            const taskContainer = document.getElementById('taskContainer');
            taskContainer.innerHTML = '';
            const tasksToShow = data.tasks.slice(0, 10); // Mostrar solo las dos primeras tareas
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
        `;
              taskContainer.appendChild(taskElement);
            });
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
  <script>
    var centesimas = 0;
    var segundos = 0;
    var minutos = 0;
    var horas = 0;
    function inicio() {
      control = setInterval(cronometro, 10);
      document.getElementById("inicio").disabled = true;
      document.getElementById("parar").disabled = false;
      document.getElementById("continuar").disabled = true;
      document.getElementById("reinicio").disabled = false;
    }
    function parar() {
      clearInterval(control);
      document.getElementById("parar").disabled = true;
      document.getElementById("continuar").disabled = false;
    }
    function reinicio() {
      clearInterval(control);
      centesimas = 0;
      segundos = 0;
      minutos = 0;
      horas = 0;
      Centesimas.innerHTML = ":00";
      Segundos.innerHTML = ":00";
      Minutos.innerHTML = ":00";
      Horas.innerHTML = "00";
      document.getElementById("inicio").disabled = false;
      document.getElementById("parar").disabled = true;
      document.getElementById("continuar").disabled = true;
      document.getElementById("reinicio").disabled = true;
    }
    function cronometro() {
      if (centesimas < 99) {
        centesimas++;
        if (centesimas < 10) { centesimas = "0" + centesimas }
        Centesimas.innerHTML = ":" + centesimas;
      }
      if (centesimas == 99) {
        centesimas = -1;
      }
      if (centesimas == 0) {
        segundos++;
        if (segundos < 10) { segundos = "0" + segundos }
        Segundos.innerHTML = ":" + segundos;
      }
      if (segundos == 59) {
        segundos = -1;
      }
      if ((centesimas == 0) && (segundos == 0)) {
        minutos++;
        if (minutos < 10) { minutos = "0" + minutos }
        Minutos.innerHTML = ":" + minutos;
      }
      if (minutos == 59) {
        minutos = -1;
      }
      if ((centesimas == 0) && (segundos == 0) && (minutos == 0)) {
        horas++;
        if (horas < 10) { horas = "0" + horas }
        Horas.innerHTML = horas;
      }
    }

  </script>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
  <script src="assets/js/pomodoro/worker.js"></script>
  <script src="assets/js/pomodoro/sw.js"></script>
  <?= $this->endSection() ?>