<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Takht extends Model
{
    use HasFactory;
    protected $fillable = [
        'state'
    ];
    public function otagh() {
        return $this->belongsTo(Otagh::class);
    }

    public function resident() {
        return $this->hasOne(Resident::class);
    }
}
