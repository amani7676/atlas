<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otagh extends Model
{
    use HasFactory;

    public function vahed() {
        return $this->belongsTo(Vahed::class);
    }

    public function takhts() {
        return $this->hasMany(Takht::class);
    }

    public function heter() {
        return $this->hasOne(Heter::class);
    }
}
