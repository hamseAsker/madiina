<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Patient;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() {
        $payments = Payment::with(['patient'])->paginate(10);
        return view('payments.index', compact('payments'));
    }
    
    public function create() {
        $patients = Patient::all();
        return view('payments.create', compact('patients'));
    }
    
    public function store(Request $request) {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'amount' => 'required|numeric|min:0.01',
            'total_amount' => 'nullable|numeric|min:0.01',
            'method' => 'required|string',
            'payment_date' => 'required|date',
            'status' => 'required|string|in:paid,pending,failed,refunded',
            'notes' => 'nullable|string'
        ]);
        
        // Calculate remaining balance if total amount is provided
        if (isset($validated['total_amount']) && $validated['total_amount'] > 0) {
            $validated['remaining_balance'] = $validated['total_amount'] - $validated['amount'];
        }
        
        Payment::create($validated);
        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully!');
    }
    
    public function show(Payment $payment) {
        return view('payments.show', compact('payment'));
    }
    
    public function edit(Payment $payment) {
        $patients = Patient::all();
        return view('payments.edit', compact('payment', 'patients'));
    }
    
    public function update(Request $request, Payment $payment) {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'amount' => 'required|numeric|min:0.01',
            'total_amount' => 'nullable|numeric|min:0.01',
            'method' => 'required|string',
            'payment_date' => 'required|date',
            'status' => 'required|string|in:paid,pending,failed,refunded',
            'notes' => 'nullable|string'
        ]);
        
        // Calculate remaining balance if total amount is provided
        if (isset($validated['total_amount']) && $validated['total_amount'] > 0) {
            $validated['remaining_balance'] = $validated['total_amount'] - $validated['amount'];
        }
        
        $payment->update($validated);
        return redirect()->route('payments.index')->with('success', 'Payment updated successfully!');
    }
    
    public function destroy(Payment $payment) {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully!');
    }
    
    // Get patient balance information (for AJAX calls)
    public function getPatientBalance($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $totalPayments = Payment::where('patient_id', $patientId)->sum('amount');
        
        // Calculate total amount due from treatments using the scope
        $totalAmountDue = \App\Models\Treatment::byPatient($patientId)->sum('cost');
        
        // Calculate outstanding balance (treatments cost - payments made)
        $outstandingBalance = $totalAmountDue - $totalPayments;
        
        return response()->json([
            'patient_name' => $patient->name,
            'phone' => $patient->phone,
            'total_paid' => $totalPayments,
            'total_amount_due' => $totalAmountDue,
            'outstanding_balance' => max(0, $outstandingBalance)
        ]);
    }
    
    // Get patient treatment costs for payment form
    public function getPatientTreatmentCosts($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $treatments = \App\Models\Treatment::byPatient($patientId)
            ->with(['service', 'appointment'])
            ->get();
        
        // Get total payments made by this patient
        $totalPaid = Payment::where('patient_id', $patientId)->sum('amount');
        
        // Calculate remaining unpaid amount
        $totalCost = $treatments->sum('cost');
        $remainingUnpaid = max(0, $totalCost - $totalPaid);
        
        // Show only treatments that still need payment
        $unpaidTreatments = $treatments->filter(function($treatment) use ($totalPaid, $totalCost) {
            // For now, show all treatments but mark which ones are paid
            // In a more advanced system, you could track individual treatment payments
            return true;
        });
        
        $treatmentDetails = $unpaidTreatments->map(function($treatment) {
            return [
                'id' => $treatment->id,
                'type' => $treatment->treatment_type ?: ($treatment->service->name ?? 'Treatment'),
                'cost' => $treatment->cost,
                'date' => $treatment->treatment_date ? $treatment->treatment_date->format('M d, Y') : 'N/A',
                'status' => $treatment->status
            ];
        });
        
        return response()->json([
            'patient_name' => $patient->name,
            'treatments' => $treatmentDetails,
            'total_cost' => $totalCost,
            'total_paid' => $totalPaid,
            'remaining_unpaid' => $remainingUnpaid,
            'treatment_count' => $treatments->count()
        ]);
    }
    
    // Get remaining unpaid treatments after payment deduction
    public function getRemainingTreatments($patientId, $paymentAmount)
    {
        $patient = Patient::findOrFail($patientId);
        $treatments = \App\Models\Treatment::byPatient($patientId)
            ->with(['service', 'appointment'])
            ->orderBy('created_at', 'asc') // Pay oldest treatments first
            ->get();
        
        $totalPaid = Payment::where('patient_id', $patientId)->sum('amount');
        $totalCost = $treatments->sum('cost');
        
        // Calculate how much of the new payment goes to remaining balance
        $remainingBalance = max(0, $totalCost - $totalPaid);
        $paymentApplied = min($paymentAmount, $remainingBalance);
        
        // Calculate remaining unpaid after this payment
        $remainingAfterPayment = max(0, $remainingBalance - $paymentApplied);
        
        // Show which treatments would be covered by this payment
        $coveredTreatments = collect();
        $uncoveredTreatments = collect();
        $amountCovered = 0;
        
        foreach ($treatments as $treatment) {
            if ($amountCovered < $paymentApplied) {
                $coveredTreatments->push([
                    'id' => $treatment->id,
                    'type' => $treatment->treatment_type ?: ($treatment->service->name ?? 'Treatment'),
                    'cost' => $treatment->cost,
                    'date' => $treatment->treatment_date ? $treatment->treatment_date->format('M d, Y') : 'N/A',
                    'status' => $treatment->status,
                    'payment_status' => 'Paid'
                ]);
                $amountCovered += $treatment->cost;
            } else {
                $uncoveredTreatments->push([
                    'id' => $treatment->id,
                    'type' => $treatment->treatment_type ?: ($treatment->service->name ?? 'Treatment'),
                    'cost' => $treatment->cost,
                    'date' => $treatment->treatment_date ? $treatment->treatment_date->format('M d, Y') : 'N/A',
                    'status' => $treatment->status,
                    'payment_status' => 'Unpaid'
                ]);
            }
        }
        
        return response()->json([
            'payment_applied' => $paymentApplied,
            'remaining_after_payment' => $remainingAfterPayment,
            'covered_treatments' => $coveredTreatments,
            'uncovered_treatments' => $uncoveredTreatments,
            'total_cost' => $totalCost,
            'total_paid_before' => $totalPaid,
            'total_paid_after' => $totalPaid + $paymentApplied
        ]);
    }
}
