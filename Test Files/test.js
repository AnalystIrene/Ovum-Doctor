const monthDropdown = document.getElementById("monthDropdown");
const yearDropdown = document.getElementById("yearDropdown");
const calendarDays = document.getElementById("calendarDays");

const months = [
  "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

const currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth();
let currentDate = new Date().getDate();

// Populate month and year dropdowns
function populateDropdowns() {
  for (let i = 0; i < months.length; i++) {
    const option = document.createElement("option");
    option.value = i;
    option.text = months[i];
    monthDropdown.add(option);
  }

  for (let i = currentYear - 10; i <= currentYear + 10; i++) {
    const option = document.createElement("option");
    option.value = i;
    option.text = i;
    yearDropdown.add(option);
  }

  monthDropdown.value = currentMonth;
  yearDropdown.value = currentYear;
}

// Render the calendar based on the selected month and year
function renderCalendar(month, year) {
  calendarDays.innerHTML = ""; // Clear previous days
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const daysInMonth = lastDay.getDate();
  const startDay = firstDay.getDay(); // Day of the week for the first day

  // Empty spaces for alignment
  for (let i = 0; i < startDay; i++) {
    const emptyDiv = document.createElement("div");
    calendarDays.appendChild(emptyDiv);
  }

  // Fill in the days
  for (let i = 1; i <= daysInMonth; i++) {
    const dayDiv = document.createElement("div");
    dayDiv.textContent = i;
    
    // Add marking for specific dates
    if (i === 7 || i === 8 || i === 9) {
      dayDiv.classList.add("circle-heavy");
    } else if (i === 10) {
      dayDiv.classList.add("light");
    } else {
      dayDiv.classList.add("normal");
    }

    calendarDays.appendChild(dayDiv);
  }
}

// Event listeners for dropdown changes
monthDropdown.addEventListener("change", function () {
  currentMonth = parseInt(this.value);
  renderCalendar(currentMonth, parseInt(yearDropdown.value));
});

yearDropdown.addEventListener("change", function () {
  renderCalendar(currentMonth, parseInt(this.value));
});

// Initialize
populateDropdowns();
renderCalendar(currentMonth, currentYear);

