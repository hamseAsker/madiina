<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() {
        $payments = Payment::all();
        return view('payments.index', compact('payments'));
    }
    public function create() {
        return view('payments.create');
    }
    public function store(Request $request) {
        Payment::create($request->all());
        return redirect()->route('payments.index');
    }
    public function show(Payment $payment) {
        return view('payments.show', compact('payment'));
    }
    public function edit(Payment $payment) {
        return view('payments.edit', compact('payment'));
    }
    public function update(Request $request, Payment $payment) {
        $payment->update($request->all());
        return redirect()->route('payments.index');
    }
    public function destroy(Payment $payment) {
        $payment->delete();
        return redirect()->route('payments.index');
    }
}
