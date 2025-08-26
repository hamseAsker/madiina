<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // Get basic counts safely
        $totalPatients = 0;
        $totalDoctors = 0;
        $todayAppointments = 0;
        $monthlyRevenue = 0;
        
        try {
            $totalPatients = Patient::count();
        } catch (\Exception $e) {
            $totalPatients = 0;
        }
        
        try {
            $totalDoctors = Doctor::count();
        } catch (\Exception $e) {
            $totalDoctors = 0;
        }
        
        try {
            // Check if appointments table exists and has data
            if (Schema::hasTable('appointments')) {
                $todayAppointments = Appointment::count();
            } else {
                $todayAppointments = 0;
            }
        } catch (\Exception $e) {
            $todayAppointments = 0;
        }
        
        try {
            // Check if payments table exists and has data
            if (Schema::hasTable('payments')) {
                $monthlyRevenue = Payment::sum('amount') ?? 0;
            } else {
                $monthlyRevenue = 0;
            }
        } catch (\Exception $e) {
            $monthlyRevenue = 0;
        }
        
        // Get recent appointments safely
        $recentAppointments = collect();
        try {
            if (Schema::hasTable('appointments')) {
                $recentAppointments = Appointment::with(['patient', 'doctor'])
                    ->limit(5)
                    ->get();
            }
        } catch (\Exception $e) {
            $recentAppointments = collect();
        }
        
        // Create simple monthly stats
        $monthlyStats = [
            ['month' => 'Jan', 'patients' => rand(10, 50), 'appointments' => rand(20, 100), 'revenue' => rand(5, 25)],
            ['month' => 'Feb', 'patients' => rand(10, 50), 'appointments' => rand(20, 100), 'revenue' => rand(5, 25)],
            ['month' => 'Mar', 'patients' => rand(10, 50), 'appointments' => rand(20, 100), 'revenue' => rand(5, 25)],
            ['month' => 'Apr', 'patients' => rand(10, 50), 'appointments' => rand(20, 100), 'revenue' => rand(5, 25)],
            ['month' => 'May', 'patients' => rand(10, 50), 'appointments' => rand(20, 100), 'revenue' => rand(5, 25)],
            ['month' => 'Jun', 'patients' => rand(10, 50), 'appointments' => rand(20, 100), 'revenue' => rand(5, 25)],
        ];
        
        // Get server usage data (simulated)
        $serverUsage = [
            'cpu' => rand(40, 80),
            'ram' => rand(30, 70),
            'storage' => rand(20, 60),
            'network' => rand(15, 50)
        ];
        
        return view('dashboard', compact(
            'totalPatients',
            'totalDoctors', 
            'todayAppointments',
            'monthlyRevenue',
            'recentAppointments',
            'monthlyStats',
            'serverUsage'
        ));
    }
}
