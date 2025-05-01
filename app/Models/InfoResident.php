<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoResident extends Model
{
    use HasFactory;
    protected $fillable = [
        'job',
        'age',
        'madrak',
        'form',
        'vadeh',
        'ejareh',
        'state',
        'created_at'
    ];
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
