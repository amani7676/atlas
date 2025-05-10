<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resident extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at']; // (اختیاری) برای Laravel 5.x

    // app/Models/Post.php
    protected $fillable = ['full_name', 'phone', 'end_date', 'start_date', 'takht_id', 'otagh_id', 'created_at'];
    // Mutator برای فیلد start_date
    private function standardizeJalaliDate($date)
    {
        if (empty($date)) {
            return null;
        }

        // حذف کاراکترهای غیرعددی به جز اسلش
        $normalized = preg_replace('/[^0-9\/]/', '', $date);
        $parts = explode('/', $normalized);

        // بررسی صحت فرمت تاریخ
        if (count($parts) !== 3) {
            return null;
        }

        // تبدیل به عدد و حذف صفرهای اضافی
        $year = (int) $parts[0];
        $month = (int) $parts[1];
        $day = (int) $parts[2];

        return "$year/$month/$day";
    }
    // Mutator برای start_date
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $this->standardizeJalaliDate($value);
    }

    // Mutator برای end_date
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $this->standardizeJalaliDate($value);
    }
    public function getPhoneAttribute()
    {
        return preg_replace('/^(\d{4})(\d{3})(\d{4})$/', '$1-$2-$3',  $this->attributes['phone']);
    }
    public function infoResident()
    {
        return $this->hasOne(InfoResident::class);
    }

    public function takht()
    {
        return $this->belongsTo(Takht::class);
    }

    public function patoBalesh()
    {
        return $this->hasOne(PatoBalesh::class);
    }

    public function descriptions()
    {
        return $this->hasMany(Description::class);
    }
}
