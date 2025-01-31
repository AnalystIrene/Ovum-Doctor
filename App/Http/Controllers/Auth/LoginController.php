<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login attempt.
     */
    public function attempt(Request $request): JsonResponse
    {
        $request->validate([
            'clinic' => 'required|string',
            'doctor_name' => 'required|string',
            'login_method' => 'required|in:password,otp',
            'auth_value' => 'required|string'
        ]);

        // Find the clinic
        $clinic = Clinic::where('name', $request->clinic)->first();
        if (!$clinic) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid clinic name'
            ], 422);
        }

        // Find the doctor
        $doctor = Doctor::where('clinic_id', $clinic->id)
                       ->where('name', $request->doctor_name)
                       ->first();
        if (!$doctor) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid doctor name'
            ], 422);
        }

        // Handle authentication based on method
        if ($request->login_method === 'password') {
            return $this->handlePasswordLogin($request, $doctor);
        } else {
            return $this->handleOTPLogin($request, $doctor);
        }
    }

    /**
     * Handle password-based login.
     */
    private function handlePasswordLogin(Request $request, Doctor $doctor): JsonResponse
    {
        if (!Hash::check($request->auth_value, $doctor->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid password'
            ], 422);
        }

        // Log the user in
        Auth::login($doctor);

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'redirect' => route('dashboard')
        ]);
    }

    /**
     * Handle OTP-based login.
     */
    private function handleOTPLogin(Request $request, Doctor $doctor): JsonResponse
    {
        $cacheKey = "otp_attempt_{$doctor->id}";
        $storedOTP = Cache::get($cacheKey);

        // If no OTP exists or this is first attempt, generate and send new OTP
        if (!$storedOTP) {
            $otp = $this->generateAndSendOTP($doctor);
            
            // Store OTP in cache for 5 minutes
            Cache::put($cacheKey, $otp, now()->addMinutes(5));

            return response()->json([
                'success' => true,
                'message' => 'OTP has been sent to your device',
                'requires_otp' => true
            ]);
        }

        // Verify OTP
        if ($request->auth_value !== $storedOTP) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ], 422);
        }

        // Clear the OTP
        Cache::forget($cacheKey);

        // Log the user in
        Auth::login($doctor);

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'redirect' => route('dashboard')
        ]);
    }

    /**
     * Generate and send OTP to doctor.
     */
    private function generateAndSendOTP(Doctor $doctor): string
    {
        $otp = Str::random(6);

        // TODO: Implement your OTP sending logic here
        // This could be SMS, email, or any other method
        // For now, we'll just return the OTP
        return $otp;
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
} 
