<?php

namespace App\Services;

use App\Models\Otagh;
use App\Models\Resident;
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
                'vahed_hoveat' => $vahed->hoveat,
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
    public function getResidentsByIds(array $residentIds)
    {
        $residents = [];

        // بگیریم همه ریزیدنت‌ها با روابط مربوط
        $residentModels = Resident::with(['infoResident', 'descriptions'])
            ->whereIn('id', $residentIds)
            ->get();

            foreach ($residentModels as $resident) {
                $descriptions = $resident->descriptions->isNotEmpty() 
                                ? $resident->descriptions->toArray() 
                                : null;
            }

        foreach ($residentModels as $resident) {
            $flattened = [
                'resident_id' => $resident->id,
                'full_name' => $resident->full_name,
                'phone' => $resident->phone,
                'start_date' => $resident->start_date,
                'end_date' => $resident->end_date,
                'descriptions' => $descriptions, // مثلا فقط متن دیسکریپشن‌ها
                'sarrsed' => $this->getDaysDiffJalali($resident->end_date),
            ];

            if ($resident->infoResident) {
                $flattened = array_merge($flattened, $resident->infoResident->toArray());
            }

            $residents[] = $flattened;
        }

        return $residents;
    }

    public function getVahedPerTotalOtaghs() {
        // لود اتاقها و تختهای مرتبط با وضعیت آنها
        $vaheds = Vahed::with(['otaghs.takhts'])->get();
    
        $result = [];
        foreach ($vaheds as $vahed) {
            $vahedData = [
                'vahed' => $vahed->id,
                'otaghs' => []
            ];
    
            $takhtGroups = [];
            foreach ($vahed->otaghs as $otagh) {
                // گروهبندی اتاقها بر اساس تعداد تخت (فیلد total)
                $type = $otagh->total . ' تخت';
                
                if (!isset($takhtGroups[$type])) {
                    $takhtGroups[$type] = [
                        'total_otaghs' => 0,
                        'total_takhts' => 0,
                        'states' => [
                            'empty' => 0,
                            'full' => 0,
                            'reserve' => 0
                        ]
                    ];
                }
    
                // شمارش اتاقها و تختها
                $takhtGroups[$type]['total_otaghs']++;
                $takhtGroups[$type]['total_takhts'] += $otagh->total;
    
                // شمارش وضعیت تختهای این اتاق
                foreach ($otagh->takhts as $takht) {
                    $state = $takht->state;
                    $takhtGroups[$type]['states'][$state]++;
                }
            }
    
            $vahedData['otaghs'] = $takhtGroups;
            $result[] = $vahedData;
        }
    
        return $result;
    }

    public function getTotalPerVahed() {
        // لود تمام دادههای مرتبط (اتاقها و تختها)
        $vaheds = Vahed::with(['otaghs.takhts'])->get();
    
        $result = [];
        foreach ($vaheds as $vahed) {
            $totalTakhts = 0;
            $emptyCount = 0;
            $fullCount = 0;
            $reserveCount = 0;
    
            // محاسبه مجموع تختها و وضعیتها برای واحد جاری
            foreach ($vahed->otaghs as $otagh) {
                foreach ($otagh->takhts as $takht) {
                    $totalTakhts++;
                    switch ($takht->state) {
                        case 'empty':
                            $emptyCount++;
                            break;
                        case 'full':
                            $fullCount++;
                            break;
                        case 'reserve':
                            $reserveCount++;
                            break;
                    }
                }
            }
    
            // افزودن دادهها به نتیجه
            $result[] = [
                "vahed" => $vahed->id,
                "otaghs" => [
                    'total' => $totalTakhts,
                    'empty' => $emptyCount,
                    'full' => $fullCount,
                    'reserve' => $reserveCount
                ]
            ];
        }
    
        return $result;
    }

    public function getTotalTakhtsPerNumbers() {
        // لود تمام اتاقها و تختهای مرتبط
        $otaghs = Otagh::with('takhts')->get();
    
        $result = [];
        foreach ($otaghs as $otagh) {
            // تشخیص نوع اتاق بر اساس تعداد تخت (فیلد total)
            $type = $otagh->total . ' تخت';
    
            // اگر گروه وجود ندارد، آن را ایجاد کن
            if (!isset($result[$type])) {
                $result[$type] = [
                    'all' => 0,
                    'full' => 0,
                    'empty' => 0,
                    'reserve' => 0
                ];
            }
    
            // شمارش وضعیت تختهای این اتاق
            foreach ($otagh->takhts as $takht) {
                $result[$type]['all']++;
                switch ($takht->state) {
                    case 'full':
                        $result[$type]['full']++;
                        break;
                    case 'empty':
                        $result[$type]['empty']++;
                        break;
                    case 'reserve':
                        $result[$type]['reserve']++;
                        break;
                }
            }
        }
    
        return $result;
    }
}

