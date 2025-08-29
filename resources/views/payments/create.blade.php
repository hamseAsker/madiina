@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-green-600 rounded-full mb-4">
                <i class="fas fa-credit-card text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Add New Payment</h1>
            <p class="text-lg text-gray-600">Record payment and track patient balance</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-500 to-green-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <i class="fas fa-credit-card mr-2"></i>
                    Payment Information
                </h2>
            </div>

            <!-- Form Content -->
            <form action="{{ route('payments.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
                
                <!-- Patient Selection -->
                <div class="space-y-2">
                    <label for="patient_id" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-user text-blue-500 mr-2"></i>
                        Patient
                    </label>
                    <select name="patient_id" id="patient_id" required onchange="loadPatientInfo()"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white">
                        <option value="">Select Patient</option>
                        @foreach($patients ?? [] as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->name }} - {{ $patient->phone }}</option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Patient Information Display -->
                <div id="patient-info" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-blue-800">Patient Name</label>
                            <p id="display-patient-name" class="text-lg font-semibold text-blue-900"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-blue-800">Phone</label>
                            <p id="display-patient-phone" class="text-lg font-semibold text-blue-900"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-blue-800">Total Paid</label>
                            <p id="display-total-paid" class="text-lg font-semibold text-green-600">$0.00</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-blue-800">Outstanding Balance</label>
                            <p id="display-outstanding" class="text-lg font-semibold text-red-600">$0.00</p>
                        </div>
                    </div>
                    
                    <!-- Treatment Details -->
                    <div id="treatment-details" class="hidden">
                        <div class="border-t border-blue-200 pt-4">
                            <h4 class="text-sm font-medium text-blue-800 mb-3 flex items-center">
                                <i class="fas fa-stethoscope mr-2"></i>
                                Treatment Details
                            </h4>
                            <div class="bg-white rounded-lg p-3 max-h-40 overflow-y-auto">
                                <div id="treatments-list" class="space-y-2">
                                    <!-- Treatment items will be loaded here -->
                                </div>
                            </div>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="text-sm font-medium text-blue-800">Total Treatment Cost:</span>
                                <span id="total-treatment-cost" class="text-lg font-bold text-blue-900">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Amount Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Total Amount -->
                    <div class="space-y-2">
                        <label for="total_amount" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-dollar-sign text-green-500 mr-2"></i>
                            Total Amount Due (Auto-filled from treatments)
                        </label>
                        <input type="number" name="total_amount" id="total_amount" step="0.01" min="0"
                               placeholder="0.00" onchange="calculateBalance()" readonly
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 bg-gray-50"
                               value="{{ old('total_amount') }}">
                        <p class="text-xs text-gray-500">This amount is automatically calculated from the patient's treatments</p>
                        @error('total_amount')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Payment Amount -->
                    <div class="space-y-2">
                        <label for="amount" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-credit-card text-blue-500 mr-2"></i>
                            Payment Amount
                        </label>
                        <input type="number" name="amount" id="amount" step="0.01" min="0.01" required
                               placeholder="0.00" onchange="calculateBalance()"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                               value="{{ old('amount') }}">
                        @error('amount')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Balance Information -->
                <div id="balance-info" class="hidden bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Remaining Balance</label>
                            <p id="display-remaining" class="text-lg font-semibold text-orange-600">$0.00</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Payment Status</label>
                            <p id="payment-status" class="text-lg font-semibold text-blue-600">Partial Payment</p>
                        </div>
                    </div>
                </div>
                
                <!-- Payment Impact on Treatments -->
                <div id="payment-impact" class="hidden bg-gradient-to-r from-green-50 to-blue-50 border border-green-200 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-green-800 mb-3 flex items-center">
                        <i class="fas fa-calculator mr-2"></i>
                        Payment Impact on Treatments
                    </h4>
                    
                    <!-- Treatments Covered by This Payment -->
                    <div class="mb-4">
                        <h5 class="text-sm font-medium text-green-700 mb-2">✅ Treatments Covered by This Payment</h5>
                        <div id="covered-treatments" class="space-y-2">
                            <!-- Covered treatments will be loaded here -->
                        </div>
                    </div>
                    
                    <!-- Remaining Unpaid Treatments -->
                    <div>
                        <h5 class="text-sm font-medium text-orange-700 mb-2">⚠️ Remaining Unpaid Treatments</h5>
                        <div id="unpaid-treatments" class="space-y-2">
                            <!-- Unpaid treatments will be loaded here -->
                        </div>
                    </div>
                    
                    <!-- Summary -->
                    <div class="mt-4 pt-3 border-t border-green-200">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                            <div>
                                <label class="block text-xs font-medium text-gray-600">Payment Applied</label>
                                <p id="payment-applied" class="text-lg font-bold text-green-600">$0.00</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600">Remaining After Payment</label>
                                <p id="remaining-after-payment" class="text-lg font-bold text-orange-600">$0.00</p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600">Total Paid (All Time)</label>
                                <p id="total-paid-after" class="text-lg font-bold text-blue-600">$0.00</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="space-y-2">
                    <label for="method" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-credit-card text-yellow-500 mr-2"></i>
                        Payment Method
                    </label>
                    <select name="method" id="method" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-all duration-200 bg-white">
                        <option value="">Select Payment Method</option>
                        <option value="cash">Cash</option>
                        <option value="credit_card">Credit Card</option>
                        <option value="debit_card">Debit Card</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="check">Check</option>
                        <option value="insurance">Insurance</option>
                    </select>
                    @error('method')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Additional Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Payment Date -->
                    <div class="space-y-2">
                        <label for="payment_date" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-calendar text-green-500 mr-2"></i>
                            Payment Date
                        </label>
                        <input type="datetime-local" name="payment_date" id="payment_date" required
                               value="{{ old('payment_date', date('Y-m-d\TH:i')) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200">
                        @error('payment_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Payment Status -->
                    <div class="space-y-2">
                        <label for="status" class="block text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                            Status
                        </label>
                        <select name="status" id="status" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white">
                            <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="refunded" {{ old('status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Notes -->
                <div class="space-y-2">
                    <label for="notes" class="block text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-sticky-note text-purple-500 mr-2"></i>
                        Notes
                    </label>
                    <textarea name="notes" id="notes" rows="3"
                              placeholder="Enter any additional notes about this payment..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all duration-200 resize-none"
                    >{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <!-- Save Button -->
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-blue-500 to-green-600 text-white px-8 py-4 rounded-lg font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Save Payment
                    </button>
                    
                    <!-- Cancel Button -->
                    <a href="{{ route('payments.index') }}" 
                       class="flex-1 bg-gray-100 text-gray-700 px-8 py-4 rounded-lg font-semibold hover:bg-gray-200 transition-all duration-200 flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for dynamic functionality -->
<script>
function loadPatientInfo() {
    const patientId = document.getElementById('patient_id').value;
    const patientInfo = document.getElementById('patient-info');
    const treatmentDetails = document.getElementById('treatment-details');
    
    if (!patientId) {
        patientInfo.classList.add('hidden');
        treatmentDetails.classList.add('hidden');
        return;
    }
    
    // Show loading state
    patientInfo.classList.remove('hidden');
    treatmentDetails.classList.add('hidden');
    document.getElementById('display-patient-name').textContent = 'Loading...';
    document.getElementById('display-patient-phone').textContent = 'Loading...';
    
    // Fetch patient information and treatments
    Promise.all([
        fetch(`/api/patient-balance/${patientId}`).then(response => response.json()),
        fetch(`/api/patient-treatments/${patientId}`).then(response => response.json())
    ])
    .then(([balanceData, treatmentData]) => {
        // Update patient info
        document.getElementById('display-patient-name').textContent = balanceData.patient_name;
        document.getElementById('display-patient-phone').textContent = balanceData.phone;
        document.getElementById('display-total-paid').textContent = `$${parseFloat(balanceData.total_paid).toFixed(2)}`;
        document.getElementById('display-outstanding').textContent = `$${parseFloat(balanceData.outstanding_balance).toFixed(2)}`;
        
        // Update treatment details
        if (treatmentData.treatments && treatmentData.treatments.length > 0) {
            displayTreatments(treatmentData.treatments);
            document.getElementById('total-treatment-cost').textContent = `$${parseFloat(treatmentData.total_cost).toFixed(2)}`;
            
            // Automatically populate total amount due field
            console.log('Auto-populating total amount due with:', treatmentData.total_cost);
            document.getElementById('total_amount').value = treatmentData.total_cost;
            
            treatmentDetails.classList.remove('hidden');
        } else {
            treatmentDetails.classList.add('hidden');
            // Clear total amount if no treatments
            console.log('No treatments found, clearing total amount');
            document.getElementById('total_amount').value = '';
        }
        
        // Trigger balance calculation
        calculateBalance();
    })
    .catch(error => {
        console.error('Error loading patient info:', error);
        document.getElementById('display-patient-name').textContent = 'Error loading data';
        document.getElementById('display-patient-phone').textContent = 'Error loading data';
    });
}

function displayTreatments(treatments) {
    const treatmentsList = document.getElementById('treatments-list');
    treatmentsList.innerHTML = '';
    
    treatments.forEach(treatment => {
        const treatmentItem = document.createElement('div');
        treatmentItem.className = 'flex justify-between items-center p-2 bg-gray-50 rounded text-sm';
        treatmentItem.innerHTML = `
            <div class="flex-1">
                <div class="font-medium text-gray-900">${treatment.type}</div>
                <div class="text-xs text-gray-500">${treatment.date} - ${treatment.status}</div>
            </div>
            <div class="font-semibold text-blue-600">$${parseFloat(treatment.cost).toFixed(2)}</div>
        `;
        treatmentsList.appendChild(treatmentItem);
    });
}

function calculateBalance() {
    const totalAmount = parseFloat(document.getElementById('total_amount').value) || 0;
    const paymentAmount = parseFloat(document.getElementById('amount').value) || 0;
    const balanceInfo = document.getElementById('balance-info');
    const paymentImpact = document.getElementById('payment-impact');
    
    if (totalAmount > 0 && paymentAmount > 0) {
        const remaining = totalAmount - paymentAmount;
        
        // Update the balance info display
        document.getElementById('display-remaining').textContent = `$${remaining.toFixed(2)}`;
        
        // Show prominent balance summary
        if (remaining > 0) {
            document.getElementById('payment-status').textContent = 'Partial Payment - Remaining: $' + remaining.toFixed(2);
            document.getElementById('payment-status').className = 'text-lg font-semibold text-orange-600';
            
            // Show warning about remaining balance
            balanceInfo.classList.remove('hidden');
            balanceInfo.className = 'bg-orange-50 border border-orange-200 rounded-lg p-4';
        } else if (remaining === 0) {
            document.getElementById('payment-status').textContent = 'Full Payment - No Balance Remaining';
            document.getElementById('payment-status').className = 'text-lg font-semibold text-green-600';
            
            // Show success styling
            balanceInfo.classList.remove('hidden');
            balanceInfo.className = 'bg-green-50 border border-green-200 rounded-lg p-4';
        } else {
            const overpayment = Math.abs(remaining);
            document.getElementById('payment-status').textContent = 'Overpayment - Refund Due: $' + overpayment.toFixed(2);
            document.getElementById('payment-status').className = 'text-lg font-semibold text-blue-600';
            
            // Show info styling
            balanceInfo.classList.remove('hidden');
            balanceInfo.className = 'bg-blue-50 border border-blue-200 rounded-lg p-4';
        }
        
        balanceInfo.classList.remove('hidden');
        
        // Calculate payment impact on treatments
        calculatePaymentImpact(paymentAmount);
        
    } else {
        balanceInfo.classList.add('hidden');
        paymentImpact.classList.add('hidden');
    }
}

function calculatePaymentImpact(paymentAmount) {
    const patientId = document.getElementById('patient_id').value;
    if (!patientId || paymentAmount <= 0) {
        document.getElementById('payment-impact').classList.add('hidden');
        return;
    }
    
    // Fetch remaining treatments calculation
    fetch(`/api/remaining-treatments/${patientId}/${paymentAmount}`)
        .then(response => response.json())
        .then(data => {
            displayPaymentImpact(data);
        })
        .catch(error => {
            console.error('Error calculating payment impact:', error);
        });
}

function displayPaymentImpact(data) {
    const paymentImpact = document.getElementById('payment-impact');
    
    // Display covered treatments
    const coveredList = document.getElementById('covered-treatments');
    coveredList.innerHTML = '';
    
    if (data.covered_treatments && data.covered_treatments.length > 0) {
        data.covered_treatments.forEach(treatment => {
            const treatmentItem = document.createElement('div');
            treatmentItem.className = 'flex justify-between items-center p-2 bg-green-50 rounded text-sm border border-green-200';
            treatmentItem.innerHTML = `
                <div class="flex-1">
                    <div class="font-medium text-green-900">${treatment.type}</div>
                    <div class="text-xs text-green-600">${treatment.date} - ${treatment.status}</div>
                </div>
                <div class="font-semibold text-green-700">$${parseFloat(treatment.cost).toFixed(2)} ✅</div>
            `;
            coveredList.appendChild(treatmentItem);
        });
    } else {
        coveredList.innerHTML = '<p class="text-sm text-gray-500 italic">No treatments covered by this payment</p>';
    }
    
    // Display remaining unpaid treatments
    const unpaidList = document.getElementById('unpaid-treatments');
    unpaidList.innerHTML = '';
    
    if (data.uncovered_treatments && data.uncovered_treatments.length > 0) {
        data.uncovered_treatments.forEach(treatment => {
            const treatmentItem = document.createElement('div');
            treatmentItem.className = 'flex justify-between items-center p-2 bg-orange-50 rounded text-sm border border-orange-200';
            treatmentItem.innerHTML = `
                <div class="flex-1">
                    <div class="font-medium text-orange-900">${treatment.type}</div>
                    <div class="text-xs text-orange-600">${treatment.date} - ${treatment.status}</div>
                </div>
                <div class="font-semibold text-orange-700">$${parseFloat(treatment.cost).toFixed(2)} ⚠️</div>
            `;
            unpaidList.appendChild(treatmentItem);
        });
    } else {
        unpaidList.innerHTML = '<p class="text-sm text-gray-500 italic">All treatments will be paid for!</p>';
    }
    
    // Update summary
    document.getElementById('payment-applied').textContent = `$${parseFloat(data.payment_applied).toFixed(2)}`;
    document.getElementById('remaining-after-payment').textContent = `$${parseFloat(data.remaining_after_payment).toFixed(2)}`;
    document.getElementById('total-paid-after').textContent = `$${parseFloat(data.total_paid_after).toFixed(2)}`;
    
    // Show the payment impact section
    paymentImpact.classList.remove('hidden');
}

// Initialize form
document.addEventListener('DOMContentLoaded', function() {
    // Set default payment date to now
    const now = new Date();
    const localDateTime = new Date(now.getTime() - now.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
    document.getElementById('payment_date').value = localDateTime;
});
</script>

<!-- Custom CSS for enhanced styling -->
<style>
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .btn-gradient:hover {
        background-size: 200% 200%;
        animation: gradient-shift 0.5s ease;
    }
    
    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
</style>
@endsection
