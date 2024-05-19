<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>
<style>
    .timeline {
        border-radius: 25px;
        height: 73vh;
        padding: 20px;
        background: #fff;
        overflow-y: scroll;
        position: relative;
        user-select: none;
        border: 2px solid #ecebeb;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
        padding-top: 60px;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 5% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
        /* Could be more or less, depending on screen size */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .timeline::before {
        display: none;
    }

    .selection-time {
        position: absolute;
        left: 10px;
        top: -25px;
        background: #000;
        color: #fff;
        padding: 2px 5px;
        border-radius: 3px;
        font-size: 12px;
        display: none;
        /* Initially hidden */
    }

    .timeline::-webkit-scrollbar {
        width: 6px;
    }

    .timeline::-webkit-scrollbar-track {
        background: transparent;
        margin: 30px 0;

    }

    .timeline::-webkit-scrollbar-thumb {
        background: transparent;
        margin: 30px 0;

    }

    .timeline::-webkit-scrollbar-thumb:hover {
        background: transparent;
        margin: 30px 0;
    }

    .time-slot {
        height: 10px;
        /* Adjusted for better visualization */
        position: relative;
        user-select: none;
    }

    .time-slot[data-hour="true"] {
        border-bottom: 1px solid #eee;
    }

    .time-label {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 14px;
        color: #666;
    }

    .task {
        position: absolute;
        left: 80px;
        right: 10px;
        background-color: #fff0de;
        border-left: 4px solid #222222;
        border-radius: 3px;
        font-size: 14px;
        padding: 5px;
        box-sizing: border-box;
        user-select: none;
    }

    .current-time {
        position: absolute;
        left: 70px;
        height: 2px;
        background-color: red;
        z-index: 10;
    }

    .current-time::before {
        content: '';
        position: absolute;
        left: -6px;
        top: -4px;
        width: 10px;
        height: 10px;
        background-color: red;
        border-radius: 50%;
    }
</style>
<section class="content-order">
    <!-- Modal Structure -->
    <div id="taskModal" class="modal">
        <div class="modal-content">
            <h4>Nueva Tarea</h4>
            <form id="taskForm">
                <div class="form-group">
                    <label for="taskTitle">Título:</label>
                    <input type="text" id="taskTitle" name="taskTitle" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="taskDescription">Descripción:</label>
                    <textarea id="taskDescription" name="taskDescription" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="taskTimeRange">Hora:</label>
                    <input type="text" id="taskTimeRange" name="taskTimeRange" class="form-control" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 pomodoro-container fullscreen-style" id="pomodoroContainer">
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

        <div class="col-12 col-md-6 pomodoro-notas-contenedor">
            <div class="col-12 selector-dia">
                <div></div>
            </div>
            <div class="col-12">
                <div class="timeline" id="timeline">
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const timeline = document.getElementById("timeline");
        const slotsPerHour = 4; // 4 slots per hour, each 15 minutes
        const slotHeight = 25; // Height in pixels
        updateCurrentTime();

        for (let i = 0; i < 24 * slotsPerHour; i++) {
            const timeSlot = document.createElement("div");
            timeSlot.classList.add("time-slot");
            timeSlot.dataset.time = i;

            const hours = Math.floor(i / slotsPerHour);
            const minutes = (i % slotsPerHour) * 15; // 15 minute intervals
            if (minutes === 0) {
                timeSlot.dataset.hour = "true";
                const timeLabel = document.createElement("div");
                timeLabel.classList.add("time-label");
                timeLabel.textContent = `${String(hours).padStart(2, "0")}:00`;
                timeSlot.appendChild(timeLabel);
            }

            timeline.appendChild(timeSlot);
        }

        let isSelecting = false;
        let startSlot = null;
        let taskElement = null;
        let selectionTimeElement = null;

        const taskModal = document.getElementById("taskModal");
        const taskForm = document.getElementById("taskForm");
        const taskTimeRangeInput = document.getElementById("taskTimeRange");

        timeline.addEventListener("mousedown", (e) => {
            if (e.target.classList.contains("time-slot")) {
                isSelecting = true;
                startSlot = parseInt(e.target.dataset.time);

                taskElement = document.createElement("div");
                taskElement.classList.add("task");
                taskElement.style.top = `0px`; // Default to top of the slot
                taskElement.style.height = `${slotHeight}px`; // Default to 15 minutes
                taskElement.textContent = "Nueva Tarea";
                e.target.appendChild(taskElement);

                selectionTimeElement = document.createElement("div");
                selectionTimeElement.classList.add("selection-time");
                selectionTimeElement.textContent = getTimeRange(startSlot, startSlot);
                taskElement.appendChild(selectionTimeElement);
                selectionTimeElement.style.display = 'block';
            }
        });

        timeline.addEventListener("mousemove", (e) => {
            if (isSelecting && e.target.classList.contains("time-slot")) {
                const currentSlot = parseInt(e.target.dataset.time);
                const duration = (currentSlot - startSlot + 1) * slotHeight;
                taskElement.style.height = `${duration}px`;
                selectionTimeElement.textContent = getTimeRange(startSlot, currentSlot);
            }
        });

        timeline.addEventListener("mouseup", () => {
            isSelecting = false;
            if (selectionTimeElement) {
                selectionTimeElement.style.display = 'none';
            }
            showModal();
        });

        timeline.addEventListener("mouseleave", () => {
            isSelecting = false;
            if (selectionTimeElement) {
                selectionTimeElement.style.display = 'none';
            }
        });

        function getTimeRange(startSlot, endSlot) {
            const startHours = Math.floor(startSlot / slotsPerHour);
            const startMinutes = (startSlot % slotsPerHour) * 15;
            const endHours = Math.floor(endSlot / slotsPerHour);
            const endMinutes = (endSlot % slotsPerHour) * 15;
            return `${String(startHours).padStart(2, "0")}:${String(startMinutes).padStart(2, "0")} - ${String(endHours).padStart(2, "0")}:${String(endMinutes).padStart(2, "0")}`;
        }

        function updateCurrentTime() {
            const now = new Date();
            const currentMinutes = now.getHours() * 60 + now.getMinutes();
            let currentTimeIndicator = document.querySelector(".current-time");
            if (!currentTimeIndicator) {
                currentTimeIndicator = document.createElement("div");
                currentTimeIndicator.classList.add("current-time");
                timeline.appendChild(currentTimeIndicator);
            }
            currentTimeIndicator.style.top = `${(currentMinutes / 15) * slotHeight}px`;
        }

        function showModal() {
            taskTimeRangeInput.value = selectionTimeElement.textContent;
            taskModal.style.display = "block";
        }

        // Close the modal when clicking outside of it
        window.onclick = function (event) {
            if (event.target == taskModal) {
                taskModal.style.display = "none";
            }
        }

        // Handle form submission
        taskForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const taskTitle = document.getElementById("taskTitle").value;
            const taskDescription = document.getElementById("taskDescription").value;
            const taskTimeRange = taskTimeRangeInput.value;

            // Update task name
            if (taskElement) {
                taskElement.textContent = taskTitle;
                taskElement.appendChild(selectionTimeElement); // Re-attach the selection time element
            }

            taskModal.style.display = "none";
        });

        setInterval(updateCurrentTime, 60000);
    });


