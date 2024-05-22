<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>

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
            events: [],
            slotLabelFormat: {
                hour: '2-digit',
                minute: '2-digit',
                omitZeroMinute: false,
                meridiem: false,
                hour12: false
            }
        });

        calendar.render();

        var prevDayButton = document.getElementById('prevDay');
        var nextDayButton = document.getElementById('nextDay');
        var selectedDateSpan = document.getElementById('selectedDate');
        var weekdays = document.querySelectorAll('.weekday');

        function formatDateString(date) {
            var today = new Date();
            var yesterday = new Date(today);
            yesterday.setDate(today.getDate() - 1);
            var tomorrow = new Date(today);
            tomorrow.setDate(today.getDate() + 1);

            if (date.toDateString() === today.toDateString()) {
                return "hoy";
            } else if (date.toDateString() === yesterday.toDateString()) {
                return "ayer";
            } else if (date.toDateString() === tomorrow.toDateString()) {
                return "mañana";
            } else {
                var options = { weekday: 'short', day: 'numeric', month: 'long' };
                return date.toLocaleDateString('es-ES', options);
            }
        }

        function updateSelectedDate(date) {
            selectedDateSpan.textContent = formatDateString(date);
        }

        function setCalendarDate(dayOffset) {
            var currentDate = calendar.getDate();
            currentDate.setDate(currentDate.getDate() - currentDate.getDay() + dayOffset);
            calendar.gotoDate(currentDate);
            updateSelectedDate(currentDate);
        }

        prevDayButton.addEventListener('click', function () {
            calendar.prev();
            updateSelectedDate(calendar.getDate());
        });

        nextDayButton.addEventListener('click', function () {
            calendar.next();
            updateSelectedDate(calendar.getDate());
        });

        weekdays.forEach(function (weekday) {
            weekday.addEventListener('click', function () {
                weekdays.forEach(function (day) {
                    day.classList.remove('selected');
                });
                weekday.classList.add('selected');
                var dayOffset = parseInt(weekday.getAttribute('data-day'));
                setCalendarDate(dayOffset);
            });
        });

        updateSelectedDate(calendar.getDate());

        // Pomodoro logic
        let focusButton = document.getElementById("focus");
        let buttons = document.querySelectorAll(".btn");
        let shortBreakButton = document.getElementById("shortbreak");
        let longBreakButton = document.getElementById("longbreak");
        let startBtn = document.getElementById("btn-start");
        let reset = document.getElementById("btn-reset");
        let pause = document.getElementById("btn-pause");
        let time = document.getElementById("time");
        let fullscreenBtn = document.getElementById("btn-fullscreen");
        let pomodoroContainer = document.getElementById("pomodoroContainer");
        let taskModal = document.getElementById("taskModal");
        let taskForm = document.getElementById("taskForm");
        let sound = new Audio('assets/audio/crono.mp3'); // Reemplaza con la ruta a tu archivo de sonido
        let worker;
        let active = "focus";
        let count = 59;
        let paused = true;
        let minCount = 24;
        time.textContent = `${minCount + 1}:00`;

        const appendZero = (value) => {
            value = value < 10 ? `0${value}` : value;
            return value;
        };

        const resetTime = () => {
            pauseTimer();
            switch (active) {
                case "long":
                    minCount = 14;
                    break;
                case "short":
                    minCount = 4;
                    break;
                default:
                    minCount = 24;
                    break;
            }
            count = 59;
            time.textContent = `${minCount + 1}:00`;
        };

        const removeFocus = () => {
            buttons.forEach((btn) => {
                btn.classList.remove("btn-focus");
            });
        };

        const pauseTimer = () => {
            paused = true;
            if (worker) {
                worker.terminate();
                worker = null;
            }
            startBtn.classList.remove("hide");
            pause.classList.remove("show");
            reset.classList.remove("show");
        };

        const openTaskModal = () => {
            taskModal.style.display = "block";
        };

        const addPomodoroToCalendar = (title, start, end) => {
            calendar.addEvent({
                title: title,
                start: start,
                end: end
            });
        };

        focusButton.addEventListener("click", () => {
            removeFocus();
            focusButton.classList.add("btn-focus");
            pauseTimer();
            minCount = 24;
            count = 59;
            time.textContent = `${minCount + 1}:00`;
        });

        shortBreakButton.addEventListener("click", () => {
            active = "short";
            removeFocus();
            shortBreakButton.classList.add("btn-focus");
            pauseTimer();
            minCount = 4;
            count = 59;
            time.textContent = `${appendZero(minCount + 1)}:00`;
        });

        longBreakButton.addEventListener("click", () => {
            active = "long";
            removeFocus();
            longBreakButton.classList.add("btn-focus");
            pauseTimer();
            minCount = 14;
            count = 59;
            time.textContent = `${minCount + 1}:00`;
        });

        pause.addEventListener("click", pauseTimer);

        startBtn.addEventListener("click", () => {
            let pomodoroStart = new Date();
            reset.classList.add("show");
            pause.classList.add("show");
            startBtn.classList.add("hide");
            startBtn.classList.remove("show");

            if (paused) {
                paused = false;
                time.textContent = `${appendZero(minCount)}:${appendZero(count)}`;

                if (typeof (Worker) !== "undefined") {
                    if (typeof (worker) === "undefined") {
                        worker = new Worker("assets/js/pomodoro/pomodoro_worker.js");
                    }

                    worker.postMessage({
                        action: 'start',
                        minCount: minCount,
                        count: count
                    });

                    worker.onmessage = function (event) {
                        const data = event.data;
                        if (data.action === 'tick') {
                            minCount = data.minCount;
                            count = data.count;
                            time.textContent = `${appendZero(minCount)}:${appendZero(count)}`;
                        } else if (data.action === 'complete') {
                            clearInterval(set);
                            openTaskModal();
                            let pomodoroEnd = new Date();
                            addPomodoroToCalendar("Pomodoro", pomodoroStart, pomodoroEnd);
                            sound.play(); // Reproducir sonido al completar
                        }
                    };
                } else {
                    alert("Sorry! No Web Worker support.");
                }
            }
        });

        fullscreenBtn.addEventListener("click", () => {
            if (!document.fullscreenElement) {
                pomodoroContainer.requestFullscreen().then(() => {
                    pomodoroContainer.classList.add('fullscreen-active');
                }).catch((err) => {
                    console.log(`Error attempting to enable fullscreen mode: ${err.message} (${err.name})`);
                });
            } else {
                document.exitFullscreen().then(() => {
                    pomodoroContainer.classList.remove('fullscreen-active');
                });
            }
        });

        document.addEventListener('fullscreenchange', () => {
            if (!document.fullscreenElement) {
                pomodoroContainer.classList.remove('fullscreen-active');
            }
        });

        taskForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var taskTitle = document.getElementById('taskTitle').value;
            var taskStart = new Date().toISOString().split('T')[0];
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
    });
</script>

<?= $this->endSection() ?>