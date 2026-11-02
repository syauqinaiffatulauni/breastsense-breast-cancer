<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'ic_number',
        'full_name',
        'age',
        'phone'
    ];

    public function predictions()
    {
        return $this->hasMany(Prediction::class);
    }
}
