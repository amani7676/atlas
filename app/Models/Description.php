<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;
    protected $fillable = [
        'desc',
        'resident_id',
        'type'
    ];
    public function resident() 
    {
        return $this->belongsTo(Resident::class);
    }
}
