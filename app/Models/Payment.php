<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'patient_id', 
        'amount', 
        'method', 
        'payment_date', 
        'status',
        'total_amount',
        'remaining_balance',
        'notes'
    ];
    
    protected $casts = [
        'payment_date' => 'datetime',
        'amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'remaining_balance' => 'decimal:2'
    ];
    
    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
    // Calculate remaining balance
    public function calculateRemainingBalance()
    {
        if ($this->total_amount && $this->amount) {
            return $this->total_amount - $this->amount;
        }
        return 0;
    }
}
