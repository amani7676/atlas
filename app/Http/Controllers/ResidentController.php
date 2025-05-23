<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Helpers\ShamsiHelper;
use App\Models\Otagh;
use App\Models\Resident;
use App\Models\Takht;
use App\Services\DataServices;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;
use TCPDF;

class ResidentController extends Controller
{

    protected $getResidentById;
    public function __construct(DataServices $dataServices)
    {
        $this->getResidentById = $dataServices;
    }

    public function updateQuick(Request $request, Resident $resident)
    {
        
        $rules = [
            'full_name' => 'required|string|min:1|max:255|', // نام نباید خالی یا فقط فاصله باشد
             'end_date' => ['required', 'regex:/^14\d{2}\/(0?[1-9]|1[0-2])\/(0?[1-9]|[12][0-9]|3[01])$/']
        ];
        // پیامهای سفارشی خطا
        $messages = [
            'full_name.required' => 'نام الزامی است.',
            'end_date.required' => 'تاریخ رو به درستی وارد نکردید'
        ];

        // اعتبارسنجی دادهها
        $validator = Validator::make($request->all(), $rules, $messages);


        // اگر اعتبارسنجی شکست بخورد
        if ($validator->fails()) {
            return response()->json([
                'data' => null,
                "type" => 'error',
                'message' => 'به مشکل برخورد کردید!'
            ]);
        }
        $resident->update([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'end_date' => $request->end_date,
        ]);
        // دریافت داده‌های تازه از دیتابیس
        $updatedResident = $resident->fresh();
        $result = $this->getResidentById->getResidentsByIds([$updatedResident->id]);
        if (!is_array($result) || empty($result)) {
            return response()->json([
                'type' => 'error',
                'message' => 'خطا در دریافت اطلاعات کاربر'
            ], 500);
        }


        $residentData = $result[0];

        // if (!is_object($residentData) || !property_exists($residentData, 'full_name')) {
        //     return response()->json([
        //         'type' => 'error',
        //         'message' => 'ساختار اطلاعات کاربر نامعتبر است'
        //     ], 500);
        // }

        return response()->json([
            'data' => $residentData,
            'type' => 'success',
            'message' => 'کاربر با موفقیت به‌روزرسانی شد'
        ]);
    }
    public function updateAll(Request $request, Resident $resident)
    {
        $arr = [$request->residentId];
        $resident = $this->getResidentById->getResidentsByIds($arr);

        return response()->json([
            "data" => $resident,
            "type" => 'success',
            'message' => 'کاربر  با موفقیت اپدیت شد',

        ]);
    }

    public function update(Request $request)
    {

        // یافتن رزیدنت بر اساس ID
        $resident = Resident::findOrFail($request->id);
        // یافتن اطلاعات مرتبط رزیدنت
        $residentInfo = $resident->infoResident;


        $resident->update([
            'otagh_name' => $request->otagh_name_collapse,
            'takht_name' => $request->takht_name_collapse,
        ]);
        //تغییر وضعیت تخت با اقامتگر

        // بروزرسانی فیلدهای رزیدنت اینفو (جدول resident_infos)
        $residentInfo->update([
            'job' => $request->job_collapse,
            'age' => $request->age_collapse,
            'madrak' => $request->has('madrak_collapse') ? 1 : 0,
            'form' => $request->has('form_collapse') ? 1 : 0,
            'vadeh' => $request->has('vadeh_collapse') ? 1 : 0,
            'ejareh' => $request->has('ajareh_collapse') ? 1 : 0,
            'state' => $request->state_collapse,
        ]);
        $takht = Takht::find($resident->takht_id);
        if ($request->state_collapse == 'active' || $request->state_collapse == 'leaving') {
            $takht->update([
                'state' => 'full'
            ]);
        } else if ($request->state_collapse == 'reserve') {
            $takht->update([
                'state' => 'reserve'
            ]);
        } else if ($request->state_collapse == 'nightly') {
            $takht->update([
                'state' => 'full'
            ]);
        }

        notify()->success('مشخصات ' . $resident->full_name . ' تغییر یافت');

        return redirect()->back()->with('success', 'اطلاعات با موفقیت آپدیت شد!');
    }


