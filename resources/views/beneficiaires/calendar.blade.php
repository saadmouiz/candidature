@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .calendar-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }
    
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .calendar-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1f2937;
    }
    
    .calendar-controls {
        display: flex;
        gap: 0.5rem;
    }
    
    .control-btn {
        padding: 0.5rem 1rem;
        background-color: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        color: #4b5563;
        transition: all 0.2s;
    }
    
    .control-btn:hover {
        background-color: #e5e7eb;
    }
    
    .control-btn.active {
        background-color: #ef4444;
        border-color: #ef4444;
        color: white;
    }
    
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 0.5rem;
    }
    
    .calendar-day-header {
        font-weight: 600;
        color: #374151;
        text-align: center;
        padding: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .calendar-day {
        min-height: 120px;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        padding: 0.5rem;
        background-color: white;
    }
    
    .calendar-day.other-month {
        background-color: #f9fafb;
        opacity: 0.7;
    }
    
    .calendar-day-number {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #374151;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .today-marker {
        background-color: #ef4444;
        color: white;
        border-radius: 9999px;
        width: 1.75rem;
        height: 1.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .appointment-list {
        display: flex;
        flex-direction: column;
        gap: 0.375rem;
    }
    
    .appointment-item {
        font-size: 0.75rem;
        padding: 0.375rem 0.5rem;
        border-radius: 0.25rem;
        position: relative;
        cursor: pointer;
        transition: all 0.15s;
    }
    
    .appointment-item.status-pending {
        background-color: #e0f2fe;
        border-left: 3px solid #0ea5e9;
    }
    
    .appointment-item.status-confirmed {
        background-color: #dcfce7;
        border-left: 3px solid #10b981;
    }
    
    .appointment-item.status-absent {
        background-color: #fee2e2;
        border-left: 3px solid #ef4444;
    }
    
    .appointment-time {
        font-weight: 600;
        color: #4b5563;
    }
    
    .appointment-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .appointment-details {
        display: none;
        position: absolute;
        left: 100%;
        top: 0;
        width: 220px;
        background-color: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        padding: 0.75rem;
        z-index: 10;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .appointment-item:hover .appointment-details {
        display: block;
    }
    
    .appointment-details-name {
        font-weight: 600;
        margin-bottom: 0.375rem;
        color: #1f2937;
    }
    
    .appointment-details-info {
        font-size: 0.75rem;
        margin-bottom: 0.25rem;
        color: #4b5563;
    }
    
    .appointment-details-status {
        font-weight: 500;
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 9999px;
        display: inline-block;
        margin-bottom: 0.5rem;
    }
    
    .appointment-details-status.status-pending {
        background-color: #e0f2fe;
        color: #0284c7;
    }
    
    .appointment-details-status.status-confirmed {
        background-color: #dcfce7;
        color: #059669;
    }
    
    .appointment-details-status.status-absent {
        background-color: #fee2e2;
        color: #dc2626;
    }
    
    .appointment-details-actions {
        margin-top: 0.5rem;
        display: flex;
        gap: 0.5rem;
    }
    
    .appointment-action {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        background-color: #f3f4f6;
        color: #4b5563;
        text-decoration: none;
        transition: all 0.15s;
    }
    
    .appointment-action:hover {
        background-color: #e5e7eb;
    }
    
    .appointment-action.primary {
        background-color: #ef4444;
        color: white;
    }
    
    .appointment-action.primary:hover {
        background-color: #dc2626;
    }
    
    .empty-day-message {
        font-size: 0.75rem;
        color: #9ca3af;
        text-align: center;
        margin-top: 1rem;
    }
    
    @media (max-width: 768px) {
        .calendar-grid {
            grid-template-columns: repeat(1, 1fr);
        }
        
        .calendar-day-header {
            display: none;
        }
        
        .calendar-day {
            min-height: auto;
            margin-bottom: 1rem;
        }
        
        .appointment-details {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 320px;
            z-index: 100;
        }
        
        .calendar-day.empty-day {
            display: none;
        }
    }
</style>
@endsection

@section('content')
<div class="calendar-container">
    <div class="calendar-header">
        <h1 class="calendar-title">Calendrier des rendez-vous</h1>
        <div class="calendar-controls">
            <a href="{{ route('beneficiaire.index') }}" class="control-btn">
                <i class="fas fa-users"></i> Bénéficiaires
            </a>
            <button id="prev-month" class="control-btn">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button id="current-month" class="control-btn active">
                Aujourd'hui
            </button>
            <button id="next-month" class="control-btn">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
    
    <div id="calendar-view">
        <div class="calendar-month">
            <h2 class="text-lg font-semibold mb-3" id="month-year-display"></h2>
            
            <div class="calendar-grid">
                <div class="calendar-day-header">Dim</div>
                <div class="calendar-day-header">Lun</div>
                <div class="calendar-day-header">Mar</div>
                <div class="calendar-day-header">Mer</div>
                <div class="calendar-day-header">Jeu</div>
                <div class="calendar-day-header">Ven</div>
                <div class="calendar-day-header">Sam</div>
            </div>
            
            <div class="calendar-grid" id="calendar-days"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get appointments data from PHP
    const appointmentsData = @json($appointments);
    console.log('Appointments:', appointmentsData);
    
    // Current date tracking
    let currentDate = new Date();
    let displayedMonth = currentDate.getMonth();
    let displayedYear = currentDate.getFullYear();
    
    // Initial calendar render
    renderCalendar(displayedMonth, displayedYear);
    
    // Event listeners for controls
    document.getElementById('prev-month').addEventListener('click', function() {
        displayedMonth--;
        if (displayedMonth < 0) {
            displayedMonth = 11;
            displayedYear--;
        }
        renderCalendar(displayedMonth, displayedYear);
    });
    
    document.getElementById('current-month').addEventListener('click', function() {
        const today = new Date();
        displayedMonth = today.getMonth();
        displayedYear = today.getFullYear();
        renderCalendar(displayedMonth, displayedYear);
    });
    
    document.getElementById('next-month').addEventListener('click', function() {
        displayedMonth++;
        if (displayedMonth > 11) {
            displayedMonth = 0;
            displayedYear++;
        }
        renderCalendar(displayedMonth, displayedYear);
    });
    
    // Function to render the calendar
    function renderCalendar(month, year) {
        const calendarDays = document.getElementById('calendar-days');
        const monthYearDisplay = document.getElementById('month-year-display');
        
        // Clear previous calendar
        calendarDays.innerHTML = '';
        
        // Set month and year display
        const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        monthYearDisplay.textContent = `${monthNames[month]} ${year}`;
        
        // Get the first day of the month
        const firstDay = new Date(year, month, 1);
        const startingDay = firstDay.getDay(); // 0 = Sunday, 1 = Monday, etc.
        
        // Get the number of days in the month
        const lastDay = new Date(year, month + 1, 0);
        const totalDays = lastDay.getDate();
        
        // Get the last day of the previous month
        const prevMonthLastDay = new Date(year, month, 0).getDate();
        
        // Get today's date for highlighting
        const today = new Date();
        const currentDay = today.getDate();
        const currentMonth = today.getMonth();
        const currentYear = today.getFullYear();
        
        // Calculate how many rows we need (6 just to be safe)
        const totalCells = 42; // 6 rows x 7 days
        
        for (let i = 0; i < totalCells; i++) {
            let day;
            let dateString;
            let isCurrentMonth = true;
            let isToday = false;
            
            // Previous month days
            if (i < startingDay) {
                day = prevMonthLastDay - (startingDay - i - 1);
                isCurrentMonth = false;
                
                // Format date string for previous month
                let prevMonth = month - 1;
                let prevYear = year;
                if (prevMonth < 0) {
                    prevMonth = 11;
                    prevYear--;
                }
                const prevMonthStr = (prevMonth + 1).toString().padStart(2, '0');
                const dayStr = day.toString().padStart(2, '0');
                dateString = `${prevYear}-${prevMonthStr}-${dayStr}`;
            } 
            // Current month days
            else if (i < startingDay + totalDays) {
                day = i - startingDay + 1;
                
                // Check if it's today
                isToday = day === currentDay && month === currentMonth && year === currentYear;
                
                // Format date string for current month
                const monthStr = (month + 1).toString().padStart(2, '0');
                const dayStr = day.toString().padStart(2, '0');
                dateString = `${year}-${monthStr}-${dayStr}`;
            } 
            // Next month days
            else {
                day = i - (startingDay + totalDays) + 1;
                isCurrentMonth = false;
                
                // Format date string for next month
                let nextMonth = month + 1;
                let nextYear = year;
                if (nextMonth > 11) {
                    nextMonth = 0;
                    nextYear++;
                }
                const nextMonthStr = (nextMonth + 1).toString().padStart(2, '0');
                const dayStr = day.toString().padStart(2, '0');
                dateString = `${nextYear}-${nextMonthStr}-${dayStr}`;
            }
            
            // Check if this date has appointments
            const hasAppointments = appointmentsData.hasOwnProperty(dateString);
            
            // Only show 6 weeks if necessary, otherwise 5 weeks
            if (i >= 35 && !hasAppointments && isCurrentMonth === false) {
                continue;
            }
            
            // Create the day element
            const dayElement = document.createElement('div');
            dayElement.className = `calendar-day ${isCurrentMonth ? '' : 'other-month'} ${!hasAppointments && !isToday ? 'empty-day' : ''}`;
            
            // Create day number display
            const dayNumberElement = document.createElement('div');
            dayNumberElement.className = 'calendar-day-number';
            
            if (isToday) {
                const todayMarker = document.createElement('div');
                todayMarker.className = 'today-marker';
                todayMarker.textContent = day;
                dayNumberElement.appendChild(todayMarker);
            } else {
                dayNumberElement.textContent = day;
            }
            
            dayElement.appendChild(dayNumberElement);
            
            // Add appointments for this day if any
            if (hasAppointments) {
                const appointmentsList = document.createElement('div');
                appointmentsList.className = 'appointment-list';
                
                appointmentsData[dateString].forEach(appointment => {
                    const appointmentItem = document.createElement('div');
                    appointmentItem.className = `appointment-item status-${appointment.status}`;
                    
                    appointmentItem.innerHTML = `
                        <div class="appointment-time">${appointment.time}</div>
                        <div class="appointment-name">${appointment.name}</div>
                        <div class="appointment-details">
                            <div class="appointment-details-name">${appointment.name}</div>
                            <div class="appointment-details-info">
                                <strong>Heure:</strong> ${appointment.time}
                            </div>
                            <div class="appointment-details-status status-${appointment.status}">
                                ${appointment.status === 'confirmed' ? 'Présence confirmée' : 
                                 (appointment.status === 'absent' ? 'Absent' : 'En attente')}
                            </div>
                            <div class="appointment-details-actions">
                                <a href="${routes.beneficiaireShow.replace(':id', appointment.id)}" 
                                   class="appointment-action primary">
                                    Voir profil
                                </a>
                            </div>
                        </div>
                    `;
                    
                    appointmentsList.appendChild(appointmentItem);
                });
                
                dayElement.appendChild(appointmentsList);
            } else if (isCurrentMonth) {
                const emptyMessage = document.createElement('div');
                emptyMessage.className = 'empty-day-message';
                emptyMessage.textContent = 'Aucun rendez-vous';
                dayElement.appendChild(emptyMessage);
            }
            
            calendarDays.appendChild(dayElement);
        }
    }
});

// Define routes for JavaScript
const routes = {
    beneficiaireShow: "{{ route('beneficiaire.show', ':id') }}"
};
</script>
@endsection 