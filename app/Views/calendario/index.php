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

    .fc-direction-ltr .fc-button-group>.fc-button:not(:first-child) {
        background-color: #f2f2f2;
        border: none;
        border-radius: 16px;
        margin: 0 5px;
        color: #000;
        border: 1px solid #E0E0E0;
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
        background-color: #f2f2f2;
        border: none;
        border-radius: 16px;
        margin: 0 5px;
        color: #000;
        border: 1px solid #E0E0E0;
        padding: 5px 10px;
    }

    .fc-direction-ltr .fc-button-group>.fc-button {
        background-color: #222;
        border: none;
        border-radius: 16px;
        border: 1px solid #E0E0E0;
        margin: 0 5px;
        padding: 5px 10px;
    }


    .fc-direction-ltr .fc-toolbar>*> :not(:first-child) {
        border: none;
        border-radius: 16px;
        opacity: 100%;
    }

    .fc .fc-scrollgrid-section-liquid>td {
        background-color: transparent;
    }

    #calendar {
        height: 92vh;
        border: none;
        margin-left: 8px;
        padding: 0;
    }

    #eventForm {
        background-color: #fff;
        padding: 14px;
        border-radius: 15px;
        border: 1px solid #E0E0E0;
        margin-bottom: 15px;
        height: 57vh;
    }

    .buscador {
        background-color: #fff;
        padding: 14px;
        border-radius: 15px;
        border: 1px solid #E0E0E0;
        width: 100%;
    }

    input {
        background-color: #f2f2f2;
        border: none;
        outline: none;
        font-size: 15px;
        padding: 5px;
        border-radius: 5px;
        color: black;
        display: block;
        width: 100%;
    }

    .apoyo-calendario {
        background-color: #f2f2f2;
        height: 92vh;
        border-radius: 0 30px 30px 0;
        width: 24%;
        padding: 12px;
        border-left: 1px solid #f2f2f2;
        display: flex;
        flex-direction: column;
        gap: 10px;
        justify-content: flex-start;
    }

    .minicalendario {
        text-align: center;
        width: 100%;
        overflow: auto;
        padding: 17px;
        padding-bottom: 0px;
        border: 1px solid #E0E0E0;
        background-color: #fff;
        border-radius: 20px;
        margin-top: auto;
        /* Asegura que el mini calendario se quede en la parte inferior */
    }

    .minicalendario ol {
        list-style: none;
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        margin: 0;
        padding: 0;
        margin-bottom: 25px;
    }

    .minicalendario li {
        font-size: 1.2ch;
    }

    .minicalendario h2 {
        margin-bottom: 4px;
        padding: 0;
        font-size: 18px;
        text-transform: capitalize;
    }

    .minicalendario .first-day {
        grid-column-start: var(--first-day-start, 0);
    }

    .minicalendario .day-name span {
        font-weight: bold;
        font-size: 12px;
        margin-bottom: 2px;
        padding: 4px;
        text-align: center;
        text-transform: capitalize;
    }

    .minicalendario .today span {
        background-color: #f04842;
        font-weight: bold;
        border-radius: 20%;
        color: white;
        padding: 4px;

    }

    .minicalendario .other-month {
        color: #aaa;
        /* Color gris para los días de los meses adyacentes */
    }

    .minicalendario .prevMonthButton,
    .minicalendario .nextMonthButton {
        background-color: transparent;
        margin-bottom: 10px;
        font-size: 12px;
    }

    .minicalendario .prevMonthButton:focus,
    .minicalendario .nextMonthButton:focus {
        border: none;
        outline: none;
        background-color: #f2f2f2;
        border-radius: 5px;
    }

    .fc-toolbar-title {
        text-transform: lowercase;
        font-family: "sf-black";
        color: #272727;
        padding-left: 14px;
    }

    .fc .fc-highlight {
        background-color: #f2f2f2;
    }

    .fc .fc-daygrid-day-frame:hover {
        background-color: #fff;
    }

    .label-form-event {
        font-size: 14px;
    }

    .form-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .form-group input {
        flex: 1;
        margin: 0 5px;
    }

    select {
        background-color: #f2f2f2;
        border: none;
        outline: none;
        font-size: 15px;
        padding: 6px;
        border-radius: 5px;
        color: black;
        display: block;
    }

    option {
        padding: 5px;
    }

    .fc-h-event .fc-event-main {
        color: black;
    }
</style>


<section>
    <div class="row">
        <div class="col-9" id="calendar"></div>
        <div class="apoyo-calendario" id="eventSidebar">
            <form id="eventForm">
                <label class="label-form-event" for="title">Evento</label>
                <div class="form-group">
                    <input type="text" placeholder="Título" id="title" name="title" required>
                    <select id="color" name="color">
                        <option value="#FF9800" style="background-color: #FF9800;">N</option>
                        <option value="#def5e6" style="background-color: #def5e6;">V</option>
                        <option value="#f2dae0" style="background-color: #f2dae0;">R</option>
                        <option value="#e0f2f7" style="background-color: #e0f2f7;">A</option>
                        <option value="#9E9E9E" style="background-color: #9E9E9E;">G</option>
                        <option value="#000000" style="background-color: #000000;">N</option>
                        <option value="#f4e8d2" style="background-color: #f4e8d2;">A</option>
                    </select>
                </div>


                <label class="label-form-event mt-3" for="description">Notas</label>
                <input type="textarea" id="description" placeholder="Escribe aquí tus notas" name="description">

                <label class="label-form-event mt-3" for="start">Fecha y Hora de Inicio</label>
                <div class="form-group">
                    <input type="date" id="startDate" name="startDate" required>
                    <input type="time" id="startTime" name="startTime" required>
                </div>

                <label class="label-form-event mt-3" for="end">Fecha y Hora de Fin</label>
                <div class="form-group">
                    <input type="date" id="endDate" name="endDate" required>
                    <input type="time" id="endTime" name="endTime" required>
                </div>



                <button type="submit" class="guardar mt-2">Guardar</button>
                <button type="button" id="deleteButton" style="display:none;">Borrar</button>
            </form>

            <div id="eventDetails" style="display:none;">
                <p><strong>Title:</strong> <span id="eventTitle"></span></p>
                <p><strong>Description:</strong> <span id="eventDescription"></span></p>
                <p><strong>Start:</strong> <span id="eventStart"></span></p>
                <p><strong>End:</strong> <span id="eventEnd"></span></p>
            </div>
            <div class="minicalendario">
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
        const monthName = intlForMonths.format(new Date(year, month));
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
                <h2>${monthName} ${year}</h2>
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
                right: 'prev,next dayGridMonth,timeGridWeek,timeGridDay'
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
                    fetch('<?= base_url('update-event') ?>', {
                        method: 'POST',
                        body: JSON.stringify({
                            id: info.event.id,
                            title: info.event.title,
                            description: info.event.extendedProps.description,
                            start: info.event.start.toISOString(),
                            end: info.event.end ? info.event.end.toISOString() : null,
                            color: info.event.backgroundColor
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

        document.getElementById('eventForm').addEventListener('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            var eventId = this.dataset.eventId;
            var start = document.getElementById('startDate').value + 'T' + document.getElementById('startTime').value;
            var end = document.getElementById('endDate').value + 'T' + document.getElementById('endTime').value;
            formData.append('start', start);
            formData.append('end', end);
            formData.append('color', document.getElementById('color').value);

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
    });


</script>

<?= $this->endSection() ?>