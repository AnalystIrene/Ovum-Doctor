const calendar = document.getElementById("calendar");
const monthYear = document.getElementById("month-year");
const selectedDateElement = document.getElementById("selected-date");
const noteContent = document.getElementById("note-content");
const saveNoteButton = document.getElementById("save-note");
const prevMonthButton = document.getElementById("prev-month");
const nextMonthButton = document.getElementById("next-month");

let currentDate = new Date();
let selectedDayElement = null; // To track the selected day

// Function to get the number of days in a month
function getDaysInMonth(month, year) {
    return new Date(year, month + 1, 0).getDate();
}

// Function to generate the calendar
function generateCalendar(date) {
    calendar.innerHTML = ''; // Clear the previous calendar
    const month = date.getMonth();
    const year = date.getFullYear();
    const daysInMonth = getDaysInMonth(month, year);
    
    const firstDay = new Date(year, month, 1).getDay(); // First day of the month
    const daysInPrevMonth = getDaysInMonth(month - 1, year);

    // Display month and year
    monthYear.textContent = date.toLocaleString('default', { month: 'long' }) + ' ' + year;

    // Filling in days from the previous month
    for (let i = firstDay - 1; i >= 0; i--) {
        const prevDayDiv = document.createElement("div");
        prevDayDiv.textContent = daysInPrevMonth - i;
        prevDayDiv.classList.add('inactive');
        calendar.appendChild(prevDayDiv);
    }

    // Adding days of the current month
    for (let i = 1; i <= daysInMonth; i++) {
        const dayDiv = document.createElement("div");
        dayDiv.textContent = i;
        dayDiv.addEventListener("click", (event) => openNotes(i, event)); // Pass event to openNotes
        calendar.appendChild(dayDiv);
    }
}

// Function to open notes for a specific date
function openNotes(day, event) {
    selectedDateElement.textContent = `${day}-${currentDate.getMonth() + 1}-${currentDate.getFullYear()}`;
    const savedNote = localStorage.getItem(`note-${day}-${currentDate.getMonth() + 1}-${currentDate.getFullYear()}`) || "";
    noteContent.value = savedNote;

    // Remove highlight from previously selected day
    if (selectedDayElement) {
        selectedDayElement.classList.remove('selected-day');
    }

    // Highlight the newly clicked day
    selectedDayElement = event.target; // Assign the clicked element to selectedDayElement
    selectedDayElement.classList.add('selected-day');
}

// Save note to local storage
saveNoteButton.addEventListener("click", () => {
    const day = selectedDateElement.textContent;
    if (day !== "None") {
        localStorage.setItem(`note-${day}`, noteContent.value);
        alert("Note saved!");
    }
});

// Event listeners for month navigation
prevMonthButton.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    generateCalendar(currentDate);
});

nextMonthButton.addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    generateCalendar(currentDate);
});

// Generate the calendar on page load
generateCalendar(currentDate);





















































