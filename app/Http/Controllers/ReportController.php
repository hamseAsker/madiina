<?php
namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Patient;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index() {
        $reports = Report::with(['patient', 'doctor'])->paginate(10);
        return view('reports.index', compact('reports'));
    }
    
    public function create() {
        $patients = Patient::all();
        return view('reports.create', compact('patients'));
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
            'content' => 'required|string',
            'report_date' => 'required|date',
            'status' => 'required|string|in:draft,completed,pending,reviewed'
        ]);
        
        Report::create($validated);
        return redirect()->route('reports.index')->with('success', 'Report created successfully!');
    }
    
    public function show(Report $report) {
        return view('reports.show', compact('report'));
    }
    
    public function edit(Report $report) {
        $patients = Patient::all();
        return view('reports.edit', compact('report', 'patients'));
    }
    
    public function update(Request $request, Report $report) {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
            'content' => 'required|string',
            'report_date' => 'required|date',
            'status' => 'required|string|in:draft,completed,pending,reviewed'
        ]);
        
        $report->update($validated);
        return redirect()->route('reports.index')->with('success', 'Report updated successfully!');
    }
    
    public function destroy(Report $report) {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully!');
    }
}