    public function AddResident(Request $request)
    {
        if (!preg_match('/^14\d{2}\/(0?[1-9]|1[0-2])\/(0?[1-9]|[12][0-9]|3[01])$/', $request->end_date_add)) {
            notify()->error('تاریخ  رو به درستی وارد کنید!');
            return redirect()->back();
        }
        $phone_add = str_replace("-", "", $request->phone_add);

        // بررسی وجود کاربر با نام یا تلفن یکسان
        $existingUser = Resident::where('full_name', $request->full_name_add)
            ->first();
        if ($existingUser) {
            notify()->error('کاربر ' . $request->full_name_add . ' در خوابگاه هست');
            return redirect()->back();
        }

        // جستجوی تخت و اتاق
        $takht = Takht::where('name', $request->takht_name_add)->first();
        $otagh = Otagh::where('name', $request->otagh_name_add)->first();
        if (!$takht || !$otagh) {
            notify()->error('اتاق و تخت پیدا نشد!!');
            return redirect()->back();
        }
        //چک کن ببین شخص دیگه ایی این تخت رو نداره؟
        $check_takht = Resident::where('takht_id', $takht->id)->exists();
        if ($check_takht) {
            notify()->error('این تخت قبلا انتخاب شده !!!');
            return redirect()->back();
        }
        //ست کردن چک باکس ها
        $vadeh_add = $request->vadeh_add === 'on' ? 1 : 0;
        $ejareh_add = $request->ejareh_add === 'on' ? 1 : 0;
        $madrak_add = $request->madrak_add === 'on' ? 1 : 0;
        $form_add = $request->form_add === 'on' ? 1 : 0;
        // dd($request->all(), $request->desc_text_add, $request->desc_type_add);

        // ذخیره اطلاعات
        try {
            $data = Resident::create([
                'full_name' => $request->full_name_add,
                'phone' => $phone_add,
                'end_date' => $request->end_date_add,
                'start_date' => ShamsiHelper::toShamsi(now()),
                'takht_id' => $takht->id,
                'otagh_id' => $otagh->id,
                'created_at ' => now(),
            ]);


            $data->infoResident()->create([
                'state' => $request->state_add,
                'job' => $request->job_add,
                'age' => $request->age_add,
                'vadeh' => $vadeh_add,
                'ejareh' => $ejareh_add,
                'madrak' => $madrak_add,
                'form' => $form_add,
                'created_at' => now(),
            ]);
            if (!is_null($request->desc_text_add)) {
                $data->descriptions()->create([
                    'desc' => $request->desc_text_add,
                    'type' => $request->desc_type_add
                ]);
            }
            //change state takht
            if ($request->state_add == 'active' || $request->state_add == 'leaving') {
                $takht->state = 'full'; // مقدار جدید برای وضعیت
                $takht->save();
            } else if ($request->state_add == 'reserve') {
                $takht->state = 'reserve'; // مقدار جدید برای وضعیت
                $takht->save();
            } else if ($request->state_add == 'nightly') {
                $takht->state = 'full'; // مقدار جدید برای وضعیت
                $takht->save();
            }

            notify()->success('کاربر با موفقیت اضافه شد');
            return redirect()->back();
        } catch (\Exception $e) {

            dd($e->getMessage());
        }
    }

    public function ForceDelete($id)
    {
        $resident = Resident::find($id); // پیدا کردن رکورد با ID مشخص
        if ($resident) {
            $resident->infoResident->update([
                'state' => 'exit'
            ]);
            $resident->infoResident->forceDelete();
            $resident->forceDelete(); // حذف کامل رکورد از دیتابیس
            $takht = Takht::find($resident->takht_id);
            $takht->update([
                'state' => 'empty',
            ]);
        }


        emotify('error', 'اقامتگر حذف شد');
        return redirect()->back();
    }
    public function SoftDelete($id)
    {
        $resident = Resident::find($id); // پیدا کردن رکورد با ID مشخص
        if ($resident) {
            $resident->infoResident->update([
                'state' => 'exit'
            ]);
            $resident->infoResident->delete();
            $resident->delete(); // حذف نرم رکورد
            $takht = Takht::find($resident->takht_id);
            $takht->update([
                'state' => 'empty',
            ]);
        }

        emotify('success', 'اقامتگر در لیست خروج قرار گرفت');
        return redirect()->back();
    }

    public function ChangeFM(Request $request)
    {

        // یافتن رزیدنت و اطلاعات مرتبط
        $resident = Resident::findOrFail($request->id);
        if ($resident) {
            $resident->infoResident()->update([
                $request->name => 1
            ]);
        }
        emotify('success', '' . $request->getScriptName . ' دریافت شد');
        return redirect()->back();
    }

    public function reportPdf()
    {
        $data = $this->getResidentById->getAllData();
        // تنظیمات PDF برای پشتیبانی از فارسی
        $config = [
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => 0,
            'margin_footer' => 0,
            'margin_top' => 25,
            'margin_bottom' => 25,
            'margin_left' => 15,
            'margin_right' => 15,
            'default_font_size' => 12,
            'default_font' => 'vazir',
            'orientation' => 'P',
            'direction' => 'rtl', // تنظیم جهت راست به چپ
            'tempDir' => storage_path('app/mpdf')
        ];
        $pdf = LaravelMpdf::loadView('other.pdf.listallresidents', ['data' => $data], [], $config);
        // برای دانلود مستقیم
        return $pdf->download('گزارش.pdf');
    }
}
