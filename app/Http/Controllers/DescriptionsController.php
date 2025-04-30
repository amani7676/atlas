<?php

namespace App\Http\Controllers;

use App\Models\Description;
use App\Models\Resident;
use Illuminate\Http\Request;

class DescriptionsController extends Controller
{
    public function GetDescriptions(Request $request, Resident $resident)
    {
        $resident = Resident::with('descriptions')->find($resident->id);

        if ($resident) {
            return response()->json($resident);
        }

        return response()->json(['message' => 'Resident not found'], 404);
    }

    public function AddDescriptions(Request $request)
    {
        // اعتبارسنجی داده‌ها
        $validated = $request->validate([
            'id_resident_modal_desc' => 'required|exists:residents,id',
            'text_desc_modal_desc' => 'required|string|max:255',
            'select_desc_modal_desc' => 'required|string|in:sarrsed,bedhey,khoroj,other',
        ]);

        // ذخیره توضیحات در دیتابیس
        $description = new Description();
        $description->resident_id = $validated['id_resident_modal_desc']; // مقدار id_resident_modal_desc
        $description->desc = $validated['text_desc_modal_desc'];
        $description->type = $validated['select_desc_modal_desc'];
        $description->save();

        notify()->success('توضیحات اضافه شد');
        // پس از ذخیره، می‌تونی به صفحه‌ای ارجاع بدی
        return redirect()->back();
    }

    public function DeleteDescriptions(Request $request, Description $description)
    {
        $descId = $request->input('id');

        // پیدا کردن توضیحات با استفاده از شناسه
        $description = Description::find($descId);

        if ($description) {
            // حذف توضیحات
            $description->delete();

            return response()->json([
                'type' => 'success',
                'message' => 'توضیحات با موفقیت حذف شد!'
            ]);
        } else {
            return response()->json([
                'type' => 'error',
                'message' => 'توضیحات یافت نشد.'
            ], 404);
        }
    }
}
