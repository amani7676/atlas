<?php

namespace App\Services;

use App\Models\Vahed;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;
use Spatie\Backtrace\Arguments\ReducedArgument\VariadicReducedArgument;
use Symfony\Component\Console\Descriptor\Descriptor;

use function PHPUnit\Framework\isNull;

class DataServices
{
    public function getDaysDiffJalali($shamsiDate)
    {
        // پارس کردن تاریخ ورودی شمسی (مثال: "1404/2/3")
        list($year, $month, $day) = explode('/', $shamsiDate);

        // اعتبارسنجی تاریخ شمسی

        // ایجاد تاریخ شمسی از ورودی
        $inputDate = Jalalian::fromFormat('Y/n/j', $shamsiDate)->toCarbon()->startOfDay(); // فرمت: سال چهاررقمی/ماه بدون صفر/روز بدون صفر

        // تاریخ امروز به شمسی
        $today = Jalalian::now()->toCarbon()->startOfDay();

        // محاسبه اختلاف روزها (با استفاده از timestamp)
        $diffInSeconds =  $inputDate->getTimestamp() - $today->getTimestamp();
        $diffInDays = (int) floor($diffInSeconds / 86400); // 86400 ثانیه = 1 روز

        return $diffInDays;
    }

    public function getAllData()
    {
        $vaheds = Vahed::with([
            'otaghs.takhts.resident.infoResident'
        ])->get();

        $data = [];
        // dd(vars: $vaheds);
        foreach ($vaheds as $vahed) {
            $vahedData = [
                'vahed_id' => $vahed->id,
                'vahed_name' => $vahed->name,
                'otaghs' => [],
            ];

            foreach ($vahed->otaghs as $otagh) {
                $otaghData = [
                    'otagh_id' => $otagh->id,
                    'otagh_name' => $otagh->name,
                    'otagh_vahedID' => $otagh->vahed_id,
                    'takhts' => [],
                ];

                foreach ($otagh->takhts as $takht) {
                    $takhtData = [
                        'takht_id' => $takht->id,
                        'takht_name' => $takht->name,
                        'state' => $takht->state,
                        'resident' => null,
                    ];

                    if ($takht->resident) {
                        $resident = $takht->resident;
                        $info = $resident->infoResident;
                        $description = $this->getDescription($resident->id);

                        $takhtData['resident'] = [
                            'resident_id' => $resident->id,
                            'full_name' => $resident->full_name,
                            'phone' => $resident->phone,
                            'start_date' => $resident->start_date,
                            'end_date' => $resident->end_date,
                            'descriptions' => $description,
                            'sarrsed' => $this->getDaysDiffJalali($resident->end_date),
                            'info' => $info ? [
                                'vadeh' => $info->vadeh,
                                'ejareh' => $info->ejareh,
                                'madrak' => $info->madrak,
                                'has_phone' => $info->has_phone,
                                'state' => $info->state,
                                'bedehy' => $info->bedehy,
                                'form' => $info->form,
                                'hamahang' => $info->hamahang,
                                'job' => $info->job,
                                'age' => $info->age,
                                'takhir' => $info->takhir,
                            ] : null
                        ];
                    }

                    $otaghData['takhts'][] = $takhtData;
                }

                $vahedData['otaghs'][] = $otaghData;
            }

            $data[] = $vahedData;
        }
        return $data;
    }


    public function getResidents($data)
    {

        $residents = [];

        foreach ($data as $vahed) {
            foreach ($vahed['otaghs'] as $otagh) {

                foreach ($otagh['takhts'] as $takht) {
                    if (!empty($takht['resident'])) {
                        $resident = $takht['resident'];
                        $description = $this->getDescription($resident['resident_id']);

                        $flattened = [
                            'resident_id' => $resident['resident_id'],
                            'full_name' => $resident['full_name'],
                            'phone' => $resident['phone'],
                            'start_date' => $resident['start_date'],
                            'descriptions' => $description,
                            'end_date' => $resident['end_date'],
                            'otagh_name' => $otagh['otagh_name'],
                            'sarrsed' => $this->getDaysDiffJalali($resident['end_date']),
                        ];

                        if (!empty($resident['info'])) {
                            $flattened = array_merge($flattened, $resident['info']);
                        }

                        $residents[] = $flattened;
                    }
                }
            }
        }

        return $residents;
    }

    public function getDescription($idResident)
    {
        
        $descs = DB::table('descriptions')
            ->where('resident_id', $idResident)
            ->get(); // استفاده از get() به جای first()

        return $descs->map(function ($desc) {
            return [
                'id' => $desc->id ?? null,
                'desc' => $desc->desc ?? 'No description',
                'type' => $desc->type ?? 'unknown',
            ];
        })->toArray();
    }
}
