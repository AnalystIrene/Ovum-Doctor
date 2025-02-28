@extends('layouts.app')

@section('title', 'Dashboard - Ovum Doctor')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
<link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <nav class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-home me-2"></i>Dashboard
                </a>
                <a class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}" href="{{ route('appointments.index') }}">
                    <i class="fas fa-calendar me-2"></i>Appointments
                </a>
                <a class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}" href="{{ route('patients.index') }}">
                    <i class="fas fa-users me-2"></i>Patients
                </a>
                <a class="nav-link {{ request()->routeIs('analytics') ? 'active' : '' }}" href="{{ route('analytics') }}">
                    <i class="fas fa-chart-line me-2"></i>Analytics
                </a>
                <a class="nav-link {{ request()->routeIs('settings') ? 'active' : '' }}" href="{{ route('settings') }}">
                    <i class="fas fa-cog me-2"></i>Settings
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 main-content">
            <!-- Welcome Section -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="welcome-text">Welcome back, Dr. {{ Auth::user()->name }}!</h4>
                <div class="action-buttons">
                    <button class="btn btn-outline-secondary btn-sm me-2">
                        <i class="fas fa-envelope"></i> Messages
                    </button>
                    <button class="btn btn-outline-primary btn-sm me-2">
                        <i class="fas fa-bell"></i>
                    </button>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#newAppointmentModal">
                        <i class="fas fa-plus me-1"></i>New Appointment
                    </button>
                </div>
            </div>
            {{-- {{dd($todayAppointments, $appointmentIncrease, $completedAppointments, $completionRate, $pendingAppointments, $nextAppointmentIn, $cancelledAppointments, $todayPatients, $calendarEvents)}} --}}
            <!-- Stats Cards -->
            <div class="row g-3 mb-3">
                <div class="col-md-3">                    
                    <div class="card stats-card bg-primary text-white">
                        <div class="card-body">
                            <h6 class="card-subtitle">Today's Appointments</h6>
                            <h2 class="card-title mb-2">{{ $todayAppointments }}</h2>
                            <p class="card-text"><i class="fas fa-arrow-up me-1"></i>{{ $appointmentIncrease }}% increase</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stats-card bg-success text-white">
                        <div class="card-body">
                            <h6 class="card-subtitle">Completed</h6>
                            <h2 class="card-title mb-2">{{ $completedAppointments }}</h2>
                            <p class="card-text">{{ $completionRate }}% of daily target</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stats-card bg-info text-white">
                        <div class="card-body">
                            <h6 class="card-subtitle">Pending</h6>
                            <h2 class="card-title mb-2">{{ $pendingAppointments }}</h2>
                            <p class="card-text">Next in {{ $nextAppointmentIn }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stats-card bg-warning text-white">
                        <div class="card-body">
                            <h6 class="card-subtitle">Cancelled</h6>
                            <h2 class="card-title mb-2">{{ $cancelledAppointments }}</h2>
                            <p class="card-text">Today's cancellations</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calendar and Patient List -->
            <div class="row g-3">
                <div class="col-md-8">
                    <div class="calendar-container" id="expandableDiv">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Appointment Calendar</h5>
                            <button class="btn btn-sm">
                                <span class="fas fa-expand expand-icon" onclick="toggleFullscreen('expandableDiv')"></span>
                            </button>
                            <div class="btn-group">
                                <button class="btn btn-outline-secondary btn-sm" id="calendarViewMonth">Monthly</button>
                                <button class="btn btn-outline-secondary btn-sm" id="calendarViewWeek">Weekly</button>
                                <button class="btn btn-outline-secondary btn-sm" id="calendarViewDay">Daily</button>
                            </div>
                        </div>
                        <div id="calendar" class="responsive-calendar"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="patient-list">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0">Today's Patients</h5>
                            <a href="{{ route('appointments.today') }}" class="btn btn-link btn-sm p-0">View All</a>
                        </div>
                        <div class="list-group">
                            @foreach($todayPatients as $patient)
                            <a href="{{ route('patients.show', $patient->id) }}" class="list-group-item list-group-item-action">
                                @foreach($patient->appointments as $appointment)
                                {{-- {{{ dd($appointment) }}} --}}
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $patient->name }}</h6>
                                    <small>{{$appointment->start_time}}</small>
                                </div>
                                <p class="mb-1">{{ $appointment->appointment_type }}</p>
                                {{-- <small class="text-{{ $appointment->status_color }}">{{ $appointment->status }}</small>
                                 TODO: implement a class that provides the color of the appointment status since its not stored in the db--}} 
                                <small class="text-{{ $appointment->status_color }}">{{ $appointment->status }}</small>
                                @endforeach
                            </a>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Appointment Modal -->
@include('appointments.partials.create-modal')
@include('appointments.partials.show-modal')
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // prepare to load appointment modal 
        function loadAppointmentDetails(appointmentId) {
            $.get(`/appointments/${appointmentId}`, function(response) {
                $('#appointmentModalContent').html(response);
                $('#appointmentModal').modal('show');
            });
        }

        // calendar function
        console.log("Creating Calendar");
        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
            initialView: 'dayGridMonth',
            height: 'auto',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            },
            handleWindowResize: true,
            expandRows: true,
            stickyHeaderDates: true,
            editable: true,
            selectable: true,
            selectMirror: true,
            dayMaxEvents: true,
            scrollTime: '00:00',
            slotDuration: '00:30:00',
            firstDay: 1,
            
            eventMouseEnter: function(info) {
                info.el.style.cursor = 'pointer';
            },
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
                $('#createAppointmentModal').modal('show');
                $('#createAppointmentForm').on('submit', function(e) {
                    e.preventDefault();
                    
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.success) {
                                // Add the new event to the calendar
                                calendar.addEvent(response.event);
                                
                                // Update modal content
                                $('#appointmentModalContent').html(response.modalContent);
                                
                                // Hide create modal and show details modal
                                $('#createAppointmentModal').modal('hide');
                                $('#appointmentModal').modal('show');
                                
                                // Optional: Clear the form
                                $('#createAppointmentForm')[0].reset();
                            }
                        },
                        error: function(xhr) {
                            // Handle errors (show validation messages, etc.)
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON;
                                // Display errors to user
                                alert(errors.message || 'Error creating appointment');
                            }
                        }
                    });
                });
            },
            eventClick: function(info) {
                loadAppointmentDetails(info.event.id);
            },
            eventDrop: function(info) {
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

        // Improved scroll handling
        document.getElementById('calendar').addEventListener('wheel', function(e) {
            if (Math.abs(e.deltaY) < 70) {  
                return;
            }
            
            if (e.deltaY > 0) {
                calendar.next(); 
            } else {
                calendar.prev(); 
            }
            e.preventDefault();
        });
        
        // If you want to use the toggleFullscreen function, add a click handler
        document.getElementById('calendar').addEventListener('dblclick', function() {
            toggleFullscreen('calendar');
        });
    });

    // Move toggleFullscreen outside the DOMContentLoaded event
    function toggleFullscreen(divId) {
        let div = document.getElementById(divId);
        if(div.classList.contains('fullscreen')) {
            div.classList.remove('fullscreen');
            div.classList.add('calendar-container');
        } else {
            div.classList.remove('calendar-container');
            div.classList.add('fullscreen');
        }
    }
</script>
@endsection