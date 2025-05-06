<?php

namespace App\Livewire\Reservations;

use App\Models\Reservation;
use Livewire\Component;

class Reserve extends Component
{
    public $rows = []; // سطرهای جدید
    public $savedReservations = []; // داده‌های موجود در دیتابیس

    public function mount()
    {
        $this->savedReservations = Reservation::all()->toArray();
    }

    public function addRow()
    {
        $this->rows[] = [
            'name' => '',
            'description' => '',
            'ovlaviat' => '',
            'phone' => ''
        ];
    }
    public function saveRow($index)
    {
        $data = $this->rows[$index];

        // اعتبارسنجی ساده (می‌تونی کامل‌ترش کنی)
        if (!empty($data['name']) && !empty($data['phone'])) {
            // dd($this->priorityMap($data['ovlaviat']));
            $reservation = Reservation::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'phone' => $data['phone'] ?? '---',
                'olaviat' => $this->priorityMap($data['ovlaviat']),
            ]);

            unset($this->rows[$index]);
            $this->rows = array_values($this->rows); // ایندکس‌ها را دوباره تنظیم کن

            $this->savedReservations[] = $reservation->toArray();
        }
    }
    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows); // مرتب‌سازی مجدد ایندکس‌ها
    }
    private function priorityMap($value)
    {
        // dd(  match ($value) {
        //     '1' => 'high',
        //     '2' => 'medium',
        //     '3' => 'low',
        //     '' => 'medium',
        // });
        // نگاشت عددی به مقدار ذخیره‌شده در دیتابیس
        return match ($value) {
            '1' => 'high',
            '2' => 'medium',
            '3' => 'low',
            '' => 'medium',
        };
    }

    public function updated($propertyName, $value)
    {

        // فقط وقتی اولویت رکورد ذخیره‌شده تغییر کرد
        if (str_starts_with($propertyName, 'savedReservations.')) {
            // استخراج index و field
            $parts = explode('.', $propertyName);
            $index = $parts[1];
            $field = $parts[2];

            if ($field === 'olaviat') {
                $reservationId = $this->savedReservations[$index]['id'];

                Reservation::where('id', $reservationId)->update([
                    'olaviat' => $value
                ]);
            }
        }
    }
    public function deleteReservation($id)
    {
        Reservation::findOrFail($id)->delete();

        // حذف از آرایه محلی هم برای ری‌ریندر صحیح
        $this->savedReservations = array_values(array_filter($this->savedReservations, function ($item) use ($id) {
            return $item['id'] != $id;
        }));
    }
    public function render()
    {
        return view('livewire.reservations.reserve');
    }
}
