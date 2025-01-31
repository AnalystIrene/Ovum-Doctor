<div class="top-nav">
    <div class="logo-section">
        <div class="logo">
            <img src="{{ asset('images/GynLogo(2).png') }}" alt="Medical Center Logo">
        </div>
        <div class="headings">
            <h2>OVUM DOCTOR</h2>
            <h3>{{ config('app.clinic_name', 'Clinic Name') }}</h3>
        </div>
    </div>
    
    <div class="nav-links">
        <nav>
            <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a>
            <a href="{{ route('patients.index') }}"><i class="fas fa-user-injured"></i> Patient</a>
            <a href="{{ route('appointments.index') }}"><i class="fas fa-calendar-check"></i> Appointments</a>
            <a href="#" onclick="window.history.back()"><i class="fas fa-arrow-up"></i> Back</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" id="logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
        <button class="hamburger">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</div> 