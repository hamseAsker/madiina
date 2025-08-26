<?php
namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index() {
        $prescriptions = Prescription::with(['patient', 'doctor'])->paginate(10);
        return view('prescriptions.index', compact('prescriptions'));
    }
    public function create() {
        return view('prescriptions.create');
    }
    public function store(Request $request) {
        Prescription::create($request->all());
        return redirect()->route('prescriptions.index');
    }
    public function show(Prescription $prescription) {
        return view('prescriptions.show', compact('prescription'));
    }
    public function edit(Prescription $prescription) {
        return view('prescriptions.edit', compact('prescription'));
    }
    public function update(Request $request, Prescription $prescription) {
        $prescription->update($request->all());
        return redirect()->route('prescriptions.index');
    }
    public function destroy(Prescription $prescription) {
        $prescription->delete();
        return redirect()->route('prescriptions.index');
    }
}
