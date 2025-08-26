<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'type', 
        'content', 
        'patient_id', 
        'doctor_id', 
        'report_date', 
        'status'
    ];
    
    protected $casts = [
        'report_date' => 'date'
    ];
    
    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
