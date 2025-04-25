<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heter extends Model
{
    use HasFactory;

    public function otagh() {
        return $this->belongsTo(Otagh::class);
    }
}
