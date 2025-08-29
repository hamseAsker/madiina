<?php
namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index() {
        $prescriptions = Prescription::with(['patient', 'doctor'])->paginate(10);
        return view('prescriptions.index', compact('prescriptions'));
    }
    
    public function create() {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('prescriptions.create', compact('patients', 'doctors'));
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'medication' => 'required|string',
            'instructions' => 'required|string',
            'prescribed_date' => 'required|date',
            'duration' => 'nullable|string'
        ]);
        
        Prescription::create($validated);
        return redirect()->route('prescriptions.index')->with('success', 'Prescription created successfully!');
    }
    
    public function show(Prescription $prescription) {
        return view('prescriptions.show', compact('prescription'));
    }
    
    public function edit(Prescription $prescription) {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('prescriptions.edit', compact('prescription', 'patients', 'doctors'));
    }
    
    public function update(Request $request, Prescription $prescription) {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'medication' => 'required|string',
            'instructions' => 'required|string',
            'prescribed_date' => 'required|date',
            'duration' => 'nullable|string'
        ]);
        
        $prescription->update($validated);
        return redirect()->route('prescriptions.index')->with('success', 'Prescription updated successfully!');
    }
    
    public function destroy(Prescription $prescription) {
        $prescription->delete();
        return redirect()->route('prescriptions.index')->with('success', 'Prescription deleted successfully!');
    }
}
