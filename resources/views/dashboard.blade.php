@extends('layouts.app')

@section('title', 'Dashboard - Ovum Doctor')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 sidebar p-4">
        <h4 class="mb-4">Ovum Doctor</h4>
        <nav class="nav flex-column">
            <a class="nav-link active" href="{{ route('dashboard') }}"><i class="fas fa-home me-2"></i>Dashboard</a>
            <a class="nav-link" href="{{ route('appointments.index') }}"><i class="fas fa-calendar me-2"></i>Appointments</a>
            <a class="nav-link" href="{{ route('patients.index') }}"><i class="fas fa-users me-2"></i>Patients</a>
            <a class="nav-link" href="{{ route('analytics') }}"><i class="fas fa-chart-line me-2"></i>Analytics</a>
            <a class="nav-link" href="{{ route('settings') }}"><i class="fas fa-cog me-2"></i>Settings</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="col-md-10 p-4">
        <!-- Welcome Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Welcome back, Dr. {{ Auth::user()->name }}!</h2>
            <div>
                <button class="btn btn-outline-secondary me-2">
                    <i class="fas fa-envelope"></i> Messages
                </button>
                <button class="btn btn-outline-primary me-2">
                    <i class="fas fa-bell"></i>
                </button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newAppointmentModal">
                    <i class="fas fa-plus me-2"></i>New Appointment
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stats-card bg-primary text-white">
                    <div class="card-body">
                        <h6>Today's Appointments</h6>
                        <h2>{{ $todayAppointments }}</h2>
                        <p class="mb-0"><i class="fas fa-arrow-up me-2"></i>{{ $appointmentIncrease }}% increase</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card bg-success text-white">
                    <div class="card-body">
                        <h6>Completed</h6>
                        <h2>{{ $completedAppointments }}</h2>
                        <p class="mb-0">{{ $completionRate }}% of daily target</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card bg-info text-white">
                    <div class="card-body">
                        <h6>Pending</h6>
                        <h2>{{ $pendingAppointments }}</h2>
                        <p class="mb-0">Next in {{ $nextAppointmentIn }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card bg-warning text-white">
                    <div class="card-body">
                        <h6>Cancelled</h6>
                        <h2>{{ $cancelledAppointments }}</h2>
                        <p class="mb-0">Today's cancellations</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar and Patient List -->
        <div class="row">
            <div class="col-md-8 mb-4">
                <div class="calendar-container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>Appointment Calendar</h4>
                        <div class="btn-group">
                            <button class="btn text-primary btn-sm" id="calendarViewMonth">Monthly</button>
                            <button class="btn text-primary btn-sm" id="calendarViewWeek">Weekly</button>
                            <button class="btn text-primary btn-sm" id="calendarViewDay">Daily</button>
                        </div>
                    </div>
                    <div id="calendar" class="responsive-calendar"></div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="patient-list">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4>Today's Patients</h4>
                        <a href="{{ route('appointments.today') }}" class="btn btn-sm text-primary">View All</a>
                    </div>
                    <div class="list-group">
                        @foreach($todayPatients as $patient)
                        <a href="{{ route('patients.show', $patient->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $patient->name }}</h6>
                                <small>{{ $patient->appointment_time }}</small>
                            </div>
                            <p class="mb-1">{{ $patient->appointment_type }}</p>
                            <small class="text-{{ $patient->status_color }}">{{ $patient->status }}</small>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Appointment Modal -->
@include('appointments.partials.create-modal')
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: null
        },
        editable: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: true,
        eventContent: function(arg) {
            return {
                html: `
                    <div class="custom-event">
                        <span class="custom-event-dot"></span>
                        ${arg.event.title}
                    </div>
                `
            }
        },
        events: @json($calendarEvents),
        select: function(info) {
            $('#newAppointmentModal').modal('show');
        },
        eventClick: function(info) {
            window.location.href = `/appointments/${info.event.id}`;
        },
        eventDrop: function(info) {
            // Handle appointment rescheduling via AJAX
            axios.patch(`/appointments/${info.event.id}/reschedule`, {
                start: info.event.startStr
            }).catch(function(error) {
                info.revert();
                alert('Failed to reschedule appointment');
            });
        }
    });
    calendar.render();

    // View buttons functionality
    document.getElementById('calendarViewMonth').addEventListener('click', function() {
        calendar.changeView('dayGridMonth');
    });
    document.getElementById('calendarViewWeek').addEventListener('click', function() {
        calendar.changeView('timeGridWeek');
    });
    document.getElementById('calendarViewDay').addEventListener('click', function() {
        calendar.changeView('timeGridDay');
    });
});

// Mobile menu toggle
const hamburger = document.querySelector('.hamburger');
const topNav = document.querySelector('.top-nav');

hamburger.addEventListener('click', () => {
    topNav.classList.toggle('active');
});

// Close mobile menu when clicking outside
document.addEventListener('click', (e) => {
    if (!topNav.contains(e.target) && topNav.classList.contains('active')) {
        topNav.classList.remove('active');
    }
});

// Close mobile menu when window is resized above mobile breakpoint
window.addEventListener('resize', () => {
    if (window.innerWidth > 767 && topNav.classList.contains('active')) {
        topNav.classList.remove('active');
    }
});
</script>
@endsection 