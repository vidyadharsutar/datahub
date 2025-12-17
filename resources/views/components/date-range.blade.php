<style>
  /* Custom Input Field Styling */
  .date-range-picker-container {
    position: relative;
    width: 200px;
    /* Adjust width as needed */
    /* Space between input and other elements */
  }

  .date-range-input-display {
    height: 51px;
    width: auto;
        font-family: "Poppins";

    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 1.25rem;
    border: 1px solid #ced4da;
    border-radius: 14px;
    /* background-color: white; */
    cursor: pointer;
    color: #495057;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;

  }

  .date-range-input-display:hover {
    border-color: #a0a0a0;
  }

  .date-range-input-display.active {
    border-color: #6366f1;
    box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
  }

  .date-range-input-display .placeholder-text {
    color: var(--dark-color);
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    padding-top: 1rem;
  }

  .date-range-input-display .dropdown-arrow {
    width: 13.834px;
    height: 7.849px;
    color: var(--light-color) !important;
    transition: transform 0.2s ease;
  }

  .date-range-input-display.active .dropdown-arrow {
    transform: rotate(180deg);
  }

  /* Calendar Card Styling (from previous prompt) */
  .calendar-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border: 1px solid #e9ecef;
    width: 320px;
    padding: 1rem;
    position: absolute;
    /* Position relative to .date-range-picker-container */
    top: calc(100% + 8px);
    /* Position below the input with some gap */
    right: 0%;
    /* Shift to left of input */
    z-index: 1000;
    /* Ensure it's above other content */
    display: none;
    /* Hidden by default */
  }

  .calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 1rem;
    border-bottom: 1px solid #f1f3f4;
    margin-bottom: 1rem;
  }

  .calendar-header h5 {
    font-size: 1rem;
    font-weight: 600;
    color: #212529;
    margin-bottom: 0;
  }

  .calendar-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
  }

  .calendar-nav .nav-arrow {
    background: none;
    border: none;
    font-size: 1.2rem;
    color: #6c757d;
    cursor: pointer;
    padding: 0.25rem 0.5rem;
  }

  .calendar-nav .current-month {
    font-size: 1rem;
    font-weight: 600;
    color: #6366f1;
    /* Purple color from screenshot */
  }

  .calendar-weekdays {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    text-align: center;
    margin-bottom: 0.5rem;
  }

  .calendar-weekdays div {
    font-size: 0.75rem;
    font-weight: 500;
    color: #6c757d;
    text-transform: uppercase;
    padding: 0.5rem 0;
  }

  .calendar-days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    text-align: center;
  }

  .calendar-day {
    font-size: 0.875rem;
    font-weight: 400;
    color: #212529;
    padding: 0.5rem 0;
    cursor: pointer;
    border-radius: 8px;
    position: relative;
    z-index: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 36px;
    /* Ensure consistent height for cells */
    width: 36px;
    /* Ensure consistent width for cells */
    margin: auto;
    /* Center the day within its grid cell */
  }

  .calendar-day.empty {
    visibility: hidden;
    cursor: default;
  }

  .calendar-day.disabled-for-range {
    /* New class for dates before startDate */
    color: #adb5bd;
    /* Lighter color for disabled dates */
    cursor: not-allowed;
    opacity: 0.6;
  }

  .calendar-day.selected {
    background-color: #6366f1;
    /* Purple background for selected date */
    color: white;
    font-weight: 600;
    border-radius: 50%;
    /* Circular highlight */
  }

  .calendar-day.in-range {
    background-color: #e2d9f3;
    /* Light purple for range */
    color: #212529;
    border-radius: 0;
    /* Square for range */
  }

  /* Adjust border-radius for range ends */
  .calendar-day.range-start {
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
  }

  .calendar-day.range-end {
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
  }

  /* Ensure selected date is always circular even if part of a range */
  .calendar-day.selected.in-range {
    border-radius: 50%;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .calendar-card {
      width: 100%;
    }

    .date-range-picker-container {
      width: 100%;
    }
  }
