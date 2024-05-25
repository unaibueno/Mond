<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>
<style>
    .fc .fc-toolbar {
        background-color: #4C50;
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
        background-color: #2196F3;
        border-color: #2196F3;
        color: #222;
    }

    .fc-col-header-cell {
        background-color: #f5f5f5;
        /* Color de fondo para los días de la semana */
        color: #000;
        /* Color del texto para los días de la semana */
        font-weight: bold;
        /* Texto en negrita para los días de la semana */
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 999;
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
        padding: 20px;
        border: 1px solid #888;
        width: 30%;
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

    .fc-daygrid-day.fc-day-selected {
        background-color: #ffd700;

    }

    .fc-direction-ltr .fc-daygrid-event.fc-event-end,
    .fc-direction-rtl .fc-daygrid-event.fc-event-start {
        background-color: #ffe7e4;
        border: solid 1px #ffe7e4;

    }

    .fc-direction-ltr .fc-daygrid-event.fc-event-start,
    .fc-direction-rtl .fc-daygrid-event.fc-event-end {
        background-color: #ffe7e4;
        border: solid 1px #ffe7e4;
        border-left: solid 4px red;

    }

    .fc .fc-toolbar {
        background-color: transparent;
        color: black;
    }

    .fc .fc-daygrid-day-number {
        color: #000;
        font-size: 14px;

    }

    .fc-direction-ltr .fc-daygrid-event.fc-event-start,
    .fc-direction-rtl .fc-daygrid-event.fc-event-end {
        color: black;
    }

    .fc-daygrid-event-dot {
        border: none;
        border-radius: calc(var(--fc-daygrid-event-dot-width) / 2);
        box-sizing: content-box;
        height: 0px;
        margin: 0px 4px;
        width: 0px;
    }

    .fc-direction-ltr .fc-button-group>.fc-button:not(:last-child) {
        background-color: #222;
        border: none;
        border-radius: 16px;
        margin: 0 5px;
    }

    .fc-direction-ltr .fc-button-group>.fc-button:last-child {
        background-color: #222;
        border: none;
        border-radius: 16px;
        margin: 0 5px;
    }

    .fc-direction-ltr .fc-toolbar>*> :not(:first-child) {
        background-color: #222;
        border: none;
        border-radius: 16px;
        opacity: 100%;
    }




    .fc .fc-scrollgrid-section-liquid>td {
        background-color: transparent;
    }

    .fc .fc-scrollgrid-section,
    .fc .fc-scrollgrid-section table,
    .fc .fc-scrollgrid-section>td {
        border: none;
    }

    .fc .fc-scrollgrid-section-body table,
    .fc .fc-scrollgrid-section-footer table {
        border: none !important;
    }

    #calendar {
        height: 90vh;
        border: none;
        margin-left: 8px;
    }

    .apoyo-calendario {
        background-color: #f2f2f2;
        height: 92vh;
        border-radius: 0 30px 30px 0;
        width: 24%;
        padding: 12px;
        border-left: 1px solid #f2f2f2;
        display: flex;
        gap: 10px;

    }

    .apoyo-calendario .buscador {
        height: 50px;
        margin-bottom: 15px;
        width: 100%;
    }

    .minicaledar {
        background-color: red;
        height: 40vh;
        background-color: white;
        border: 1px solid #E0E0E0;
        padding: 14px;
        border-radius: 15px;


    }

    .fc-direction-ltr {
        width: 100% !important;

    }

    #eventForm {
        background-color: #fff;
        padding: 14px;
        border-radius: 15px;
        border: 1px solid #E0E0E0;
        margin-bottom: 15px;


    }

    .buscador {
        background-color: #fff;
        padding: 14px;
        border-radius: 15px;
        border: 1px solid #E0E0E0;
        width: 100%;
    }

    input {
        background-color: #fff;
        border: none;
        outline: none;
        font-size: 25px;
        color: black;
        display: block;
        width: 100%;
    }
</style>
<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>

<section>
    <div class="row">
        <div class="col-9" id="calendar"></div>
        <div class="apoyo-calendario" id="eventSidebar">
            <div class="minicaledar">
                <div id="minicalendar"></div>

            </div>
            <form id="eventForm" style="display:none;">
                <label for="description">Evento:</label>
                <input type="text" placeholder="Nuevo evento" id="title" name="title" required>
                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
                <input type="hidden" id="start" name="start">
                <input type="hidden" id="end" name="end">
                <button type="submit">Save</button>
                <button type="button" id="deleteButton" style="display:none;">Delete</button>
            </form>
            <div id="eventDetails" style="display:none;">
                <p><strong>Title:</strong> <span id="eventTitle"></span></p>
                <p><strong>Description:</strong> <span id="eventDescription"></span></p>
                <p><strong>Start:</strong> <span id="eventStart"></span></p>
                <p><strong>End:</strong> <span id="eventEnd"></span></p>
            </div>


        </div>
    </div>
