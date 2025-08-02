<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $guarded = [];

    /**
     * Get the patient associated with the visit.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the payment associated with the visit.
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
