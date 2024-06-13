<?= $this->extend('master/master') ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="assets/css/calendario.css">

<section>
    <div class="row">
        <div class="col-12 col-md-9" id="calendar"></div>
        <div class="apoyo-calendario" id="eventSidebar">
            <form id="eventForm">
                <label class="label-form-event" for="title">Evento</label>
                <div class="form-group">
                    <input type="text" placeholder="Título" id="title" name="title" required>
                    <select id="color" name="color">
                        <option value="#f1e6cb">Amarillo</option>
                        <option value="#fbe4e3">Rojo</option>
                        <option value="#eeeaf9">Morado</option>
                        <option value="#e9f4f5">Verde</option>
                        <option value="#eef3fe">Azul</option>
                    </select>
                </div>
                <label class="label-form-event mt-3" for="description">Notas</label>
                <input type="textarea" id="description" placeholder="Escribe aquí tus notas" name="description">
                <label class="label-form-event mt-3" for="start">Fecha de inicio</label>
                <div class="form-group">
                    <input type="date" id="startDate" name="startDate" required>
                    <input type="time" id="startTime" name="startTime" required>
                </div>
                <label class="label-form-event mt-3" for="end">Fecha de fin</label>
                <div class="form-group">
                    <input type="date" id="endDate" name="endDate" required>
                    <input type="time" id="endTime" name="endTime" required>
                </div>
                <div class="button-group">
                    <button type="button" id="deleteButton" style="display:none;">Borrar</button>
                    <button type="button" id="saveButton">Guardar</button>
                </div>
            </form>
            <div id="eventDetails" style="display:none;">
                <p><strong>Title:</strong> <span id="eventTitle"></span></p>
                <p><strong>Description:</strong> <span id="eventDescription"></span></p>
                <p><strong>Start:</strong> <span id="eventStart"></span></p>
                <p><strong>End:</strong> <span id="eventEnd"></span></p>
            </div>
            <div class="minicalendario mt-2">
                <div id="minicalendarioderecha"></div>
            </div>
        </div>
    </div>
</section>

