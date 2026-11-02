<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    protected $fillable = [
        'user_id',
        'patient_id',
        'patient_name',
        'age',
        'prediction_result',
        'confidence_score',
        'shape',
        'margin',
        'size',
        'birads_score',
        'risk_level',
        'recommendation',
        'reviewed_by'
    ];
}