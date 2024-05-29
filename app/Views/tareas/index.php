<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>
<style>
    .task-container-title {
        border-radius: 13px;
        font-weight: bold;
    }

    .en-proceso {
        background-color: #fff4ea !important;
        color: #8c6b4c;
        margin-bottom: 10px;
    }

    .revisar {
        background-color: #fff0f1;
        color: #a35b5b;
        margin-bottom: 10px;
    }

    .pendiente {
        background-color: #f2f2f2;
        color: #666;
        margin-bottom: 10px;
    }

    .completado {
        background-color: #eff9f4;
        color: #63a782;
        margin-bottom: 10px;
    }

    .tasks-container {
        min-height: 20vh;
        border-radius: 20px;
        margin-bottom: 10px;
    }

    .task-item {
        background-color: #f2f2f2;
        border-radius: 12px;
        padding: 10px;
        margin-bottom: 10px;
        cursor: move;
        position: relative;
    }

    .task-item h4,
    .task-item p {
        margin: 0;
        padding: 0;
    }

    .task-item .edit-task,
    .task-item .delete-task {
        position: absolute;
        top: 10px;
        cursor: pointer;
    }

    .task-item .edit-task {
        right: 40px;
        color: green;
    }

    .task-item .delete-task {
        right: 10px;
        color: red;
    }

    .selector-vista-task {
        display: block;
        width: 100%;
        border-bottom: 2px solid #f1f1f1;
        margin-bottom: 8px;
    }

    .titulo-tareas {
        padding: 20px;
        font-family: "sf-bold";
    }
</style>

<section style="padding:20px">
    <div class="row titulo-tareas">
        <div class="selector-vista-task"><i class="fa-solid fa-bars-progress"></i>
            <span class="ml-2">Tabla general</span>
        </div>
    </div>
    <div class="container overflow-hidden">
        <div class="row gy-5">
            <?php foreach (['0' => 'pendiente', '1' => 'en-proceso', '2' => 'revisar', '3' => 'completado'] as $estado => $estadoTexto): ?>
                <div class="col-3">
                    <div class="p-3 task-container-title <?= $estadoTexto ?>">
                        <span class="mr-2"><?= ucfirst(str_replace('-', ' ', $estadoTexto)) ?></span>
                        <span
                            class="badge <?= $estadoTexto ?>-badge"><?= count(array_filter($tasks, fn($task) => $task['estado'] == $estado)) ?></span>
                        <i class="fa-solid fa-plus add-task-btn" data-column="<?= $estadoTexto ?>"></i>
                    </div>
                    <div class=" tasks-container" id="<?= $estadoTexto ?>">
                        <?php foreach ($tasks as $task): ?>
                            <?php if ($task['estado'] == $estado): ?>
                                <div class="task-item" data-id="<?= $task['id_tarea'] ?>">
                                    <h4><?= $task['nombre_tarea'] ?></h4>
                                    <p><?= $task['descripcion_tarea'] ?></p>
                                    <i class="fa-solid fa-edit edit-task"></i>
                                    <i class="fa-solid fa-trash delete-task"></i>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function () {
        // Añadir nueva tarea
        $(document).on('click', '.add-task-btn', function () {
            var column = $(this).data("column");
            var newTask = $('<div class="task-item">' +
                '<input type="text" placeholder="Nombre de la Tarea">' +
                '<textarea placeholder="Descripción"></textarea>' +
                '<i class="fa-solid fa-check save-task"></i>' +
                '<i class="fa-solid fa-edit edit-task"></i>' +
                '<i class="fa-solid fa-trash delete-task"></i>' +
                '</div>');
            $("#" + column).append(newTask);
            newTask.find("input").focus();
        });

        // Guardar la tarea
        $(document).on('click', '.save-task', function () {
            var taskItem = $(this).closest('.task-item');
            var taskName = taskItem.find("input").val();
            var taskDesc = taskItem.find("textarea").val();
            var column = taskItem.closest('.tasks-container').attr('id');
            var estado;

            switch (column) {
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

            if (taskName.trim() !== "") {
                $.ajax({
                    url: '<?= base_url('tareas/save') ?>',
                    method: 'POST',
                    data: {
                        nombre_tarea: taskName,
                        descripcion_tarea: taskDesc,
                        estado: estado
                    },
                    success: function (response) {
                        if (response.success) {
                            console.log(response.message);
                            taskItem.html('<h4>' + taskName + '</h4>' +
                                '<p>' + taskDesc + '</p>' +
                                '<i class="fa-solid fa-edit edit-task"></i>' +
                                '<i class="fa-solid fa-trash delete-task"></i>');
                        } else {
                            console.log(response.message);
                        }
                    },
                    error: function () {
                        console.log('Error al guardar la tarea');
                    }
                });
            } else {
                taskItem.remove();
            }
        });

        // Editar la tarea
        $(document).on('click', '.edit-task', function () {
            var taskItem = $(this).closest('.task-item');
            var taskName = taskItem.find("h4").text();
            var taskDesc = taskItem.find("p:first").text();
            taskItem.html('<input type="text" value="' + taskName + '">' +
                '<textarea>' + taskDesc + '</textarea>' +
                '<i class="fa-solid fa-check save-task"></i>' +
                '<i class="fa-solid fa-trash delete-task"></i>');
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
</script>

<?= $this->endSection() ?>