</section>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inicialización del calendario principal
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            editable: true,
            locale: 'es',
            firstDay: 1,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: '<?= base_url('get-events') ?>',
            select: function (info) {
                document.getElementById('start').value = info.startStr;
                document.getElementById('end').value = info.endStr;
                document.getElementById('eventForm').style.display = 'block';
                document.getElementById('eventDetails').style.display = 'none';
                document.getElementById('deleteButton').style.display = 'none';
                document.getElementById('eventSidebar').style.display = 'block';
            },
            eventClick: function (info) {
                document.getElementById('title').value = info.event.title;
                document.getElementById('description').value = info.event.extendedProps.description || '';
                document.getElementById('start').value = info.event.start.toISOString().slice(0, 10);
                document.getElementById('end').value = info.event.end ? info.event.end.toISOString().slice(0, 10) : '';
                document.getElementById('eventForm').style.display = 'block';
                document.getElementById('eventDetails').style.display = 'none';
                document.getElementById('deleteButton').style.display = 'block';
                document.getElementById('eventSidebar').style.display = 'block';

                // Añadir ID del evento para modificar
                document.getElementById('eventForm').dataset.eventId = info.event.id;
                document.getElementById('deleteButton').dataset.eventId = info.event.id;
            },
            eventDrop: function (info) {
                if (!confirm("¿Estás seguro de este cambio?")) {
                    info.revert();
                } else {
                    fetch('<?= base_url('update-event') ?>', {
                        method: 'POST',
                        body: JSON.stringify({
                            id: info.event.id,
                            title: info.event.title,
                            description: info.event.extendedProps.description,
                            start: info.event.start.toISOString(),
                            end: info.event.end ? info.event.end.toISOString() : null
                        }),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    }).then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Evento actualizado con éxito');
                            } else {
                                alert('Error al actualizar el evento: ' + JSON.stringify(data.error));
                                info.revert();
                            }
                        }).catch(error => {
                            console.error('Error:', error);
                            info.revert();
                        });
                }
            },
            events: function (fetchInfo, successCallback, failureCallback) {
                fetch('<?= base_url('get-events') ?>')
                    .then(response => response.json())
                    .then(events => {
                        console.log('Eventos recibidos:', events);
                        successCallback(events);
                    })
                    .catch(error => {
                        console.error('Error cargando eventos:', error);
                        failureCallback(error);
                    });
            }
        });
        calendar.render();

        document.getElementById('eventForm').addEventListener('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);

            var eventId = this.dataset.eventId;

            if (eventId) {
                formData.append('id', eventId);
            }

            fetch(eventId ? '<?= base_url('update-event') ?>' : '<?= base_url('save-event') ?>', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Evento ' + (eventId ? 'actualizado' : 'guardado') + ' con éxito');
                        calendar.refetchEvents();
                    } else {
                        alert('Error al ' + (eventId ? 'actualizar' : 'guardar') + ' el evento: ' + JSON.stringify(data.error));
                    }
                }).catch(error => console.error('Error:', error));
        });

        document.getElementById('deleteButton').addEventListener('click', function () {
            var eventId = this.dataset.eventId;

            if (eventId && confirm("¿Estás seguro de que deseas eliminar este evento?")) {
                fetch('<?= base_url('delete-event') ?>', {
                    method: 'POST',
                    body: JSON.stringify({ id: eventId }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Evento eliminado con éxito');
                            calendar.refetchEvents();
                        } else {
                            alert('Error al eliminar el evento: ' + JSON.stringify(data.error));
                        }
                    }).catch(error => console.error('Error:', error));
            }
        });

        // Inicialización del mini calendario
        function initializeMiniCalendar() {
            var minicalendarEl = document.getElementById('minicalendar');
            var miniCalendar = new FullCalendar.Calendar(minicalendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: false,
                height: 'auto'
            });
            miniCalendar.render();
        }

        initializeMiniCalendar(); // Renderiza el mini calendario siempre
    });


</script>

<?= $this->endSection() ?>
<?= $this->endSection() ?>