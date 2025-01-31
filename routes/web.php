use App\Http\Controllers\Auth\LoginController;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'attempt'])->name('login.attempt');
});

Route::post('logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('patients', 'PatientController');
    Route::resource('appointments', 'AppointmentController');
    Route::get('appointments/today', 'AppointmentController@today')->name('appointments.today');
    Route::get('analytics', 'AnalyticsController@index')->name('analytics');
    Route::get('settings', 'SettingsController@index')->name('settings');
}); 