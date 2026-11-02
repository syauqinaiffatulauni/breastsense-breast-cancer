<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Prediction extends Model
{
    protected $fillable = [
        'user_id',
        'patient_id',
        'image_path',
        'prediction',
        'confidence',
        'birads_score',
        'shape',
        'margin',
        'size',
        'risk_level',
        'recommendation'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->created_at)
            ->timezone('Asia/Kuala_Lumpur')
            ->format('d/m/Y h:i A');
    }
}