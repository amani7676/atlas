<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatoBalesh extends Model
{
    use HasFactory;

    public function resident() {
        return $this->belongsTo(Resident::class);
    }
}