</script>

<script>
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
    let set;
    let active = "focus";
    let count = 59;
    let paused = true;
    let minCount = 24;
    time.textContent = `${minCount + 1}:00`;

    const appendZero = (value) => {
        value = value < 10 ? `0${value}` : value;
        return value;
    };

    reset.addEventListener(
        "click",
        (resetTime = () => {
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
        })
    );

    const removeFocus = () => {
        buttons.forEach((btn) => {
            btn.classList.remove("btn-focus");
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

    pause.addEventListener(
        "click",
        (pauseTimer = () => {
            paused = true;
            clearInterval(set);
            startBtn.classList.remove("hide");
            pause.classList.remove("show");
            reset.classList.remove("show");
        })
    );

    startBtn.addEventListener("click", () => {
        reset.classList.add("show");
        pause.classList.add("show");
        startBtn.classList.add("hide");
        startBtn.classList.remove("show");
        if (paused) {
            paused = false;
            time.textContent = `${appendZero(minCount)}:${appendZero(count)}`;
            set = setInterval(() => {
                count--;
                time.textContent = `${appendZero(minCount)}:${appendZero(count)}`;
                if (count == 0) {
                    if (minCount != 0) {
                        minCount--;
                        count = 60;
                    } else {
                        clearInterval(set);
                    }
                }
            }, 1000);
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

    // Detecta cuando se sale del modo pantalla completa usando el evento
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            pomodoroContainer.classList.remove('fullscreen-active');
        }
    });
</script>
<?= $this->endSection() ?>