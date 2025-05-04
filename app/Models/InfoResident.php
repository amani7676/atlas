<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InfoResident extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at']; // اگه لازم باشه
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
