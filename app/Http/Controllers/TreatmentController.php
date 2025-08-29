<?php
namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index() {
        $treatments = Treatment::with(['patient', 'doctor', 'service'])->paginate(10);
        return view('treatments.index', compact('treatments'));
    }
    
    public function create() {
        $appointments = Appointment::with(['patient', 'doctor'])->get();
        $services = Service::all();
        return view('treatments.create', compact('appointments', 'services'));
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'service_id' => 'required|exists:services,id',
            'details' => 'required|string',
            'treatment_date' => 'required|date',
            'status' => 'required|string|in:scheduled,in_progress,completed,cancelled',
            'cost' => 'nullable|numeric|min:0',
            'treatment_type' => 'nullable|string'
        ]);
        
        // Set default values if not provided
        $validated['cost'] = $validated['cost'] ?? 0.00;
        $validated['treatment_type'] = $validated['treatment_type'] ?? null;
        
        Treatment::create($validated);
        return redirect()->route('treatments.index')->with('success', 'Treatment created successfully!');
    }
    
    public function show(Treatment $treatment) {
        return view('treatments.show', compact('treatment'));
    }
    
    public function edit(Treatment $treatment) {
        $appointments = Appointment::with(['patient', 'doctor'])->get();
        $services = Service::all();
        return view('treatments.edit', compact('treatment', 'appointments', 'services'));
    }
    
    public function update(Request $request, Treatment $treatment) {
        $validated = $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'service_id' => 'required|exists:services,id',
            'details' => 'required|string',
            'treatment_date' => 'required|date',
            'status' => 'required|string|in:scheduled,in_progress,completed,cancelled',
            'cost' => 'nullable|numeric|min:0',
            'treatment_type' => 'nullable|string'
        ]);
        
        // Set default values if not provided
        $validated['cost'] = $validated['cost'] ?? 0.00;
        $validated['treatment_type'] = $validated['treatment_type'] ?? null;
        
        $treatment->update($validated);
        return redirect()->route('treatments.index')->with('success', 'Treatment updated successfully!');
    }
    
    public function destroy(Treatment $treatment) {
        $treatment->delete();
        return redirect()->route('treatments.index')->with('success', 'Treatment deleted successfully!');
    }
}
