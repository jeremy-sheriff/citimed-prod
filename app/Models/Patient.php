<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
    protected $guarded = [];
    protected function name(): Attribute
    {

        return Attribute::make(
            get: fn (string $value) => ucwords(strtolower($value)),
        );
    }
}
