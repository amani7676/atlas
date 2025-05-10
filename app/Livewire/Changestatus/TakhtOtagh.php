<?php

namespace App\Livewire\Changestatus;

use App\Models\Resident;
use App\Models\Takht;
use App\Services\DataServices;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class TakhtOtagh extends Component
{
    public $residents = [];
    public $takhts = [];
    public $selectedResident;
    public $residentDetails = null;
    public $takhtDetails = null;

    public function mount()
    {
        // دریافت لیست residents هنگام لود صفحه
        $this->loadResidents();
        $this->loadTakht();
    }

    public function loadResidents()
    {
        $this->residents = Resident::query()
            ->select('id', 'full_name')
            ->orderBy('otagh_id')
            ->get()
            ->toArray();
    }

    public function handleSelectChange($residentId)
    {

        // وقتی کاربر شخصی را انتخاب کرد
        if ($residentId) {
            $this->loadResidentDetails($residentId);
        }
    }
    public function loadResidentDetails($residentId)
    {

        $services = new DataServices();
        $this->residentDetails = $services->getResidentsByIds([$residentId])[0];
    }




    // برای تخت
    public function loadTakht()
    {
        $this->takhts = Takht::query()
            ->select('id', 'name')
            ->orderBy('id')
            ->get()
            ->toArray();
    }
    public function handleSelectChangeTakht($takhtId)
    {

        // وقتی اتاق شخصی را انتخاب کرد
        if ($takhtId) {
            $this->loadTakhtDetails($takhtId);
        }
    }
    public function loadTakhtDetails($takhtId)
    {

        $services = new DataServices();
        $this->takhtDetails = $services->getFullTakhtDetails($takhtId);
    }

    //ذخیره سازی
    public function storeResidentInfo()
    {


        if (!$this->takhtDetails || !$this->residentDetails) {
            session()->flash('error', 'هر دو تخت انتخاب شود!!');

            return;
        }
        if ($this->takhtDetails->name == $this->residentDetails['takht_name']) {
            session()->flash('error', 'هر دو سطر مطعلق به یک نفر میباشد');
            return;
        }
        $residentA = Resident::with('infoResident')->find($this->residentDetails['id']);
        $takhtB = Takht::find($this->takhtDetails->id);
        $takhtA = Takht::where('name', $this->residentDetails['takht_name'])->first();

        if ($residentA) {
            if ($this->takhtDetails->state == 'empty') {

                $residentA->takht_id = $this->takhtDetails->id;
                $residentA->otagh_id = $this->takhtDetails->otagh->id;
                $residentA->save();
                //takht
                $takhtA->state = 'empty';
                $takhtA->save();
                if ($this->residentDetails['state'] == 'active' || $this->residentDetails['state'] == 'leaving') {
                    $takhtB->state = 'full';
                } else if ($this->residentDetails['state'] == 'reserve') {
                    $takhtB->state = 'reserve';
                }
                session()->flash(key: 'success', value: 'کاربر فلانی به اتاق خالی فلانی جابجا شد');
                $takhtB->save();
                
                return;

                
            } else if ($this->takhtDetails->state == 'full' || $this->takhtDetails->state == 'reserve') {

                
                $residentB = Resident::with(['infoResident'])->find($takhtB->resident->id);

                // تخت و اتاق فعلی residentA
                $takhtA_id = $residentA->takht_id;
                $otaghA_id = $residentA->otagh_id;


                // تخت و اتاق جدید (تخت انتخاب‌شده)
                $takhtB_id = $takhtB->id;
                $otaghB_id = $takhtB->otagh->id;

                DB::beginTransaction();
                try {
                    // جابجا کردن residentA
                    $residentA->takht_id = $takhtB_id;
                    $residentA->otagh_id = $otaghB_id;
                    $residentA->save();
                    //takhtb
                    if($residentA->infoResident->state == 'full' || $residentA->infoResident->state == 'leaving'){
                        $takhtB->state = "full";
                    }else{
                        $takhtB->state = 'reserve';
                    }
                    $takhtB->save();
                    // جابجا کردن residentB اگر وجود داشته باشه
                    if ($residentB) {
                        $residentB->takht_id = $takhtA_id;
                        $residentB->otagh_id = $otaghA_id;
                        $residentB->save();
                        //takhtA
                        if($residentB->infoResident->state == 'full' || $residentB->infoResident->state == 'leaving'){
                            $takhtA->state = "full";
                        }else{
                            $takhtA->state = 'reserve';
                        }
                        $takhtA->save();
                    }

                    DB::commit();
                    session()->flash('success', 'جابجایی با موفقیت انجام شد.');
                } catch (\Exception $e) {
                    DB::rollBack();
                    session()->flash('error', 'خطا در جابجایی: ' . $e->getMessage());
                }
            }
        } else {
        }

        // فرض: می‌خواییم اطلاعات resident را به‌روزرسانی کنیم


    }


    public function render()
    {
        return view('livewire.changestatus.takht-otagh');
    }
}
