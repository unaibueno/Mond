<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>

<section style="padding:20px">
    <div class="row">
        <div class="col-8" style="height:90vh; border-radius:15px;">
            <div class="row justify-content-left">
                <div class="col-12">
                    <div class="pl-1">
                        <h2 class="welcome-title pt-3">TAREAS</h2>
                    </div>
                    <div class="col-12 selector-tareas">

                    </div>
                </div>
                <div class="col-12 tareas-dashboard" style="height:70vh;">
                    <div class="col-12 tarea-dashboard" id="tarea-dashboard-1">
                        <div class="tarea">
                            <div class="tarea-icon"></div>
                            <div class="tarea-content">TAREA 1</div>
                            <div class="tarea-timer">
                                <button name="toggle_timer" class="time-btn" id="time-btn-1" data-timer-id="1">
                                    <div class="sign">
                                        <i class="sing-icon fa-solid fa-play" id="timer-icon-1"></i>
                                    </div>
                                    <div id="count_click-1" class="time-text" style="color:white; font-size:13px;">
                                        00:00:00
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 tarea-dashboard" id="tarea-dashboard-2">
                        <div class="tarea">
                            <div class="tarea-icon"></div>
                            <div class="tarea-content">TAREA 2.</div>
                            <div class="tarea-timer">
                                <button name="toggle_timer" class="time-btn" id="time-btn-2" data-timer-id="2">
                                    <div class="sign">
                                        <i class="sing-icon fa-solid fa-play" id="timer-icon-2"></i>
                                    </div>
                                    <div id="count_click-2" class="time-text" style="color:white; font-size:13px;">
                                        00:00:00
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4" style="height:85vh; border-radius:15px;">
            <div class="col-12 vistazo-general">
                <!-- Contenido adicional -->
            </div>
        </div>
    </div>
</section>

<script>
    var timers = {};

    // Formatea el tiempo en formato 00:00:00
    function formatTime(seconds) {
        var hrs = Math.floor(seconds / 3600);
        var mins = Math.floor((seconds % 3600) / 60);
        var secs = seconds % 60;
        return (
            (hrs < 10 ? "0" : "") + hrs + ":" +
            (mins < 10 ? "0" : "") + mins + ":" +
            (secs < 10 ? "0" : "") + secs
        );
    }

    // Calcula el tiempo transcurrido desde la hora de inicio
    function calculateElapsedTime(startTime) {
        var currentTime = new Date();
        var elapsedTime = Math.floor((currentTime - new Date(startTime)) / 1000);
        return elapsedTime;
    }

    // Actualiza el contador de tiempo
    function update_timer(timerId) {
        var startTime = localStorage.getItem("startTime-" + timerId);
        if (startTime) {
            var elapsedTime = calculateElapsedTime(startTime);
            $("#count_click-" + timerId).text(formatTime(elapsedTime));
        }
    }

    // Inicia el contador
    function start_timer(timerId) {
        if (!localStorage.getItem("startTime-" + timerId)) {
            var startTime = new Date();
            localStorage.setItem("startTime-" + timerId, startTime);
        }
        if (!timers[timerId]) {
            timers[timerId] = setInterval(function () { update_timer(timerId); }, 1000);
        }
        $("#timer-icon-" + timerId).removeClass("fa-play").addClass("fa-pause");
        $("#time-btn-" + timerId).addClass("active");
    }

    // Detiene el contador y limpia la hora de inicio del almacenamiento local
    function stop_timer(timerId) {
        clearInterval(timers[timerId]);
        timers[timerId] = null;
        localStorage.removeItem("startTime-" + timerId);
        $("#count_click-" + timerId).text("00:00:00");
        $("#timer-icon-" + timerId).removeClass("fa-pause").addClass("fa-play");
        $("#time-btn-" + timerId).removeClass("active");
    }

    // Alterna el temporizador
    function toggle_timer(timerId) {
        if (timers[timerId]) {
            stop_timer(timerId);
        } else {
            start_timer(timerId);
        }
    }

    // Añade el evento de click a los botones
    $(document).ready(function () {
        $("button[name='toggle_timer']").click(function () {
            var timerId = $(this).data("timer-id");
            toggle_timer(timerId);
        });

        // Inicia los temporizadores si ya se han iniciado previamente
        $("button[name='toggle_timer']").each(function () {
            var timerId = $(this).data("timer-id");
            if (localStorage.getItem("startTime-" + timerId)) {
                start_timer(timerId);
            }
        });
    });
</script>

<?= $this->endSection() ?>