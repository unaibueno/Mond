<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>

<style>
    .fc .fc-toolbar {
        background-color: red;
        color: #fff;
    }

    .fc-button {
        background-color: #4CAF50;
        border-color: #4CAF50;
        color: #fff;
    }

    .fc-button:hover {
        background-color: #45A049;
        border-color: #45A049;
    }

    .fc-daygrid-day {
        background-color: white;
        border: solid 1px #e9e9e9 !important;
    }

    .fc-daygrid-day:hover {
        background-color: #e0e0e0;
    }

    .fc .fc-daygrid-bg-harness {
        background-color: #e0e0e0 !important;
    }

    .fc-event {
        background-color: #222;
        border-color: #222;
        color: #222;
    }

    #calendar {
        height: 80vh;
    }

    /* Asegura que solo haya borde en las horas principales */
    .fc-timegrid-slot.fc-timegrid-slot-label {
        position: relative;
    }

    .fc-timegrid-slot.fc-timegrid-slot-label .fc-timegrid-slot-label-frame::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        width: 100vw;
        /* Usa el ancho de la ventana */
        border-top: 1px solid #ddd;
        z-index: 1;
    }

    /* Elimina el borde de los intervalos menores */
    .fc-timegrid-slot.fc-timegrid-slot-minor {
        border-top: none !important;
    }

    /* Eliminar cualquier margen o padding que limite el ancho */
    .fc-timegrid-slot.fc-timegrid-slot-label,
    .fc-timegrid-slot.fc-timegrid-slot-label .fc-timegrid-slot-label-frame::after {
        margin: 0;
        padding: 0;
    }


    /* Borde sólido en el centro de cada hora que ocupa todo el ancho del calendario */
    .fc-timegrid-slot.fc-timegrid-slot-label {
        position: relative;
    }

    .fc-timegrid-slot.fc-timegrid-slot-label .fc-timegrid-slot-label-frame::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        width: 100vw;
        border-top: 1px solid #ddd;
        z-index: 1;
    }

    /* Coloca las horas por encima de las líneas */
    .fc-timegrid-slot.fc-timegrid-slot-label .fc-timegrid-slot-label-cushion {
        position: relative;
        z-index: 2;
        background-color: #f2f2f2;
    }

    /* Elimina el borde de los intervalos menores */
    .fc-timegrid-slot.fc-timegrid-slot-minor {
        border-top: none !important;
    }

    /* Eliminar cualquier margen o padding que limite el ancho */
    .fc-timegrid-slot.fc-timegrid-slot-label,
    .fc-timegrid-slot.fc-timegrid-slot-label .fc-timegrid-slot-label-frame::after {
        margin: 0;
        padding: 0;
    }
</style>



