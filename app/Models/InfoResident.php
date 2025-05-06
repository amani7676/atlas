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
    // در مدل InfoResident
    public function getJobAttribute($value)
    {
        $jobs = [
            'karmand_dolat' => 'کارمند دولت',
            'karmand_shkhse' => 'کارمند شرکت خصوصی',
            'daneshjo_azad' => 'دانشجوی دانشگاه آزاد',
            'danshjo_dolati' => 'دانشجوی دانشگاه دولتی',
            'danshjo_sair' => 'دانشجوی سایر مراکز',
            'sair' => 'سایر'
        ];

        return $jobs[$value] ?? 'سایر';
    }
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
