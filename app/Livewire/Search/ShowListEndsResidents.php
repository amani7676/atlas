<?php

namespace App\Livewire\Search;

use App\Models\Resident;
use Livewire\Component;

class ShowListEndsResidents extends Component
{
    public $full_name;
    public $phone;
    public $end_date;
    public $start_date;
    public $age;
    public $job;

    // متد برای تغییر خودکار فرمت تاریخ هنگام آپدیت فیلدها
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['start_date', 'end_date'])) {
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
        $this->reset(['full_name', 'phone', 'end_date', 'age', 'job']);
    }


    public function render()
    {

        $residents = Resident::onlyTrashed()
            ->with(['infoResident' => function ($query) {
                $query->withTrashed(); // اطلاعات حذف شده infoResident را هم بیاورد
            }, 'takht.otagh']) // اتاق و تخت حذف نشده
            ->when($this->full_name, fn($q) => $q->where('full_name', 'like', '%' . $this->full_name . '%'))
            ->when($this->phone, fn($q) => $q->where('phone', 'like', '%' . $this->phone . '%'))
            ->when($this->end_date, fn($q) => $q->where('end_date', $this->end_date))
            ->when($this->start_date, fn($q) => $q->where('start_date', $this->start_date))
            ->when($this->age, function ($q) {
                $q->whereHas('infoResident', function ($query) {
                    $query->withTrashed()->where('age', $this->age); // فیلتر age روی infoResident حذف شده
                });
            })
            ->when($this->job, function ($q) {
                $q->whereHas('infoResident', function ($query) {
                    $query->withTrashed()->where('job', $this->job); // فیلتر job روی infoResident حذف شده
                });
            })
            ->orderBy('deleted_at', 'desc')
            ->get();

        return view('livewire.search.show-list-ends-residents', [
            'residents' => $residents
        ]);
    }
}
