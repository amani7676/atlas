<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at']; // (اختیاری) برای Laravel 5.x
 
    public function infoResident() {
        return $this->hasOne(InfoResident::class);
    }

    public function takht() {
        return $this->belongsTo(Takht::class);
    }

    public function patoBalesh() {
        return $this->hasOne(PatoBalesh::class);
    }

    public function descriptions()
    {
        return $this->hasMany(Description::class);
    }
}
