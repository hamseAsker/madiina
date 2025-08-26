<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'appointment_id', 
        'service_id', 
        'details',
        'treatment_date',
        'status'
    ];
    
    protected $casts = [
        'treatment_date' => 'date'
    ];
    
    // Relationships
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
    public function patient()
    {
        return $this->hasOneThrough(Patient::class, Appointment::class, 'id', 'id', 'appointment_id', 'patient_id');
    }
    
    public function doctor()
    {
        return $this->hasOneThrough(Doctor::class, Appointment::class, 'id', 'id', 'appointment_id', 'doctor_id');
    }
}
