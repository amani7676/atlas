<?php

namespace App\Livewire\Search;

use App\Helpers\ShamsiHelper;
use App\Models\Resident;
use Livewire\Attributes\Title;
use Livewire\Component;
use Morilog\Jalali\Jalalian;

#[Title ('گزارش اقامتگران خروجی')] 
class ShowListEndsResidents extends Component
{
    public $full_name;
    public $phone;
    public $end_date;
    public $end_date_ta;
    public $start_date;
    public $start_date_ta;
    public $age;
    public $job;

    // متد برای تغییر خودکار فرمت تاریخ هنگام آپدیت فیلدها
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['start_date', 'end_date', 'start_data_ta', 'end_date_ta'])) {
            $this->formatDateField($propertyName);
        }
    }
    // تابع کمکی برای فرمت‌دهی تاریخ شمسی
    private function formatDateField($field)
    {
        if (empty($this->$field)) {
            return;
        }

        // حذف کاراکترهای غیرعددی به جز اسلش
        $normalized = preg_replace('/[^0-9\/]/', '', $this->$field);
        $parts = explode('/', $normalized);

        if (count($parts) !== 3) {
            return; // اگر فرمت اشتباه بود، تغییر نده
        }

        // تبدیل به عدد و حذف صفرهای اضافی
        $year = (int)$parts[0];
        $month = (int)$parts[1];
        $day = (int)$parts[2];

        // ذخیره به فرمت 1404/2/1
        $this->$field = "$year/$month/$day";
    }
    public function ShowList()
    {
        // منطق نمایش لیست
    }
    public function resetFilters()
    {
        $this->reset(['full_name', 'phone', 'start_date', 'start_date_ta', 'end_date_ta', 'end_date', 'age', 'job']);
    }


    public function render()
    {
        // تبدیل شمسی به میلادی اگر مقدار وجود داشته باشه
        // $start_date = $this->start_date ?  ShamsiHelper::toShamsi($this->start_date) : null;
        // $start_date_ta = $this->start_date_ta ?  ShamsiHelper::toShamsi($this->start_date_ta) : null;
        // $end_date = $this->end_date ?  ShamsiHelper::toShamsi($this->end_date) : null;
        // $end_date_ta = $this->end_date_ta ?  ShamsiHelper::toShamsi($this->end_date_ta) : null;

        $residents = Resident::onlyTrashed()
        ->with([
            'infoResident' => fn($q) => $q->withTrashed(),
            'takht.otagh'
        ])
        ->when($this->full_name, fn($q) => $q->where('full_name', 'like', '%' . $this->full_name . '%'))
        ->when($this->phone, fn($q) => $q->where('phone', 'like', '%' . $this->phone . '%'))

        // فیلتر شروع قرارداد
        ->when($this->start_date && $this->start_date_ta, fn($q) =>
            $q->whereBetween('start_date', [$this->start_date, $this->start_date_ta])
        )
        ->when($this->start_date && !$this->start_date_ta, fn($q) =>
            $q->whereDate('start_date', '>=', $this->start_date)
        )
        ->when(!$this->start_date && $this->start_date_ta, fn($q) =>
            $q->whereDate('start_date', '<=', $this->start_date_ta)
        )

        // فیلتر پایان قرارداد
        ->when($this->end_date && $this->end_date_ta, fn($q) =>
            $q->whereBetween('end_date', [$this->end_date, $this->end_date_ta])
        )
        ->when($this->end_date && !$this->end_date_ta, fn($q) =>
            $q->whereDate('end_date', '>=', $this->end_date)
        )
        ->when(!$this->end_date && $this->end_date_ta, fn($q) =>
            $q->whereDate('end_date', '<=', $this->end_date_ta)
        )

        // سن و شغل
        ->when($this->age, function ($q) {
            $q->whereHas('infoResident', function ($query) {
                $query->withTrashed()->where('age', $this->age);
            });
        })
        ->when($this->job, function ($q) {
            $q->whereHas('infoResident', function ($query) {
                $query->withTrashed()->where('job', $this->job);
            });
        })
        ->orderBy('deleted_at', 'desc')
        ->get();


        return view('livewire.search.show-list-ends-residents', [
            'residents' => $residents
        ]);
    }
}