<section class="content-order">
    <!-- Modal Structure -->
    <div id="taskModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h4>Completar Tarea</h4>
            <form id="taskForm">
                <div class="form-group">
                    <label for="taskTitle">Título de la Tarea:</label>
                    <input type="text" id="taskTitle" name="taskTitle" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-7 pomodoro-container fullscreen-style" id="pomodoroContainer">
            <div class="col-12"
                style="height:10vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <div class="section-container" style="display: flex; justify-content: center; gap: 10px;">
                    <button id="focus" class="btn btn-timer btn-focus">Pomodoro</button>
                    <button id="shortbreak" class="btn btn-shortbreak">Descanso corto</button>
                    <button id="longbreak" class="btn btn-longbreak">Descanso largo</button>
                </div>
            </div>
            <div class="col-12"
                style="height:60vh; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                <div class="time-btn-container" style="margin-top: 20px;">
                    <span id="time"></span>
                </div>
            </div>
            <div class="col-12 btn-pomodoro-container">
                <div class="btn-container">
                    <button id="btn-start" class="btn-pomodoro show">Iniciar</button>
                    <button id="btn-pause" class="btn-pomodoro hide">Pausar</button>
                    <button id="btn-reset" class="btn-pomodoro hide">
                        <i class="fa-solid fa-rotate-right"></i>
                    </button>
                    <button id="btn-fullscreen" class="btn-pomodoro">Pantalla completa</button>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-5 pomodoro-notas-contenedor">
            <div class="col-12">
                <div class="col-12 selector-dia" id="selector-dia">
                    <button id="prevDay" class="btn"><i class="fa-solid fa-angle-left"></i></button>
                    <span id="selectedDate" class="selected-date"></span>
                    <button id="nextDay" class="btn"><i class="fa-solid fa-angle-right"></i></button>
                </div>
            </div>
            <div class="col-12">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var today = new Date();
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            initialDate: today,
            initialView: 'timeGridDay',
            nowIndicator: true,
            headerToolbar: false,
            navLinks: true,
            editable: true,
            selectable: true,
            selectMirror: true,
            dayMaxEvents: true,
            allDaySlot: false,
            events: '<?= base_url('get-events') ?>',
            slotLabelFormat: {
                hour: '2-digit',
                minute: '2-digit',
                omitZeroMinute: false,
                meridiem: false,
                hour12: false
            },
            select: function (info) {
                var title = prompt('Event Title:');
                if (title) {
                    var eventData = {
                        title: title,
                        start: info.startStr,
                        end: info.endStr
                    };
                    calendar.addEvent(eventData);
                    saveEvent(eventData);
                }
                calendar.unselect();
            }
        });

        calendar.render();

        function saveEvent(event) {
            fetch('<?= base_url('save-event') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(event)
            }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Event saved successfully');
                    } else {
                        alert('Failed to save event');
                    }
                });
        }

        var prevDayButton = document.getElementById('prevDay');
        var nextDayButton = document.getElementById('nextDay');
        var selectedDateSpan = document.getElementById('selectedDate');

        function formatDateString(date) {
            var options = { day: 'numeric', month: 'long', year: 'numeric' };
            return date.toLocaleDateString('es-ES', options);
        }

        function updateSelectedDate(date) {
            selectedDateSpan.textContent = formatDateString(date);
        }

        prevDayButton.addEventListener('click', function () {
            calendar.prev();
            updateSelectedDate(calendar.getDate());
        });

        nextDayButton.addEventListener('click', function () {
            calendar.next();
            updateSelectedDate(calendar.getDate());
        });

        updateSelectedDate(calendar.getDate());

        // Pomodoro logic
        let focusButton = document.getElementById("focus");
        let buttons = document.querySelectorAll(".btn");
        let shortBreakButton = document.getElementById("shortbreak");
        let longBreakButton = document.getElementById("longbreak");
        let startBtn = document.getElementById("btn-start");
        let resetBtn = document.getElementById("btn-reset");
        let pauseBtn = document.getElementById("btn-pause");
        let time = document.getElementById("time");
        let fullscreenBtn = document.getElementById("btn-fullscreen");
        let pomodoroContainer = document.getElementById("pomodoroContainer");
        let taskModal = document.getElementById("taskModal");
        let taskForm = document.getElementById("taskForm");
        let sound = new Audio('assets/audio/crono.mp3'); // Reemplaza con la ruta a tu archivo de sonido
        let timerInterval;
        let isPaused = true;
        let remainingTime = { minutes: 25, seconds: 0 };

        const updateTimeDisplay = () => {
            time.textContent = `${String(remainingTime.minutes).padStart(2, '0')}:${String(remainingTime.seconds).padStart(2, '0')}`;
        };

        const startTimer = () => {
            if (isPaused) {
                isPaused = false;
                startBtn.classList.add("hide");
                pauseBtn.classList.remove("hide");
                resetBtn.classList.remove("hide");
                timerInterval = setInterval(() => {
                    if (remainingTime.seconds === 0) {
                        if (remainingTime.minutes === 0) {
                            clearInterval(timerInterval);
                            sound.play();
                            openTaskModal();
                        } else {
                            remainingTime.minutes--;
                            remainingTime.seconds = 59;
                        }
                    } else {
                        remainingTime.seconds--;
                    }
                    updateTimeDisplay();
                }, 1000);
            }
        };

        const pauseTimer = () => {
            isPaused = true;
            clearInterval(timerInterval);
            startBtn.classList.remove("hide");
            pauseBtn.classList.add("hide");
        };

        const resetTimer = () => {
            pauseTimer();
            remainingTime = { minutes: 25, seconds: 0 };
            updateTimeDisplay();
            resetBtn.classList.add("hide");
        };

        const openTaskModal = () => {
            taskModal.style.display = "block";
        };

        taskForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var taskTitle = document.getElementById('taskTitle').value;
            var taskStart = new Date().toISOString();
            calendar.addEvent({
                title: taskTitle,
                start: taskStart,
                allDay: true
            });
            taskModal.style.display = "none";
        });

        document.querySelector(".close").addEventListener('click', function () {
            taskModal.style.display = "none";
        });

        window.addEventListener('click', function (event) {
            if (event.target == taskModal) {
                taskModal.style.display = "none";
            }
        });

        focusButton.addEventListener("click", () => {
            resetTimer();
            remainingTime = { minutes: 25, seconds: 0 };
            updateTimeDisplay();
        });

        shortBreakButton.addEventListener("click", () => {
            resetTimer();
            remainingTime = { minutes: 5, seconds: 0 };
            updateTimeDisplay();
        });

        longBreakButton.addEventListener("click", () => {
            resetTimer();
            remainingTime = { minutes: 15, seconds: 0 };
            updateTimeDisplay();
        });

        startBtn.addEventListener('click', startTimer);
        pauseBtn.addEventListener('click', pauseTimer);
        resetBtn.addEventListener('click', resetTimer);

        fullscreenBtn.addEventListener('click', () => {
            if (!document.fullscreenElement) {
                pomodoroContainer.requestFullscreen().catch(err => {
                    console.error(`Error attempting to enable full-screen mode: ${err.message} (${err.name})`);
                });
            } else {
                document.exitFullscreen();
            }
        });

        document.addEventListener('fullscreenchange', () => {
            if (!document.fullscreenElement) {
                pomodoroContainer.classList.remove('fullscreen-active');
            }
        });

        updateTimeDisplay();
    });
</script>

<?= $this->endSection() ?>