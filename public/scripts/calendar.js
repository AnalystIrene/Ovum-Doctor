/**
 * Initializes the FullCalendar instance with interactivity and event data.
 * @param {HTMLElement} calendarEl - The calendar DOM element where the calendar will be rendered.
 */
function initializeCalendar(calendarEl) {
    try {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: null // No buttons on the right for now
            },
            editable: true,
            selectable: true,
            selectMirror: true,
            dayMaxEvents: true, // Limit the number of events per day
            events: getEventData(), // Load events from a function
            eventContent: customizeEventContent, // Customize how event looks
            select: handleDateSelection, // Handle selecting a date range
            eventClick: handleEventClick, // Handle clicking an event
            eventDrop: handleEventDrop // Handle dragging/dropping an event
        });

        calendar.render(); // Render the calendar
    } catch (error) {
        console.error('Error initializing calendar:', error);
    }
}

/**
 * Function to return an array of event data.
 * You can replace this with a dynamic data source like an API.
 */
function getEventData() {
    return [
        {
            title: 'Sharifah N - Checkup',
            start: '2024-11-11T09:00:00',
            className: 'appointment-confirmed'
        },
        {
            title: 'Ryn M.A. - Follow-up',
            start: '2024-11-11T10:30:00',
            className: 'appointment-pending'
        },
        {
            title: 'Aine W.U. - Consultation',
            start: '2024-11-11T14:00:00',
            className: 'appointment-cancelled'
        }
    ];
}

/**
 * Customizes how the events are displayed on the calendar.
 * @param {Object} arg - The argument containing event details.
 */
function customizeEventContent(arg) {
    return {
        html: `
            <div class="custom-event">
                <span class="custom-event-dot"></span>
                ${arg.event.title}
            </div>
        `
    };
}

/**
 * Handles what happens when a date range is selected.
 * @param {Object} info - The information about the selected date range.
 */
function handleDateSelection(info) {
    var modal = new bootstrap.Modal(document.getElementById('newAppointmentModal'));
    modal.show(); // Open modal for a new appointment
}

/**
 * Handles the event click interaction.
 * @param {Object} info - The information about the clicked event.
 */
function handleEventClick(info) {
    alert('Appointment: ' + info.event.title);
}

/**
 * Handles the event drop interaction (when an event is moved to a new date).
 * @param {Object} info - The information about the dropped event.
 */
function handleEventDrop(info) {
    alert('Appointment moved to ' + info.event.startStr);
}

/**
 * Sets event listeners for calendar view buttons to switch views.
 */
function setCalendarViewButtons() {
    try {
        document.getElementById('calendarViewMonth').addEventListener('click', function() {
            FullCalendar.getCalendar('calendar').changeView('dayGridMonth');
        });

        document.getElementById('calendarViewWeek').addEventListener('click', function() {
            FullCalendar.getCalendar('calendar').changeView('timeGridWeek');
        });

        document.getElementById('calendarViewDay').addEventListener('click', function() {
            FullCalendar.getCalendar('calendar').changeView('timeGridDay');
        });
    } catch (error) {
        console.error('Error setting calendar view buttons:', error);
    }
}

// Initialize the calendar once the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    // Ensure calendar element exists before proceeding
    if (calendarEl) {
        initializeCalendar(calendarEl);
        setCalendarViewButtons(); // Set view button listeners after initializing calendar
    } else {
        console.error("Calendar element not found.");
    }
});