</style>
<div class="date-range-picker-container">
  <div class="date-range-input-display mt-3" id="dateRangeInputDisplay">
    <p class="placeholder-text" id="dateRangeText">Date Range</p>
    <span class="dropdown-arrow">
      <i class="fas fa-chevron-down"></i>
    </span>
  </div>

  <div class="calendar-card" id="calendarCard">
    <div class="calendar-header">
      <h5>Select Range</h5>
    </div>
    <div class="calendar-nav">
      <button class="nav-arrow" id="prevMonth"><i class="fas fa-chevron-left"></i></button>
      <span class="current-month" id="currentMonthDisplay"></span>
      <button class="nav-arrow" id="nextMonth"><i class="fas fa-chevron-right"></i></button>
    </div>
    <div class="calendar-weekdays">
      <div>MON</div>
      <div>TUE</div>
      <div>WED</div>
      <div>THU</div>
      <div>FRI</div>
      <div>SAT</div>
      <div>SUN</div>
    </div>
    <div class="calendar-days" id="calendarDays"></div>
    <input type="hidden" id="hiddenDateRangeInput" name="date_range">
  </div>
</div>

@push('scripts')
  <script>
    const dateRangeInputDisplay = document.getElementById('dateRangeInputDisplay');
    const calendarCard = document.getElementById('calendarCard');
    const calendarDays = document.getElementById('calendarDays');
    const currentMonthDisplay = document.getElementById('currentMonthDisplay');
    const prevMonthBtn = document.getElementById('prevMonth');
    const nextMonthBtn = document.getElementById('nextMonth');
    const hiddenDateRangeInput = document.getElementById('hiddenDateRangeInput');

    let currentDate = new Date();
    let startDate = null;
    let endDate = null;
    let isDragging = false;

    function formatDate(date) {
    return date ? date.toISOString().split('T')[0] : '';
    }

    function updateHiddenInput() {
    if (startDate && endDate) {
      hiddenDateRangeInput.value = `${formatDate(startDate)}|${formatDate(endDate)}`;
    } else {
      hiddenDateRangeInput.value = '';
    }
    }

    function renderCalendar() {
    calendarDays.innerHTML = '';
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    currentMonthDisplay.textContent = currentDate.toLocaleDateString('en-US', {
      month: 'long',
      year: 'numeric'
    });

    const firstDayOfMonth = new Date(year, month, 1).getDay();
    const startDayIndex = firstDayOfMonth === 0 ? 6 : firstDayOfMonth - 1;
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    for (let i = 0; i < startDayIndex; i++) {
      const empty = document.createElement('div');
      empty.className = 'calendar-day empty';
      calendarDays.appendChild(empty);
    }

    for (let d = 1; d <= daysInMonth; d++) {
      const dayEl = document.createElement('div');
      const thisDate = new Date(year, month, d);
      thisDate.setHours(0, 0, 0, 0);
      dayEl.className = 'calendar-day';
      dayEl.textContent = d;
      dayEl.dataset.date = thisDate.toISOString();

      if (startDate && endDate) {
      const s = new Date(startDate), e = new Date(endDate);
      s.setHours(0, 0, 0, 0); e.setHours(0, 0, 0, 0);
      if (thisDate >= s && thisDate <= e) {
        dayEl.classList.add('in-range');
        if (thisDate.getTime() === s.getTime()) dayEl.classList.add('range-start');
        if (thisDate.getTime() === e.getTime()) dayEl.classList.add('range-end');
      }
      }

      if (startDate && thisDate.getTime() === startDate.getTime()) {
      dayEl.classList.add('selected');
      }
      if (endDate && thisDate.getTime() === endDate.getTime()) {
      dayEl.classList.add('selected');
      }

      dayEl.addEventListener('mousedown', () => {
      startDate = thisDate;
      endDate = null;
      isDragging = true;
      renderCalendar();
      });

      dayEl.addEventListener('mouseenter', () => {
      if (isDragging && startDate) {
        const dragDate = new Date(thisDate);
        if (dragDate < startDate) {
        endDate = startDate;
        startDate = dragDate;
        } else {
        endDate = dragDate;
        }
        renderCalendar();
      }
      });

      dayEl.addEventListener('mouseup', () => {
      isDragging = false;
      updateHiddenInput();
      });

      calendarDays.appendChild(dayEl);
    }

    updateHiddenInput();
    }

    dateRangeInputDisplay.addEventListener('click', () => {
    const isVisible = calendarCard.style.display === 'block';
    calendarCard.style.display = isVisible ? 'none' : 'block';
    });

    document.addEventListener('click', (e) => {
    const isInside = dateRangeInputDisplay.contains(e.target) || calendarCard.contains(e.target);
    if (!isInside) {
      calendarCard.style.display = 'none';
    }
    });

    prevMonthBtn.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
    });

    nextMonthBtn.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
    });

    renderCalendar();
  </script>
@endpush