<script>
    const locale = 'es';
    let currentYear = new Date().getFullYear();
    let currentMonth = new Date().getMonth();
    const today = new Date();

    const intlForMonths = new Intl.DateTimeFormat(locale, { month: 'long' });
    const intlForWeeks = new Intl.DateTimeFormat(locale, { weekday: 'short' });
    const weekDays = [...Array(7).keys()].map(dayIndex => intlForWeeks.format(new Date(2021, 2, dayIndex + 1)));

    const getCalendarHtml = (year, month) => {
        const daysOfMonth = new Date(year, month + 1, 0).getDate();
        const startsOn = new Date(year, month, 1).getDay();
        const prevMonthDays = new Date(year, month, 0).getDate();
        const days = [...Array(daysOfMonth).keys()];

        const htmlDaysName = weekDays.map(dayName => `<li class='day-name'><span>${dayName}</span></li>`).join('');

        const prevDays = [...Array(startsOn).keys()].map(i => {
            const dayNumber = prevMonthDays - (startsOn - i - 1);
            return `<li class="other-month">${dayNumber}</li>`;
        }).join('');

        const htmlDays = days.map((day, index) => {
            const dayNumber = index + 1;
            const isToday = (year === today.getFullYear() && month === today.getMonth() && dayNumber === today.getDate());
            const todayClass = isToday ? 'class="today"' : '';
            return `<li ${todayClass}><span>${dayNumber}</span></li>`;
        }).join('');

        const nextDaysCount = 42 - (startsOn + daysOfMonth); // Ensure full 6 weeks calendar
        const nextDays = [...Array(nextDaysCount).keys()].map(i => {
            const dayNumber = i + 1;
            return `<li class="other-month"><span>${dayNumber}</span></li>`;
        }).join('');

        return `
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2></h2>
                <div>
                    <button class="prevMonthButton"><i class="fa-solid fa-angle-up"></i></button>
                    <button class="nextMonthButton"><i class="fa-solid fa-angle-down"></i></button>
                </div>
            </div>
            <ol>${htmlDaysName}${prevDays}${htmlDays}${nextDays}</ol>
        `;
    };

    const updateCalendar = () => {
        const html = getCalendarHtml(currentYear, currentMonth);
        document.getElementById('minicalendarioderecha').innerHTML = html;

        document.querySelector('.prevMonthButton').addEventListener('click', () => {
            if (currentMonth === 0) {
                currentMonth = 11;
                currentYear -= 1;
            } else {
                currentMonth -= 1;
            }
            updateCalendar();
        });

        document.querySelector('.nextMonthButton').addEventListener('click', () => {
            if (currentMonth === 11) {
                currentMonth = 0;
                currentYear += 1;
            } else {
                currentMonth += 1;
            }
            updateCalendar();
        });
    };

    // Inicializar con el mes actual
    updateCalendar();
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            editable: true,
            locale: 'es',
            firstDay: 1,
            headerToolbar: {
                left: 'title',
                center: '',
                right: 'prev,next'
            },
            buttonText: {
                month: 'Mes',
                week: 'Semana',
                day: 'Día',
                list: 'Lista'
            },
            events: '<?= base_url('get-events') ?>',
            select: function (info) {
                document.getElementById('startDate').value = info.startStr.split('T')[0];
                document.getElementById('startTime').value = '00:00';
                document.getElementById('endDate').value = info.endStr ? info.endStr.split('T')[0] : '';
                document.getElementById('endTime').value = '23:59';
                document.getElementById('eventForm').style.display = 'block';
                document.getElementById('eventDetails').style.display = 'none';
                document.getElementById('deleteButton').style.display = 'none';
                document.getElementById('eventSidebar').style.display = 'block';
            },
            eventClick: function (info) {
                document.getElementById('title').value = info.event.title;
                document.getElementById('description').value = info.event.extendedProps.description || '';
                document.getElementById('startDate').value = info.event.start.toISOString().slice(0, 10);
                document.getElementById('startTime').value = info.event.start.toISOString().slice(11, 16);
                document.getElementById('endDate').value = info.event.end ? info.event.end.toISOString().slice(0, 10) : '';
                document.getElementById('endTime').value = info.event.end ? info.event.end.toISOString().slice(11, 16) : '';
                document.getElementById('color').value = info.event.backgroundColor || '#2196F3';
                document.getElementById('eventForm').style.display = 'block';
                document.getElementById('eventDetails').style.display = 'none';
                document.getElementById('deleteButton').style.display = 'block';
                document.getElementById('eventSidebar').style.display = 'block';

                document.getElementById('eventForm').dataset.eventId = info.event.id;
                document.getElementById('deleteButton').dataset.eventId = info.event.id;
            },
            eventDrop: function (info) {
                if (!confirm("¿Estás seguro de este cambio?")) {
                    info.revert();
                } else {
                    saveEvent(info.event);
                }
            },
            eventRender: function (info) {
                info.el.style.backgroundColor = info.event.backgroundColor;
            },
            events: function (fetchInfo, successCallback, failureCallback) {
                fetch('<?= base_url('get-events') ?>')
                    .then(response => response.json())
                    .then(events => {
                        events.forEach(event => {
                            event.backgroundColor = event.color || '#2196F3';
                        });
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

        const saveEvent = (event) => {
            var formData = new FormData();
            var startDate = document.getElementById('startDate').value;
            var startTime = document.getElementById('startTime').value;
            var endDate = document.getElementById('endDate').value;
            var endTime = document.getElementById('endTime').value;

            // Combinar fecha y tiempo en formato ISO 8601 para el inicio y fin del evento
            var start = startDate + 'T' + startTime + ':00';
            var end = endDate + 'T' + endTime + ':00';

            formData.append('title', document.getElementById('title').value);
            formData.append('description', document.getElementById('description').value);
            formData.append('start', start);
            formData.append('end', end);
            formData.append('color', document.getElementById('color').value);

            if (event) {
                formData.append('id', event.id);
            }

            fetch(event ? '<?= base_url('update-event') ?>' : '<?= base_url('save-event') ?>', {
                method: 'POST',
                body: formData
            }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        calendar.refetchEvents();
                    } else {
                        alert('Error al ' + (event ? 'actualizar' : 'guardar') + ' el evento: ' + JSON.stringify(data.error));
                    }
                }).catch(error => console.error('Error:', error));
        };


        document.getElementById('saveButton').addEventListener('click', () => {
            saveEvent();
        });

        // Remover los event listeners de los campos individuales para guardar automáticamente
        // document.getElementById('title').addEventListener('input', () => saveEvent());
        // document.getElementById('description').addEventListener('input', () => saveEvent());
        // document.getElementById('startDate').addEventListener('change', () => saveEvent());
        // document.getElementById('startTime').addEventListener('change', () => saveEvent());
        // document.getElementById('endDate').addEventListener('change', () => saveEvent());
        // document.getElementById('endTime').addEventListener('change', () => saveEvent());
        // document.getElementById('color').addEventListener('change', () => saveEvent());


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
                            //  alert('Evento eliminado con éxito');
                            calendar.refetchEvents();
                        } else {
                            alert('Error al eliminar el evento: ' + JSON.stringify(data.error));
                        }
                    }).catch(error => console.error('Error:', error));
            }
        });
    });
</script>

<?= $this->endSection() ?>