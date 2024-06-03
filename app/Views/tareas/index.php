<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>
<link type="text/css" href="assets/css/tareas.css" rel="stylesheet">


<section style="padding:20px">
    <div class="row titulo-tareas">
        <button class="btn btn-active mr-2" id="btn-general">General</button>
        <button class="btn" id="btn-estado">Vista de estado</button>
    </div>
    <div class="row" id="vista-general">
        <div class="col-12">
            <div class="p-3 task-container-title">
                <div class="tasks-container">
                    <?php foreach ($tasks as $task): ?>
                        <div class="task-item row" data-id="<?= $task['id_tarea'] ?>">
                            <div class=" col-12 d-flex justify-content-between align-items-center task-header"
                                data-toggle="task-details-<?= $task['id_tarea'] ?>">
                                <div class="checkbox-wrapper">
                                    <input type="checkbox" id="cbx-<?= $task['id_tarea'] ?>" class="inp-cbx"
                                        <?= $task['estado'] == 3 ? 'checked' : '' ?> />
                                    <label for="cbx-<?= $task['id_tarea'] ?>" class="cbx">
                                        <span></span>
                                        <span><?= $task['nombre_tarea'] ?></span>
                                    </label>
                                </div>


                                <div class=" tarea-timer">
                                    <button name="count_click" class="time-btn" data-task-id="<?= $task['id_tarea'] ?>">
                                        <div class="sign">
                                            <i class="sing-icon fa-solid fa-play play-icon"></i>
                                            <i class="sing-icon fa-solid fa-pause stop-icon" style="display: none;"></i>
                                        </div>
                                        <div class=" time-display" id="time-display-<?= $task['id_tarea'] ?>">00:00:00
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 task-details closed" id="task-details-<?= $task['id_tarea'] ?>">
                                <i class="fa-solid fa-trash delete-task"></i>
                                <textarea class="form-control" rows="3"
                                    data-field="descripcion_tarea"><?= $task['descripcion_tarea'] ?></textarea>
                                <textarea class="form-control" rows="2"
                                    data-field="notas_tarea"><?= $task['notas_tarea'] ?></textarea>
                                <button class="btn btn-success save-task"
                                    data-id="<?= $task['id_tarea'] ?>">Guardar</button>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>

    <div class="container overflow-hidden">
        <div class="row gy-5" id="vista-estado" style="display:none;">
            <?php foreach (['0' => 'pendiente', '1' => 'en-proceso', '2' => 'revisar', '3' => 'completado'] as $estado => $estadoTexto): ?>
                <div class="col-3">
                    <div class="p-3 task-container-title <?= $estadoTexto ?>">
                        <div class="row">
                            <div class="col-10">
                                <span class="mr-2"><?= ucfirst(str_replace('-', ' ', $estadoTexto)) ?></span>
                                <span
                                    class="badge <?= $estadoTexto ?>-badge"><span><?= count(array_filter($tasks, fn($task) => $task['estado'] == $estado)) ?></span></span>
                            </div>
                            <div class="col-2">
                                <i class="fa-solid fa-plus add-task-btn" data-column="<?= $estadoTexto ?>"></i>
                            </div>
                        </div>
                    </div>
                    <div class="tasks-container" id="<?= $estadoTexto ?>">
                        <?php foreach ($tasks as $task): ?>
                            <?php if ($task['estado'] == $estado): ?>
                                <div class="task-item" data-id="<?= $task['id_tarea'] ?>">
                                    <h4 contenteditable="true"><?= $task['nombre_tarea'] ?></h4>
                                    <p contenteditable="true"><?= $task['descripcion_tarea'] ?></p>
                                    <i class="fa-solid fa-trash delete-task"></i>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Botón fijo para agregar tarea -->
    <button class="add-task-fixed-btn"><i class="fa-solid fa-plus"></i></button>

    <!-- Formulario para nueva tarea -->
    <div class="task-form">
        <input type="text" id="new-task-title" placeholder="Título de la tarea">
        <textarea id="new-task-notes" placeholder="Notas"></textarea>
        <select id="new-task-status">
            <option value="" selected>Selecciona el estado</option>
            <option value="0">Pendiente</option>
            <option value="1">En proceso</option>
            <option value="2">Revisar
        </select>
        <button id="save-new-task">Guardar</button>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>$(document).ready(function () {
        $('#vista-general').show();
        $('#vista-estado').hide();

        $('#btn-general').on('click', function () {
            $('#vista-estado').hide();
            $('#vista-general').show();
            $('#btn-general').addClass('btn-active');
            $('#btn-estado').removeClass('btn-active');
        });

        $('#btn-estado').on('click', function () {
            $('#vista-general').hide();
            $('#vista-estado').show();
            $('#btn-estado').addClass('btn-active');
            $('#btn-general').removeClass('btn-active');
        });
    });

    $(document).ready(function () {
        $('#vista-general').show();
        $('#vista-estado').hide();

        $('#btn-general').on('click', function () {
            $('#vista-estado').hide();
            $('#vista-general').show();
        });

        $('#btn-estado').on('click', function () {
            $('#vista-general').hide();
            $('#vista-estado').show();
        });

        // Mostrar detalles de la tarea
        $(document).on('click', '.edit-task', function () {
            var toggleId = $(this).data('toggle');
            $('#' + toggleId).toggle();
        });

        // Mostrar el formulario de nueva tarea
        $('.add-task-fixed-btn').on('click', function () {
            $('.task-form').toggle();
            $(this).toggleClass('rotate');
        });

        // Guardar la nueva tarea
        $('#save-new-task').on('click', function () {
            var taskName = $('#new-task-title').val();
            var taskNotes = $('#new-task-notes').val();
            var taskStatus = $('#new-task-status').val();

            if (taskName.trim() !== "") {
                $.ajax({
                    url: '<?= base_url('tareas/save') ?>',
                    method: 'POST',
                    data: {
                        nombre_tarea: taskName,
                        descripcion_tarea: taskNotes,
                        estado: taskStatus
                    },
                    success: function (response) {
                        if (response.success) {
                            console.log(response.message);
                            var newTask = $('<div class="task-item row" data-id="' + response.id_tarea + '">' +
                                '<div class="col-8">' +
                                '<div class="checkbox-wrapper">' +
                                '<input type="checkbox" id="cbx-' + response.id_tarea + '" class="inp-cbx" />' +
                                '<label for="cbx-' + response.id_tarea + '" class="cbx">' +
                                '<span></span>' +
                                '<span>' + taskName + '</span>' +
                                '</label>' +
                                '</div>' +
                                '</div>' +
                                '<i class="fa-solid fa-chevron-down edit-task" data-toggle="task-details-' + response.id_tarea + '"></i>' +
                                '<i class="fa-solid fa-trash delete-task"></i>' +
                                '<div class="col-12 task-details" id="task-details-' + response.id_tarea + '">' +
                                '<textarea class="form-control" rows="3" data-field="descripcion_tarea">' + taskNotes + '</textarea>' +
                                '<textarea class="form-control" rows="2" data-field="notas_tarea"></textarea>' +
                                '<button class="btn btn-success save-task" data-id="' + response.id_tarea + '">Guardar</button>' +
                                '</div>' +
                                '</div>');

                            $("#" + taskStatus).append(newTask);
                            $('.task-form').hide();
                            $('#new-task-title').val('');
                            $('#new-task-notes').val('');
                            $('#new-task-status').val('0');
                        } else {
                            console.log(response.message);
                        }
                    },
                    error: function () {
                        console.log('Error al guardar la tarea');
                    }
                });
            }
        });

        // Eliminar la tarea
        $(document).on('click', '.delete-task', function () {
            var taskItem = $(this).closest('.task-item');
            var taskId = taskItem.data('id');

            $.ajax({
                url: '<?= base_url('tareas/delete') ?>',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    id_tarea: taskId
                }),
                success: function (response) {
                    if (response.success) {
                        console.log(response.message);
                        taskItem.remove();
                    } else {
                        console.log(response.message);
                    }
                },
                error: function () {
                    console.log('Error al eliminar la tarea');
                }
            });
        });

        // Guardar cambios en la tarea
        $(document).on('click', '.save-task', function () {
            var taskId = $(this).data('id');
            var taskDetails = $(this).closest('.task-details');
            var descripcion = taskDetails.find('textarea[data-field="descripcion_tarea"]').val();
            var notas = taskDetails.find('textarea[data-field="notas_tarea"]').val();

            $.ajax({
                url: '<?= base_url('tareas/update') ?>',
                method: 'POST',
                data: {
                    id_tarea: taskId,
                    descripcion_tarea: descripcion,
                    notas_tarea: notas
                },
                success: function (response) {
                    if (response.success) {
                        console.log(response.message);
                    } else {
                        console.log(response.message);
                    }
                },
                error: function () {
                    console.log('Error al actualizar la tarea');
                }
            });
        });

        // Hacer las tareas arrastrables y dropeables
        $(".tasks-container").sortable({
            connectWith: ".tasks-container",
            placeholder: "ui-state-highlight",
            start: function (event, ui) {
                ui.placeholder.height(ui.item.height());
            },
            update: function (event, ui) {
                var taskId = ui.item.data('id');
                var newState = ui.item.closest('.tasks-container').attr('id');
                var estado;

                switch (newState) {
                    case 'pendiente':
                        estado = '0';
                        break;
                    case 'en-proceso':
                        estado = '1';
                        break;
                    case 'revisar':
                        estado = '2';
                        break;
                    case 'completado':
                        estado = '3';
                        break;
                }

                $.ajax({
                    url: '<?= base_url('tareas/updateState') ?>',
                    method: 'POST',
                    data: {
                        id_tarea: taskId,
                        estado: estado
                    },
                    success: function (response) {
                        console.log(response.message);
                    },
                    error: function () {
                        console.log('Error al actualizar el estado');
                    }
                });
            }
        }).disableSelection();
    });

    var timers = {};

    function formatTime(seconds) {
        var hrs = Math.floor(seconds / 3600);
        var mins = Math.floor((seconds % 3600) / 60);
        var secs = seconds % 60;
        return (hrs < 10 ? "0" : "") + hrs + ":" + (mins < 10 ? "0" : "") + mins + ":" + (secs < 10 ? "0" : "") + secs;
    }

    function calculateElapsedTime(startTime) {
        var currentTime = new Date();
        var elapsedTime = Math.floor((currentTime - new Date(startTime)) / 1000);
        return elapsedTime;
    }

    function update_timer(taskId) {
        var startTime = localStorage.getItem("startTime-" + taskId);
        if (startTime) {
            var elapsedTime = calculateElapsedTime(startTime);
            $("#time-display-" + taskId).text(formatTime(elapsedTime));
        }
    }

    function start_timer(taskId) {
        if (!localStorage.getItem("startTime-" + taskId)) {
            var startTime = new Date();
            localStorage.setItem("startTime-" + taskId, startTime);
        }

        if (!timers[taskId]) {
            timers[taskId] = setInterval(function () { update_timer(taskId); }, 1000);
            $("[data-task-id='" + taskId + "']").addClass("running");
        }
    }

    function stop_timer(taskId) {
        clearInterval(timers[taskId]);
        timers[taskId] = null;
        localStorage.removeItem("startTime-" + taskId);
        $("#time-display-" + taskId).text("00:00:00");
        $("[data-task-id='" + taskId + "']").removeClass("running");
    }

    $(document).ready(function () {
        $(".time-btn").click(function () {
            var taskId = $(this).data("task-id");
            if (!timers[taskId]) {
                start_timer(taskId);
            } else {
                stop_timer(taskId);
            }
        });

        $(".time-btn").each(function () {
            var taskId = $(this).data("task-id");
            if (localStorage.getItem("startTime-" + taskId)) {
                start_timer(taskId);
            }
        });
    });
</script>

<script>
    // Mostrar detalles de la tarea con animación sin hover
    $(document).on('click', '.task-header', function (e) {
        if (!$(e.target).closest('.time-btn').length) {
            var toggleId = $(this).data('toggle');
            var details = $('#' + toggleId);
            if (details.hasClass('closed')) {
                details.removeClass('closed').addClass('open');
            } else {
                details.removeClass('open').addClass('closed');
            }
        }
    });


</script>
<?= $this->endSection() ?>